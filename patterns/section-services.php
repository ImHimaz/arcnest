<?php
/**
 * Title: Services
 * Slug: wp-elite/section-services
 * Categories: wp-elite, services
 * Keywords: services, cards, packages, features
 * Description: "What we do best": the heading and a line, then four service cards (number, title, text and a link), the second one featured ("Most popular", purple). 4 across from laptops, 2 on tablets, stacked on phones; they lift on hover and rise in one by one. Section class elite-section--services, ID services.
 *
 * @package WpElite
 */

/**
 * One service card.
 *
 * @param string $number   "01"…
 * @param string $title    Title.
 * @param string $text     What it is.
 * @param string $link     Link text.
 * @param string $url      Where it goes.
 * @param bool   $featured The highlighted one ("Most popular", purple).
 */
$wp_elite_service = static function ( string $number, string $title, string $text, string $link, string $url, bool $featured = false ): void {
	$classes = $featured ? 'elite-div--service elite-div--service-featured' : 'elite-div--service';
	$button  = array(
		'text'      => $link,
		'link'      => array( 'url' => $url ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--service-link',
	);
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":6},"laptop":{"width":3}}} -->
<div class="elite-column col-12 col-md-6 col-lg-3"><div class="column-inner"><!-- wp:elite/div {"className":"<?php echo esc_attr( $classes ); ?>"} -->
<div class="elite-div <?php echo esc_attr( str_replace( '-', '-', $classes ) ); ?>"><div class="div-inner">
	<?php if ( $featured ) : ?>
<!-- wp:elite/paragraph {"className":"elite-paragraph--service-flag"} -->
<p class="elite-paragraph elite-paragraph--service-flag"><?php esc_html_e( 'Most popular', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

	<?php endif; ?>
<!-- wp:elite/paragraph {"className":"elite-paragraph--service-num"} -->
<p class="elite-paragraph elite-paragraph--service-num"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--service-text"} -->
<p class="elite-paragraph elite-paragraph--service-text"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/button <?php echo wp_json_encode( $button, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> /--></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Services","anchor":"services","className":"elite-section--services"} -->
<section class="elite-section alignfull elite-section--services" id="services"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--services-head"} -->
<div class="elite-div elite-div--services-head"><div class="div-inner"><!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Services', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'What we do best', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--services-lead"} -->
<p class="elite-paragraph elite-paragraph--services-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Clear packages with a fixed scope, so you know exactly what you get and when it’s done.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/row {"className":"elite-row--services-grid"} -->
<div class="elite-row row elite-row--services-grid">
<?php
$wp_elite_service( '01', __( 'Speed rescue', 'wp-elite' ), __( 'We find what’s slowing your WordPress site down, then fix it. Before-and-after PageSpeed report included.', 'wp-elite' ), __( 'Fix my site speed', 'wp-elite' ), '#contact' );
echo "\n";
$wp_elite_service( '02', __( 'Page builder → blocks rebuild', 'wp-elite' ), __( 'We rebuild your Elementor or Divi site on a lightweight block theme. Same design, 3–5× faster, easier to edit.', 'wp-elite' ), __( 'Plan my rebuild', 'wp-elite' ), '#contact', true );
echo "\n";
$wp_elite_service( '03', __( 'White-label development', 'wp-elite' ), __( 'Your agency designs it, we build it, under your brand. Pixel-perfect, fast and delivered on time.', 'wp-elite' ), __( 'Partner with us', 'wp-elite' ), '#agencies' );
echo "\n";
$wp_elite_service( '04', __( 'Care plans', 'wp-elite' ), __( 'Updates, backups, uptime and speed monitoring, plus small edits every month. Your site stays fast.', 'wp-elite' ), __( 'Get a care plan', 'wp-elite' ), '#contact' );
?>
</div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
