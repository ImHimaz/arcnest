<?php
/**
 * Feature folders load only where they're used (inc/assets.php). Uses
 * fixture build files, removed afterwards. Run by run.php.
 *
 * @package WpElite
 */

use function WpElite\enqueue_feature;
use function WpElite\enqueue_pages;
use function WpElite\enqueue_used_features;
use function WpElite\enqueue_vendor;
use function WpElite\feature_handle;
use function WpElite\register_sections;

// Fixture builds: a section with a script, a template part, a page type and
// two plugins (one active).
$wp_elite_fixtures = array(
	'sections/check-hero'   => true,
	'layout/check-part'     => false,
	'pages/check-page'      => false,
	'vendor/check-active'   => false,
	'vendor/check-inactive' => false,
);
foreach ( $wp_elite_fixtures as $wp_elite_entry => $wp_elite_script ) {
	wp_mkdir_p( dirname( get_theme_file_path( "build/{$wp_elite_entry}.css" ) ) );
	file_put_contents( get_theme_file_path( "build/{$wp_elite_entry}.css" ), '.check{color:red}' ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- Test fixture.
	file_put_contents( get_theme_file_path( "build/{$wp_elite_entry}.asset.php" ), "<?php return array( 'dependencies' => array( 'wp-dom-ready' ), 'version' => 'check' );" ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- Test fixture.
	if ( $wp_elite_script ) {
		file_put_contents( get_theme_file_path( "build/{$wp_elite_entry}.js" ), '' ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- Test fixture.
	}
}
$wp_elite_manifest = static function ( array $manifest ): array {
	$manifest['sections']['check-hero']   = array(
		'modifiers' => array(),
		'script'    => true,
		'trigger'   => 'elite-section--check-hero',
	);
	$manifest['layout']['check-part']     = array(
		'modifiers' => array(),
		'script'    => false,
	);
	$manifest['pages']['check-page']      = array(
		'modifiers' => array(),
		'script'    => false,
	);
	$manifest['vendor']['check-active']   = array(
		'script' => false,
		'when'   => 'WP_ELITE_VERSION',
	);
	$manifest['vendor']['check-inactive'] = array(
		'script' => false,
		'when'   => 'WP_ELITE_NOT_A_PLUGIN',
	);
	return $manifest;
};
add_filter( 'wp_elite_manifest', $wp_elite_manifest );
register_sections();

$wp_elite_enqueued = static fn ( string $kind, string $name ): bool => wp_style_is( feature_handle( $kind, $name ) );

// Sections: by their root class, the whole class only.
enqueue_used_features( '<div class="elite-section elite-section--check-hero-large"></div>', array() );
$wp_elite_check( 'Section: a longer class doesn’t load it', false, $wp_elite_enqueued( 'sections', 'check-hero' ) );
enqueue_used_features( '<div class="elite-section elite-section--check-hero"></div>', array() );
$wp_elite_check( 'Section: its class loads its styles', true, $wp_elite_enqueued( 'sections', 'check-hero' ) );
$wp_elite_script = wp_scripts()->query( feature_handle( 'sections', 'check-hero' ) );
$wp_elite_check( 'Section: …and its script, enqueued', true, wp_script_is( feature_handle( 'sections', 'check-hero' ) ) );
$wp_elite_check(
	'Section script: deferred, in the footer, with its asset file’s dependencies',
	array( 'defer', 1, array( 'wp-dom-ready' ) ),
	array( $wp_elite_script ? $wp_elite_script->extra['strategy'] ?? null : null, $wp_elite_script ? $wp_elite_script->extra['group'] ?? null : null, $wp_elite_script ? $wp_elite_script->deps : null )
);
$wp_elite_check( 'Feature handles: blocks keep wp-elite-<folder>', array( 'wp-elite-elite-button', 'wp-elite-sections-hero' ), array( feature_handle( 'blocks', 'elite-button' ), feature_handle( 'sections', 'hero' ) ) );

// Non-block folders (the Span format): its modifier alone is enough.
wp_dequeue_style( 'wp-elite-elite-span' );
enqueue_used_features( '<p>a <span class="elite-span--highlight">word</span></p>', array() );
$wp_elite_check( 'Span classes load the Span styles', true, wp_style_is( 'wp-elite-elite-span' ) );

// Layout: with its template part.
enqueue_used_features(
	'<footer></footer>',
	array(
		'blockName' => 'core/template-part',
		'attrs'     => array( 'slug' => 'footer' ),
	)
);
$wp_elite_check( 'Layout: another part doesn’t load it', false, $wp_elite_enqueued( 'layout', 'check-part' ) );
enqueue_used_features(
	'<header></header>',
	array(
		'blockName' => 'core/template-part',
		'attrs'     => array( 'slug' => 'check-part' ),
	)
);
$wp_elite_check( 'Layout: its template part loads it', true, $wp_elite_enqueued( 'layout', 'check-part' ) );

// Pages: by body class; the filter can say no.
enqueue_pages();
$wp_elite_check( 'Page type: not without its body class', false, $wp_elite_enqueued( 'pages', 'check-page' ) );
$wp_elite_body_class = static fn ( array $classes ): array => array_merge( $classes, array( 'check-page' ) );
add_filter( 'body_class', $wp_elite_body_class );
add_filter( 'wp_elite_load_feature', '__return_false' );
enqueue_pages();
$wp_elite_check( 'Page type: wp_elite_load_feature can stop it', false, $wp_elite_enqueued( 'pages', 'check-page' ) );
remove_filter( 'wp_elite_load_feature', '__return_false' );
enqueue_pages();
$wp_elite_check( 'Page type: its body class loads it', true, $wp_elite_enqueued( 'pages', 'check-page' ) );
remove_filter( 'body_class', $wp_elite_body_class );

// Vendor: while its plugin is active.
enqueue_vendor();
$wp_elite_check( 'Vendor: loads while its plugin is active', true, $wp_elite_enqueued( 'vendor', 'check-active' ) );
$wp_elite_check( 'Vendor: not when it isn’t', false, $wp_elite_enqueued( 'vendor', 'check-inactive' ) );
$wp_elite_check( 'Vendor: Max Mega Menu’s styles follow the plugin', defined( 'MEGAMENU_VERSION' ), $wp_elite_enqueued( 'vendor', 'megamenu' ) );

// By hand, e.g. from a custom template.
enqueue_feature( 'vendor', 'check-inactive' );
$wp_elite_check( 'enqueue_feature() loads any folder', true, $wp_elite_enqueued( 'vendor', 'check-inactive' ) );

remove_filter( 'wp_elite_manifest', $wp_elite_manifest );
foreach ( array_keys( $wp_elite_fixtures ) as $wp_elite_entry ) {
	foreach ( array( 'css', 'js', 'asset.php' ) as $wp_elite_extension ) {
		wp_delete_file( get_theme_file_path( "build/{$wp_elite_entry}.{$wp_elite_extension}" ) );
	}
}
foreach ( array( 'sections', 'layout', 'pages', 'vendor' ) as $wp_elite_kind ) {
	$wp_elite_dir = get_theme_file_path( "build/{$wp_elite_kind}" );
	if ( is_dir( $wp_elite_dir ) && ! glob( "{$wp_elite_dir}/*" ) ) {
		rmdir( $wp_elite_dir ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- Test fixture.
	}
}
