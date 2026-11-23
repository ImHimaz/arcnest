<?php
/**
 * This site's own settings for the base theme's features (the files they
 * change stay as in the base theme, so its fixes merge in).
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\Site;

/**
 * One page: inline all its CSS (inc/performance.php). Nothing to share
 * between pages, so no files kept for caching, and room for nearly all of
 * it (150 KB; the largest, Navigation's, stays a file). Back to the base
 * theme's defaults if the site grows to more pages.
 */
add_filter( 'wp_elite_cached_styles', '__return_empty_array' );
add_filter( 'wp_elite_styles_inline_size_limit', static fn (): int => 150 * KB_IN_BYTES );

/**
 * The body font, preloaded (inc/fonts.php), and theme.json's
 * `font-display: optional`: the font starts loading with the page, so it is
 * usually there for the first paint; when it isn't, the page keeps the
 * size-matched fallback instead of swapping fonts in front of the visitor,
 * and the next page has it from the cache. All CSS is inline here, so the
 * preload competes only with the page and its first image.
 *
 * @return string[] Font family slugs.
 */
function preload_body_font(): array {
	return array( 'body' );
}
add_filter( 'wp_elite_preload_fonts', __NAMESPACE__ . '\\preload_body_font' );

// "Check your site": the PageSpeed route behind the home page's form.
require_once __DIR__ . '/site-check.php';

/**
 * Don't advertise the WordPress version: no generator tag, and core files'
 * `?ver=` (the WordPress version) becomes a short hash of it, which still
 * changes on every update so caches refresh.
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

/**
 * A core file's `ver` without the WordPress version in it.
 *
 * @param string $src File URL.
 */
function hide_core_version( string $src ): string {
	$version = get_bloginfo( 'version' );
	if ( ! str_contains( $src, 'ver=' . $version ) ) {
		return $src;
	}

	return add_query_arg( 'ver', substr( wp_hash( 'ver-' . $version ), 0, 8 ), $src );
}
add_filter( 'style_loader_src', __NAMESPACE__ . '\\hide_core_version' );
add_filter( 'script_loader_src', __NAMESPACE__ . '\\hide_core_version' );
