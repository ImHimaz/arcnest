<?php
/**
 * The generated files in assets/json/ (`npm run classes`, also before
 * build/start): never edit them, edit the SCSS and feature folders.
 *
 * - manifest.json: every feature folder (assets/blocks, layout, sections,
 *   pages, vendor), its classes, what loads it, whether it has a script.
 * - colors.json, text-styles.json, breakpoints.json: from the abstracts.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

/**
 * A generated JSON file, decoded (empty if missing).
 *
 * @param string $name File name in assets/json, e.g. 'colors'.
 * @return array<mixed>
 */
function read_json( string $name ): array {
	static $cache = array();

	if ( ! isset( $cache[ $name ] ) ) {
		$file           = get_theme_file_path( "assets/json/{$name}.json" );
		$decoded        = is_readable( $file ) ? json_decode( (string) file_get_contents( $file ), true ) : null; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local file.
		$cache[ $name ] = is_array( $decoded ) ? $decoded : array();
	}

	return $cache[ $name ];
}

/**
 * Feature folders by kind.
 *
 * - blocks: by block name → {folder, styles, modifiers, script}
 * - layout, sections, pages, vendor: by folder → {modifiers (by block),
 *   script, trigger (sections: the root class), when (vendor)}
 *
 * @phpstan-return array{blocks: array<string, array{folder: string, styles: list<array{name: string, label: string}>, modifiers: list<array{value: string, label: string}>, script: bool}>, layout: array<string, array<string, mixed>>, sections: array<string, array<string, mixed>>, pages: array<string, array<string, mixed>>, vendor: array<string, array<string, mixed>>}
 * @return array<string, array<string, array<string, mixed>>>
 */
function manifest(): array {
	/**
	 * The feature manifest (e.g. for tests, or a child theme adding folders).
	 *
	 * @param array<string, mixed> $manifest Manifest by kind.
	 */
	$manifest = (array) apply_filters( 'wp_elite_manifest', read_json( 'manifest' ) );
	foreach ( array( 'blocks', 'layout', 'sections', 'pages', 'vendor' ) as $kind ) {
		$manifest[ $kind ] = is_array( $manifest[ $kind ] ?? null ) ? $manifest[ $kind ] : array();
	}
	return $manifest;
}

/**
 * The colour palette (from `$colors`).
 *
 * @return list<array{slug: string, name: string, color: string}>
 */
function color_palette(): array {
	return array_values( read_json( 'colors' ) );
}

/**
 * The text styles (the `$text-styles` keys).
 *
 * @return list<array{slug: string, name: string}>
 */
function text_styles(): array {
	return array_values( read_json( 'text-styles' ) );
}
