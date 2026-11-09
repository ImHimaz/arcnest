<?php
/**
 * Title: Our theme
 * Slug: wp-elite/section-theme
 * Categories: wp-elite, about
 * Keywords: theme, foundation, features, checklist, blocks
 * Description: "Our foundation": the heading, a line and a checklist, beside a dark "Arcnest blocks" panel with a grid of block tiles (a list: Enter adds a tile). The checks and tiles come in one by one. Section class elite-section--theme, ID theme.
 *
 * @package WpElite
 */

/**
 * A core List's items.
 *
 * @param string[] $items Item texts.
 */
$wp_elite_items = static fn ( array $items ): string => implode( "\n\n", array_map( static fn ( string $item ): string => "<!-- wp:list-item -->\n<li>" . esc_html( $item ) . "</li>\n<!-- /wp:list-item -->", $items ) );

$wp_elite_checks = array(
	__( 'No page builder bloat', 'wp-elite' ),
	__( 'Custom blocks for every type of section', 'wp-elite' ),
	__( 'Edit everything in the native WordPress editor', 'wp-elite' ),
	__( 'Clean code that you fully own', 'wp-elite' ),
);
$wp_elite_tiles  = array(
	__( 'Hero', 'wp-elite' ),
	__( 'Features', 'wp-elite' ),
	__( 'Stats', 'wp-elite' ),
	__( 'Logo strip', 'wp-elite' ),
	__( 'Cards', 'wp-elite' ),
	__( 'Tabs', 'wp-elite' ),
	__( 'Timeline', 'wp-elite' ),
	__( 'FAQ', 'wp-elite' ),
	__( 'CTA', 'wp-elite' ),
);
?>
<!-- wp:elite/section {"label":"Theme","anchor":"theme","className":"elite-section--theme"} -->
<section class="elite-section alignfull elite-section--theme" id="theme"><div class="section-inner"><div class="container"><!-- wp:elite/row {"flex":{"desktop":{"align":"center"}}} -->
<div class="elite-row row has-e-align" style="--e-align:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6}}} -->
<div class="elite-column col-12 col-lg-6"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Our foundation', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Every site starts on our own block theme', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--theme-lead"} -->
<p class="elite-paragraph elite-paragraph--theme-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We don’t rent speed from a page builder. Arcnest sites are built on our own lightweight block theme and custom blocks library, so every page starts fast and stays easy to edit.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--checks"} -->
<ul class="wp-block-list core-list--checks">
<?php echo $wp_elite_items( $wp_elite_checks ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Each item escaped. ?>
</ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5,"offset":1}},"className":"elite-column--theme-visual"} -->
<div class="elite-column col-12 col-lg-5 offset-lg-1 elite-column--theme-visual"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--theme-panel"} -->
<div class="elite-div elite-div--theme-panel"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--theme-panel-top"} -->
<div class="elite-div elite-div--theme-panel-top"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--theme-panel-title"} -->
<p class="elite-paragraph elite-paragraph--theme-panel-title"><?php esc_html_e( 'Arcnest blocks', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--theme-panel-tag"} -->
<p class="elite-paragraph elite-paragraph--theme-panel-tag"><?php esc_html_e( 'Native Gutenberg', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--theme-search"} -->
<p class="elite-paragraph elite-paragraph--theme-search"><?php esc_html_e( 'Search blocks…', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--theme-blocks"} -->
<ul class="wp-block-list core-list--theme-blocks">
<?php echo $wp_elite_items( $wp_elite_tiles ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Each item escaped. ?>
</ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
