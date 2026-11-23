<?php
/**
 * Title: Speed test: why it's faster
 * Slug: wp-elite/section-speed-why
 * Categories: wp-elite, about
 * Keywords: speed, test, why, reasons
 * Description: Why the Arcnest page is faster, in the service pages' "Who it's for" look: the heading with a line beside it, then three numbered reasons (title and text). 3 across from laptops, stacked below. Section class elite-section--service-fit, ID why.
 *
 * @package WpElite
 */

use WpElite\Patterns as P;

P\fit(
	__( 'Why', 'wp-elite' ),
	__( 'Where the difference comes from', 'wp-elite' ),
	array(
		array( __( 'Nothing in the way of the first paint', 'wp-elite' ), __( 'Our pages carry their CSS inside the page and start drawing text as soon as it arrives. The Elementor pages first fetch 24 to 30 stylesheets and jQuery, and on a slow connection every one of them waits its turn.', 'wp-elite' ) ),
		array( __( 'About half the JavaScript', 'wp-elite' ), __( 'Google Tag Manager adds the same 179 KB to both. Even so, our pages run 216 to 246 KB of JavaScript against 394 to 472 KB. Without tracking it would be 45 KB against 290 KB.', 'wp-elite' ) ),
		array( __( 'Less work for the server', 'wp-elite' ), __( 'Elementor keeps each page as data plus a rendered copy, and builds its templates on every visit. On the same hosting, our site served about 50% more pages a second before it slowed down.', 'wp-elite' ) ),
	),
	__( 'Neither site is badly built, and both carry the same plugins. One simply asks the phone and the server to do less.', 'wp-elite' ),
	'why',
	__( 'Why it’s faster', 'wp-elite' )
);
