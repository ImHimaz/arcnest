<?php
/**
 * Title: Page not found
 * Slug: wp-elite/template-404
 * Inserter: no
 * Description: The main content of the 404 template, in the home hero's look: a big "404", the heading, a line, buttons back home and to the contact form, and links into the home page. Section class elite-section--not-found; it starts under the header.
 *
 * @package WpElite
 */

/**
 * An Elite Button's block comment (its text and link are attributes).
 *
 * @param array<string, mixed> $attributes Button attributes.
 */
$wp_elite_button = static function ( array $attributes ): void {
	echo '<!-- wp:elite/button ' . wp_json_encode( $attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded.
};

// Links into the home page's sections.
$wp_elite_links = esc_html__( 'Or jump to:', 'wp-elite' );
foreach (
	array(
		'services' => __( 'Services', 'wp-elite' ),
		'process'  => __( 'How we work', 'wp-elite' ),
		'faq'      => __( 'FAQ', 'wp-elite' ),
		'contact'  => __( 'Contact', 'wp-elite' ),
	) as $wp_elite_anchor => $wp_elite_text
) {
	$wp_elite_links .= sprintf( ' <a href="%s">%s</a>', esc_url( home_url( '/#' . $wp_elite_anchor ) ), esc_html( $wp_elite_text ) );
}
?>
<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
<main class="wp-block-group"><!-- wp:elite/section {"label":"Not found","className":"elite-section--not-found"} -->
<section class="elite-section alignfull elite-section--not-found"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"className":"elite-paragraph--not-found-code"} -->
<p class="elite-paragraph elite-paragraph--not-found-code">4<span class="elite-span elite-span--dot">0</span>4</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":1,"textStyle":"title-2"} -->
<h1 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Nothing to load here', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h1>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--not-found-lead"} -->
<p class="elite-paragraph elite-paragraph--not-found-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'This page doesn’t exist, which makes it the fastest page we’ve ever built. Let’s get you somewhere useful.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--not-found-actions"} -->
<div class="elite-div elite-div--not-found-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Back to home', 'wp-elite' ),
		'link'      => array( 'url' => home_url( '/' ) ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'Start a project', 'wp-elite' ),
		'link'      => array( 'url' => home_url( '/#contact' ) ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--not-found-links"} -->
<p class="elite-paragraph elite-paragraph--not-found-links"><?php echo $wp_elite_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></p>
<!-- /wp:elite/paragraph --></div></div></section>
<!-- /wp:elite/section --></main>
<!-- /wp:group -->
