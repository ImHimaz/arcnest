<?php
/**
 * Title: Care plans page
 * Slug: wp-elite/page-care-plans
 * Categories: wp-elite, featured
 * Keywords: service, care, maintenance, plans, support
 * Description: The Care plans service page: hero with what happens every month, what's covered (nine items), three plans (no prices), the "no lock-in" band, questions, other services and the closing call to action.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\service_hero(
	array(
		'crumb'     => __( 'Care plans', 'wp-elite' ),
		'eyebrow'   => __( 'Care plans', 'wp-elite' ),
		'title'     => __( 'Your website, kept', 'wp-elite' ),
		'highlight' => __( 'fast, secure and up to date.', 'wp-elite' ),
		'lead'      => __( 'Monthly care from the people who build WordPress sites: updates, backups, monitoring and small changes, handled for you. No lock-in: stop any time, and your site keeps working.', 'wp-elite' ),
		'buttons'   => array(
			array( __( 'Choose a plan', 'wp-elite' ), '#plans', 'elite-button--secondary', 'arrow-right' ),
			array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=care-plans&call=1', 'elite-button--outline' ),
		),
		'card'      => __( 'Every month', 'wp-elite' ),
		'rows'      => array(
			array( 'refresh', __( 'Updates, tested first', 'wp-elite' ), __( 'WordPress and plugins updated on a staging copy before your live site.', 'wp-elite' ) ),
			array( 'shield-check', __( 'Backed up and watched', 'wp-elite' ), __( 'Off-site backups, uptime and security checks around the clock.', 'wp-elite' ) ),
			array( 'zap', __( 'Still fast next year', 'wp-elite' ), __( 'Core Web Vitals checked monthly, and fixed before they slip.', 'wp-elite' ) ),
		),
	)
);

P\included(
	__( 'What’s covered', 'wp-elite' ),
	__( 'The jobs that keep a website healthy', 'wp-elite' ),
	__( 'The work most teams forget until something breaks. We do it every month and tell you what we did.', 'wp-elite' ),
	array(
		array( 'refresh', __( 'Tested updates', 'wp-elite' ), __( 'WordPress, theme and plugins updated safely, checked on staging first.', 'wp-elite' ) ),
		array( 'download', __( 'Off-site backups', 'wp-elite' ), __( 'Copies kept away from your hosting, ready to restore when you need them.', 'wp-elite' ) ),
		array( 'bell', __( 'Uptime monitoring', 'wp-elite' ), __( 'We know when your site is down, often before you do, and act on it.', 'wp-elite' ) ),
		array( 'shield-check', __( 'Security', 'wp-elite' ), __( 'Hardening, malware scans and login protection kept up to date.', 'wp-elite' ) ),
		array( 'zap', __( 'Speed monitoring', 'wp-elite' ), __( 'Core Web Vitals checked monthly, so new content and plugins don’t slow you down.', 'wp-elite' ) ),
		array( 'edit', __( 'Content changes', 'wp-elite' ), __( 'Text, images and new pages from your existing blocks, done for you.', 'wp-elite' ) ),
		array( 'mail', __( 'Form checks', 'wp-elite' ), __( 'Your contact forms tested regularly, so no enquiry goes missing.', 'wp-elite' ) ),
		array( 'file-text', __( 'Monthly report', 'wp-elite' ), __( 'What we updated, fixed and changed, with your speed and uptime figures.', 'wp-elite' ) ),
		array( 'message', __( 'A real person to ask', 'wp-elite' ), __( 'Email the developer who looks after your site and get a reply within a working day.', 'wp-elite' ) ),
	)
);

P\plans(
	__( 'Plans', 'wp-elite' ),
	__( 'Pick the level of care your site needs', 'wp-elite' ),
	__( 'Every plan is monthly, with no long contract. Tell us about your site and we’ll recommend one, with a fixed monthly quote.', 'wp-elite' ),
	array(
		array(
			__( 'Essential', 'wp-elite' ),
			__( 'For brochure sites that change now and then.', 'wp-elite' ),
			array( __( 'Tested monthly updates', 'wp-elite' ), __( 'Weekly off-site backups', 'wp-elite' ), __( 'Uptime and security monitoring', 'wp-elite' ), __( 'Monthly report', 'wp-elite' ) ),
		),
		array(
			__( 'Growth', 'wp-elite' ),
			__( 'For sites that bring in leads every week.', 'wp-elite' ),
			array( __( 'Everything in Essential', 'wp-elite' ), __( 'Daily off-site backups', 'wp-elite' ), __( 'Monthly Core Web Vitals check and fixes', 'wp-elite' ), __( 'Content changes each month', 'wp-elite' ), __( 'Form checks', 'wp-elite' ) ),
			true,
		),
		array(
			__( 'Priority', 'wp-elite' ),
			__( 'For busy sites where downtime costs money.', 'wp-elite' ),
			array( __( 'Everything in Growth', 'wp-elite' ), __( 'Weekly updates', 'wp-elite' ), __( 'More time for changes each month', 'wp-elite' ), __( 'Same-day response on working days', 'wp-elite' ) ),
		),
	),
	__( 'Already have a WordPress site we didn’t build? We’ll check it first, then take it on.', 'wp-elite' )
);

P\standards(
	__( 'No lock-in', 'wp-elite' ),
	__( 'No lock-in', 'wp-elite' ),
	__( 'Stop any time. Your site keeps working', 'wp-elite' ),
	__( 'A care plan is help, not a hostage situation. Your site never depends on us or any subscription.', 'wp-elite' ),
	array(
		array( __( 'No long contract', 'wp-elite' ), __( 'Monthly, cancel with a month’s notice', 'wp-elite' ) ),
		array( __( 'No page builder to renew', 'wp-elite' ), __( 'Nothing stops working if you leave', 'wp-elite' ) ),
		array( __( 'Your hosting, your accounts', 'wp-elite' ), __( 'Everything stays in your name', 'wp-elite' ) ),
		array( __( 'A clean handover', 'wp-elite' ), __( 'Backups and notes, if you move on', 'wp-elite' ) ),
	)
);

P\faq(
	array(
		array( __( 'Do you look after sites you didn’t build?', 'wp-elite' ), __( 'Yes, if they run on WordPress. We check the site first, fix anything urgent, then add it to a plan.', 'wp-elite' ) ),
		array( __( 'What counts as a content change?', 'wp-elite' ), __( 'Updating text and images, adding a team member, a case study or a new page from your existing blocks. New designs or features are quoted separately.', 'wp-elite' ) ),
		array( __( 'Is hosting included?', 'wp-elite' ), __( 'No. Your site stays on hosting in your name, so you’re never tied to us. We can recommend and set up a provider if you need one.', 'wp-elite' ) ),
		array( __( 'What happens if my site goes down?', 'wp-elite' ), __( 'Monitoring alerts us, and we start working on it. If something breaks after an update, we restore from backup and fix it.', 'wp-elite' ) ),
		array( __( 'Can I cancel?', 'wp-elite' ), __( 'Yes, with a month’s notice. You keep everything, and we hand over backups and notes so the next person can carry on.', 'wp-elite' ) ),
	)
);

P\related( 'care-plans' );

P\cta(
	__( 'Keep your website', 'wp-elite' ),
	__( 'fast and worry-free.', 'wp-elite' ),
	__( 'Tell us about your site. We’ll check it and recommend the right plan, with a fixed monthly quote.', 'wp-elite' ),
	array(
		array( __( 'Get a care plan', 'wp-elite' ), '/contact/?service=care-plans', 'elite-button--primary' ),
		array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=care-plans&call=1', 'elite-button--ghost' ),
	)
);
