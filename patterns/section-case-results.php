<?php
/**
 * Title: Case study: results
 * Slug: wp-elite/section-case-results
 * Categories: wp-elite, about
 * Keywords: case study, results, before, after, table
 * Description: A case study's numbers: the heading, three headline changes as big figures, then a before / after / change table (mobile PageSpeed, accessibility, LCP, page weight, requests, plugins, yearly licences). Measure both sites the same way (PageSpeed Insights, mobile, median of 5 runs) and replace every [placeholder]. Section class elite-section--case-results, ID results.
 *
 * @package WpElite
 */

/**
 * One headline figure.
 *
 * @param string $number The change.
 * @param string $text   What changed.
 */
$wp_elite_figure = static function ( string $number, string $text ): void {
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":4}}} -->
<div class="elite-column col-12 col-md-4"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--case-figure"} -->
<div class="elite-div elite-div--case-figure"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--case-figure-number"} -->
<p class="elite-paragraph elite-paragraph--case-figure-number"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};

$wp_elite_rows = array(
	array( __( 'Mobile PageSpeed score', 'wp-elite' ), '[38]', '[94]', '[+56]' ),
	array( __( 'Accessibility score', 'wp-elite' ), '[81]', '[100]', '[+19]' ),
	array( __( 'Main content shown (LCP)', 'wp-elite' ), '[4.6 s]', '[1.4 s]', '[3.2 s sooner]' ),
	array( __( 'Page weight', 'wp-elite' ), '[3.1 MB]', '[0.6 MB]', '[−81%]' ),
	array( __( 'Requests', 'wp-elite' ), '[118]', '[34]', '[−84]' ),
	array( __( 'Active plugins', 'wp-elite' ), '[27]', '[9]', '[−18]' ),
	array( __( 'Yearly licences', 'wp-elite' ), '[$249]', '[$0]', '[−$249]' ),
);
$wp_elite_body = '';
foreach ( $wp_elite_rows as $wp_elite_row ) {
	$wp_elite_body .= sprintf( '<tr><td>%1$s</td><td>%2$s</td><td><strong>%3$s</strong></td><td>%4$s</td></tr>', esc_html( $wp_elite_row[0] ), esc_html( $wp_elite_row[1] ), esc_html( $wp_elite_row[2] ), esc_html( $wp_elite_row[3] ) );
}
?>
<!-- wp:elite/section {"label":"Case study results","anchor":"results","className":"elite-section--case-results"} -->
<section class="elite-section alignfull elite-section--case-results" id="results"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Results', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Before and after', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/row {"className":"elite-row--case-figures"} -->
<div class="elite-row row elite-row--case-figures">
<?php
$wp_elite_figure( __( '[+56]', 'wp-elite' ), __( '[points on the mobile PageSpeed score, from 38 to 94]', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( __( '[3.2 s]', 'wp-elite' ), __( '[sooner to show the main content on a phone]', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( __( '[$249]', 'wp-elite' ), __( '[a year saved on plugin and builder licences]', 'wp-elite' ) );
?>
</div>
<!-- /wp:elite/row -->

<!-- wp:table {"hasFixedLayout":false,"className":"core-table--case"} -->
<figure class="wp-block-table core-table--case"><table><thead><tr><th><?php esc_html_e( 'Home page (mobile)', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Before', 'wp-elite' ); ?></th><th><?php esc_html_e( 'After', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Change', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--case-note"} -->
<p class="elite-paragraph elite-paragraph--case-note"><?php esc_html_e( '[Google PageSpeed Insights, mobile, median of 5 runs per site, before: Month Year, after: Month Year.]', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div></section>
<!-- /wp:elite/section -->
