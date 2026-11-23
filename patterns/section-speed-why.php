<?php
/**
 * Title: Speed test: why it's faster
 * Slug: wp-elite/section-speed-why
 * Categories: wp-elite, about
 * Keywords: speed, test, why, reasons
 * Description: Why the Arcnest page is faster, in the services cards' look: the heading and a line, then three numbered reasons (title and text). 3 across from laptops, stacked below. Section class elite-section--services, ID why.
 *
 * @package WpElite
 */

/**
 * One reason: a services card without a link.
 *
 * @param string $number "01"…
 * @param string $title  Title.
 * @param string $text   Why.
 */
$wp_elite_reason = static function ( string $number, string $title, string $text ): void {
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4}}} -->
<div class="elite-column col-12 col-lg-4"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--service"} -->
<div class="elite-div elite-div--service"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--service-num"} -->
<p class="elite-paragraph elite-paragraph--service-num"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--service-text"} -->
<p class="elite-paragraph elite-paragraph--service-text"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Why it's faster","anchor":"why","className":"elite-section--services"} -->
<section class="elite-section alignfull elite-section--services" id="why"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--services-head"} -->
<div class="elite-div elite-div--services-head"><div class="div-inner"><!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Why', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Where the difference comes from', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--services-lead"} -->
<p class="elite-paragraph elite-paragraph--services-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Neither site is badly built, and both carry the same plugins. One simply asks the phone and the server to do less.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/row {"className":"elite-row--services-grid"} -->
<div class="elite-row row elite-row--services-grid">
<?php
$wp_elite_reason( '01', __( 'Nothing in the way of the first paint', 'wp-elite' ), __( 'Our pages carry their CSS inside the page and start drawing text as soon as it arrives. The Elementor pages first fetch 24 to 30 stylesheets and jQuery, and on a slow connection every one of them waits its turn.', 'wp-elite' ) );
echo "\n";
$wp_elite_reason( '02', __( 'About half the JavaScript', 'wp-elite' ), __( 'Google Tag Manager adds the same 179 KB to both. Even so, our pages run 216 to 246 KB of JavaScript against 394 to 472 KB. Without tracking it would be 45 KB against 290 KB.', 'wp-elite' ) );
echo "\n";
$wp_elite_reason( '03', __( 'Less work for the server', 'wp-elite' ), __( 'Elementor keeps each page as data plus a rendered copy, and builds its templates on every visit. On the same hosting, our site served about 50% more pages a second before it slowed down.', 'wp-elite' ) );
?>
</div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
