<?php
/**
 * Title: Speed test: intro
 * Slug: wp-elite/section-speed-hero
 * Categories: wp-elite, banner
 * Keywords: speed, test, comparison, elementor, intro
 * Description: The speed test page's intro, in the home hero's look: a badge, the heading, a line, how the test was run (pills: a list) and buttons to the results and the method. Section class elite-section--speed-hero; it starts under the header.
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

$wp_elite_facts = array(
	__( 'Lighthouse, mobile', 'wp-elite' ),
	__( 'Median of 5 runs', 'wp-elite' ),
	__( 'Same server, same content', 'wp-elite' ),
	__( 'Elementor 4.3 + Pro 4.3', 'wp-elite' ),
);
?>
<!-- wp:elite/section {"label":"Speed test intro","className":"elite-section--speed-hero"} -->
<section class="elite-section alignfull elite-section--speed-hero"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"className":"elite-paragraph--speed-badge"} -->
<p class="elite-paragraph elite-paragraph--speed-badge"><strong><?php esc_html_e( 'Speed test', 'wp-elite' ); ?></strong> <?php esc_html_e( 'Elementor vs Arcnest', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":1,"textStyle":"title-1"} -->
<h1 class="elite-heading" style="font-family:var(--text-title-1-font-family);font-size:var(--text-title-1-font-size);font-weight:var(--text-title-1-font-weight);line-height:var(--text-title-1-line-height);letter-spacing:var(--text-title-1-letter-spacing);text-transform:var(--text-title-1-text-transform)"><?php esc_html_e( 'Same page, two builders. One loads twice as fast', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h1>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--speed-lead"} -->
<p class="elite-paragraph elite-paragraph--speed-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We built one home page twice: with Elementor Pro, the way most agencies would, and with our own block theme. Same design, same content, same server. Then we measured both.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--speed-facts"} -->
<ul class="wp-block-list core-list--speed-facts">
	<?php foreach ( $wp_elite_facts as $wp_elite_index => $wp_elite_fact ) : ?>
		<?php echo $wp_elite_index ? "\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $wp_elite_fact ); ?></li>
<!-- /wp:list-item -->
	<?php endforeach; ?>
</ul>
<!-- /wp:list -->

<!-- wp:elite/div {"className":"elite-div--speed-actions"} -->
<div class="elite-div elite-div--speed-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'See the results', 'wp-elite' ),
		'link'      => array( 'url' => '#results' ),
		'iconEnd'   => 'arrow-down',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'How we tested', 'wp-elite' ),
		'link'      => array( 'url' => '#method' ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
