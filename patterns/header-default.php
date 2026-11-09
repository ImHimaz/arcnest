<?php
/**
 * Title: Header
 * Slug: wp-elite/header-default
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Logo, the menu (links to the home page's sections) and "Let's talk"; the header template part's content. Below the laptop width the menu opens from a button, with the logo at its top and "Let's talk" under the links (both only in the open menu).
 *
 * @package WpElite
 */

/**
 * A menu link to a section of the home page.
 *
 * @param string $label  Link text.
 * @param string $anchor Section ID on the home page.
 */
$wp_elite_link = static function ( string $label, string $anchor ): void {
	printf(
		'<!-- wp:navigation-link %s /-->' . "\n",
		wp_json_encode(
			array(
				'label' => $label,
				'url'   => home_url( '/#' . $anchor ),
				'kind'  => 'custom',
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
		)
	);
};
?>
<!-- wp:group {"align":"full","className":"site-header__bar","layout":{"type":"constrained","contentSize":"1280px"}} -->
<div class="wp-block-group alignfull site-header__bar"><!-- wp:group {"className":"site-header__inner","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group site-header__inner"><!-- wp:pattern {"slug":"wp-elite/site-logo"} /-->

<!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"primary-900","overlayTextColor":"base","className":"site-header__nav","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:site-logo {"width":144,"className":"site-header__menu-logo"} /-->

<?php
$wp_elite_link( __( 'Services', 'wp-elite' ), 'services' );
$wp_elite_link( __( 'Our theme', 'wp-elite' ), 'theme' );
$wp_elite_link( __( 'Process', 'wp-elite' ), 'process' );
$wp_elite_link( __( 'For agencies', 'wp-elite' ), 'agencies' );
$wp_elite_link( __( 'FAQ', 'wp-elite' ), 'faq' );
?>

<!-- wp:buttons {"className":"site-header__menu-cta"} -->
<div class="wp-block-buttons site-header__menu-cta"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Let’s talk', 'wp-elite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:navigation -->

<!-- wp:buttons {"className":"site-header__cta"} -->
<div class="wp-block-buttons site-header__cta"><!-- wp:button {"className":"core-button--small"} -->
<div class="wp-block-button core-button--small"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Let’s talk', 'wp-elite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
