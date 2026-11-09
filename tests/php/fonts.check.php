<?php
/**
 * Fonts: theme.json's body font files are preloaded (inc/fonts.php). Run by
 * run.php.
 *
 * @package WpElite
 */

use function WpElite\preload_fonts;

$wp_elite_check(
	'Preloads the body font (woff2, from theme.json)',
	array( get_theme_file_uri( 'assets/fonts/plus-jakarta-sans/PlusJakartaSans-Latin-VariableFont_wght.woff2' ) ),
	preload_fonts()
);
$wp_elite_check( 'The font file is in the theme', true, is_readable( get_theme_file_path( 'assets/fonts/plus-jakarta-sans/PlusJakartaSans-Latin-VariableFont_wght.woff2' ) ) );

$wp_elite_no_preload = static fn (): array => array();
add_filter( 'wp_elite_preload_fonts', $wp_elite_no_preload );
$wp_elite_check( 'wp_elite_preload_fonts can turn it off', array(), preload_fonts() );
remove_filter( 'wp_elite_preload_fonts', $wp_elite_no_preload );
