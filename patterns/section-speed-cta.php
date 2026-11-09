<?php
/**
 * Title: Speed test: call to action
 * Slug: wp-elite/section-speed-cta
 * Categories: wp-elite, call-to-action
 * Keywords: speed, contact, rebuild, cta
 * Description: The speed test page's close on the dark purple: the heading, a line and buttons to the contact form and the services. Section class elite-section--speed-cta.
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
?>
<!-- wp:elite/section {"label":"Speed test call to action","className":"elite-section--speed-cta"} -->
<section class="elite-section alignfull elite-section--speed-cta"><div class="section-inner"><div class="container"><!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Want these numbers on your site', 'wp-elite' ); ?><span class="elite-span elite-span--dot">?</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead"} -->
<p class="elite-paragraph" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We rebuild Elementor and Divi sites on our block theme: the same design, with a fraction of the code.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--speed-cta-actions"} -->
<div class="elite-div elite-div--speed-cta-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Start a project', 'wp-elite' ),
		'link'      => array( 'url' => home_url( '/#contact' ) ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'See our services', 'wp-elite' ),
		'link'      => array( 'url' => home_url( '/#services' ) ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
