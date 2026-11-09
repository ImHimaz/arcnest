<?php
/**
 * Styles and scripts: the global stylesheet, and each feature folder's files
 * only where that feature is used (assets/json/manifest.json):
 *
 * | Folder                 | Loads                                              |
 * |------------------------|----------------------------------------------------|
 * | blocks/<block-class>/  | with that block (or, not a block, its class)       |
 * | layout/<part>/         | with that template part (header, footer)           |
 * | sections/<name>/       | on pages using its root class (elite-section--…)   |
 * | pages/<body-class>/    | on pages with that body class (single-post…)       |
 * | vendor/<plugin>/       | while the plugin is active (`// Active when:`)     |
 *
 * Scripts (a folder's view.js) load with their styles, deferred, in the
 * footer. In the editor, every layout, section and page style loads
 * (build/editor-features.css): it can't know which a post will use.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

/**
 * Version string from a wp-scripts asset file, so caches bust on every build.
 *
 * @param string $name Entry name, e.g. 'theme' or 'sections/hero'.
 */
function asset_version( string $name ): string {
	$file = get_theme_file_path( "build/{$name}.asset.php" );

	return is_readable( $file ) ? (string) ( require $file )['version'] : WP_ELITE_VERSION;
}

/**
 * Global theme styles, on every page.
 */
