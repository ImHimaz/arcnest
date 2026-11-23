<?php
/**
 * Title: Design & build page
 * Slug: wp-elite/page-design-and-build
 * Categories: wp-elite, featured
 * Keywords: service, design, build, new website
 * Description: The Design & build service page: hero with what you get, who it's for, what's included (nine items), how it works (four timed steps), our standards (purple band), our work, questions, other services and the closing call to action.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\service_hero(
	array(
		'crumb'     => __( 'Design & build', 'wp-elite' ),
		'eyebrow'   => __( 'Design & build', 'wp-elite' ),
		'title'     => __( 'A new website, designed around', 'wp-elite' ),
		'highlight' => __( 'how your customers buy.', 'wp-elite' ),
		'lead'      => __( 'We plan, design and build a fast WordPress website that explains what you do, earns trust and turns visitors into enquiries. No page builder, no licence fees, and it’s yours outright.', 'wp-elite' ),
		'buttons'   => array(
			array( __( 'Start a project', 'wp-elite' ), '/contact/?service=design-and-build', 'elite-button--secondary', 'arrow-right' ),
			array( __( 'See our work', 'wp-elite' ), '#work', 'elite-button--outline' ),
		),
		'card'      => __( 'What you get', 'wp-elite' ),
		'rows'      => array(
			array( 'message', __( 'A clear message in seconds', 'wp-elite' ), __( 'Visitors understand what you do and why you’re the right choice.', 'wp-elite' ) ),
			array( 'zap', __( 'Fast on every phone', 'wp-elite' ), __( 'Passes Core Web Vitals, measured with Google’s tools before launch.', 'wp-elite' ) ),
			array( 'bar-chart', __( 'Enquiries you can measure', 'wp-elite' ), __( 'Forms, booking and analytics set up, tested and tracked.', 'wp-elite' ) ),
		),
	)
);

P\fit(
	__( 'Who it’s for', 'wp-elite' ),
	__( 'When your website should be doing more of the selling', 'wp-elite' ),
	array(
		array( __( 'You’re launching or rebranding', 'wp-elite' ), __( 'A new company, a new offer or a new brand that needs a website to match, built properly from the start.', 'wp-elite' ) ),
		array( __( 'Your site doesn’t bring in enquiries', 'wp-elite' ), __( 'People visit, but few get in touch. The message, the layout or the path to contact isn’t working.', 'wp-elite' ) ),
		array( __( 'You’ve outgrown a template', 'wp-elite' ), __( 'A theme or DIY site that looked fine at first, but now feels slow, dated and hard to change.', 'wp-elite' ) ),
	)
);

P\included(
	__( 'What’s included', 'wp-elite' ),
	__( 'From the first conversation to the day you go live', 'wp-elite' ),
	__( 'One fixed scope and price, agreed before we start. No surprise invoices along the way.', 'wp-elite' ),
	array(
		array( 'search', __( 'Discovery', 'wp-elite' ), __( 'Your customers, your goals and what your site needs to do, in a short workshop.', 'wp-elite' ) ),
		array( 'grid', __( 'Sitemap and page structure', 'wp-elite' ), __( 'Which pages you need, what goes on each, and the path from visitor to enquiry.', 'wp-elite' ) ),
		array( 'message', __( 'Messaging', 'wp-elite' ), __( 'The key messages for each page, shaped with you so the words sell as well as the design.', 'wp-elite' ) ),
		array( 'image', __( 'Custom design', 'wp-elite' ), __( 'Designs for desktop and phone in your brand. You see and approve them before we build.', 'wp-elite' ) ),
		array( 'layers', __( 'Built on WordPress', 'wp-elite' ), __( 'WordPress’s own editor with blocks made for your content. No page builder.', 'wp-elite' ) ),
		array( 'mail', __( 'Lead capture', 'wp-elite' ), __( 'Contact forms, booking and quote requests, connected to your inbox or CRM.', 'wp-elite' ) ),
		array( 'bar-chart', __( 'Analytics and tracking', 'wp-elite' ), __( 'Google Analytics with your enquiries tracked as goals, so you know what works.', 'wp-elite' ) ),
		array( 'globe', __( 'SEO foundations', 'wp-elite' ), __( 'Page titles, descriptions, redirects and sitemaps set up with a trusted SEO plugin.', 'wp-elite' ) ),
		array( 'graduation-cap', __( 'Training and handover', 'wp-elite' ), __( 'A recorded walkthrough of your site, so your team can update it with confidence.', 'wp-elite' ) ),
	)
);

P\steps(
	__( 'How it works', 'wp-elite' ),
	__( 'Four steps, and you’re involved in each one', 'wp-elite' ),
	__( 'Most business websites take six to eight weeks, depending on the number of pages and how quickly content comes together.', 'wp-elite' ),
	array(
		array( __( 'Discover', 'wp-elite' ), __( 'A workshop on your business, your customers and your goals. You get a written plan and fixed quote.', 'wp-elite' ), __( 'Week 1', 'wp-elite' ) ),
		array( __( 'Structure & design', 'wp-elite' ), __( 'Page structure, key messages and designs for desktop and phone, revised until you’re happy.', 'wp-elite' ), __( 'Weeks 2–3', 'wp-elite' ) ),
		array( __( 'Build', 'wp-elite' ), __( 'We build the real site on a private staging address. You review it on your own devices as it comes together.', 'wp-elite' ), __( 'Weeks 3–6', 'wp-elite' ) ),
		array( __( 'Launch', 'wp-elite' ), __( 'Final checks, a speed and accessibility report, a zero-downtime launch and a walkthrough for your team.', 'wp-elite' ), __( 'Weeks 6–8', 'wp-elite' ) ),
	)
);

P\standards(
	__( 'Our standards', 'wp-elite' ),
	__( 'Our standards', 'wp-elite' ),
	__( 'Every site we launch, without exception', 'wp-elite' ),
	__( 'These aren’t extras. They’re how we build, and we show you the results before launch.', 'wp-elite' ),
	array(
		array( __( 'Passes Core Web Vitals on phones', 'wp-elite' ), __( 'Measured with Google’s tools before launch', 'wp-elite' ) ),
		array( __( 'No page builder, no licence fees', 'wp-elite' ), __( 'Built on WordPress’s own editor', 'wp-elite' ) ),
		array( __( 'Accessible', 'wp-elite' ), __( 'Checked for keyboard, contrast and screen readers', 'wp-elite' ) ),
		array( __( 'Easy for your team to edit', 'wp-elite' ), __( 'Blocks made for your content', 'wp-elite' ) ),
		array( __( 'Yours outright', 'wp-elite' ), __( 'Code, content and hosting in your name', 'wp-elite' ) ),
		array( __( 'Secure from day one', 'wp-elite' ), __( 'Updates, backups and hardening set up', 'wp-elite' ) ),
	)
);
?>
<!-- wp:pattern {"slug":"wp-elite/section-work"} /-->

<?php
P\faq(
	array(
		array( __( 'Do you write the words for the site?', 'wp-elite' ), __( 'We plan the structure and key messages of each page with you, so the words and the design work together. Tell us at the start if you’d also like the full copy written, and we’ll include it in the plan.', 'wp-elite' ) ),
		array( __( 'Can you work with our existing brand?', 'wp-elite' ), __( 'Yes. We design within your logo, colours and fonts. If your brand needs a refresh, we’ll tell you where and keep it consistent across the site.', 'wp-elite' ) ),
		array( __( 'Where will our site be hosted?', 'wp-elite' ), __( 'On hosting in your name. We recommend a provider that suits your traffic and budget, set it up with you, and you keep full control.', 'wp-elite' ) ),
		array( __( 'How long does it take?', 'wp-elite' ), __( 'Most business websites take six to eight weeks. Your fixed quote includes a timeline, and you’ll get a written update every week.', 'wp-elite' ) ),
		array( __( 'What happens after launch?', 'wp-elite' ), __( 'Your team can edit the site straight away. If you’d like us to keep it updated, backed up and fast, add a care plan. It’s optional, and the site never depends on it.', 'wp-elite' ) ),
	)
);

P\related( 'design-and-build' );

P\cta(
	__( 'Let’s plan a website that', 'wp-elite' ),
	__( 'brings you customers.', 'wp-elite' ),
	__( 'Tell us about your business and what you need. You’ll get a clear plan and a fixed quote, with no obligation.', 'wp-elite' ),
	array(
		array( __( 'Start a project', 'wp-elite' ), '/contact/?service=design-and-build', 'elite-button--primary' ),
		array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=design-and-build&call=1', 'elite-button--ghost' ),
	)
);
