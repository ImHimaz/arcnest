<?php
/**
 * Title: Header
 * Slug: wp-elite/header-default
 * Categories: header
 * Block Types: core/template-part/header
 * Description: A white sticky bar: the logo (purple, Settings → Site logo), the menu (Services, Work, Speed test, About, Contact) and "Start a project"; the header template part's content. Below the laptop width the menu opens from a button, with the logo at its top and "Start a project" under the links (both only in the open menu).
 *
 * @package WpElite
 */

/**
 * A menu link to a section of the home page.
 *
 * @param string $label  Link text.
 * @param string $anchor Section ID on the home page.
 */
$wp_elite_link = static function ( string $label, string $path ): void {
	printf(
		'<!-- wp:navigation-link %s /-->' . "\n",
		wp_json_encode(
			array(
				'label' => $label,
				'url'   => home_url( $path ),
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

<!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"base","overlayTextColor":"contrast","className":"site-header__nav","layout":{"type":"flex","justifyContent":"right"}} -->
<!-- wp:site-logo {"width":144,"className":"site-header__menu-logo"} /-->

<?php
$wp_elite_link( __( 'Services', 'wp-elite' ), '/#services' );
$wp_elite_link( __( 'Work', 'wp-elite' ), '/#work' );
$wp_elite_link( __( 'Speed test', 'wp-elite' ), '/speed-test/' );
$wp_elite_link( __( 'About', 'wp-elite' ), '/about/' );
$wp_elite_link( __( 'Contact', 'wp-elite' ), '/contact/' );
?>

<!-- wp:buttons {"className":"site-header__menu-cta"} -->
<div class="wp-block-buttons site-header__menu-cta"><!-- wp:button {"className":"core-button--purple"} -->
<div class="wp-block-button core-button--purple"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start a project', 'wp-elite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:navigation -->

<!-- wp:buttons {"className":"site-header__cta"} -->
<div class="wp-block-buttons site-header__cta"><!-- wp:button {"className":"core-button--small core-button--purple"} -->
<div class="wp-block-button core-button--small core-button--purple"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start a project', 'wp-elite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
