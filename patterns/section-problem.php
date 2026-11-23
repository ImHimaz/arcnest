<?php
/**
 * Title: Why it matters
 * Slug: wp-elite/section-problem
 * Categories: wp-elite, about
 * Keywords: problem, why, speed, leads, page builder
 * Description: "Your website is your first salesperson": the heading, a line and a purple card with the Core Web Vitals pass rate of Elementor sites (HTTP Archive), beside three points (slow pages, hard-to-edit sites, page-builder lock-in), each with an icon, a title, a line and, where there is one, a fact. Section class elite-section--problem.
 *
 * @package WpElite
 */

/**
 * One point: an icon, a title, a line and an optional fact.
 *
 * @param string $icon  Theme icon name.
 * @param string $title Title.
 * @param string $text  Line.
 * @param string $fact  Fact under it ('' for none).
 */
$wp_elite_point = static function ( string $icon, string $title, string $text, string $fact = '' ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--problem-point"} -->
<div class="elite-div elite-div--problem-point"><div class="div-inner"><!-- wp:elite/icon {"icon":"<?php echo esc_attr( $icon ); ?>","size":{"desktop":26}} /-->

<!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/heading {"level":3,"textStyle":"title-4"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php echo esc_html( $title ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $text ); ?></p>
<!-- /wp:elite/paragraph -->
	<?php if ( '' !== $fact ) : ?>

<!-- wp:elite/paragraph {"className":"elite-paragraph--problem-fact"} -->
<p class="elite-paragraph elite-paragraph--problem-fact"><?php echo esc_html( $fact ); ?></p>
<!-- /wp:elite/paragraph -->
	<?php endif; ?></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Why it matters","anchor":"why","className":"elite-section--problem"} -->
<section class="elite-section alignfull elite-section--problem" id="why"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--problem"} -->
<div class="elite-row row elite-row--problem"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5}}} -->
<div class="elite-column col-12 col-lg-5"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Why it matters', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Your website is your first salesperson', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--problem-lead"} -->
<p class="elite-paragraph elite-paragraph--problem-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Most buyers check your website before they ever talk to you. If it’s slow, dated or hard to use, they leave and call someone else, and you never know they were there.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--problem-stat"} -->
<div class="elite-div elite-div--problem-stat"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--problem-stat-number"} -->
<p class="elite-paragraph elite-paragraph--problem-stat-number">36%</p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php esc_html_e( 'of Elementor sites pass Google’s Core Web Vitals on phones. Sites built on WordPress’s own block editor pass about half the time.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--problem-source"} -->
<p class="elite-paragraph elite-paragraph--problem-source"><a href="https://httparchive.org/reports/techreport/tech?tech=Elementor,Gutenberg&amp;geo=ALL&amp;rank=ALL" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Source: HTTP Archive, real Chrome visitors, Sept 2026', 'wp-elite' ); ?></a></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6,"offset":1}}} -->
<div class="elite-column col-12 col-lg-6 offset-lg-1"><div class="column-inner">
<?php
$wp_elite_point( 'clock', __( 'Slow pages lose leads', 'wp-elite' ), __( 'Every second of waiting costs you visitors, especially on phones. Google also uses page speed when it ranks your site.', 'wp-elite' ), __( '0.1 s faster → 8.4% more conversions (Deloitte)', 'wp-elite' ) );
echo "\n";
$wp_elite_point( 'edit', __( 'Hard-to-edit sites go stale', 'wp-elite' ), __( 'When every change needs a developer, your offers, case studies and news fall behind. Your team should be able to update pages in minutes.', 'wp-elite' ) );
echo "\n";
$wp_elite_point( 'lock', __( 'Page builders lock you in', 'wp-elite' ), __( 'Builder sites need a licence every year, for as long as the site runs, and moving away means a rebuild. Ours run on WordPress alone.', 'wp-elite' ), __( 'Elementor Pro: $84+ a year, every year', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
