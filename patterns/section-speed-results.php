<?php
/**
 * Title: Speed test: full results
 * Slug: wp-elite/section-speed-results
 * Categories: wp-elite, about
 * Keywords: speed, test, results, table, lighthouse
 * Description: Every number of the speed test: the heading, then an Elite Accordion (closed) holding a table (metric, Arcnest, Elementor, difference; groups for the home page, pricing page, blog post, server and desktop; a core Table, edited in place) and a note on where the figures come from. Section class elite-section--speed-results.
 *
 * @package WpElite
 */

/**
 * "x s sooner", from the rounded figures shown (readers subtract them).
 *
 * @param string $ours   Our time, e.g. "3.0 s".
 * @param string $theirs Elementor's time.
 */
$wp_elite_sooner = static fn ( string $ours, string $theirs ): string => sprintf(
	/* translators: %s: seconds. */
	__( '%s s sooner', 'wp-elite' ),
	number_format_i18n( round( (float) $theirs - (float) $ours, 1 ), 1 )
);

// Metric, Arcnest, Elementor, difference. A row with only a label starts a
// group (styled as a heading row).
$wp_elite_rows = array(
	array( __( 'Home page', 'wp-elite' ), '', '', '' ),
	array( __( 'Performance score', 'wp-elite' ), '96', '91', __( '+5 points', 'wp-elite' ) ),
	array( __( 'First content shown (FCP)', 'wp-elite' ), '1.1 s', '1.4 s', $wp_elite_sooner( '1.1 s', '1.4 s' ) ),
	array( __( 'Page weight', 'wp-elite' ), '351 KB', '698 KB', __( 'Half the weight', 'wp-elite' ) ),
	array( __( 'JavaScript', 'wp-elite' ), '223 KB', '472 KB', __( '53% less', 'wp-elite' ) ),
	array( __( 'Requests', 'wp-elite' ), '41', '89', __( '54% fewer', 'wp-elite' ) ),
	array( __( 'HTML elements', 'wp-elite' ), '1,044', '1,476', __( '29% fewer', 'wp-elite' ) ),
	array( __( 'Accessibility score', 'wp-elite' ), '100', '88', __( '+12 points', 'wp-elite' ) ),
	array( __( 'Pricing page', 'wp-elite' ), '', '', '' ),
	array( __( 'Performance score', 'wp-elite' ), '84', '76', __( '+8 points', 'wp-elite' ) ),
	array( __( 'Largest element shown (LCP)', 'wp-elite' ), '3.9 s', '4.8 s', $wp_elite_sooner( '3.9 s', '4.8 s' ) ),
	array( __( 'Page weight', 'wp-elite' ), '339 KB', '599 KB', __( '43% lighter', 'wp-elite' ) ),
	array( __( 'JavaScript', 'wp-elite' ), '246 KB', '455 KB', __( '46% less', 'wp-elite' ) ),
	array( __( 'Blog post', 'wp-elite' ), '', '', '' ),
	array( __( 'Performance score', 'wp-elite' ), '92', '88', __( '+4 points', 'wp-elite' ) ),
	array( __( 'Page weight', 'wp-elite' ), '321 KB', '575 KB', __( '44% lighter', 'wp-elite' ) ),
	array( __( 'Requests', 'wp-elite' ), '19', '56', __( '66% fewer', 'wp-elite' ) ),
	array( __( 'Accessibility score', 'wp-elite' ), '100', '87', __( '+13 points', 'wp-elite' ) ),
	array( __( 'The server (same hosting, no page cache)', 'wp-elite' ), '', '', '' ),
	array( __( 'Pages a second, at the plan’s limit', 'wp-elite' ), '6.2–7.2', '4.1–4.6', __( 'About 50% more', 'wp-elite' ) ),
	array( __( 'Server time, blog post', 'wp-elite' ), '172 ms', '386 ms', __( '2.2× faster', 'wp-elite' ) ),
	array( __( 'Server time, blog page', 'wp-elite' ), '190 ms', '463 ms', __( '2.4× faster', 'wp-elite' ) ),
	array( __( 'Desktop', 'wp-elite' ), '', '', '' ),
	array( __( 'Performance score (3 pages)', 'wp-elite' ), '95–97', '94–95', __( 'About even', 'wp-elite' ) ),
);

// The rows as the Table block saves them (one line, no spaces between tags).
$wp_elite_body = '';
foreach ( $wp_elite_rows as $wp_elite_row ) {
	$wp_elite_body .= '' === $wp_elite_row[1]
		? sprintf( '<tr><td><strong>%s</strong></td><td></td><td></td><td></td></tr>', esc_html( $wp_elite_row[0] ) )
		: sprintf(
			'<tr><td>%1$s</td><td><strong>%2$s</strong></td><td>%3$s</td><td>%4$s</td></tr>',
			esc_html( $wp_elite_row[0] ),
			esc_html( $wp_elite_row[1] ),
			esc_html( $wp_elite_row[2] ),
			esc_html( $wp_elite_row[3] )
		);
}
?>
<!-- wp:elite/section {"label":"Speed test results","className":"elite-section--speed-results"} -->
<section class="elite-section alignfull elite-section--speed-results"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Every number', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'The full results', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/accordion {"start":"none","indicator":"plus","className":"elite-accordion\u002d\u002dspeed-results"} -->
<!-- wp:elite/accordion-item {"title":"<?php echo esc_attr__( 'Open the full table: three pages, the server and desktop', 'wp-elite' ); ?>"} -->
<!-- wp:elite/accordion-body -->
<!-- wp:table {"hasFixedLayout":false,"className":"core-table--speed"} -->
<figure class="wp-block-table core-table--speed"><table><thead><tr><th><?php esc_html_e( 'Metric (mobile)', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Arcnest', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Elementor Pro', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Difference', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--speed-note"} -->
<p class="elite-paragraph elite-paragraph--speed-note"><?php esc_html_e( 'Google PageSpeed Insights (Lighthouse 13.6), mobile unless noted, median of 5 runs per page, taking turns between the sites, November 2026. Server figures: requests from the hosting server itself to each site, unique addresses so nothing was cached.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->
<!-- /wp:elite/accordion-body -->
<!-- /wp:elite/accordion-item -->
<!-- /wp:elite/accordion --></div></div></section>
<!-- /wp:elite/section -->
