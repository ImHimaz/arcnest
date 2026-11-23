<?php
/**
 * Title: Rebuild page
 * Slug: wp-elite/page-rebuild
 * Categories: wp-elite, featured
 * Keywords: service, rebuild, elementor, divi, page builder, speed
 * Description: The Rebuild service page: hero with our speed test numbers, signs it's time, what's included (nine items), how it works (four steps), a before-and-after comparison table, the free speed check, questions, other services and the closing call to action.
 * Post Types: page
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\service_hero(
	array(
		'crumb'     => __( 'Rebuild', 'wp-elite' ),
		'eyebrow'   => __( 'Rebuild without a page builder', 'wp-elite' ),
		'title'     => __( 'Keep your design.', 'wp-elite' ),
		'highlight' => __( 'Lose the page builder.', 'wp-elite' ),
		'lead'      => __( 'We rebuild your Elementor, Divi or WPBakery site on WordPress’s own editor. It looks the same, loads faster, is easier to edit, and has no licence to renew. Your content and search rankings come with it.', 'wp-elite' ),
		'buttons'   => array(
			array( __( 'Plan my rebuild', 'wp-elite' ), '/contact/?service=rebuild', 'elite-button--secondary', 'arrow-right' ),
			array( __( 'Test your site free', 'wp-elite' ), '#check', 'elite-button--outline' ),
		),
		'card'      => __( 'Same design, rebuilt by us', 'wp-elite' ),
		'dark'      => true,
		'rows'      => array(
			array( '2×', __( '2× lighter pages', 'wp-elite' ), __( '351 KB vs 698 KB per page, same design as the Elementor Pro build', 'wp-elite' ), true ),
			array( '3.5s', __( '3.5 s sooner', 'wp-elite' ), __( 'fully loaded on a budget phone: 7.1 s vs 10.6 s', 'wp-elite' ), true ),
			array( '$0', __( '$0 a year', 'wp-elite' ), __( 'in builder licences, for as long as the site runs', 'wp-elite' ), true ),
		),
	)
);

P\signs(
	__( 'Signs it’s time', 'wp-elite' ),
	__( 'Your site works, but it’s holding you back', 'wp-elite' ),
	array(
		array( __( 'It’s slow on phones', 'wp-elite' ), __( 'PageSpeed shows red, Core Web Vitals fail, and visitors leave before the page appears.', 'wp-elite' ) ),
		array( __( 'Editing breaks the layout', 'wp-elite' ), __( 'Small text changes shift columns, and nobody on your team wants to touch the builder.', 'wp-elite' ) ),
		array( __( 'You pay for a builder every year', 'wp-elite' ), __( 'Elementor Pro or a theme bundle renews every year, just to keep the site running.', 'wp-elite' ) ),
		array( __( 'Updates are risky', 'wp-elite' ), __( 'A stack of add-ons and plugins, where every update might break something.', 'wp-elite' ) ),
	)
);

P\included(
	__( 'What’s included', 'wp-elite' ),
	__( 'Everything moved, nothing lost', 'wp-elite' ),
	__( 'We measure your site before we start and after we finish, so you can see exactly what changed.', 'wp-elite' ),
	array(
		array( 'search', __( 'Speed and SEO audit', 'wp-elite' ), __( 'Where your site loses time today, and every page, link and ranking we need to keep.', 'wp-elite' ) ),
		array( 'eye', __( 'Pixel-matched rebuild', 'wp-elite' ), __( 'Your design rebuilt as it is, or improved where it helps. You decide.', 'wp-elite' ) ),
		array( 'layers', __( 'Blocks made for your content', 'wp-elite' ), __( 'Each section becomes a block your team can edit in WordPress’s own editor.', 'wp-elite' ) ),
		array( 'file-text', __( 'Content moved over', 'wp-elite' ), __( 'Pages, posts, images and downloads, moved and checked one by one.', 'wp-elite' ) ),
		array( 'link', __( 'Links and rankings kept', 'wp-elite' ), __( 'The same addresses, page titles and descriptions, with redirects wherever anything moves.', 'wp-elite' ) ),
		array( 'mail', __( 'Forms and tools reconnected', 'wp-elite' ), __( 'Contact forms, booking, analytics and your CRM, tested end to end.', 'wp-elite' ) ),
		array( 'trash', __( 'Plugin clean-up', 'wp-elite' ), __( 'The builder and its add-ons removed, along with plugins you no longer need.', 'wp-elite' ) ),
		array( 'trending-up', __( 'Before-and-after report', 'wp-elite' ), __( 'Speed, page weight and Core Web Vitals, measured before and after the switch.', 'wp-elite' ) ),
		array( 'graduation-cap', __( 'Team walkthrough', 'wp-elite' ), __( 'A recorded tour of the new editor, so your team is comfortable from day one.', 'wp-elite' ) ),
	)
);

P\steps(
	__( 'How it works', 'wp-elite' ),
	__( 'Your live site stays up the whole time', 'wp-elite' ),
	__( 'We build the new version alongside your current one and switch over only when you’re happy.', 'wp-elite' ),
	array(
		array( __( 'Audit', 'wp-elite' ), __( 'We measure your current site and list every page, form and link. You get a fixed scope and quote.', 'wp-elite' ) ),
		array( __( 'Rebuild', 'wp-elite' ), __( 'We rebuild the site on a private staging address, section by section, as blocks.', 'wp-elite' ) ),
		array( __( 'Compare', 'wp-elite' ), __( 'You review old and new side by side on your own devices. We fix anything that doesn’t match.', 'wp-elite' ) ),
		array( __( 'Switch over', 'wp-elite' ), __( 'A zero-downtime switch, redirects checked, and your before-and-after report.', 'wp-elite' ) ),
	)
);

// Before and after: label, after the rebuild, on a page builder.
$wp_elite_rows = array(
	array( __( 'Yearly licence to keep it running', 'wp-elite' ), __( 'None', 'wp-elite' ), __( '$60–$228 a year (Elementor Pro)', 'wp-elite' ) ),
	array( __( 'Page weight, same design', 'wp-elite' ), '351 KB', '698 KB' ),
	array( __( 'Fully loaded on a budget phone', 'wp-elite' ), '7.1 s', '10.6 s' ),
	array( __( 'Accessibility score', 'wp-elite' ), '100', '88' ),
	array( __( 'Editing', 'wp-elite' ), __( 'WordPress’s own editor, custom blocks', 'wp-elite' ), __( 'Builder panels, easy to break the layout', 'wp-elite' ) ),
);
$wp_elite_body = '';
foreach ( $wp_elite_rows as $wp_elite_row ) {
	$wp_elite_body .= '<tr><td>' . esc_html( $wp_elite_row[0] ) . '</td><td>' . esc_html( $wp_elite_row[1] ) . '</td><td>' . esc_html( $wp_elite_row[2] ) . '</td></tr>';
}
P\section_open( __( 'Before and after', 'wp-elite' ), 'elite-section--service-compare' );
?>
<!-- wp:table {"className":"core-table--compare"} -->
<figure class="wp-block-table core-table--compare"><table class="has-fixed-layout"><thead><tr><th></th><th><?php esc_html_e( 'After the rebuild', 'wp-elite' ); ?></th><th><?php esc_html_e( 'On a page builder', 'wp-elite' ); ?></th></tr></thead><tbody><?php echo $wp_elite_body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?></tbody></table><figcaption class="wp-element-caption"><?php esc_html_e( 'Measured on the same design and hosting: our build vs Elementor Pro, Nov 2026. Licence prices from elementor.com.', 'wp-elite' ); ?></figcaption></figure>
<!-- /wp:table -->
<?php P\section_close(); ?>
<!-- wp:pattern {"slug":"wp-elite/section-check"} /-->

<?php
P\faq(
	array(
		array( __( 'Will my site look the same?', 'wp-elite' ), __( 'Yes. We match your current design closely. If there are things you’ve wanted to improve, we can do that at the same time; it’s your choice, agreed before we start.', 'wp-elite' ) ),
		array( __( 'Will we lose our Google rankings?', 'wp-elite' ), __( 'We keep your addresses, page titles and descriptions, and add redirects wherever anything moves. A faster site usually helps rankings rather than hurting them.', 'wp-elite' ) ),
		array( __( 'Will the site go offline?', 'wp-elite' ), __( 'No. We build on a staging address and switch over in minutes, at a quiet time for your business.', 'wp-elite' ) ),
		array( __( 'Which builders do you rebuild from?', 'wp-elite' ), __( 'Elementor, Divi, WPBakery, Beaver Builder and most theme builders. If your site is on WordPress, we can rebuild it.', 'wp-elite' ) ),
		array( __( 'What happens to the builder licence?', 'wp-elite' ), __( 'Once the new site is live, you no longer need it. Cancel the renewal and keep the money.', 'wp-elite' ) ),
	)
);

P\related( 'rebuild' );

P\cta(
	__( 'Same site.', 'wp-elite' ),
	__( 'Faster, lighter, yours.', 'wp-elite' ),
	__( 'Send us your site’s address. We’ll measure it and come back with a fixed scope and quote for the rebuild.', 'wp-elite' ),
	array(
		array( __( 'Plan my rebuild', 'wp-elite' ), '/contact/?service=rebuild', 'elite-button--primary' ),
		array( __( 'Book a 30-minute call', 'wp-elite' ), '/contact/?service=rebuild&call=1', 'elite-button--ghost' ),
	)
);
