<?php
/**
 * Title: Call to action
 * Slug: wp-elite/section-cta
 * Categories: wp-elite, call-to-action
 * Keywords: cta, contact, start, call
 * Description: The closing band on the darkest purple, with a faint grid: a large centred heading (part of it in lime), a line and two buttons (start a project, book a call), which rise in as it scrolls into view. Section class elite-section--cta.
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
<!-- wp:elite/section {"label":"Call to action","className":"elite-section--cta"} -->
<section class="elite-section alignfull elite-section--cta"><div class="section-inner"><div class="container"><!-- wp:elite/heading {"textStyle":"title-1","className":"elite-heading--cta-title"} -->
<h2 class="elite-heading elite-heading--cta-title" style="font-family:var(--text-title-1-font-family);font-size:var(--text-title-1-font-size);font-weight:var(--text-title-1-font-weight);line-height:var(--text-title-1-line-height);letter-spacing:var(--text-title-1-letter-spacing);text-transform:var(--text-title-1-text-transform)"><?php esc_html_e( 'Let’s build a website that', 'wp-elite' ); ?> <span class="elite-span elite-span--lime"><?php esc_html_e( 'brings you customers', 'wp-elite' ); ?></span>.</h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--cta-lead"} -->
<p class="elite-paragraph elite-paragraph--cta-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Tell us about your business and your current site. You’ll get a clear plan and a fixed quote, with no obligation.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--cta-actions"} -->
<div class="elite-div elite-div--cta-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Start a project', 'wp-elite' ),
		'link'      => array( 'url' => '/contact/' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'Book a 30-minute call', 'wp-elite' ),
		'link'      => array( 'url' => '/contact/?call=1' ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
