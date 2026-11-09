<?php
/**
 * Title: Hero
 * Slug: wp-elite/section-hero
 * Categories: wp-elite, banner
 * Keywords: hero, banner, intro
 * Description: The home page's intro: a badge, the heading, a lead, two buttons and a trust line, beside a speed report card (score ring, three metrics) and a lime stat. Section class elite-section--hero; it starts under the header.
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
<!-- wp:elite/section {"label":"Hero","className":"elite-section--hero"} -->
<section class="elite-section alignfull elite-section--hero"><div class="section-inner"><div class="container"><!-- wp:elite/row {"flex":{"laptop":{"align":"center"}}} -->
<div class="elite-row row has-e-align-laptop" style="--e-align-laptop:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}},"className":"elite-column--hero-copy"} -->
<div class="elite-column col-12 col-lg-7 elite-column--hero-copy"><div class="column-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-badge"} -->
<p class="elite-paragraph elite-paragraph--hero-badge"><strong><?php esc_html_e( 'New', 'wp-elite' ); ?></strong> <?php esc_html_e( 'Now taking on founding clients', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":1,"textStyle":"title-1"} -->
<h1 class="elite-heading" style="font-family:var(--text-title-1-font-family);font-size:var(--text-title-1-font-size);font-weight:var(--text-title-1-font-weight);line-height:var(--text-title-1-line-height);letter-spacing:var(--text-title-1-letter-spacing);text-transform:var(--text-title-1-text-transform)"><?php esc_html_e( 'WordPress that loads before they blink', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h1>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--hero-lead"} -->
<p class="elite-paragraph elite-paragraph--hero-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We build fast, clean WordPress websites with no page builders and no bloat, so they pass Core Web Vitals, rank better and win more customers.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--hero-actions"} -->
<div class="elite-div elite-div--hero-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Start your project', 'wp-elite' ),
		'link'      => array( 'url' => '#contact' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'Why we’re fast', 'wp-elite' ),
		'link'      => array( 'url' => '#theme' ),
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--hero-trust"} -->
<p class="elite-paragraph elite-paragraph--hero-trust"><?php esc_html_e( 'Built by a team that already delivers WordPress sites for US companies.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5}},"className":"elite-column--hero-visual"} -->
<div class="elite-column col-12 col-lg-5 elite-column--hero-visual"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--hero-report"} -->
<div class="elite-div elite-div--hero-report"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--hero-report-top"} -->
<div class="elite-div elite-div--hero-report-top"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-url"} -->
<p class="elite-paragraph elite-paragraph--hero-url">arcnest.dev</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--hero-tag"} -->
<p class="elite-paragraph elite-paragraph--hero-tag"><?php esc_html_e( 'Target · Mobile', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--hero-gauge"} -->
<div class="elite-div elite-div--hero-gauge"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-score"} -->
<p class="elite-paragraph elite-paragraph--hero-score">98</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--hero-gauge-label"} -->
<p class="elite-paragraph elite-paragraph--hero-gauge-label" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Performance', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--hero-gauge-title"} -->
<p class="elite-paragraph elite-paragraph--hero-gauge-title"><?php esc_html_e( 'Our standard for every build', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->

<!-- wp:list {"className":"core-list--hero-metrics"} -->
<ul class="wp-block-list core-list--hero-metrics"><!-- wp:list-item -->
<li><?php esc_html_e( 'Largest Contentful Paint', 'wp-elite' ); ?> <strong>0.8 s</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Total Blocking Time', 'wp-elite' ); ?> <strong>0 ms</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Cumulative Layout Shift', 'wp-elite' ); ?> <strong>0</strong></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--hero-stat"} -->
<div class="elite-div elite-div--hero-stat"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-stat-number"} -->
<p class="elite-paragraph elite-paragraph--hero-stat-number">0</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php esc_html_e( 'page builders. Native WordPress blocks only', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
