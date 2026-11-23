<?php
/**
 * Title: Check your site
 * Slug: wp-elite/section-check
 * Categories: wp-elite, call-to-action
 * Keywords: check, test, pagespeed, lead, form, compare
 * Description: "Free check": the heading and a line, then a form for a website address. view.js asks this site (inc/site-check.php, which holds the PageSpeed key) to run Google's PageSpeed test on phones, then shows the scores next to our demo site's, with a button to the contact form (filled in with the results). The demo's numbers are in the HTML block (edit them after each new measurement). Section class elite-section--check, ID check.
 *
 * @package WpElite
 */

// Our demo site's mobile PageSpeed medians (speed test, round 2c).
$wp_elite_ours = array(
	'performance'   => '96',
	'accessibility' => '100',
	'lcp'           => '1.2 s',
	'weight'        => '351 KB',
);

$wp_elite_rows = '';
foreach (
	array(
		'performance'   => __( 'Performance', 'wp-elite' ),
		'accessibility' => __( 'Accessibility', 'wp-elite' ),
		'lcp'           => __( 'Main content shown (LCP)', 'wp-elite' ),
		'weight'        => __( 'Page weight', 'wp-elite' ),
	) as $wp_elite_key => $wp_elite_label
) {
	$wp_elite_rows .= sprintf(
		'<tr><th scope="row">%1$s</th><td data-check="%2$s">–</td><td>%3$s</td></tr>',
		esc_html( $wp_elite_label ),
		esc_attr( $wp_elite_key ),
		esc_html( $wp_elite_ours[ $wp_elite_key ] )
	);
}

$wp_elite_tool = sprintf(
	'<div class="site-check"><form class="site-check__form" novalidate><label class="site-check__label" for="site-check-url">%1$s</label><div class="site-check__field"><input id="site-check-url" name="url" type="text" inputmode="url" autocomplete="url" placeholder="yourwebsite.com" required maxlength="200"><button type="submit" class="wp-element-button">%2$s</button></div><p class="site-check__status" role="status" aria-live="polite"></p></form><div class="site-check__result" hidden><table class="site-check__table"><caption class="screen-reader-text">%3$s</caption><thead><tr><td></td><th scope="col" class="site-check__yours">%4$s</th><th scope="col">%5$s</th></tr></thead><tbody>%6$s</tbody></table><p class="site-check__note">%7$s</p><a class="wp-element-button site-check__cta" href="/contact/">%8$s</a></div></div>',
	esc_html__( 'Your website', 'wp-elite' ),
	esc_html__( 'Test my site', 'wp-elite' ),
	esc_html__( 'Your site’s mobile PageSpeed results next to our demo site’s', 'wp-elite' ),
	esc_html__( 'Your site', 'wp-elite' ),
	esc_html__( 'Our demo', 'wp-elite' ),
	$wp_elite_rows,
	esc_html__( 'Google PageSpeed Insights, phone test. Scores vary a few points between runs.', 'wp-elite' ),
	esc_html__( 'Let’s talk about your site', 'wp-elite' )
);
?>
<!-- wp:elite/section {"label":"Check your site","anchor":"check","className":"elite-section--check"} -->
<section class="elite-section alignfull elite-section--check" id="check"><div class="section-inner"><div class="container"><!-- wp:elite/row {"flex":{"laptop":{"align":"center"}}} -->
<div class="elite-row row has-e-align-laptop" style="--e-align-laptop:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5}}} -->
<div class="elite-column col-12 col-lg-5"><div class="column-inner"><!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'How fast is your site on a phone', 'wp-elite' ); ?><span class="elite-span elite-span--dot">?</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--check-lead"} -->
<p class="elite-paragraph elite-paragraph--check-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Enter your address. We run Google’s PageSpeed test for phones and show your scores next to our demo site’s. It takes about 30 seconds, and no email is needed.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":6,"offset":1}}} -->
<div class="elite-column col-12 col-lg-6 offset-lg-1"><div class="column-inner"><!-- wp:html -->
<?php echo $wp_elite_tool; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Built and escaped above. ?>
<!-- /wp:html --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
