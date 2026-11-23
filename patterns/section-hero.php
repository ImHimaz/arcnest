<?php
/**
 * Title: Hero
 * Slug: wp-elite/section-hero
 * Categories: wp-elite, banner
 * Keywords: hero, intro, home, heading, speed
 * Description: The home page's intro on a light grid: an eyebrow, the heading (part of it highlighted in lime), a lead, two buttons and three ticks, beside a browser window showing a site we built (the "Hearthline Realty home page" image from the Media Library) with three cards over it: Core Web Vitals passed, $0 a year in builder licences and the demo's mobile PageSpeed score (edit the numbers after each new measurement). Section class elite-section--hero.
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

// The screenshot in the browser window: the Media Library image with this
// slug (upload it there; it isn't a theme file).
$wp_elite_shot  = get_posts(
	array(
		'name'           => 'hearthline-home',
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'posts_per_page' => 1,
		'fields'         => 'ids',
	)
);
$wp_elite_image = array(
	'images'    => array(),
	'ratio'     => array( 'desktop' => '16/10' ),
	'sizeSlug'  => 'full',
	'priority'  => true,
	'lazyLoad'  => false,
	'className' => 'elite-image--hero-shot',
);
if ( $wp_elite_shot ) {
	$wp_elite_image['images']['desktop'] = array(
		'id'  => (int) $wp_elite_shot[0],
		'url' => (string) wp_get_attachment_url( (int) $wp_elite_shot[0] ),
		'alt' => __( 'The Hearthline Realty home page, a real estate website built by Arcnest', 'wp-elite' ),
	);
}
?>
<!-- wp:elite/section {"label":"Hero","className":"elite-section--hero"} -->
<section class="elite-section alignfull elite-section--hero"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--hero"} -->
<div class="elite-row row elite-row--hero"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6}},"className":"elite-column--hero-copy"} -->
<div class="elite-column col-12 col-lg-6 elite-column--hero-copy"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'WordPress websites for growing businesses', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":1,"textStyle":"title-1"} -->
<h1 class="elite-heading" style="font-family:var(--text-title-1-font-family);font-size:var(--text-title-1-font-size);font-weight:var(--text-title-1-font-weight);line-height:var(--text-title-1-line-height);letter-spacing:var(--text-title-1-letter-spacing);text-transform:var(--text-title-1-text-transform)"><?php esc_html_e( 'Websites that', 'wp-elite' ); ?> <span class="elite-span elite-span--highlight"><?php esc_html_e( 'win you more customers.', 'wp-elite' ); ?></span></h1>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--hero-lead"} -->
<p class="elite-paragraph elite-paragraph--hero-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We design and build fast WordPress websites that turn visitors into enquiries. No page builder, no yearly licence fees, and you own every line of code.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--hero-actions"} -->
<div class="elite-div elite-div--hero-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Start a project', 'wp-elite' ),
		'link'      => array( 'url' => '/contact/' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--secondary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'Test your site free', 'wp-elite' ),
		'link'      => array( 'url' => '#check' ),
		'className' => 'elite-button--outline',
	)
);
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:list {"className":"core-list--hero-ticks"} -->
<ul class="wp-block-list core-list--hero-ticks"><!-- wp:list-item -->
<li><?php esc_html_e( 'No page builder', 'wp-elite' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'No licence fees', 'wp-elite' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Passes Core Web Vitals', 'wp-elite' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6}},"className":"elite-column--hero-visual"} -->
<div class="elite-column col-12 col-lg-6 elite-column--hero-visual"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--hero-browser"} -->
<div class="elite-div elite-div--hero-browser"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-url"} -->
<p class="elite-paragraph elite-paragraph--hero-url"><a href="https://demo1.arcnestpreview.com/">demo1.arcnestpreview.com</a></p>
<!-- /wp:elite/paragraph -->

<?php echo '<!-- wp:elite/image ' . wp_json_encode( $wp_elite_image, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. ?></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--hero-cwv"} -->
<div class="elite-div elite-div--hero-cwv"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-card-label"} -->
<p class="elite-paragraph elite-paragraph--hero-card-label"><?php esc_html_e( 'Core Web Vitals', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--hero-pass"} -->
<p class="elite-paragraph elite-paragraph--hero-pass"><?php esc_html_e( 'Passed', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--hero-metrics"} -->
<ul class="wp-block-list core-list--hero-metrics"><!-- wp:list-item -->
<li><?php esc_html_e( 'Largest paint', 'wp-elite' ); ?> <strong>1.2 s</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Blocking time', 'wp-elite' ); ?> <strong>95 ms</strong></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Layout shift', 'wp-elite' ); ?> <strong>0.01</strong></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--hero-licence"} -->
<div class="elite-div elite-div--hero-licence"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-licence-number"} -->
<p class="elite-paragraph elite-paragraph--hero-licence-number">$0</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php esc_html_e( 'a year in builder licences', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--hero-score"} -->
<div class="elite-div elite-div--hero-score"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-score-number"} -->
<p class="elite-paragraph elite-paragraph--hero-score-number">96</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--hero-card-label"} -->
<p class="elite-paragraph elite-paragraph--hero-card-label"><?php esc_html_e( 'Mobile PageSpeed', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--hero-score-title"} -->
<p class="elite-paragraph elite-paragraph--hero-score-title"><?php esc_html_e( 'Our demo site, measured on Google PageSpeed', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
