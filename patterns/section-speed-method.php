<?php
/**
 * Title: Speed test: how we tested
 * Slug: wp-elite/section-speed-method
 * Categories: wp-elite, text
 * Keywords: speed, test, method, faq
 * Description: How the speed test was run, in the FAQ's look: the heading beside an Elite Accordion of questions and answers (the first open; no FAQ schema). Section class elite-section--faq, ID method.
 *
 * @package WpElite
 */

/**
 * One question and its answer.
 *
 * @param string $question The question.
 * @param string $answer   The answer.
 */
$wp_elite_question = static function ( string $question, string $answer ): void {
	?>
<!-- wp:elite/accordion-item <?php echo wp_json_encode( array( 'title' => $question ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> -->
<!-- wp:elite/accordion-body -->
<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $answer ); ?></p>
<!-- /wp:elite/paragraph -->
<!-- /wp:elite/accordion-body -->
<!-- /wp:elite/accordion-item -->
	<?php
};
?>
<!-- wp:elite/section {"label":"How we tested","anchor":"method","className":"elite-section--faq"} -->
<section class="elite-section alignfull elite-section--faq" id="method"><div class="section-inner"><div class="container"><!-- wp:elite/row -->
<div class="elite-row row"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4}}} -->
<div class="elite-column col-12 col-lg-4"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Method', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'How we tested', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7,"offset":1}},"className":"elite-column--faq-list"} -->
<div class="elite-column col-12 col-lg-7 offset-lg-1 elite-column--faq-list"><div class="column-inner"><!-- wp:elite/accordion {"start":"first","indicator":"plus","className":"elite-accordion--faq-list"} -->
<?php
$wp_elite_question( __( 'What exactly did you build?', 'wp-elite' ), __( 'A home page for a made-up software product: a header with dropdown menus, a hero image, counters, a video, a tab slider, a testimonial slider, an FAQ accordion, the latest blog posts and a footer. Both versions use the same images, video, font file and text.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How was the Elementor page built?', 'wp-elite' ), __( 'On the Hello theme with Elementor 4.3 and Elementor Pro 4.3: a Theme Builder header and footer, Mega Menu, Nested Tabs, Carousel and Accordion, and a Loop Grid for the posts. Standard widgets, with Elementor’s own performance settings switched on.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How was the Arcnest page built?', 'wp-elite' ), __( 'On our WP Elite block theme with Elite Blocks: native WordPress blocks, with each section loading only its own CSS and scripts.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How did you measure?', 'wp-elite' ), __( 'Google Lighthouse with its mobile settings (a mid-range phone on a slow 4G connection), five runs per page, taking turns between the two, and the median of each number. Both pages on the same server, with no caching plugin.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Can I check the pages myself?', 'wp-elite' ), __( 'Yes. Both demo pages will be online with the final results, so you can run PageSpeed Insights on them yourself.', 'wp-elite' ) );
?>
<!-- /wp:elite/accordion --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
