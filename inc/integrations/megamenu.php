<?php
/**
 * Max Mega Menu: the header's menu, with lean settings. Its styles:
 * assets/vendor/megamenu.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\MegaMenu;

/** The header menu's location (Appearance → Menus, Mega Menu → Menu Locations). */
const LOCATION = 'primary';

/**
 * Settings kept in code (every site and environment the same), over the
 * ones saved in Mega Menu → General Settings:
 *
 * - No icon fonts: Pro loads Font Awesome 4, 5, 6 and Genericons on every
 *   page unless each is turned off (~190 KB of CSS, plus fonts). Icons:
 *   the theme's SVGs.
 * - CSS in a file (cached by browsers), scripts in the footer.
 *
 * A project that needs one back: the `wp_elite_megamenu_settings` filter.
 */
const SETTINGS = array(
	'css'                => 'fs',
	'js'                 => 'footer',
	'enqueue_fa_4'       => 'disabled',
	'enqueue_fa_5'       => 'disabled',
	'enqueue_fa_6'       => 'disabled',
	'enqueue_genericons' => 'disabled',
);

/**
 * Whether Max Mega Menu is active.
 */
function active(): bool {
	return defined( 'MEGAMENU_VERSION' );
}

/**
 * The settings kept in code.
 *
 * @return array<string, mixed>
 */
function settings(): array {
	/**
	 * Max Mega Menu settings WP Elite keeps (over the saved ones).
	 *
	 * @param array<string, mixed> $settings Settings.
	 */
	return (array) apply_filters( 'wp_elite_megamenu_settings', SETTINGS );
}

/**
 * The header menu's location: also brings back Appearance → Menus (block
 * themes hide it), where Max Mega Menu's panels are built.
 */
function register_location(): void {
	register_nav_menus( array( LOCATION => __( 'Header menu', 'wp-elite' ) ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\register_location' );

/**
 * The saved settings, with the ones kept in code over them (also before
 * any are saved).
 *
 * @param mixed $saved Saved settings.
 * @return mixed
 */
function apply_settings( $saved ) {
	return array_merge( is_array( $saved ) ? $saved : array(), settings() );
}
add_filter( 'option_megamenu_settings', __NAMESPACE__ . '\\apply_settings' );
add_filter( 'default_option_megamenu_settings', __NAMESPACE__ . '\\apply_settings' );

/**
 * Visitors: no Dashicons (Max Mega Menu loads them on every page for its
 * default arrows; the theme draws arrows with CSS). Logged-in users keep
 * them (the admin bar uses them).
 */
function dequeue_dashicons(): void {
	/**
	 * Keep Dashicons for visitors (e.g. a menu item icon is a Dashicon).
	 *
	 * @param bool $keep Keep them.
	 */
	if ( ! is_user_logged_in() && ! apply_filters( 'wp_elite_megamenu_dashicons', false ) ) {
		wp_dequeue_style( 'dashicons' );
	}
}
add_action( 'megamenu_enqueue_public_scripts', __NAMESPACE__ . '\\dequeue_dashicons', 20 );

/**
 * The menu's scripts load in the footer, deferred: they don't hold up the
 * page. jQuery stays as WordPress loads it (in <head>), because code that
 * plugins, widgets or a Custom HTML block print straight into the page
 * (`<script>jQuery(…)</script>`) runs as soon as it's read and needs jQuery
 * already there. A site that knows nothing does that can defer jQuery too:
 * `add_filter( 'wp_elite_megamenu_defer_jquery', '__return_true' );`.
 */
function defer_scripts(): void {
	if ( ! active() || is_admin() ) {
		return;
	}
	$handles = array( 'megamenu', 'megamenu-pro', 'hoverIntent' );
	/**
	 * Also load jQuery in the footer, deferred (off by default: inline
	 * jQuery code in the page would break).
	 *
	 * @param bool $defer Defer it.
	 */
	if ( apply_filters( 'wp_elite_megamenu_defer_jquery', false ) ) {
		$handles = array_merge( $handles, array( 'jquery', 'jquery-core', 'jquery-migrate' ) );
	}
	$scripts = wp_scripts();
	foreach ( $handles as $handle ) {
		$script = $scripts->registered[ $handle ] ?? null;
		if ( ! $script ) {
			continue;
		}
		$scripts->add_data( $handle, 'group', 1 );
		// Not an alias ('jquery' only names jquery-core and jquery-migrate).
		// WordPress keeps it blocking if a script needing it isn't deferred.
		if ( $script->src ) {
			$scripts->add_data( $handle, 'strategy', 'defer' );
		}
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\defer_scripts', 1000 );

// The theme's menu styles (arrows, panel base): assets/vendor/megamenu,
// loaded after Max Mega Menu's while it's active (inc/assets.php).
