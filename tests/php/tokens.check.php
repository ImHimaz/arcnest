<?php
/**
 * Design tokens from the SCSS abstracts become theme.json's palette and
 * font sizes (inc/setup.php). Run by run.php.
 *
 * @package WpElite
 */

use function WpElite\color_palette;
use function WpElite\text_styles;

$wp_elite_sizes = wp_get_global_settings( array( 'typography', 'fontSizes', 'theme' ) );
$wp_elite_check(
	'Font sizes: one per text style, same names and order',
	array_map( static fn ( array $style ): string => $style['name'], text_styles() ),
	array_map( static fn ( array $size ): string => $size['name'], (array) $wp_elite_sizes )
);
$wp_elite_check(
	'Font sizes: the type scale’s own per-device size, not fluid',
	array( 'var(--text-title-1-font-size)', false ),
	array( $wp_elite_sizes[0]['size'] ?? null, $wp_elite_sizes[0]['fluid'] ?? null )
);
$wp_elite_check(
	'WordPress’s own font sizes are off (only the type scale in the picker)',
	false,
	wp_get_global_settings( array( 'typography', 'defaultFontSizes' ) )
);
$wp_elite_check(
	'The palette is $colors',
	array_column( color_palette(), 'slug' ),
	array_column( (array) wp_get_global_settings( array( 'color', 'palette', 'theme' ) ), 'slug' )
);
$wp_elite_check(
	'Preset variables point at the type scale',
	true,
	str_contains( wp_get_global_stylesheet( array( 'variables' ) ), '--wp--preset--font-size--title-1: var(--text-title-1-font-size)' )
);
