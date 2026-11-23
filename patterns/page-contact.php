<?php
/**
 * Title: Contact page
 * Slug: wp-elite/page-contact
 * Categories: wp-elite, featured
 * Keywords: contact, form, enquiry, project, call
 * Description: The Contact page: crumbs, heading and a line, the contact form in a card (the Elite Form "Contact": run `wp arcnest contact-form` to create it), what happens next (three steps) and questions. A link can preselect the service (?service=rebuild) and the call box (?call=1); a speed check result fills in the website and message.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

// The Elite Form named "contact" (slug), if this site has it; otherwise the
// block asks for a form in the editor.
$wp_elite_form = class_exists( '\EliteBlocks\Forms' ) ? get_page_by_path( 'contact', OBJECT, \EliteBlocks\Forms::POST_TYPE ) : null;

P\section_open( __( 'Contact', 'wp-elite' ), 'elite-section--service-hero elite-section--contact-page', 'contact' );
P\div_open( 'elite-div--contact-layout' );

// Intro.
P\div_open( 'elite-div--contact-intro' );
P\para(
	sprintf(
		'<a href="%1$s">%2$s</a> <span class="elite-span elite-span--crumb">/</span> %3$s',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Home', 'wp-elite' ),
		esc_html__( 'Contact', 'wp-elite' )
	),
	'elite-paragraph--service-crumbs'
);
P\eyebrow( __( 'Contact', 'wp-elite' ) );
P\heading( 1, 'title-1', esc_html__( 'Tell us about', 'wp-elite' ) . ' <span class="elite-span elite-span--highlight">' . esc_html__( 'your website.', 'wp-elite' ) . '</span>' );
P\para( esc_html__( 'A new site, a rebuild, care or white-label work: tell us what you need. We reply within one working day, and every project gets a fixed quote before we start.', 'wp-elite' ), 'elite-paragraph--service-hero-lead', 'lead' );
P\div_close();

// The form.
P\div_open( 'elite-div--contact-card' );
P\heading( 2, 'title-3', esc_html__( 'Start a project', 'wp-elite' ) );
P\para( esc_html__( 'Takes about two minutes.', 'wp-elite' ), 'elite-paragraph--contact-card-lead' );
?>
<!-- wp:elite/form <?php echo wp_json_encode( array( 'form' => $wp_elite_form ? $wp_elite_form->ID : 0 ) ); ?> /-->

<?php
P\para(
	sprintf(
		/* translators: %s: privacy policy link. */
		esc_html__( 'No obligation. We use your details only to reply. %s', 'wp-elite' ),
		'<a href="/privacy-policy/">' . esc_html__( 'Privacy policy', 'wp-elite' ) . '</a>'
	),
	'elite-paragraph--contact-card-note'
);
P\div_close();

// What happens next.
P\div_open( 'elite-div--contact-next' );
P\para( esc_html__( 'What happens next', 'wp-elite' ), 'elite-paragraph--contact-next-label' );
foreach ( array(
	array( __( 'We reply within a working day', 'wp-elite' ), __( 'Usually with a few questions, or times for a call.', 'wp-elite' ) ),
	array( __( 'A 30-minute call', 'wp-elite' ), __( 'Your goals, your current site and your deadline. No sales pitch.', 'wp-elite' ) ),
	array( __( 'A fixed quote', 'wp-elite' ), __( 'Scope, price and timeline in writing, so the price you approve is the price you pay.', 'wp-elite' ) ),
) as $wp_elite_i => $wp_elite_step ) {
	P\div_open( 'elite-div--contact-step' );
	P\para( sprintf( '%02d', $wp_elite_i + 1 ), 'elite-paragraph--contact-step-num' );
	P\div_open();
	P\para( esc_html( $wp_elite_step[0] ), 'elite-paragraph--contact-step-title' );
	P\para( esc_html( $wp_elite_step[1] ) );
	P\div_close();
	P\div_close();
}
P\para( esc_html__( 'Prefer email?', 'wp-elite' ) . ' <a href="mailto:hello@arcnest.dev">hello@arcnest.dev</a>', 'elite-paragraph--contact-email' );
P\div_close();

P\div_close();
P\section_close();

P\faq(
	array(
		array( __( 'How much does a website cost?', 'wp-elite' ), __( 'It depends on the pages and features you need. After a short call we send a fixed price in writing, so there are no surprises later.', 'wp-elite' ) ),
		array( __( 'How soon can you start?', 'wp-elite' ), __( 'Usually within two weeks. Tell us your deadline in the form and we’ll say honestly whether we can meet it.', 'wp-elite' ) ),
		array( __( 'Do I need a design ready?', 'wp-elite' ), __( 'No. For a new site we design it with you; for a rebuild we work from your current site. Agencies send their Figma.', 'wp-elite' ) ),
		array( __( 'Do you work with clients in other countries?', 'wp-elite' ), __( 'Yes. We work with businesses and agencies in the UK, Australia, the US and elsewhere, by email and video call, invoiced in USD, GBP or AUD.', 'wp-elite' ) ),
		array( __( 'What if I just have a question?', 'wp-elite' ), __( 'Send it anyway, or email hello@arcnest.dev. There’s no obligation, and you’ll get a straight answer.', 'wp-elite' ) ),
	)
);
