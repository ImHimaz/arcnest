<?php
/**
 * Title: Proof band
 * Slug: wp-elite/section-proof
 * Categories: wp-elite, about
 * Keywords: proof, numbers, stats, band
 * Description: A dark band under the hero: four big lime numbers, each with a short line (0 page builders, $0 a year in licence fees, the demo's mobile PageSpeed score, the accessibility score from our speed test). Four across from laptops, two by two below. Section class elite-section--proof.
 *
 * @package WpElite
 */

/**
 * One figure: the number and its line.
 *
 * @param string $number The number.
 * @param string $text   The line under it.
 */
$wp_elite_figure = static function ( string $number, string $text ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--proof-figure"} -->
<div class="elite-div elite-div--proof-figure"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--proof-number"} -->
<p class="elite-paragraph elite-paragraph--proof-number"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Proof band","className":"elite-section--proof"} -->
<section class="elite-section alignfull elite-section--proof"><div class="section-inner"><div class="container"><!-- wp:elite/div {"className":"elite-div--proof-figures"} -->
<div class="elite-div elite-div--proof-figures"><div class="div-inner">
<?php
$wp_elite_figure( '0', __( 'page builders. WordPress’s own editor only', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( '$0', __( 'a year in licence fees to keep your site running', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( '96', __( 'mobile PageSpeed score on our demo site', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( '100', __( 'accessibility score in our speed test', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
