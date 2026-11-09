<?php
/**
 * Theme PHP checks, run inside WordPress (they need its functions): every
 * tests/php/*.check.php. Each file adds to $wp_elite_failures. Run with
 * `npm run test:php`.
 *
 * (No strict_types declaration: WP-CLI's eval-file runs this through eval().)
 *
 * @package WpElite
 */

$wp_elite_failures = 0;

/**
 * One check.
 *
 * @param string $name     What it checks.
 * @param mixed  $expected Expected value.
 * @param mixed  $actual   Actual value.
 */
$wp_elite_check = static function ( string $name, $expected, $actual ) use ( &$wp_elite_failures ): void {
	if ( $expected === $actual ) {
		echo "✓ {$name}\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI output.
		return;
	}
	++$wp_elite_failures;
	printf( "✗ %s\n    expected %s\n    got      %s\n", $name, wp_json_encode( $expected ), wp_json_encode( $actual ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI output.
};

$wp_elite_test_files = glob( __DIR__ . '/*.check.php' );
foreach ( false === $wp_elite_test_files ? array() : $wp_elite_test_files as $wp_elite_test_file ) {
	echo "\n== theme/" . basename( $wp_elite_test_file ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI output.
	require $wp_elite_test_file;
}
printf( "\nTheme failures: %d\n", $wp_elite_failures ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CLI output.
if ( $wp_elite_failures ) {
	exit( 1 ); // phpcs:ignore WordPress.WP.AlternativeFunctions -- CLI exit code for CI.
}
