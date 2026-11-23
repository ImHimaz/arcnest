<?php
/**
 * Title: Process
 * Slug: wp-elite/section-process
 * Categories: wp-elite, about
 * Keywords: process, steps, how we work
 * Description: "How we work": an eyebrow, the heading and a line, then four numbered steps in a row (a purple number square, a title and a line), joined by a dashed line from laptops; two by two on tablets, stacked on phones. The steps rise in one by one. Section class elite-section--process, ID process.
 *
 * @package WpElite
 */

/**
 * One step: number, title and line.
 *
 * @param string $num   Number.
 * @param string $title Title.
 * @param string $text  Line.
 */
$wp_elite_step = static function ( string $num, string $title, string $text ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--process-step"} -->
<div class="elite-div elite-div--process-step"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--process-num"} -->
<p class="elite-paragraph elite-paragraph--process-num"><?php echo esc_html( $num ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":3,"textStyle":"title-4"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Process","anchor":"process","className":"elite-section--process"} -->
<section class="elite-section alignfull elite-section--process" id="process"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--process-head"} -->
<div class="elite-div elite-div--process-head"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'How we work', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'A clear process, with no surprises', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--process-lead"} -->
<p class="elite-paragraph elite-paragraph--process-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'We reply within one working day and send a written update every week, in your time zone overlap.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--process-steps"} -->
<div class="elite-div elite-div--process-steps"><div class="div-inner">
<?php
$wp_elite_step( '01', __( 'Discover', 'wp-elite' ), __( 'A short call about your business, your customers and what your site needs to do.', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '02', __( 'Plan', 'wp-elite' ), __( 'A fixed scope, price and timeline. You approve before any work starts.', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '03', __( 'Design & build', 'wp-elite' ), __( 'You review designs, then the real site on a private staging address as it comes together.', 'wp-elite' ) );
echo "\n";
$wp_elite_step( '04', __( 'Launch & care', 'wp-elite' ), __( 'A zero-downtime launch, a speed report, and an optional care plan.', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
