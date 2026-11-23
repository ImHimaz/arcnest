<?php
/**
 * Title: Speed test: phones
 * Slug: wp-elite/section-speed-phones
 * Categories: wp-elite, about
 * Keywords: speed, test, phone, budget, taps, inp
 * Description: The home page on a mid-range and a budget phone, and how fast taps respond: the heading and a line, a table (metric, Arcnest, Elementor, difference; groups per phone and for taps; a core Table, edited in place) and a note. The full results' look: section class elite-section--speed-results, ID phones.
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
	array( __( 'Mid-range phone (CPU 4× slower, 1.6 Mbps)', 'wp-elite' ), '', '', '' ),
	array( __( 'First content shown', 'wp-elite' ), '3.0 s', '3.4 s', $wp_elite_sooner( '3.0 s', '3.4 s' ) ),
	array( __( 'Main element shown', 'wp-elite' ), '3.0 s', '3.7 s', $wp_elite_sooner( '3.0 s', '3.7 s' ) ),
	array( __( 'Fully loaded', 'wp-elite' ), '5.3 s', '7.6 s', $wp_elite_sooner( '5.3 s', '7.6 s' ) ),
	array( __( 'Budget phone (CPU 6× slower, 0.75 Mbps)', 'wp-elite' ), '', '', '' ),
	array( __( 'First content shown', 'wp-elite' ), '3.2 s', '3.6 s', $wp_elite_sooner( '3.2 s', '3.6 s' ) ),
	array( __( 'Main element shown', 'wp-elite' ), '3.2 s', '4.1 s', $wp_elite_sooner( '3.2 s', '4.1 s' ) ),
	array( __( 'Fully loaded', 'wp-elite' ), '7.1 s', '10.6 s', $wp_elite_sooner( '7.1 s', '10.6 s' ) ),
	array( __( 'Main thread blocked while loading', 'wp-elite' ), '291 ms', '397 ms', __( '27% less', 'wp-elite' ) ),
	array( __( 'Taps on the budget phone (until the screen responds)', 'wp-elite' ), '', '', '' ),
	array( __( 'Switch a tab', 'wp-elite' ), '32 ms', '80 ms', __( '2.5× quicker', 'wp-elite' ) ),
	array( __( 'Open an FAQ answer', 'wp-elite' ), '40 ms', '56 ms', __( '16 ms quicker', 'wp-elite' ) ),
	array( __( 'Open the menu', 'wp-elite' ), '64 ms', '64 ms', __( 'Even', 'wp-elite' ) ),
	array( __( 'Close the menu', 'wp-elite' ), '48 ms', '32 ms', __( '16 ms slower', 'wp-elite' ) ),
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
<!-- wp:elite/section {"label":"Speed test phones","anchor":"phones","className":"elite-section--speed-results"} -->
<section class="elite-section alignfull elite-section--speed-results" id="phones"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'On a cheaper phone', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'The slower the phone, the bigger the gap', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:table {"hasFixedLayout":false,"className":"core-table--speed"} -->
<figure class="wp-block-table core-table--speed"><table><thead><tr><th><?php esc_html_e( 'Home page, first visit', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Arcnest', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Elementor Pro', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Difference', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--speed-note"} -->
<p class="elite-paragraph elite-paragraph--speed-note"><?php esc_html_e( 'Measured in Chrome from Colombo to our US server, no cache, the median of five runs per site, taking turns. Taps are timed the way Google’s INP is: from the tap to the next frame on screen. Both sites stay well inside Google’s 200 ms “good” limit for taps.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div></section>
<!-- /wp:elite/section -->
