<?php
/**
 * Max Mega Menu's scripts are deferred; jQuery stays as WordPress loads it
 * unless a site opts in (inc/integrations/megamenu.php). Run by run.php.
 *
 * @package WpElite
 */

use function WpElite\MegaMenu\active;
use function WpElite\MegaMenu\defer_scripts;

if ( ! active() ) {
	echo "- Max Mega Menu isn't active: skipped\n";
	return;
}

// The plugin registers its scripts on the page; stand-ins here.
wp_register_script( 'megamenu', 'https://example.com/megamenu.js', array( 'jquery', 'hoverIntent' ), '1', true );

$wp_elite_strategy = static fn ( string $handle ): ?string => wp_scripts()->get_data( $handle, 'strategy' ) ? (string) wp_scripts()->get_data( $handle, 'strategy' ) : null;

defer_scripts();
$wp_elite_check( 'The menu’s scripts are deferred', array( 'defer', 'defer' ), array( $wp_elite_strategy( 'megamenu' ), $wp_elite_strategy( 'hoverIntent' ) ) );
$wp_elite_check( 'jQuery stays as WordPress loads it (inline jQuery code keeps working)', array( null, null ), array( $wp_elite_strategy( 'jquery-core' ), $wp_elite_strategy( 'jquery-migrate' ) ) );

add_filter( 'wp_elite_megamenu_defer_jquery', '__return_true' );
defer_scripts();
remove_filter( 'wp_elite_megamenu_defer_jquery', '__return_true' );
$wp_elite_check( 'Opt in: jQuery deferred too', array( 'defer', 'defer' ), array( $wp_elite_strategy( 'jquery-core' ), $wp_elite_strategy( 'jquery-migrate' ) ) );
