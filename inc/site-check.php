<?php
/**
 * "Check your site" (pattern section-check): a REST route that runs Google's
 * PageSpeed test on phones for a visitor's address, so the API key stays on
 * the server.
 *
 *   POST /wp-json/arcnest/v1/check  { "url": "https://example.com" }
 *   → { url, performance, accessibility, lcp, weight }
 *
 * The key: define( 'ARCNEST_PSI_KEY', '…' ); in wp-config.php (never in the
 * theme). Without it the test still runs, on Google's small keyless quota.
 *
 * Limits: 5 tests an hour per visitor and 300 a day in all (the key's quota
 * is 25,000 a day); each address's result is kept for 12 hours. Nothing about
 * the visitor is stored beyond a hashed counter that expires in an hour.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\Site\Check;

const PER_VISITOR = 5;
const PER_DAY     = 300;
const KEEP        = 12 * HOUR_IN_SECONDS;

add_action(
	'rest_api_init',
	static function (): void {
		register_rest_route(
			'arcnest/v1',
			'/check',
			array(
				'methods'             => 'POST',
				'callback'            => __NAMESPACE__ . '\\check',
				'permission_callback' => '__return_true',
				'args'                => array(
					'url' => array(
						'type'     => 'string',
						'required' => true,
					),
				),
			)
		);
	}
);

/**
 * The address to test, or null: http(s) only, a public host (WordPress
 * refuses local and private addresses), no login details in it.
 *
 * @param string $raw What the visitor typed.
 */
function visitor_url( string $raw ): ?string {
	$raw = trim( $raw );
	if ( '' === $raw || strlen( $raw ) > 200 ) {
		return null;
	}
	if ( ! preg_match( '#^https?://#i', $raw ) ) {
		$raw = 'https://' . $raw;
	}
	$url   = esc_url_raw( $raw, array( 'http', 'https' ) );
	$parts = wp_parse_url( $url );
	if ( ! $url || empty( $parts['host'] ) || isset( $parts['user'] ) || isset( $parts['pass'] ) || ! str_contains( $parts['host'], '.' ) ) {
		return null;
	}

	return wp_http_validate_url( $url ) ? $url : null;
}

/**
 * Count one use against a limit; false once it's reached.
 *
 * @param string $key    Transient name.
 * @param int    $limit  Uses allowed.
 * @param int    $period Seconds.
 */
function within_limit( string $key, int $limit, int $period ): bool {
	$count = (int) get_transient( $key );
	if ( $count >= $limit ) {
		return false;
	}
	set_transient( $key, $count + 1, $period );

	return true;
}

/**
 * Run the test (or return the kept result).
 *
 * @param \WP_REST_Request $request The request.
 * @return \WP_REST_Response|\WP_Error
 */
function check( \WP_REST_Request $request ) {
	$url = visitor_url( (string) $request->get_param( 'url' ) );
	if ( null === $url ) {
		return new \WP_Error( 'check_url', __( 'That doesn’t look like a public website address. Try something like yourwebsite.com.', 'wp-elite' ), array( 'status' => 400 ) );
	}

	$kept_key = 'arcnest_check_' . md5( untrailingslashit( strtolower( $url ) ) );
	$kept     = get_transient( $kept_key );
	if ( is_array( $kept ) ) {
		return rest_ensure_response( $kept );
	}

	$visitor = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	if ( ! within_limit( 'arcnest_check_v_' . md5( wp_salt() . $visitor ), PER_VISITOR, HOUR_IN_SECONDS ) ) {
		return new \WP_Error( 'check_busy', __( 'You’ve run a few tests already. Please try again in an hour.', 'wp-elite' ), array( 'status' => 429 ) );
	}
	if ( ! within_limit( 'arcnest_check_day_' . gmdate( 'Ymd' ), PER_DAY, DAY_IN_SECONDS ) ) {
		return new \WP_Error( 'check_busy', __( 'Our free checks are used up for today. Please try again tomorrow.', 'wp-elite' ), array( 'status' => 429 ) );
	}

	$query = array(
		'url'      => $url,
		'strategy' => 'mobile',
	);
	if ( defined( 'ARCNEST_PSI_KEY' ) && ARCNEST_PSI_KEY ) {
		$query['key'] = ARCNEST_PSI_KEY;
	}
	$api = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?' . http_build_query( $query ) . '&category=performance&category=accessibility';

	// The test takes 15–60 s.
	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 120 ); // phpcs:ignore Squiz.PHP.DiscouragedFunctions.Discouraged -- A long outside request, on purpose.
	}
	$response = wp_remote_get( $api, array( 'timeout' => 100 ) );
	$data     = is_wp_error( $response ) ? null : json_decode( wp_remote_retrieve_body( $response ), true );
	$lh       = is_array( $data ) ? ( $data['lighthouseResult'] ?? null ) : null;

	if ( ! is_array( $lh ) || ! isset( $lh['categories']['performance']['score'] ) ) {
		return new \WP_Error( 'check_failed', __( 'We couldn’t test that site. Check the address, or try again in a minute.', 'wp-elite' ), array( 'status' => 502 ) );
	}

	$audits = $lh['audits'] ?? array();
	$result = array(
		'url'           => $url,
		'performance'   => (int) round( (float) $lh['categories']['performance']['score'] * 100 ),
		'accessibility' => isset( $lh['categories']['accessibility']['score'] ) ? (int) round( (float) $lh['categories']['accessibility']['score'] * 100 ) : null,
		'lcp'           => isset( $audits['largest-contentful-paint']['numericValue'] ) ? round( (float) $audits['largest-contentful-paint']['numericValue'] / 1000, 1 ) : null,
		'weight'        => isset( $audits['total-byte-weight']['numericValue'] ) ? (int) round( (float) $audits['total-byte-weight']['numericValue'] / 1024 ) : null,
	);
	set_transient( $kept_key, $result, KEEP );

	return rest_ensure_response( $result );
}
