<?php
/**
 * Staging and production run the built theme (README → Environments), so the
 * Theme File Editor is off there: theme code is changed in the repo and
 * deployed, never edited on the server. Local and development sites keep it.
 *
 * (Elite Blocks, when active, also turns off the Plugin File Editor and
 * leaves itself out of the Plugins screen on those sites.)
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

/**
 * Whether this is a built site: `WP_ENVIRONMENT_TYPE` staging or production
 * (a site without one counts as production). The `wp_elite_locked` filter
 * decides otherwise.
 */
function locked(): bool {
	$locked = in_array( wp_get_environment_type(), array( 'staging', 'production' ), true );

	/**
	 * Whether the Theme File Editor is off.
	 *
	 * @param bool $locked True on staging and production.
	 */
	return (bool) apply_filters( 'wp_elite_locked', $locked );
}

/**
 * No one may use the Theme File Editor on a built site.
 *
 * @param string[] $caps Primitive capabilities the check needs.
 * @param string   $cap  Capability being checked.
 * @return string[]
 */
function lock_theme_editor( array $caps, string $cap ): array {
	if ( 'edit_themes' === $cap && locked() ) {
		return array( 'do_not_allow' );
	}
	return $caps;
}
add_filter( 'map_meta_cap', __NAMESPACE__ . '\\lock_theme_editor', 10, 2 );