function enqueue_styles(): void {
	wp_enqueue_style(
		'wp-elite',
		get_theme_file_uri( 'build/theme.css' ),
		array(),
		asset_version( 'theme' )
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_styles' );

/**
 * A feature's handle: `wp-elite-<folder>` for blocks (`wp-elite-elite-button`),
 * `wp-elite-<kind>-<name>` for the rest (`wp-elite-sections-hero`).
 *
 * @param string $kind Folder kind.
 * @param string $name Folder name.
 */
function feature_handle( string $kind, string $name ): string {
	return 'blocks' === $kind ? "wp-elite-{$name}" : "wp-elite-{$kind}-{$name}";
}

/**
 * A feature folder's manifest entry (blocks by folder name too).
 *
 * @param string $kind Folder kind.
 * @param string $name Folder name.
 * @return array<string, mixed>|null
 */
function feature( string $kind, string $name ): ?array {
	$features = manifest()[ $kind ] ?? array();
	if ( 'blocks' === $kind ) {
		foreach ( $features as $entry ) {
			if ( ( $entry['folder'] ?? '' ) === $name ) {
				return $entry;
			}
		}
		return null;
	}
	return $features[ $name ] ?? null;
}

/**
 * Register a feature's built style and script (once).
 *
 * @param string $kind Folder kind.
 * @param string $name Folder name.
 * @return array{style: string|null, script: string|null} Handles registered.
 */
function register_feature( string $kind, string $name ): array {
	static $registered = array();

	$entry = "{$kind}/{$name}";
	// Registered once a request, except that the editor collects its
	// canvas's styles with a fresh registry: register again there.
	if ( isset( $registered[ $entry ] ) && ( ! $registered[ $entry ]['style'] || wp_style_is( $registered[ $entry ]['style'], 'registered' ) ) ) {
		return $registered[ $entry ];
	}

	$handle  = feature_handle( $kind, $name );
	$handles = array(
		'style'  => null,
		'script' => null,
	);

	$css = get_theme_file_path( "build/{$entry}.css" );
	if ( is_readable( $css ) ) {
		wp_register_style( $handle, get_theme_file_uri( "build/{$entry}.css" ), array(), asset_version( $entry ) );
		// Small files are inlined (styles_inline_size_limit), as block styles;
		// right-to-left languages get the -rtl.css file.
		$rtl = get_theme_file_path( "build/{$entry}-rtl.css" );
		wp_style_add_data( $handle, 'path', is_rtl() && is_readable( $rtl ) ? $rtl : $css );
		if ( is_readable( $rtl ) ) {
			wp_style_add_data( $handle, 'rtl', 'replace' );
		}
		$handles['style'] = $handle;
	}

	$asset_file = get_theme_file_path( "build/{$entry}.asset.php" );
	if ( ! empty( feature( $kind, $name )['script'] ) && is_readable( get_theme_file_path( "build/{$entry}.js" ) ) && is_readable( $asset_file ) ) {
		$asset = require $asset_file;
		wp_register_script(
			$handle,
			get_theme_file_uri( "build/{$entry}.js" ),
			$asset['dependencies'] ?? array(),
			$asset['version'] ?? WP_ELITE_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		$handles['script'] = $handle;
	}

	$registered[ $entry ] = $handles;
	return $handles;
}

/**
 * Load a feature's style and script now, e.g. from a custom template:
 * `\WpElite\enqueue_feature( 'sections', 'hero' );`.
 *
 * @param string $kind Folder kind: blocks, layout, sections, pages or vendor.
 * @param string $name Folder name.
 */
function enqueue_feature( string $kind, string $name ): void {
	$handles = register_feature( $kind, $name );
	if ( $handles['style'] ) {
		wp_enqueue_style( $handles['style'] );
	}
	if ( $handles['script'] ) {
		wp_enqueue_script( $handles['script'] );
	}
}

/**
 * Load a feature its trigger found on the page, unless a filter says no.
 *
 * @param string $kind Folder kind.
 * @param string $name Folder name.
 * @param bool   $load Whether its trigger matched.
 */
function maybe_enqueue_feature( string $kind, string $name, bool $load = true ): void {
	/**
	 * Whether to load a feature folder on this page (its trigger matched:
	 * class, template part, body class or active plugin).
	 *
	 * @param bool   $load Load it.
	 * @param string $kind Folder kind.
	 * @param string $name Folder name.
	 */
	if ( apply_filters( 'wp_elite_load_feature', $load, $kind, $name ) ) {
		enqueue_feature( $kind, $name );
	}
}

/**
 * Blocks that share another block's classes (and so its stylesheet), e.g.
 * Elite Post's button looks like an Elite Button.
 *
 * @return array<string, list<string>>
 */
function style_aliases(): array {
	$aliases = apply_filters( 'wp_elite_block_style_aliases', array( 'elite/button' => array( 'elite/post-button' ) ) );
	return is_array( $aliases ) ? $aliases : array();
}

/**
 * Blocks (assets/blocks): each folder's CSS with its block (front end and
 * editor), its script when the block renders, and its block styles. A
 * folder that isn't a registered block (e.g. `elite-span`, a text format)
 * loads on pages whose content has its class.
 */
function register_blocks(): void {
	$registry = \WP_Block_Type_Registry::get_instance();

	foreach ( manifest()['blocks'] as $block_name => $block ) {
		$folder = $block['folder'];

		if ( ! $registry->is_registered( $block_name ) ) {
			class_triggers( array( $folder => array( 'blocks', $folder ) ) );
			continue;
		}

		$handles = register_feature( 'blocks', $folder );
		$blocks  = array_merge( array( $block_name ), style_aliases()[ $block_name ] ?? array() );
		foreach ( $blocks as $name ) {
			if ( $handles['style'] ) {
				wp_enqueue_block_style( $name, array( 'handle' => $handles['style'] ) );
			}
			if ( $handles['script'] ) {
				$script = $handles['script'];
				add_filter(
					"render_block_{$name}",
					static function ( string $content ) use ( $script ): string {
						wp_enqueue_script( $script );
						return $content;
					}
				);
			}
		}

		foreach ( $block['styles'] as $style ) {
			register_block_style( $block_name, $style );
		}
	}
}
// After plugins register their blocks (init, 10).
add_action( 'init', __NAMESPACE__ . '\\register_blocks', 20 );

/**
 * Sections (assets/sections): each loads on pages using its root class.
 */
function register_sections(): void {
	foreach ( manifest()['sections'] as $name => $section ) {
		if ( is_string( $section['trigger'] ?? null ) ) {
			class_triggers( array( $section['trigger'] => array( 'sections', (string) $name ) ) );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\\register_sections', 20 );

/**
 * Classes that load a feature when found in the content: a section's root
 * class, or a non-block folder's base class (and its modifiers).
 *
 * @param array<string, array{0: string, 1: string}> $add Class => [kind, name] to watch for.
 * @return array<string, array{0: string, 1: string}> Every class watched for.
 */
function class_triggers( array $add = array() ): array {
	static $triggers = array();
	$triggers        = array_merge( $triggers, $add );
	return $triggers;
}

/**
 * While the page renders (block themes render before <head> is printed, so
 * styles land there): load the features whose class or template part shows
 * up. Each is looked for until found once.
 *
 * @param string               $content Block HTML.
 * @param array<string, mixed> $block   Parsed block.
 */
function enqueue_used_features( string $content, array $block ): string {
	static $found = array();

	if ( 'core/template-part' === ( $block['blockName'] ?? '' ) ) {
		$slug = $block['attrs']['slug'] ?? '';
		if ( is_string( $slug ) && isset( manifest()['layout'][ $slug ] ) && ! isset( $found[ "layout/{$slug}" ] ) ) {
			$found[ "layout/{$slug}" ] = true;
			maybe_enqueue_feature( 'layout', $slug );
		}
	}

	$pending = array_diff_key( class_triggers(), $found );
	if ( ! $pending || ! str_contains( $content, 'class=' ) ) {
		return $content;
	}

	// A whole class: `elite-section--hero`, not `…--hero-large`; a base
	// class also with its modifiers (`elite-span--highlight`).
	$classes = implode( '|', array_map( 'preg_quote', array_keys( $pending ) ) );
	if ( ! preg_match_all( "/(?<![\\w-])(?:{$classes})(?:--[\\w-]+)?(?![\\w-])/", $content, $matches ) ) {
		return $content;
	}
	foreach ( array_unique( $matches[0] ) as $class ) {
		$key = isset( $pending[ $class ] ) ? $class : explode( '--', $class )[0];
		if ( isset( $pending[ $key ] ) && ! isset( $found[ $key ] ) ) {
			$found[ $key ] = true;
			maybe_enqueue_feature( ...$pending[ $key ] );
		}
	}

	return $content;
}
add_filter( 'render_block', __NAMESPACE__ . '\\enqueue_used_features', 10, 2 );

/**
 * Page types (assets/pages): by body class (`single-post`, `search`,
 * `error404`, `page-template-landing`, `post-type-archive-resource`…).
 */
function enqueue_pages(): void {
	$pages = manifest()['pages'];
	if ( ! $pages ) {
		return;
	}
	$body_classes = get_body_class();
	foreach ( array_keys( $pages ) as $name ) {
		maybe_enqueue_feature( 'pages', (string) $name, in_array( (string) $name, $body_classes, true ) );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_pages' );

/**
 * Plugins (assets/vendor): while its plugin is active (`// Active when:
 * NAME`, a constant, class or function), after the plugin's own styles.
 */
function enqueue_vendor(): void {
	foreach ( manifest()['vendor'] as $name => $vendor ) {
		$when = is_string( $vendor['when'] ?? null ) ? $vendor['when'] : '';
		maybe_enqueue_feature( 'vendor', (string) $name, '' !== $when && ( defined( $when ) || class_exists( $when ) || function_exists( $when ) ) );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_vendor', 1000 );

/**
 * Editor: every layout, section and page style, and non-block folders
 * (e.g. Span classes), so content looks as it will on the page.
 */
function enqueue_editor_features(): void {
	if ( ! is_admin() ) {
		return;
	}
	$css = get_theme_file_path( 'build/editor-features.css' );
	if ( is_readable( $css ) ) {
		wp_enqueue_style( 'wp-elite-editor-features', get_theme_file_uri( 'build/editor-features.css' ), array(), asset_version( 'editor-features' ) );
	}
	foreach ( class_triggers() as list( $kind, $name ) ) {
		$handles = 'blocks' === $kind ? register_feature( $kind, $name ) : array( 'style' => null );
		if ( $handles['style'] ) {
			wp_enqueue_style( $handles['style'] );
		}
	}
}
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\enqueue_editor_features' );
