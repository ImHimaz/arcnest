<?php
/**
 * Title: Comparison
 * Slug: wp-elite/section-compare
 * Categories: wp-elite, about
 * Keywords: comparison, problem, speed, page builder
 * Description: "The problem": the heading and a line, then two cards side by side, a page builder's PageSpeed score and numbers against Arcnest's, with the scores counting up and the cards sliding in. Section class elite-section--compare, ID why.
 *
 * @package WpElite
 */

/**
 * One card: its title and tag, the score (an Elite Counter), its caption
 * and three numbers.
 *
 * @param bool                         $good    Arcnest's card (purple) rather than the page builder's.
 * @param string                       $title   Title.
 * @param string                       $tag     Tag beside the title.
 * @param int                          $score   PageSpeed score.
 * @param string                       $caption Line under the score.
 * @param list<array{0: string, 1: string}> $numbers Label and value.
 */
$wp_elite_card = static function ( bool $good, string $title, string $tag, int $score, string $caption, array $numbers ): void {
	$card = $good ? 'elite-div--compare-card elite-div--compare-good' : 'elite-div--compare-card';
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":6}}} -->
<div class="elite-column col-12 col-md-6"><div class="column-inner"><!-- wp:elite/div {"className":"<?php echo esc_attr( $card ); ?>"} -->
<div class="elite-div <?php echo esc_attr( str_replace( '-', '-', $card ) ); ?>"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--compare-card-head"} -->
<div class="elite-div elite-div--compare-card-head"><div class="div-inner"><!-- wp:elite/heading {"level":3,"className":"elite-heading--compare-title"} -->
<h3 class="elite-heading elite-heading--compare-title"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--compare-tag"} -->
<p class="elite-paragraph elite-paragraph--compare-tag"><?php echo esc_html( $tag ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/counter {"end":<?php echo (int) $score; ?>,"duration":1400,"className":"elite-counter--compare-score"} /-->

<!-- wp:elite/paragraph {"className":"elite-paragraph--compare-sub"} -->
<p class="elite-paragraph elite-paragraph--compare-sub"><?php echo esc_html( $caption ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--compare-metrics"} -->
<ul class="wp-block-list core-list--compare-metrics">
	<?php foreach ( $numbers as $index => $number ) : ?>
		<?php echo $index ? "\n\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $number[0] ); ?> <strong><?php echo esc_html( $number[1] ); ?></strong></li>
<!-- /wp:list-item -->
	<?php endforeach; ?>
</ul>
<!-- /wp:list --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Comparison","anchor":"why","className":"elite-section--compare"} -->
<section class="elite-section alignfull elite-section--compare" id="why"><div class="section-inner"><div class="container"><!-- wp:elite/row {"flex":{"desktop":{"align":"flex-end"}}} -->
<div class="elite-row row has-e-align" style="--e-align:flex-end"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6}}} -->
<div class="elite-column col-12 col-lg-6"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'The problem', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Page builders are slowing your business down', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5,"offset":1}}} -->
<div class="elite-column col-12 col-lg-5 offset-lg-1"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--compare-lead"} -->
<p class="elite-paragraph elite-paragraph--compare-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Elementor and Divi sites load megabytes of code you never use. Google notices, visitors leave, and you pay for it in rankings and leads. We build the same design, lighter and faster.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row -->

<!-- wp:elite/row {"className":"elite-row--compare-cards"} -->
<div class="elite-row row elite-row--compare-cards">
<?php
$wp_elite_card(
	false,
	__( 'Same page, page builder', 'wp-elite' ),
	__( 'Typical', 'wp-elite' ),
	38,
	__( 'Mobile PageSpeed score', 'wp-elite' ),
	array(
		array( __( 'Load time', 'wp-elite' ), '5.2 s' ),
		array( __( 'Page weight', 'wp-elite' ), '3.4 MB' ),
		array( __( 'Requests', 'wp-elite' ), '112' ),
	)
);
echo "\n";
$wp_elite_card(
	true,
	__( 'Same page, Arcnest', 'wp-elite' ),
	__( 'Our target', 'wp-elite' ),
	98,
	__( 'Mobile PageSpeed target', 'wp-elite' ),
	array(
		array( __( 'Load time', 'wp-elite' ), '0.9 s' ),
		array( __( 'Page weight', 'wp-elite' ), '420 KB' ),
		array( __( 'Requests', 'wp-elite' ), '18' ),
	)
);
?>
</div>
<!-- /wp:elite/row -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--compare-note"} -->
<p class="elite-paragraph elite-paragraph--compare-note"><?php /* translators: 1: link start, 2: link end. */ echo wp_kses_post( sprintf( __( 'Illustrative example. %1$sLet’s talk%2$s about what’s possible for your site.', 'wp-elite' ), '<a href="#contact">', '</a>' ) ); ?></p>
<!-- /wp:elite/paragraph --></div></div></section>
<!-- /wp:elite/section -->
