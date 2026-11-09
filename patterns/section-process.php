<?php
/**
 * Title: Process
 * Slug: wp-elite/section-process
 * Categories: wp-elite, about
 * Keywords: process, steps, how we work, timeline
 * Description: "How we work" on dark: the heading, a line and a button (kept in view from laptops while the steps scroll past), beside four numbered steps, each with a title, a line and how long it takes. The steps rise in one by one. Section class elite-section--process, ID process.
 *
 * @package WpElite
 */

/**
 * One step: its number, title, what happens and how long.
 *
 * @param string $number "01"…
 * @param string $title  Title.
 * @param string $text   What happens.
 * @param string $meta   How long it takes.
 */
$wp_elite_step = static function ( string $number, string $title, string $text, string $meta ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--process-step"} -->
<div class="elite-div elite-div--process-step"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--process-num"} -->
<p class="elite-paragraph elite-paragraph--process-num"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/heading {"level":3,"className":"elite-heading--process-title"} -->
<h3 class="elite-heading elite-heading--process-title"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--process-text"} -->
<p class="elite-paragraph elite-paragraph--process-text"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--process-meta"} -->
<p class="elite-paragraph elite-paragraph--process-meta"><?php echo esc_html( $meta ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->
	<?php
};

$wp_elite_button = array(
	'text'      => __( 'Book a discovery call', 'wp-elite' ),
	'link'      => array( 'url' => '#contact' ),
	'iconEnd'   => 'arrow-right',
	'className' => 'elite-button--primary elite-button--process-cta',
);
?>
<!-- wp:elite/section {"label":"Process","anchor":"process","className":"elite-section--process"} -->
<section class="elite-section alignfull elite-section--process" id="process"><div class="section-inner"><div class="container"><!-- wp:elite/row -->
<div class="elite-row row"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5}},"className":"elite-column--process-head"} -->
<div class="elite-column col-12 col-lg-5 elite-column--process-head"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'How we work', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Simple process. No surprises', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--process-lead"} -->
<p class="elite-paragraph elite-paragraph--process-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We work in your time zone overlap, reply within a day, and you get a clear update every week.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/button <?php echo wp_json_encode( $wp_elite_button, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> /--></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6,"offset":1}},"className":"elite-column--process-steps"} -->
<div class="elite-column col-12 col-lg-6 offset-lg-1 elite-column--process-steps"><div class="column-inner">
<?php
$wp_elite_step( '01', __( 'Discover', 'wp-elite' ), __( 'A short call to understand your business, your goals and your current site.', 'wp-elite' ), __( '30-minute call', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '02', __( 'Plan', 'wp-elite' ), __( 'A fixed scope, fixed price and timeline. You approve before any work starts.', 'wp-elite' ), __( '1–2 days', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '03', __( 'Build', 'wp-elite' ), __( 'Clean, native WordPress blocks. You review on a staging site as we go.', 'wp-elite' ), __( '1–4 weeks', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '04', __( 'Launch & care', 'wp-elite' ), __( 'Zero-downtime launch, a before-and-after speed report, and optional monthly care.', 'wp-elite' ), __( 'Ongoing', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
