<?php
/**
 * WP Elite theme bootstrap.
 *
 * - inc/setup.php: theme supports, editor styles, pattern category, palette.
 * - inc/manifest.php: the generated assets/json/ files.
 * - inc/assets.php: global styles; each feature folder only where it's used.
 * - inc/fonts.php: preloads the body font (fonts are in theme.json).
 * - inc/environment.php: no Theme File Editor on staging and production.
 * - inc/integrations/: what the theme does with plugins, each file only
 *   acting when its plugin is active.
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite;

defined( 'ABSPATH' ) || exit;

define( 'WP_ELITE_VERSION', '0.1.0' );

require_once __DIR__ . '/inc/setup.php';
require_once __DIR__ . '/inc/manifest.php';
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/fonts.php';
require_once __DIR__ . '/inc/performance.php';
require_once __DIR__ . '/inc/environment.php';
require_once __DIR__ . '/inc/integrations/elite-blocks.php';
require_once __DIR__ . '/inc/integrations/megamenu.php';
require_once __DIR__ . '/inc/integrations/contact-form-7.php';
require_once __DIR__ . '/inc/site.php';
