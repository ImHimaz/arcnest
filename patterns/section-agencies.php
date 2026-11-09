<?php
/**
 * Title: Agencies
 * Slug: wp-elite/section-agencies
 * Categories: wp-elite, call-to-action
 * Keywords: agencies, white-label, partner, call to action
 * Description: "For agencies": a large lime box with the heading, a line and a purple button, beside four points (a list), with decorative circles. Section class elite-section--agencies, ID agencies.
 *
 * @package WpElite
 */

$wp_elite_points = array(
	__( 'Figma → WordPress, pixel-perfect', 'wp-elite' ),
	__( 'Your brand, NDA by default', 'wp-elite' ),
	__( 'Overlap with US, UK & AU hours', 'wp-elite' ),
	__( 'Small first project at a reduced rate', 'wp-elite' ),
);
$wp_elite_button = array(
	'text'      => __( 'Partner with us', 'wp-elite' ),
	'link'      => array( 'url' => 'mailto:hello@arcnest.dev?subject=White-label%20partnership' ),
	'iconEnd'   => 'arrow-right',
	'className' => 'elite-button--secondary elite-button--agency-cta',
);
$wp_elite_items  = implode( "\n\n", array_map( static fn ( string $point ): string => "<!-- wp:list-item -->\n<li>" . esc_html( $point ) . "</li>\n<!-- /wp:list-item -->", $wp_elite_points ) );
?>
<!-- wp:elite/section {"label":"Agencies","anchor":"agencies","className":"elite-section--agencies"} -->
<section class="elite-section alignfull elite-section--agencies" id="agencies"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--agency-box"} -->
<div class="elite-div elite-div--agency-box"><div class="div-inner"><!-- wp:elite/row {"flex":{"desktop":{"align":"center"}}} -->
<div class="elite-row row has-e-align" style="--e-align:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}}} -->
<div class="elite-column col-12 col-lg-7"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'For agencies', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Your white-label WordPress team', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--agency-lead"} -->
<p class="elite-paragraph elite-paragraph--agency-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Take on more projects without hiring. You design and manage the client, and we build fast, pixel-perfect WordPress under your brand.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/button <?php echo wp_json_encode( $wp_elite_button, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> /--></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4,"offset":1}},"className":"elite-column--agency-points"} -->
<div class="elite-column col-12 col-lg-4 offset-lg-1 elite-column--agency-points"><div class="column-inner"><!-- wp:list {"className":"core-list--agency-points"} -->
<ul class="wp-block-list core-list--agency-points"><?php echo $wp_elite_items; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Each item escaped. ?></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
