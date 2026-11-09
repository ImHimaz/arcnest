<?php
/**
 * Contact Form 7: lean, and styled by the theme.
 *
 * - No CSS of its own: the theme styles forms (assets/blocks/elite-form, and
 *   a section's look, e.g. sections/contact).
 * - Its script only on pages that show a form (it loads on every page
 *   otherwise): rendering a form notes it, and the script is queued once
 *   CF7 has registered it. A block theme renders the page before <head>,
 *   so the note is there in time.
 * - No <p>/<br> added to form templates: their markup is what's written
 *   (fields in <div class="form-field">…).
 *
 * The forms themselves (fields, mail) are set up in Contact → Contact Forms
 * and placed with an Elite Form (README: Contact form).
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\ContactForm7;

add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Whether the page shows a form (set while rendering it).
 *
 * @param bool|null $set True to note one.
 */
function has_form( ?bool $set = null ): bool {
	static $has_form = false;
	if ( true === $set ) {
		$has_form = true;
	}
	return $has_form;
}

/**
 * Note a rendered form.
 *
 * @param string $output Shortcode output.
 * @param string $tag    Shortcode name.
 */
function note_form( string $output, string $tag ): string {
	if ( 'contact-form-7' === $tag || 'contact-form' === $tag ) {
		has_form( true );
	}
	return $output;
}
add_filter( 'do_shortcode_tag', __NAMESPACE__ . '\\note_form', 10, 2 );

/**
 * Queue the script where a form is (after CF7 registers it, priority 10).
 */
function enqueue_script(): void {
	if ( has_form() && function_exists( 'wpcf7_enqueue_scripts' ) ) {
		wpcf7_enqueue_scripts();
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_script', 20 );

/**
 * The contact form's template: the fields in the theme's markup
 * (assets/blocks/elite-form styles `.form-field`, `.form-submit`).
 */
function contact_template(): string {
	// Each field: its ID, label, Contact Form 7 tag and width.
	$fields = array(
		array( 'cf-name', __( 'Your name', 'wp-elite' ), '[text* your-name id:cf-name autocomplete:name placeholder "' . __( 'Jane Smith', 'wp-elite' ) . '"]', '' ),
		array( 'cf-email', __( 'Email', 'wp-elite' ), '[email* your-email id:cf-email autocomplete:email placeholder "' . __( 'you@company.com', 'wp-elite' ) . '"]', '' ),
		array( 'cf-website', __( 'Website', 'wp-elite' ) . ' <span class="form-field__optional">' . __( '(optional)', 'wp-elite' ) . '</span>', '[url your-website id:cf-website autocomplete:url placeholder "https://yourwebsite.com"]', ' form-field--full' ),
		array( 'cf-message', __( 'About your project', 'wp-elite' ), '[textarea* your-message id:cf-message x4 placeholder "' . __( 'What do you need help with?', 'wp-elite' ) . '"]', ' form-field--full' ),
	);
	$html   = '';
	foreach ( $fields as list( $id, $label, $tag, $width ) ) {
		$html .= sprintf( "<div class=\"form-field%s\">\n\t<label for=\"%s\">%s</label>\n\t%s\n</div>\n", $width, $id, $label, $tag );
	}
	return $html . '<button type="submit" class="form-submit">' . __( 'Send project details', 'wp-elite' ) . '</button>';
}

/**
 * `wp arcnest contact-form`: create the contact form, or bring it up to
 * date (fields, mail, messages): a Contact Form 7 form and the Elite Form
 * "Contact" (slug `contact`) that places it, with the thank-you message
 * after submit. Run it on each site (local, staging, production) after
 * activating both plugins; the Home page's Contact section uses the Elite
 * Form by its slug.
 */
function cli_contact_form(): void {
	if ( ! class_exists( 'WPCF7_ContactForm' ) || ! class_exists( '\EliteBlocks\Forms' ) ) {
		\WP_CLI::error( 'Activate Contact Form 7 and Elite Blocks first.' );
	}

	$elite    = get_page_by_path( 'contact', OBJECT, \EliteBlocks\Forms::POST_TYPE );
	$settings = $elite ? get_post_meta( $elite->ID, \EliteBlocks\Forms::META, true ) : array();
	$cf7_id   = is_array( $settings ) ? (int) ( $settings['plugin']['id'] ?? 0 ) : 0;
	$cf7      = $cf7_id ? \wpcf7_contact_form( $cf7_id ) : null;
	if ( ! $cf7 ) {
		$cf7 = \WPCF7_ContactForm::get_template( array( 'title' => __( 'Contact', 'wp-elite' ) ) );
	}

	$messages = array_merge(
		$cf7->prop( 'messages' ),
		array(
			'mail_sent_ok'     => __( 'Thanks for reaching out! We’ll reply within one working day.', 'wp-elite' ),
			'mail_sent_ng'     => __( 'Sorry, your message couldn’t be sent. Please try again, or email us directly.', 'wp-elite' ),
			'validation_error' => __( 'Please check the highlighted fields.', 'wp-elite' ),
			'invalid_required' => __( 'Please fill in this field.', 'wp-elite' ),
			'invalid_email'    => __( 'Enter a valid email address.', 'wp-elite' ),
			'invalid_url'      => __( 'Enter a full address, e.g. https://example.com', 'wp-elite' ),
		)
	);
	$mail     = array_merge(
		$cf7->prop( 'mail' ),
		array(
			/* translators: the site's name, then the sender's name (Contact Form 7 mail tags). */
			'subject'            => __( '[_site_title] New project enquiry from [your-name]', 'wp-elite' ),
			'recipient'          => '[_site_admin_email]',
			'body'               => implode(
				"\n",
				array(
					__( 'Name: [your-name]', 'wp-elite' ),
					__( 'Email: [your-email]', 'wp-elite' ),
					__( 'Website: [your-website]', 'wp-elite' ),
					'',
					__( 'About the project:', 'wp-elite' ),
					'[your-message]',
					'',
					'-- ',
					__( 'Sent from the contact form on [_site_title] ([_site_url])', 'wp-elite' ),
				)
			),
			'additional_headers' => 'Reply-To: [your-email]',
		)
	);
	$cf7->set_properties(
		array(
			'form'     => contact_template(),
			'mail'     => $mail,
			'messages' => $messages,
		)
	);
	$cf7_id = (int) $cf7->save();

	$elite_settings = array(
		'provider' => 'cf7',
		'plugin'   => array( 'id' => (string) $cf7_id ),
		'success'  => array(
			'action'  => 'message',
			'message' => $messages['mail_sent_ok'],
		),
	);
	$elite_id       = $elite ? $elite->ID : wp_insert_post(
		array(
			'post_type'   => \EliteBlocks\Forms::POST_TYPE,
			'post_title'  => __( 'Contact', 'wp-elite' ),
			'post_name'   => 'contact',
			'post_status' => 'publish',
		),
		true
	);
	if ( is_wp_error( $elite_id ) ) {
		\WP_CLI::error( $elite_id );
	}
	update_post_meta( $elite_id, \EliteBlocks\Forms::META, $elite_settings );

	\WP_CLI::success( sprintf( 'Contact form ready: Contact Form 7 form %1$d, Elite Form %2$d.', $cf7_id, $elite_id ) );
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	\WP_CLI::add_command( 'arcnest contact-form', __NAMESPACE__ . '\\cli_contact_form' );
}
