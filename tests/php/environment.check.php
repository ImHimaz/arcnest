<?php
/**
 * The Theme File Editor is off on staging and production. Run by run.php.
 *
 * @package WpElite
 */

$wp_elite_admin = get_users(
	array(
		'role'   => 'administrator',
		'number' => 1,
		'fields' => 'ID',
	)
);
wp_set_current_user( (int) ( $wp_elite_admin[0] ?? 1 ) );

$wp_elite_check( 'This local site is not locked', false, WpElite\locked() );
$wp_elite_check( 'Locally, admins edit theme files', true, current_user_can( 'edit_themes' ) );

add_filter( 'wp_elite_locked', '__return_true' );
$wp_elite_check( 'Locked: no one may edit theme files', false, current_user_can( 'edit_themes' ) );
$wp_elite_check( 'Locked: themes can still be switched', true, current_user_can( 'switch_themes' ) );
remove_filter( 'wp_elite_locked', '__return_true' );

wp_set_current_user( 0 );
