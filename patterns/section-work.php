<?php
/**
 * Title: Work
 * Slug: wp-elite/section-work
 * Categories: wp-elite, portfolio
 * Keywords: work, portfolio, demo, speed test, case
 * Description: "See it for yourself": the heading beside a line, then our concept sites and the speed test. Add each new concept site when it's live by duplicating the Hearthline card (the grid turns into even pairs; keep the speed test last). Cards: a site we built (its screenshot, the "Hearthline Realty home page" image from the Media Library, tags, title, a line and a link to the live site) and the speed test (dark: three differences between our build and Elementor Pro on the same design and hosting, and a link to the speed test page). Each card is clickable as a whole. Section class elite-section--work, ID work.
 *
 * @package WpElite
 */

/**
 * Tags in a row (a list).
 *
 * @param list<string> $tags Tags.
 */
$wp_elite_tags = static function ( array $tags ): void {
	echo "<!-- wp:list {\"className\":\"core-list--work-tags\"} -->\n<ul class=\"wp-block-list core-list--work-tags\">";
	foreach ( $tags as $index => $tag ) {
		echo ( $index ? "\n\n" : '' ) . "<!-- wp:list-item -->\n<li>" . esc_html( $tag ) . "</li>\n<!-- /wp:list-item -->";
	}
	echo "</ul>\n<!-- /wp:list -->\n\n";
};

/**
 * An Elite Button's block comment.
 *
 * @param array<string, mixed> $attributes Button attributes.
 */
$wp_elite_button = static function ( array $attributes ): void {
	echo '<!-- wp:elite/button ' . wp_json_encode( $attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded.
};

/**
 * One "versus" row: the difference, what it is, and the two measurements.
 *
 * @param string $big   The difference.
 * @param string $what  What it is.
 * @param string $means The measurements.
 */
$wp_elite_versus = static function ( string $big, string $what, string $means ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--work-versus"} -->
<div class="elite-div elite-div--work-versus"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--work-versus-number"} -->
<p class="elite-paragraph elite-paragraph--work-versus-number"><?php echo esc_html( $big ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><strong><?php echo esc_html( $what ); ?></strong> <?php echo esc_html( $means ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->
	<?php
};

$wp_elite_shot  = get_posts(
	array(
		'name'           => 'hearthline-home',
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'posts_per_page' => 1,
		'fields'         => 'ids',
	)
);
$wp_elite_image = array(
	'images'    => array(),
	'ratio'     => array( 'desktop' => '16/9.4' ),
	'className' => 'elite-image--work-shot',
);
if ( $wp_elite_shot ) {
	$wp_elite_image['images']['desktop'] = array(
		'id'  => (int) $wp_elite_shot[0],
		'url' => (string) wp_get_attachment_url( (int) $wp_elite_shot[0] ),
		'alt' => __( 'The Hearthline Realty home page', 'wp-elite' ),
	);
}
?>
<!-- wp:elite/section {"label":"Work","anchor":"work","className":"elite-section--work"} -->
<section class="elite-section alignfull elite-section--work" id="work"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--work-head"} -->
<div class="elite-row row elite-row--work-head"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}}} -->
<div class="elite-column col-12 col-lg-7"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Work', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'See it for yourself', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4,"offset":1}}} -->
<div class="elite-column col-12 col-lg-4 offset-lg-1"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--work-lead"} -->
<p class="elite-paragraph elite-paragraph--work-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Concept sites we designed and built for different kinds of business. They’re live: open them on your phone and test them on Google PageSpeed.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row -->

<!-- wp:elite/div {"className":"elite-div--work-grid"} -->
<div class="elite-div elite-div--work-grid"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--work-card"} -->
<div class="elite-div elite-div--work-card"><div class="div-inner"><?php echo '<!-- wp:elite/image ' . wp_json_encode( $wp_elite_image, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. ?>


<!-- wp:elite/div {"className":"elite-div--work-body"} -->
<div class="elite-div elite-div--work-body"><div class="div-inner"><?php $wp_elite_tags( array( __( 'Design & build', 'wp-elite' ), __( 'Property search', 'wp-elite' ), __( 'Concept site', 'wp-elite' ) ) ); ?><!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php esc_html_e( 'Hearthline Realty', 'wp-elite' ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php esc_html_e( 'A real estate site with property search, filters and enquiries. Five page types, built on WordPress’s own editor.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<?php
$wp_elite_button(
	array(
		'text'      => __( 'Visit the site', 'wp-elite' ),
		'link'      => array(
			'url'           => 'https://demo1.arcnestpreview.com/',
			'opensInNewTab' => true,
		),
		'iconEnd'   => 'arrow-up-right',
		'className' => 'elite-button--work-link',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--work-card elite-div--work-speed"} -->
<div class="elite-div elite-div--work-card elite-div--work-speed"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--work-body"} -->
<div class="elite-div elite-div--work-body"><div class="div-inner"><?php $wp_elite_tags( array( __( 'Speed test', 'wp-elite' ), __( 'Same design, same hosting', 'wp-elite' ) ) ); ?><!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php esc_html_e( 'Same site, two builders', 'wp-elite' ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php esc_html_e( 'We built one site twice, with our blocks and with Elementor Pro. Here’s what changed.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<?php
$wp_elite_versus( '2×', __( 'lighter pages to download', 'wp-elite' ), __( '351 KB vs 698 KB', 'wp-elite' ) );
echo "\n\n";
$wp_elite_versus( '3.5 s', __( 'sooner fully loaded on a budget phone', 'wp-elite' ), __( '7.1 s vs 10.6 s', 'wp-elite' ) );
echo "\n\n";
$wp_elite_versus( '+50%', __( 'more visitors served by the same hosting', 'wp-elite' ), __( '6–7 vs 4–4.6 pages a second', 'wp-elite' ) );
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'See the speed test', 'wp-elite' ),
		'link'      => array( 'url' => '/speed-test/' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--work-link',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
