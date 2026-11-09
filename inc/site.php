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
