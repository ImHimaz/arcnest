<?php
/**
 * Title: FAQ
 * Slug: wp-elite/section-faq
 * Categories: wp-elite, text
 * Keywords: faq, questions, answers, accordion
 * Description: "Questions": the heading beside an Elite Accordion of questions and answers (the first open, a round plus that turns into a minus, FAQ schema for search engines). The questions rise in one by one. Section class elite-section--faq, ID faq.
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
<!-- wp:elite/section {"label":"FAQ","anchor":"faq","className":"elite-section--faq"} -->
<section class="elite-section alignfull elite-section--faq" id="faq"><div class="section-inner"><div class="container"><!-- wp:elite/row -->
<div class="elite-row row"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4}}} -->
<div class="elite-column col-12 col-lg-4"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'FAQ', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Questions', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7,"offset":1}},"className":"elite-column--faq-list"} -->
<div class="elite-column col-12 col-lg-7 offset-lg-1 elite-column--faq-list"><div class="column-inner"><!-- wp:elite/accordion {"start":"first","indicator":"plus","faqSchema":true,"className":"elite-accordion--faq-list"} -->
<?php
$wp_elite_question( __( 'Will my site look the same after a rebuild?', 'wp-elite' ), __( 'Yes. We match your current design closely, or improve it if you’d like. The difference is under the hood: cleaner code, fewer requests and much faster loading.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Can I still edit my site myself?', 'wp-elite' ), __( 'Yes, and more easily. We use the native WordPress block editor with custom blocks built for your content, so editing is simple and hard to break.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'You’re in Sri Lanka. How does that work across time zones?', 'wp-elite' ), __( 'Our team already works with US clients day to day. We overlap with UK and Australian working hours and the US morning, reply within one working day, and send weekly written updates so you’re never waiting.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How do payments work?', 'wp-elite' ), __( 'Fixed-price projects are usually 50% upfront and 50% on launch. We invoice in USD, GBP or AUD.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Who owns the website?', 'wp-elite' ), __( 'You do. All code, content and accounts are yours from day one, with no lock-in.', 'wp-elite' ) );
?>
<!-- /wp:elite/accordion --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
