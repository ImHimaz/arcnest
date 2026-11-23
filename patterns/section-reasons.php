<?php
/**
 * Title: Why Arcnest
 * Slug: wp-elite/section-reasons
 * Categories: wp-elite, about
 * Keywords: why, reasons, comparison, table, page builder
 * Description: "A website that works as hard as your team": the heading, four reasons in one bordered strip (built to convert, fast by default, yours outright, easy to edit), then a table comparing Arcnest with a typical page-builder site (a Table block: the Arcnest column is highlighted; the caption names the sources). Section class elite-section--reasons, ID reasons.
 *
 * @package WpElite
 */

/**
 * One reason: number, title and line.
 *
 * @param string $num   Number.
 * @param string $title Title.
 * @param string $text  Line.
 */
$wp_elite_reason = static function ( string $num, string $title, string $text ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--reason"} -->
<div class="elite-div elite-div--reason"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--reason-num"} -->
<p class="elite-paragraph elite-paragraph--reason-num"><?php echo esc_html( $num ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":3,"textStyle":"title-4"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->
	<?php
};

// The comparison: label, Arcnest, a typical page-builder site.
$wp_elite_rows = array(
	array( __( 'Yearly licence to keep it running', 'wp-elite' ), __( 'None', 'wp-elite' ), __( '$60–$228 a year (Elementor Pro)', 'wp-elite' ) ),
	array( __( 'Mobile speed', 'wp-elite' ), __( 'Passes Core Web Vitals', 'wp-elite' ), __( '36% of Elementor sites pass', 'wp-elite' ) ),
	array( __( 'Who can work on it', 'wp-elite' ), __( 'Any WordPress developer', 'wp-elite' ), __( 'Developers who know that builder', 'wp-elite' ) ),
	array( __( 'Editing', 'wp-elite' ), __( 'WordPress’s own editor, custom blocks', 'wp-elite' ), __( 'Builder panels, easy to break the layout', 'wp-elite' ) ),
	array( __( 'If you leave us', 'wp-elite' ), __( 'Everything keeps working', 'wp-elite' ), __( 'Leaving the builder means a rebuild', 'wp-elite' ) ),
);
$wp_elite_body = '';
foreach ( $wp_elite_rows as $wp_elite_row ) {
	$wp_elite_body .= '<tr><td>' . esc_html( $wp_elite_row[0] ) . '</td><td>' . esc_html( $wp_elite_row[1] ) . '</td><td>' . esc_html( $wp_elite_row[2] ) . '</td></tr>';
}
?>
<!-- wp:elite/section {"label":"Why Arcnest","anchor":"reasons","className":"elite-section--reasons"} -->
<section class="elite-section alignfull elite-section--reasons" id="reasons"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Why Arcnest', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2","className":"elite-heading--reasons-title"} -->
<h2 class="elite-heading elite-heading--reasons-title" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'A website that works as hard as your team', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/div {"className":"elite-div--reasons-grid"} -->
<div class="elite-div elite-div--reasons-grid"><div class="div-inner">
<?php
$wp_elite_reason( '01', __( 'Built to convert', 'wp-elite' ), __( 'Clear messages, simple paths and forms that work, so visitors know what to do next.', 'wp-elite' ) );
echo "\n";
$wp_elite_reason( '02', __( 'Fast by default', 'wp-elite' ), __( 'Lean code that passes Core Web Vitals on phones, measured before and after.', 'wp-elite' ) );
echo "\n";
$wp_elite_reason( '03', __( 'Yours outright', 'wp-elite' ), __( 'No page builder and no licence fees. You own the site and the code, for good.', 'wp-elite' ) );
echo "\n";
$wp_elite_reason( '04', __( 'Easy to edit', 'wp-elite' ), __( 'Your team edits in WordPress’s own editor, with blocks made for your content.', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:table {"className":"core-table--compare"} -->
<figure class="wp-block-table core-table--compare"><table class="has-fixed-layout"><thead><tr><th></th><th><?php esc_html_e( 'Arcnest', 'wp-elite' ); ?></th><th><?php esc_html_e( 'Typical page-builder site', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table><figcaption class="wp-element-caption"><?php esc_html_e( 'Prices from elementor.com, Nov 2026. Pass rates from the HTTP Archive Technology Report, Sept 2026.', 'wp-elite' ); ?></figcaption></figure>
<!-- /wp:table --></div></div></section>
<!-- /wp:elite/section -->
