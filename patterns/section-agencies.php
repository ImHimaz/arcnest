<?php
/**
 * Title: For agencies
 * Slug: wp-elite/section-agencies
 * Categories: wp-elite, call-to-action
 * Keywords: agencies, white-label, partners
 * Description: "For agencies": a purple box with an eyebrow, the heading, a line and two buttons (to the White-label page), beside four points on a darker panel (a list: Enter adds one). Section class elite-section--agencies, ID agencies.
 *
 * @package WpElite
 */

/**
 * An Elite Button's block comment.
 *
 * @param array<string, mixed> $attributes Button attributes.
 */
$wp_elite_button = static function ( array $attributes ): void {
	echo '<!-- wp:elite/button ' . wp_json_encode( $attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded.
};
?>
<!-- wp:elite/section {"label":"For agencies","anchor":"agencies","className":"elite-section--agencies"} -->
<section class="elite-section alignfull elite-section--agencies" id="agencies"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--agency-box"} -->
<div class="elite-div elite-div--agency-box"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--agency-text"} -->
<div class="elite-div elite-div--agency-text"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'For agencies', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Your white-label WordPress team', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--agency-lead"} -->
<p class="elite-paragraph elite-paragraph--agency-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Take on more projects without hiring. You design and manage the client; we build fast, pixel-perfect WordPress under your brand.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--agency-actions"} -->
<div class="elite-div elite-div--agency-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Partner with us', 'wp-elite' ),
		'link'      => array( 'url' => '/white-label/' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'How it works', 'wp-elite' ),
		'link'      => array( 'url' => '/white-label/' ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->

<!-- wp:list {"className":"core-list--agency-points"} -->
<ul class="wp-block-list core-list--agency-points"><!-- wp:list-item -->
<li><?php esc_html_e( 'Figma to WordPress, pixel-perfect', 'wp-elite' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Your brand, NDA by default', 'wp-elite' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Overlap with US, UK and AU hours', 'wp-elite' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'A small first project to try us out', 'wp-elite' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
