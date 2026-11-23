<?php
/**
 * Title: Speed test: loading race
 * Slug: wp-elite/section-speed-race
 * Categories: wp-elite, about
 * Keywords: speed, test, video, race, comparison, pagespeed
 * Description: Both demo sites loading side by side (an Elite Video, ambient: muted, looping, loaded as it nears the screen), a line on how it was recorded, and buttons that open PageSpeed Insights on each demo site. The video and poster are the media items titled "Speed race…" (slugs speed-race, speed-race-poster). Section class elite-section--speed-race, ID race.
 *
 * @package WpElite
 */

/**
 * A media item by its slug: its ID and URL (none: empty).
 *
 * @param string $slug Attachment slug.
 * @return array{id: int, url: string}
 */
$wp_elite_media = static function ( string $slug ): array {
	$found = get_posts(
		array(
			'post_type'   => 'attachment',
			'name'        => $slug,
			'numberposts' => 1,
			'fields'      => 'ids',
		)
	);
	$id    = $found ? (int) $found[0] : 0;
	return array(
		'id'  => $id,
		'url' => $id ? (string) wp_get_attachment_url( $id ) : '',
	);
};

/**
 * An Elite Button's block comment (its text and link are attributes).
 *
 * @param array<string, mixed> $attributes Button attributes.
 */
$wp_elite_button = static function ( array $attributes ): void {
	echo '<!-- wp:elite/button ' . wp_json_encode( $attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded.
};

$wp_elite_video = array(
	'mode'      => 'ambient',
	'file'      => $wp_elite_media( 'speed-race' ),
	'poster'    => $wp_elite_media( 'speed-race-poster' ),
	'title'     => __( 'Arcnest and Elementor Pro loading the same home page on a mid-range phone', 'wp-elite' ),
	'ratio'     => array( 'desktop' => '16/15' ),
	'fit'       => 'contain',
	'className' => 'elite-video--speed-race',
);
$wp_elite_psi   = static fn ( string $site ): string => 'https://pagespeed.web.dev/report?url=' . rawurlencode( "https://$site.arcnestpreview.com/" ) . '&form_factor=mobile';
?>
<!-- wp:elite/section {"label":"Speed test loading race","anchor":"race","className":"elite-section--speed-race"} -->
<section class="elite-section alignfull elite-section--speed-race" id="race"><div class="section-inner"><div class="container"><!-- wp:elite/row {"flex":{"desktop":{"align":"center"}}} -->
<div class="elite-row row has-e-align" style="--e-align:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":5}}} -->
<div class="elite-column col-12 col-lg-5"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Watch it load', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Same phone, same second, same page', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--speed-race-lead"} -->
<p class="elite-paragraph elite-paragraph--speed-race-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'A first-time visitor opens each home page on a mid-range phone over 4G. In this recording, ours is on screen 0.8 s sooner (3.1 s against 3.9 s) and finishes loading 2.7 s sooner (5.3 s against 8.0 s).', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--speed-race-note"} -->
<p class="elite-paragraph elite-paragraph--speed-race-note"><?php esc_html_e( 'One recording of each site, from Colombo to our US server: phone CPU slowed 4×, connection held to 1.6 Mbps, no cache. Of five runs each, we show the one with the middle first-paint time. The phone figures below are medians from a separate set of runs, so they differ a little. Both cookie banners appear, as they would for a new visitor.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--speed-race-actions"} -->
<div class="elite-div elite-div--speed-race-actions"><div class="div-inner">
<?php
$wp_elite_button(
	array(
		'text'      => __( 'Test our page on PageSpeed', 'wp-elite' ),
		'link'      => array(
			'url'           => $wp_elite_psi( 'elite' ),
			'opensInNewTab' => true,
		),
		'iconEnd'   => 'arrow-up-right',
		'className' => 'elite-button--primary',
	)
);
echo "\n\n";
$wp_elite_button(
	array(
		'text'      => __( 'Test the Elementor page', 'wp-elite' ),
		'link'      => array(
			'url'           => $wp_elite_psi( 'elementor' ),
			'opensInNewTab' => true,
		),
		'iconEnd'   => 'arrow-up-right',
		'className' => 'elite-button--ghost',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}}} -->
<div class="elite-column col-12 col-lg-7"><div class="column-inner"><?php echo '<!-- wp:elite/video ' . wp_json_encode( $wp_elite_video, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. ?></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
