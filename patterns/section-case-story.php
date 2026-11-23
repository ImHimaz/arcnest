<?php
/**
 * Title: Case study: story
 * Slug: wp-elite/section-case-story
 * Categories: wp-elite, about
 * Keywords: case study, story, challenge, quote, testimonial
 * Description: A case study's story in three columns (the challenge, what we did, the result), then the client's quote on lilac with their name and role. Replace every [placeholder]; only quote a client with their written OK. Section class elite-section--case-story.
 *
 * @package WpElite
 */

/**
 * One part of the story.
 *
 * @param string $title Title.
 * @param string $text  Text.
 */
$wp_elite_part = static function ( string $title, string $text ): void {
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4}}} -->
<div class="elite-column col-12 col-lg-4"><div class="column-inner"><!-- wp:elite/heading {"level":3,"textStyle":"title-4"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--case-text"} -->
<p class="elite-paragraph elite-paragraph--case-text"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Case study story","className":"elite-section--case-story"} -->
<section class="elite-section alignfull elite-section--case-story"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--case-story"} -->
<div class="elite-row row elite-row--case-story">
<?php
$wp_elite_part( __( 'The challenge', 'wp-elite' ), __( '[What was wrong: slow pages, failing Core Web Vitals, hard to edit, licence costs, a redesign that kept breaking.]', 'wp-elite' ) );
echo "\n";
$wp_elite_part( __( 'What we did', 'wp-elite' ), __( '[What we built: the same design on our block theme, the plugins we removed, images, forms and tracking moved over, the launch.]', 'wp-elite' ) );
echo "\n";
$wp_elite_part( __( 'The result', 'wp-elite' ), __( '[What changed for the business: faster pages, passing Core Web Vitals, enquiries, edits the team now makes themselves.]', 'wp-elite' ) );
?>
</div>
<!-- /wp:elite/row -->

<!-- wp:elite/div {"className":"elite-div--case-quote"} -->
<div class="elite-div elite-div--case-quote"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"title-4","className":"elite-paragraph--case-quote"} -->
<p class="elite-paragraph elite-paragraph--case-quote" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php esc_html_e( '“[The client’s words, one or two sentences, about the result.]”', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--case-cite"} -->
<p class="elite-paragraph elite-paragraph--case-cite"><strong><?php esc_html_e( '[Name]', 'wp-elite' ); ?></strong> <?php esc_html_e( '[Role, Company]', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
