<?php
/**
 * Title: White-label page
 * Slug: wp-elite/page-white-label
 * Categories: wp-elite, featured
 * Keywords: service, white-label, agencies, partners
 * Description: The White-label development page for agencies: hero with how partnering works, why agencies work with us, what you get (nine items), how it works (four steps), "Start with one small project", questions, other services and the closing call to action.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\service_hero(
	array(
		'crumb'     => __( 'White-label', 'wp-elite' ),
		'eyebrow'   => __( 'For agencies', 'wp-elite' ),
		'title'     => __( 'Your white-label', 'wp-elite' ),
		'highlight' => __( 'WordPress build team.', 'wp-elite' ),
		'lead'      => __( 'You design and own the client relationship. We turn your Figma into fast, pixel-perfect WordPress, under your brand and on your timeline. Your client never hears our name.', 'wp-elite' ),
		'buttons'   => array(
			array( __( 'Partner with us', 'wp-elite' ), '/contact/?service=white-label', 'elite-button--secondary', 'arrow-right' ),
			array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=white-label&call=1', 'elite-button--outline' ),
		),
		'card'      => __( 'How partnering works', 'wp-elite' ),
		'dark'      => true,
		'rows'      => array(
			array( '01', __( 'You send the design', 'wp-elite' ), __( 'Figma files and a short brief, with your deadline.', 'wp-elite' ), true ),
			array( '02', __( 'We quote a fixed price', 'wp-elite' ), __( 'Scope, price and timeline within two working days.', 'wp-elite' ), true ),
			array( '03', __( 'We build, you review', 'wp-elite' ), __( 'On your staging site, in your project tools, under your brand.', 'wp-elite' ), true ),
			array( '04', __( 'You launch and take the credit', 'wp-elite' ), __( 'We stay on call for fixes and future work.', 'wp-elite' ), true ),
		),
	)
);

P\fit(
	__( 'Why agencies work with us', 'wp-elite' ),
	__( 'More projects, without more hires', 'wp-elite' ),
	array(
		array( __( 'Say yes to more work', 'wp-elite' ), __( 'Take on the projects you’d otherwise turn down, without hiring or stretching your team.', 'wp-elite' ) ),
		array( __( 'Sites your clients love', 'wp-elite' ), __( 'Fast, accessible and easy to edit, so clients stay happy long after launch.', 'wp-elite' ) ),
		array( __( 'No builder costs to pass on', 'wp-elite' ), __( 'No page-builder licences for you or your clients to renew every year.', 'wp-elite' ) ),
	)
);

P\included(
	__( 'What you get', 'wp-elite' ),
	__( 'A senior build partner who fits into your process', 'wp-elite' ),
	__( 'We work the way your team already works, in your tools and your hours.', 'wp-elite' ),
	array(
		array( 'eye', __( 'Pixel-perfect builds', 'wp-elite' ), __( 'Your Figma, matched on desktop, tablet and phone, checked side by side.', 'wp-elite' ) ),
		array( 'layers', __( 'Blocks clients can edit', 'wp-elite' ), __( 'Custom blocks in WordPress’s own editor, built for each client’s content.', 'wp-elite' ) ),
		array( 'zap', __( 'Fast by default', 'wp-elite' ), __( 'Core Web Vitals passed on phones, with a speed report you can share.', 'wp-elite' ) ),
		array( 'lock', __( 'Your brand, NDA', 'wp-elite' ), __( 'We sign your NDA. Our name never appears in code, emails or handovers.', 'wp-elite' ) ),
		array( 'message', __( 'In your tools', 'wp-elite' ), __( 'Slack, Teams, Jira, Asana or email: whatever your team already uses.', 'wp-elite' ) ),
		array( 'clock', __( 'Your hours', 'wp-elite' ), __( 'Overlap with UK and Australian working hours and the US morning.', 'wp-elite' ) ),
		array( 'file-text', __( 'Unbranded handover', 'wp-elite' ), __( 'Editing guides and walkthrough videos your client can use, under your name.', 'wp-elite' ) ),
		array( 'shield-check', __( 'Care after launch', 'wp-elite' ), __( 'Updates and changes for your clients, billed to you, under your brand.', 'wp-elite' ) ),
		array( 'user', __( 'One senior developer', 'wp-elite' ), __( 'The same lead developer on every project, so quality doesn’t vary.', 'wp-elite' ) ),
	)
);

P\steps(
	__( 'How it works', 'wp-elite' ),
	__( 'From Figma to launch, on your timeline', 'wp-elite' ),
	__( 'Fixed price per project, agreed before we start. No retainers needed.', 'wp-elite' ),
	array(
		array( __( 'Brief', 'wp-elite' ), __( 'Send the Figma, the pages and any functions, with your deadline.', 'wp-elite' ) ),
		array( __( 'Quote', 'wp-elite' ), __( 'A fixed price, scope and timeline within two working days.', 'wp-elite' ) ),
		array( __( 'Build', 'wp-elite' ), __( 'Weekly updates and a staging link you can share with your client.', 'wp-elite' ) ),
		array( __( 'Handover', 'wp-elite' ), __( 'Launch support, unbranded guides, and care if you want it.', 'wp-elite' ) ),
	)
);

// "Start with one small project": the home page's agency box (its classes).
P\section_open( __( 'Try us first', 'wp-elite' ), 'elite-section--agencies', 'agencies' );
P\div_open( 'elite-div--agency-box' );
P\div_open( 'elite-div--agency-text' );
P\eyebrow( __( 'Try us first', 'wp-elite' ) );
P\title( __( 'Start with one small project', 'wp-elite' ) );
P\para( esc_html__( 'A landing page or a few templates is the easiest way to see our quality, speed and communication before you trust us with a full site.', 'wp-elite' ), 'elite-paragraph--agency-lead', 'lead' );
P\div_open( 'elite-div--agency-actions' );
P\button( __( 'Send a brief', 'wp-elite' ), '/contact/?service=white-label', 'elite-button--primary', 'arrow-right' );
P\button( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=white-label&call=1', 'elite-button--ghost' );
P\div_close();
P\div_close();
P\items(
	'core-list--agency-points',
	array(
		esc_html__( 'A reduced rate on your first project', 'wp-elite' ),
		esc_html__( 'Your NDA signed before you share anything', 'wp-elite' ),
		esc_html__( 'A fixed quote within two working days', 'wp-elite' ),
		esc_html__( 'No retainer or long-term commitment', 'wp-elite' ),
	)
);
P\div_close();
P\section_close();

P\faq(
	array(
		array( __( 'Will our clients know we work with you?', 'wp-elite' ), __( 'No. We sign your NDA, work under your brand, and leave our name out of code, emails and handover material.', 'wp-elite' ) ),
		array( __( 'Do you design too?', 'wp-elite' ), __( 'For white-label work we build from your designs. If you need design help on a project, ask us, and we’ll tell you honestly whether it’s a fit.', 'wp-elite' ) ),
		array( __( 'Who owns the code?', 'wp-elite' ), __( 'You and your client do. Everything is handed over on launch, with no licences or lock-in.', 'wp-elite' ) ),
		array( __( 'Can you work alongside our developers?', 'wp-elite' ), __( 'Yes. We follow your Git workflow, coding standards and review process, or bring ours if you don’t have one.', 'wp-elite' ) ),
		array( __( 'How do payments work?', 'wp-elite' ), __( 'A fixed price per project, usually 50% to start and 50% on launch, invoiced to your agency in USD, GBP or AUD.', 'wp-elite' ) ),
	)
);

P\related( 'white-label' );

P\cta(
	__( 'Take on more projects,', 'wp-elite' ),
	__( 'without more hires.', 'wp-elite' ),
	__( 'Send us a brief or book a call. You’ll have a fixed quote within two working days.', 'wp-elite' ),
	array(
		array( __( 'Partner with us', 'wp-elite' ), '/contact/?service=white-label', 'elite-button--primary' ),
		array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=white-label&call=1', 'elite-button--ghost' ),
	)
);
