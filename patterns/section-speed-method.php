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
 * @param string $answer   The answer (links allowed).
 */
$wp_elite_question = static function ( string $question, string $answer ): void {
	?>
<!-- wp:elite/accordion-item <?php echo wp_json_encode( array( 'title' => $question ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> -->
<!-- wp:elite/accordion-body -->
<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo wp_kses( $answer, array( 'a' => array( 'href' => true ) ) ); ?></p>
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
$wp_elite_question( __( 'What exactly did you build?', 'wp-elite' ), __( 'A small website for a made-up software product: home, about, pricing and contact pages, a blog with 25 posts, and a post template with related posts. Menus with dropdowns, sliders, tabs, an accordion, counters, a video, pricing plans, a comparison table and two forms. Both versions use the same images, video, font file and text.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Which plugins do both sites run?', 'wp-elite' ), __( 'The same set, as on a typical client site: Yoast SEO, Contact Form 7, Google Tag Manager with Google Analytics 4, and the CookieYes cookie banner.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How was the Elementor site built?', 'wp-elite' ), __( 'On the Hello theme with Elementor 4.3 and Elementor Pro 4.3: Theme Builder header, footer, post and blog templates, Mega Menu, Nested Tabs, Carousel, Accordion, Loop Grid and standard widgets. Elementor’s default settings, with fonts set to show text while they load.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How was the Arcnest site built?', 'wp-elite' ), __( 'On our WP Elite block theme with Elite Blocks: WordPress blocks, each section bringing only its own CSS and scripts. With the theme’s speed settings on: the CSS printed in the page, and the font loaded without holding back the text.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'How did you measure?', 'wp-elite' ), __( 'Three ways, always taking turns between the sites and taking the median of five runs. PageSpeed Insights on three pages, mobile and desktop. Chrome from Colombo with a slowed-down phone: a mid-range one (CPU 4× slower, 1.6 Mbps) and a budget one (6× slower, 0.75 Mbps), which is also how the video was recorded. And a load test on the server. Both sites on the same shared hosting, with no caching plugin.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Did you tune either site?', 'wp-elite' ), __( 'Each runs the way its builder would set it up. Elementor on its defaults, with fonts set to show text while they load (an Elementor expert always switches this on). Ours with our theme’s speed settings switched on, as described above. Neither has a caching or optimisation plugin.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Why is the pricing page slower on both?', 'wp-elite' ), __( 'Its intro has no image, so the cookie banner’s text becomes the largest thing on screen, and it only appears once its script has run. Every first-time visitor sees this, so we left it in. It’s worth knowing: a consent banner can set a page’s LCP.', 'wp-elite' ) );
echo "\n";
$wp_elite_question( __( 'Can I check the sites myself?', 'wp-elite' ), __( 'Yes. Both are online: <a href="https://elite.arcnestpreview.com/">elite.arcnestpreview.com</a> (Arcnest) and <a href="https://elementor.arcnestpreview.com/">elementor.arcnestpreview.com</a> (Elementor Pro). Run PageSpeed Insights on any page.', 'wp-elite' ) );
?>
<!-- /wp:elite/accordion --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
