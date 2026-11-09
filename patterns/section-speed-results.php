<?php
/**
 * Title: Speed test: full results
 * Slug: wp-elite/section-speed-results
 * Categories: wp-elite, about
 * Keywords: speed, test, results, table, lighthouse
 * Description: Every number of the speed test: the heading and a line, a table (metric, Arcnest, Elementor, difference; a core Table, edited in place) and a note on where the figures come from. Section class elite-section--speed-results.
 *
 * @package WpElite
 */

// Metric, Arcnest, Elementor, difference.
$wp_elite_rows = array(
	array( __( 'Performance score', 'wp-elite' ), '98', '89', __( '+9 points', 'wp-elite' ) ),
	array( __( 'First content shown (FCP)', 'wp-elite' ), '0.9 s', '2.3 s', __( '2.5× sooner', 'wp-elite' ) ),
	array( __( 'Main image shown (LCP)', 'wp-elite' ), '2.3 s', '3.4 s', __( '1.1 s sooner', 'wp-elite' ) ),
	array( __( 'Page fully drawn (Speed Index)', 'wp-elite' ), '0.9 s', '2.3 s', __( '2.4× sooner', 'wp-elite' ) ),
	array( __( 'Blocking time (TBT)', 'wp-elite' ), '0 ms', '15 ms', __( 'Both fine', 'wp-elite' ) ),
	array( __( 'Layout shift (CLS)', 'wp-elite' ), '0', '0', __( 'Both fine', 'wp-elite' ) ),
	array( __( 'Requests', 'wp-elite' ), '30', '66', __( '55% fewer', 'wp-elite' ) ),
	array( __( 'Page weight', 'wp-elite' ), '212 KB', '492 KB', __( '57% lighter', 'wp-elite' ) ),
	array( __( 'JavaScript', 'wp-elite' ), '30 KB', '293 KB', __( '90% less', 'wp-elite' ) ),
	array( __( 'CSS files', 'wp-elite' ), '1', '22', __( '21 fewer', 'wp-elite' ) ),
	array( __( 'HTML elements', 'wp-elite' ), '598', '847', __( '29% fewer', 'wp-elite' ) ),
);

// The rows as the Table block saves them (one line, no spaces between tags).
$wp_elite_body = '';
foreach ( $wp_elite_rows as $wp_elite_row ) {
	$wp_elite_body .= sprintf(
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

<!-- wp:table {"hasFixedLayout":false,"className":"core-table--speed"} -->
<figure class="wp-block-table core-table--speed"><table><thead><tr><th><?php esc_html_e( 'Metric (mobile)', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Arcnest', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Elementor Pro', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Difference', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--speed-note"} -->
<p class="elite-paragraph elite-paragraph--speed-note"><?php esc_html_e( 'Draft figures from our local test (Lighthouse 13.5, mobile, median of 5 runs). They will be replaced with PageSpeed Insights results from our server.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div></section>
<!-- /wp:elite/section -->
