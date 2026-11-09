<?php
/**
 * Fonts: self-hosted in assets/fonts/<family>/, registered in theme.json
 * (`settings.typography.fontFamilies[].fontFace`), from which WordPress
 * writes the `@font-face` rules on the site and in the editor. This file
 * preloads the ones every page needs, so text doesn't wait for them.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

/**
 * Font files to preload: the theme.json files of the families named by the
 * `wp_elite_preload_fonts` filter (default: the body font). Preload only
 * what the top of every page uses; each preload competes with the page's
 * first image.
 *
 * @return list<string> Font URLs.
 */
function preload_fonts(): array {
	/**
	 * Font families (theme.json slugs) whose files are preloaded.
	 *
	 * @param string[] $slugs Slugs.
	 */
	$slugs    = (array) apply_filters( 'wp_elite_preload_fonts', array( 'body' ) );
	$families = wp_get_global_settings( array( 'typography', 'fontFamilies', 'theme' ) );
	$urls     = array();

	foreach ( is_array( $families ) ? $families : array() as $family ) {
		if ( ! in_array( $family['slug'] ?? '', $slugs, true ) ) {
			continue;
		}
		foreach ( (array) ( $family['fontFace'] ?? array() ) as $face ) {
			foreach ( (array) ( $face['src'] ?? array() ) as $src ) {
				// woff2 only: every browser that preloads reads it.
				if ( is_string( $src ) && str_ends_with( $src, '.woff2' ) ) {
					$urls[] = str_starts_with( $src, 'file:./' ) ? get_theme_file_uri( substr( $src, 7 ) ) : $src;
				}
			}
		}
	}

	return array_values( array_unique( $urls ) );
}

/**
 * Preload links, first thing in <head>.
 */
function print_font_preloads(): void {
	foreach ( preload_fonts() as $url ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $url ) );
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\print_font_preloads', 1 );
