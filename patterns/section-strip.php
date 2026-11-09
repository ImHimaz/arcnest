<?php
/**
 * Title: Tech strip
 * Slug: wp-elite/section-strip
 * Categories: wp-elite, about
 * Keywords: strip, logos, technologies, pills
 * Description: A slim band: "Built with modern, native WordPress" and the technologies as pills (a list: Enter adds one). Section class elite-section--strip.
 *
 * @package WpElite
 */

$wp_elite_pills = array( 'Block themes', 'Gutenberg', 'WooCommerce', 'ACF', 'Cloudflare', 'Core Web Vitals' );
?>
<!-- wp:elite/section {"label":"Strip","className":"elite-section--strip"} -->
<section class="elite-section alignfull elite-section--strip"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--strip-inner"} -->
<div class="elite-div elite-div--strip-inner"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--strip-label"} -->
<p class="elite-paragraph elite-paragraph--strip-label"><?php esc_html_e( 'Built with modern, native WordPress', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--strip-pills"} -->
<ul class="wp-block-list core-list--strip-pills"><?php echo implode( "\n\n", array_map( static fn ( string $pill ): string => "<!-- wp:list-item -->\n<li>" . esc_html( $pill ) . "</li>\n<!-- /wp:list-item -->", $wp_elite_pills ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Each item escaped above. ?></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
