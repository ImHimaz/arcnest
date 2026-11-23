<?php
/**
 * Fonts: this site preloads the body font, theme.json's basic Latin file
 * (inc/site.php); the base theme preloads none by default (inc/fonts.php).
 * The size-matched fallback second in the Body family. Run by run.php.
 *
 * @package WpElite
 */

use function WpElite\preload_fonts;

$wp_elite_font_url = get_theme_file_uri( 'assets/fonts/plus-jakarta-sans/PlusJakartaSans-Latin-VariableFont_wght.woff2' );
$wp_elite_check( 'This site preloads the body font (woff2, from theme.json)', array( $wp_elite_font_url ), preload_fonts() );
remove_filter( 'wp_elite_preload_fonts', 'WpElite\\Site\\preload_body_font' );
$wp_elite_check( 'No font preloaded by default', array(), preload_fonts() );
$wp_elite_check( 'The font file is in the theme', true, is_readable( get_theme_file_path( 'assets/fonts/plus-jakarta-sans/PlusJakartaSans-Latin-VariableFont_wght.woff2' ) ) );
$wp_elite_body = current( array_filter( (array) wp_get_global_settings( array( 'typography', 'fontFamilies', 'theme' ) ), static fn ( $f ): bool => 'body' === ( $f['slug'] ?? '' ) ) );
$wp_elite_check( 'Body family: Plus Jakarta Sans, then the size-matched fallback', '"Plus Jakarta Sans", "Plus Jakarta Sans Fallback"', implode( ', ', array_slice( array_map( 'trim', explode( ',', (string) ( $wp_elite_body['fontFamily'] ?? '' ) ) ), 0, 2 ) ) );

$wp_elite_body_preload = static fn (): array => array( 'body' );
add_filter( 'wp_elite_preload_fonts', $wp_elite_body_preload );
$wp_elite_check(
	'wp_elite_preload_fonts can preload the body font (woff2, from theme.json)',
	array( $wp_elite_font_url ),
	preload_fonts()
);
remove_filter( 'wp_elite_preload_fonts', $wp_elite_body_preload );
add_filter( 'wp_elite_preload_fonts', 'WpElite\\Site\\preload_body_font' );
