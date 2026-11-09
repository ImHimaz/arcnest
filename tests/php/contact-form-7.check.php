<?php
/**
 * Contact Form 7 runs lean and in the theme's markup, and its script loads
 * only where a form is (inc/integrations/contact-form-7.php). Run by run.php.
 *
 * @package WpElite
 */

use function WpElite\ContactForm7\contact_template;
use function WpElite\ContactForm7\enqueue_script;
use function WpElite\ContactForm7\has_form;

if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
	echo "- Contact Form 7 isn't active: skipped\n";
	return;
}

$wp_elite_check( 'No Contact Form 7 CSS, no global script, no <p>/<br> in templates', array( false, false, false ), array( (bool) wpcf7_load_css(), (bool) wpcf7_load_js(), wpcf7_autop_or_not() ) );

$wp_elite_template = contact_template();
$wp_elite_check(
	'The contact template: four fields in the theme’s markup, labels tied to them, a submit button',
	array( 4, 2, true, true, true ),
	array(
		substr_count( $wp_elite_template, '<div class="form-field' ),
		substr_count( $wp_elite_template, 'form-field--full' ),
		str_contains( $wp_elite_template, '<label for="cf-email">' ) && str_contains( $wp_elite_template, 'id:cf-email' ),
		str_contains( $wp_elite_template, 'autocomplete:email' ),
		str_contains( $wp_elite_template, '<button type="submit" class="form-submit">' ),
	)
);

// As on a page: CF7 registers its script (and the theme's hook runs: no
// form yet).
do_action( 'wp_enqueue_scripts' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Core's hook, fired as a page does.
$wp_elite_before = wp_script_is( 'contact-form-7', 'enqueued' );

$wp_elite_form = get_posts(
	array(
		'post_type'   => 'wpcf7_contact_form',
		'numberposts' => 1,
	)
);
if ( ! $wp_elite_form ) {
	echo "- No Contact Form 7 form yet (wp arcnest contact-form): script check skipped\n";
	return;
}
do_shortcode( '[contact-form-7 id="' . $wp_elite_form[0]->ID . '"]' );
enqueue_script();
$wp_elite_check( 'Its script: not queued without a form, queued once a form renders', array( false, true, true ), array( $wp_elite_before, has_form(), wp_script_is( 'contact-form-7', 'enqueued' ) ) );
