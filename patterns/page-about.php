<?php
/**
 * Title: About page
 * Slug: wp-elite/page-about
 * Categories: wp-elite, featured
 * Keywords: about, studio, founder, team, story, principles
 * Description: The About page: hero with Arcnest at a glance, our story, the founder (the home page's "Who you'll work with"), how we work (six principles), our own toolkit (purple band), the work, our services and the closing call to action.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\service_hero(
	array(
		'crumb'     => __( 'About', 'wp-elite' ),
		'top'       => true,
		'eyebrow'   => __( 'About Arcnest', 'wp-elite' ),
		'title'     => __( 'A small studio for', 'wp-elite' ),
		'highlight' => __( 'fast WordPress websites.', 'wp-elite' ),
		'lead'      => __( 'Arcnest is a WordPress studio in Sri Lanka. We build websites on WordPress’s own editor, with no page builder and no yearly licence, so they load fast, are easy to edit and belong to you.', 'wp-elite' ),
		'buttons'   => array(
			array( __( 'Start a project', 'wp-elite' ), '/contact/', 'elite-button--secondary', 'arrow-right' ),
			array( __( 'See our work', 'wp-elite' ), '#work', 'elite-button--outline' ),
		),
		'card'      => __( 'Arcnest at a glance', 'wp-elite' ),
		'rows'      => array(
			array( 'user', __( 'Founder-led', 'wp-elite' ), __( 'You work directly with the developer who builds your site.', 'wp-elite' ) ),
			array( 'layers', __( 'Our own block toolkit', 'wp-elite' ), __( 'Elite Blocks and the WP Elite theme, behind every site we build.', 'wp-elite' ) ),
			array( 'globe', __( 'Based in Sri Lanka', 'wp-elite' ), __( 'Working with clients in the UK, Australia and the US.', 'wp-elite' ) ),
		),
	)
);

// Our story.
P\section_open( __( 'Our story', 'wp-elite' ), 'elite-section--about-story' );
P\row_open( 'elite-row--about-story' );
P\col_open(
	array(
		'mobile' => array( 'width' => 12 ),
		'laptop' => array( 'width' => 5 ),
	)
);
P\eyebrow( __( 'Our story', 'wp-elite' ) );
P\title( __( 'Why we started Arcnest', 'wp-elite' ) );
P\col_close();
P\col_open(
	array(
		'mobile' => array( 'width' => 12 ),
		'laptop' => array(
			'width'  => 6,
			'offset' => 1,
		),
	)
);
P\para( esc_html__( 'After eight years of building WordPress sites, we kept seeing the same thing: businesses paying every year for a page builder that made their site slower and harder to edit.', 'wp-elite' ), 'elite-paragraph--about-story-lead', 'lead' );
P\para( esc_html__( 'Pages carried hundreds of kilobytes of code they never used. Visitors on phones waited. Teams were afraid to change a line of text in case the layout broke.', 'wp-elite' ) );
P\para( esc_html__( 'So we built our own way of working. Elite Blocks and the WP Elite theme are the tools behind every Arcnest site: custom blocks in WordPress’s own editor that load only the code each page needs.', 'wp-elite' ) );
P\para( esc_html__( 'The result is a website that’s fast on a phone, simple for your team to edit, and free of licences, so it keeps working whether or not you keep working with us.', 'wp-elite' ) );
P\col_close();
P\row_close();
P\section_close();
?>
<!-- wp:pattern {"slug":"wp-elite/section-team"} /-->

<?php
P\included(
	__( 'How we work', 'wp-elite' ),
	__( 'The principles behind every site', 'wp-elite' ),
	__( 'Six things we won’t compromise on, whatever the project or budget.', 'wp-elite' ),
	array(
		array( 'zap', __( 'Speed is a feature', 'wp-elite' ), __( 'Every page is measured on a budget phone before launch. Fast pages keep visitors and win more enquiries.', 'wp-elite' ) ),
		array( 'layers', __( 'No page builders', 'wp-elite' ), __( 'Custom blocks in WordPress’s own editor. Nothing to renew, nothing slowing the site down.', 'wp-elite' ) ),
		array( 'eye', __( 'Accessible by default', 'wp-elite' ), __( 'Clear contrast, keyboard navigation and screen reader support, built in from the first block.', 'wp-elite' ) ),
		array( 'lock', __( 'You own everything', 'wp-elite' ), __( 'Your hosting, your accounts, your code. No lock-in, and a clean handover whenever you want one.', 'wp-elite' ) ),
		array( 'file-text', __( 'Fixed quotes', 'wp-elite' ), __( 'Scope, price and timeline agreed in writing before we start. No surprise invoices.', 'wp-elite' ) ),
		array( 'message', __( 'Plain English', 'wp-elite' ), __( 'No jargon. You’ll always know what we’re doing, why, and what it costs.', 'wp-elite' ) ),
	)
);

P\standards(
	__( 'Our toolkit', 'wp-elite' ),
	__( 'Our toolkit', 'wp-elite' ),
	__( 'One toolkit behind every site', 'wp-elite' ),
	__( 'We build with our own tools, not someone else’s page builder, so every site starts lean and stays that way.', 'wp-elite' ),
	array(
		array( __( 'Elite Blocks', 'wp-elite' ), __( 'Our block plugin for WordPress’s editor', 'wp-elite' ) ),
		array( __( 'WP Elite theme', 'wp-elite' ), __( 'A lean base that loads only what each page uses', 'wp-elite' ) ),
		array( __( 'Checked before launch', 'wp-elite' ), __( 'Speed and accessibility on every page', 'wp-elite' ) ),
		array( __( 'Measured on phones', 'wp-elite' ), __( 'Core Web Vitals on a budget phone, not a desktop', 'wp-elite' ) ),
	)
);
?>
<!-- wp:pattern {"slug":"wp-elite/section-work"} /-->

<?php
P\related( '', __( 'Our services', 'wp-elite' ) );

P\cta(
	__( 'Let’s build a website', 'wp-elite' ),
	__( 'that wins you customers.', 'wp-elite' ),
	__( 'Tell us about your site or your idea. We reply within one working day.', 'wp-elite' ),
	array(
		array( __( 'Start a project', 'wp-elite' ), '/contact/', 'elite-button--primary' ),
		array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?call=1', 'elite-button--ghost' ),
	)
);
