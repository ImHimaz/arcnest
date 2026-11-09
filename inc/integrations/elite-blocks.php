<?php
/**
 * Elite Blocks: what the theme offers the plugin, through its filters only
 * (the two never depend on each other; without the plugin these filters are
 * simply never applied).
 *
 * - Block Classes: modifiers from every feature folder (assets/json/manifest.json).
 * - Text Styles: the type scale (`$text-styles`).
 * - Icons: every assets/icons/<slug>.svg, labelled from its file name
 *   (`arrow-right.svg` → "Arrow Right"). Draw with `currentColor` so icons
 *   follow the text colour.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\EliteBlocks;

use function WpElite\manifest;
use function WpElite\text_styles;

/**
 * Modifier classes for the "Block Classes" panel: each block's own, then
 * the parts of layout, section and page folders ("Hero › Media").
 *
 * @param array<string, list<array{value: string, label: string}>> $presets Presets by block name.
 * @return array<string, list<array{value: string, label: string}>>
 */
function add_class_presets( array $presets ): array {
	$manifest = manifest();

	foreach ( $manifest['blocks'] as $block_name => $block ) {
		foreach ( $block['modifiers'] as $modifier ) {
			$presets[ $block_name ][] = $modifier;
		}
	}

	foreach ( array( 'layout', 'sections', 'pages' ) as $kind ) {
		foreach ( $manifest[ $kind ] as $feature ) {
			foreach ( (array) ( $feature['modifiers'] ?? array() ) as $block_name => $modifiers ) {
				foreach ( (array) $modifiers as $modifier ) {
					$presets[ $block_name ][] = $modifier;
				}
			}
		}
	}

	return $presets;
}
add_filter( 'elite_blocks_class_presets', __NAMESPACE__ . '\\add_class_presets' );

/**
 * The theme's text styles, for the Text Style dropdown.
 *
 * @param array<int, mixed> $styles Text styles.
 * @return array<int, mixed>
 */
function add_text_styles( array $styles ): array {
	return array_merge( $styles, text_styles() );
}
add_filter( 'elite_blocks_text_styles', __NAMESPACE__ . '\\add_text_styles' );

/**
 * The theme's icons (the plugin sanitises them).
 *
 * @param array<string, mixed> $icons Icons by slug.
 * @return array<string, mixed>
 */
function add_icons( array $icons ): array {
	$files = glob( get_theme_file_path( 'assets/icons/*.svg' ) );

	foreach ( false === $files ? array() : $files as $file ) {
		$slug = basename( $file, '.svg' );
		$svg  = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local file.

		if ( false !== $svg ) {
			$icons[ $slug ] = array(
				'label' => ucwords( str_replace( array( '-', '_' ), ' ', $slug ) ),
				'svg'   => $svg,
			);
		}
	}

	return $icons;
}
add_filter( 'elite_blocks_icons', __NAMESPACE__ . '\\add_icons' );
