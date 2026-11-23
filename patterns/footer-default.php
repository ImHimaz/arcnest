<?php
/**
 * Title: Footer
 * Slug: wp-elite/footer-default
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: On dark: the white logo (the secondary logo from Settings → General, with Elite Blocks) and a line about Arcnest, three link columns (Services, Company, Contact) and the copyright line; the footer template part's content.
 *
 * @package WpElite
 */

/**
 * A footer link list item.
 *
 * @param string $label    Link text.
 * @param string $url      Address.
 * @param bool   $external Opens another site (new tab).
 */
$wp_elite_item = static function ( string $label, string $url, bool $external = false ): void {
	printf(
		"<!-- wp:list-item -->\n<li><a href=\"%s\"%s>%s</a></li>\n<!-- /wp:list-item -->\n\n",
		esc_url( $url ),
		$external ? ' target="_blank" rel="noreferrer noopener"' : '',
		esc_html( $label )
	);
};

/**
 * A footer column: a small heading and its links.
 *
 * @param string                          $title Heading.
 * @param list<array{0: string, 1: string, 2?: bool}> $links Label, address, external.
 */
$wp_elite_column = static function ( string $title, array $links ) use ( $wp_elite_item ): void {
	echo "<!-- wp:group {\"className\":\"site-footer__col\",\"layout\":{\"type\":\"default\"}} -->\n<div class=\"wp-block-group site-footer__col\">";
	printf( "<!-- wp:heading {\"className\":\"site-footer__title\"} -->\n<h2 class=\"wp-block-heading site-footer__title\">%s</h2>\n<!-- /wp:heading -->\n\n", esc_html( $title ) );
	echo "<!-- wp:list {\"className\":\"site-footer__links\"} -->\n<ul class=\"wp-block-list site-footer__links\">";
	foreach ( $links as $link ) {
		$wp_elite_item( $link[0], $link[1], $link[2] ?? false );
	}
	echo "</ul>\n<!-- /wp:list --></div>\n<!-- /wp:group -->\n\n";
};
?>
<!-- wp:group {"align":"full","className":"site-footer__main","layout":{"type":"constrained","contentSize":"1280px"}} -->
<div class="wp-block-group alignfull site-footer__main"><!-- wp:group {"className":"site-footer__grid","layout":{"type":"default"}} -->
<div class="wp-block-group site-footer__grid"><!-- wp:group {"className":"site-footer__brand","layout":{"type":"default"}} -->
<div class="wp-block-group site-footer__brand"><!-- wp:site-logo {"width":144,"className":"site-logo","eliteLogo":"secondary"} /-->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Fast WordPress websites that win customers. No page builder, no licence fees.', 'wp-elite' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
$wp_elite_column(
	__( 'Services', 'wp-elite' ),
	array(
		array( __( 'Design & build', 'wp-elite' ), home_url( '/design-and-build/' ) ),
		array( __( 'Rebuild', 'wp-elite' ), home_url( '/rebuild/' ) ),
		array( __( 'Care plans', 'wp-elite' ), home_url( '/care-plans/' ) ),
		array( __( 'White-label', 'wp-elite' ), home_url( '/white-label/' ) ),
	)
);
$wp_elite_column(
	__( 'Company', 'wp-elite' ),
	array(
		array( __( 'Work', 'wp-elite' ), home_url( '/#work' ) ),
		array( __( 'Speed test', 'wp-elite' ), home_url( '/speed-test/' ) ),
		array( __( 'About', 'wp-elite' ), home_url( '/about/' ) ),
		array( __( 'Contact', 'wp-elite' ), home_url( '/contact/' ) ),
	)
);
$wp_elite_column(
	__( 'Contact', 'wp-elite' ),
	array(
		array( 'hello@arcnest.dev', 'mailto:hello@arcnest.dev' ),
		array( 'LinkedIn', 'https://www.linkedin.com/in/imhimaz/', true ),
		array( __( 'Privacy', 'wp-elite' ), get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ),
	)
);
?>
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"site-footer__bottom","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group site-footer__bottom"><!-- wp:paragraph -->
<p><?php /* translators: %s: the current year. */ printf( esc_html__( '© %s Arcnest. All rights reserved.', 'wp-elite' ), esc_html( gmdate( 'Y' ) ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Made fast in Sri Lanka', 'wp-elite' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
