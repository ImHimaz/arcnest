<?php
/**
 * Theme supports, editor styles, pattern category, and the palette and font
 * sizes from the SCSS abstracts.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

/**
 * Theme supports and pattern categories.
 */
function setup(): void {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'build/editor.css' );

	// Patterns come from this theme, not from the remote directory.
	remove_theme_support( 'core-block-patterns' );

	register_block_pattern_category(
		'wp-elite',
		array( 'label' => __( 'WP Elite', 'wp-elite' ) )
	);
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * The theme.json font sizes, one per text style: the size of "Title 1" is
 * `var(--text-title-1-font-size)`, so core blocks' Font size picker uses
 * the type scale's own per-device sizes (no fluid sizes of its own).
 *
 * @return list<array{slug: string, name: string, size: string, fluid: false}>
 */
function font_sizes(): array {
	return array_map(
		static fn ( array $style ): array => array(
			'slug'  => $style['slug'],
			'name'  => $style['name'],
			'size'  => "var(--text-{$style['slug']}-font-size)",
			'fluid' => false,
		),
		text_styles()
	);
}

/**
 * Design tokens from the SCSS abstracts, replacing theme.json's lists:
 * - the palette (`$colors` in _colors.scss): every colour picker,
 *   `has-*-color` class and `--wp--preset--color--*` variable;
 * - the font sizes (`$text-styles` in _text-styles.scss): core blocks'
 *   Font size picker, `has-*-font-size` classes and
 *   `--wp--preset--font-size--*` variables, named as the Text Styles.
 *
 * @param \WP_Theme_JSON_Data $theme_json Theme data.
 */
function set_design_tokens( \WP_Theme_JSON_Data $theme_json ): \WP_Theme_JSON_Data {
	$settings = array();
	if ( color_palette() ) {
		$settings['color']['palette'] = color_palette();
	}
	if ( text_styles() ) {
		$settings['typography']['fontSizes'] = font_sizes();
	}
	if ( ! $settings ) {
		return $theme_json;
	}

	return $theme_json->update_with(
		array(
			'version'  => 3,
			'settings' => $settings,
		)
	);
}
add_filter( 'wp_theme_json_data_theme', __NAMESPACE__ . '\\set_design_tokens' );

/**
 * No emoji scripts: browsers draw emoji themselves, and WordPress's
 * detection script and Twemoji fallback cost every page a request.
 */
function remove_emoji(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', __NAMESPACE__ . '\\remove_emoji' );

/**
 * A logo used as decoration (the footer's wordmark, class
 * `site-footer__wordmark`): hidden from screen readers, which already have
 * the site's name from the logo above it, and loaded lazily (WordPress may
 * take it for the page's main image on a page without others).
 *
 * @param string               $content Block HTML.
 * @param array<string, mixed> $block   Parsed block.
 */
function hide_decorative_logo( string $content, array $block ): string {
	$class = $block['attrs']['className'] ?? '';
	if ( ! is_string( $class ) || ! in_array( 'site-footer__wordmark', explode( ' ', $class ), true ) ) {
		return $content;
	}
	$html = new \WP_HTML_Tag_Processor( $content );
	if ( $html->next_tag() ) {
		$html->set_attribute( 'aria-hidden', 'true' );
	}
	if ( $html->next_tag( array( 'tag_name' => 'img' ) ) ) {
		$html->set_attribute( 'alt', '' );
		// At the bottom of every page: never the image to load first.
		$html->remove_attribute( 'fetchpriority' );
		$html->set_attribute( 'loading', 'lazy' );
	}
	return $html->get_updated_html();
}
add_filter( 'render_block_core/site-logo', __NAMESPACE__ . '\\hide_decorative_logo', 10, 2 );
