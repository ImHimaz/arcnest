<?php
/**
 * Fewer requests: small files are printed in the page instead of loaded one
 * by one. A section's CSS and script are a few KB each, and each would be a
 * request of its own.
 *
 * - Styles: the CSS every page uses (the theme's global CSS, header,
 *   footer, the grid, WordPress's common block CSS, Navigation) stays in
 *   files, downloaded once and cached for every later page. The rest (a
 *   page's sections and blocks: sliders, tabs, accordions, post cards)
 *   WordPress inlines, smallest first, up to 50 KB a page (its default is
 *   20 KB); larger ones stay files, cached for the next page using them.
 *   Filters: `wp_elite_cached_styles` (the handles kept in files) and
 *   `wp_elite_styles_inline_size_limit`. A one-page site can inline it all:
 *   no cached handles and a larger limit.
 * - Scripts: a theme or plugin script of up to 4 KB is printed in the page
 *   as an inline module, which runs after the page is parsed and in order,
 *   as a deferred file does. Not one with code set to run after it (a
 *   module would run later than that code), one that looks for its own
 *   <script> (`document.currentScript`, e.g. to load more files from its
 *   folder: a module has none) or writes into the page (`document.write`),
 *   or a script module.
 *
 * Both are filterable; the larger files (WordPress's own scripts, larger
 * plugin scripts, the Interactivity API) stay files, cached between pages.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\Performance;

/**
 * How much of a page's CSS is inlined, in bytes (WordPress's
 * `styles_inline_size_limit`).
 */
function styles_inline_size_limit(): int {
	/**
	 * The page's CSS inlined at most, in bytes (smallest files first).
	 *
	 * @param int $limit Bytes.
	 */
	return (int) apply_filters( 'wp_elite_styles_inline_size_limit', 50 * KB_IN_BYTES );
}
add_filter( 'styles_inline_size_limit', __NAMESPACE__ . '\\styles_inline_size_limit' );

/**
 * The stylesheets every page uses, kept in files (cached between pages).
 *
 * @return list<string> Style handles.
 */
function cached_styles(): array {
	/**
	 * Style handles never inlined: CSS every page uses, cached once.
	 *
	 * @param list<string> $handles Style handles.
	 */
	$handles = apply_filters(
		'wp_elite_cached_styles',
		array(
			'wp-elite',               // The theme's global CSS.
			'wp-elite-layout-header', // Header and footer (layout folders).
			'wp-elite-layout-footer',
			'elite-grid',             // Elite Blocks' grid.
			'wp-block-library',       // WordPress's common block CSS.
			'wp-block-navigation',
		)
	);
	return $handles;
}

/**
 * The theme's global stylesheet can be inlined (its file path), unless it's
 * kept in a file.
 */
function inline_global_styles(): void {
	wp_style_add_data( 'wp-elite', 'path', get_theme_file_path( 'build/theme.css' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\inline_global_styles', 20 );

/**
 * Keep the shared stylesheets in files: without a file path WordPress
 * doesn't inline them. Just before it inlines (wp_head and wp_footer, 1).
 */
function keep_cached_styles(): void {
	foreach ( cached_styles() as $handle ) {
		if ( wp_style_is( $handle, 'registered' ) ) {
			wp_style_add_data( $handle, 'path', '' );
		}
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\keep_cached_styles', PHP_INT_MAX );
add_action( 'wp_footer', __NAMESPACE__ . '\\keep_cached_styles', 0 );

/**
 * A script's file on this site (in wp-content), if it is one.
 *
 * @param string $src Script URL.
 */
function local_file( string $src ): ?string {
	$src     = (string) strtok( $src, '?#' );
	$content = content_url();
	if ( ! str_starts_with( set_url_scheme( $src ), set_url_scheme( $content ) ) ) {
		return null;
	}
	$path = realpath( WP_CONTENT_DIR . substr( set_url_scheme( $src ), strlen( set_url_scheme( $content ) ) ) );
	return $path && str_starts_with( $path, (string) realpath( WP_CONTENT_DIR ) ) && str_ends_with( $path, '.js' ) ? $path : null;
}

/**
 * Print a small script in the page: its `<script src>` becomes an inline
 * module (translations and code before it stay as they are).
 *
 * @param string $tag    The script's tags.
 * @param string $handle Script handle.
 * @param string $src    Script URL.
 */
function inline_small_script( string $tag, string $handle, string $src ): string {
	/**
	 * The largest script printed in the page, in bytes (0: none).
	 *
	 * @param int    $limit  Bytes.
	 * @param string $handle Script handle.
	 */
	$limit = (int) apply_filters( 'wp_elite_script_inline_size_limit', 4 * KB_IN_BYTES, $handle );
	if ( $limit <= 0 || is_admin() || wp_scripts()->get_data( $handle, 'after' ) ) {
		return $tag;
	}
	$file = local_file( $src );
	$size = $file ? filesize( $file ) : false;
	if ( ! $file || false === $size || $size > $limit ) {
		return $tag;
	}

	$code = (string) file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- A local file.
	if ( str_contains( $code, 'currentScript' ) || str_contains( $code, 'document.write' ) ) {
		return $tag;
	}
	// No source map (its URL is relative to the file), and nothing that
	// would close the tag early.
	$code   = preg_replace( '~\n?//# sourceMappingURL=\S+\s*$~', '', $code ) ?? $code;
	$code   = str_ireplace( '</script', '<\/script', $code );
	$inline = wp_get_inline_script_tag(
		$code,
		array(
			'type' => 'module',
			'id'   => "{$handle}-js",
		)
	);

	return preg_replace_callback( '#<script\b[^>]*\bsrc=[^>]*>\s*</script>#i', static fn(): string => rtrim( $inline ), $tag, 1 ) ?? $tag;
}
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\inline_small_script', 10, 3 );
