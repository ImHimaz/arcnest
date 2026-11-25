<?php
/**
 * Title: Work
 * Slug: wp-elite/section-work
 * Categories: wp-elite, portfolio
 * Keywords: work, portfolio, demo, speed test, case
 * Description: "See it for yourself": the heading beside a line; the speed test as a dark strip (three differences between our build and Elementor Pro on the same design and hosting, and a link to the speed test page); then our concept sites (Hearthline Realty, Quillpay), each in a browser window playing a muted loop of its home page scrolling top to bottom (an Elite Div's background video: WebM, MP4 fallback and poster from the Media Library, slugs <site>-scroll-vp9 / -h264 / -poster), with tags, name, a line, its mobile PageSpeed score and a link to the live site. Each site card is clickable as a whole. Add a site when it's live with another $wp_elite_site() call (two across from tablets). Section class elite-section--work, ID work.
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
 * One speed test result: the difference, what it is, and the two
 * measurements.
 *
 * @param string $big   The difference.
 * @param string $what  What it is.
 * @param string $means The measurements.
 */
$wp_elite_stat = static function ( string $big, string $what, string $means ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--work-stat"} -->
<div class="elite-div elite-div--work-stat"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--work-stat-number"} -->
<p class="elite-paragraph elite-paragraph--work-stat-number"><?php echo esc_html( $big ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><strong><?php echo esc_html( $what ); ?></strong> <?php echo esc_html( $means ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

	<?php
};

/**
 * A Media Library file by its slug: id and URL (empty when it isn't there).
 *
 * @param string $slug The attachment's slug.
 * @return array{id?: int, url?: string}
 */
$wp_elite_media = static function ( string $slug ): array {
	$found = get_posts(
		array(
			'name'           => $slug,
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	return $found ? array(
		'id'  => (int) $found[0],
		'url' => (string) wp_get_attachment_url( (int) $found[0] ),
	) : array();
};

/**
 * A concept site's card: a browser window (its address, then its home page
 * scrolling: an Elite Div with a background video), tags, name, a line, its
 * mobile PageSpeed score and a link to the live site.
 *
 * @param string       $slug  The site's media slug prefix (hearthline → hearthline-scroll-vp9…).
 * @param array<int, string> $tags Tags.
 * @param string       $name  The site's name.
 * @param string       $line  One line about it.
 * @param string       $url   The live site.
 * @param int          $score Its mobile PageSpeed score.
 */
$wp_elite_site = static function ( string $slug, array $tags, string $name, string $line, string $url, int $score ) use ( $wp_elite_tags, $wp_elite_button, $wp_elite_media ): void {
	$webm   = $wp_elite_media( "{$slug}-scroll-vp9" );
	$mp4    = $wp_elite_media( "{$slug}-scroll-h264" );
	$poster = $wp_elite_media( "{$slug}-scroll-poster" );
	$host   = (string) wp_parse_url( $url, PHP_URL_HOST );
	$video  = array(
		'autoplay' => true,
		'muted'    => true,
		'loop'     => true,
	);
	if ( $webm ) {
		$video['source'] = $webm;
	}
	if ( $mp4 ) {
		$video['fallbackEnabled'] = true;
		$video['fallback']        = $mp4;
	}
	if ( $poster ) {
		$video['poster'] = $poster;
	}
	$screen = array(
		'className'  => 'elite-div--work-screen',
		'background' => array(
			'type'  => 'video',
			'video' => $video,
		),
	);
	?>
<!-- wp:elite/div {"className":"elite-div--work-card"} -->
<div class="elite-div elite-div--work-card"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--work-browser"} -->
<div class="elite-div elite-div--work-browser"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--work-address"} -->
<p class="elite-paragraph elite-paragraph--work-address"><?php echo esc_html( $host ); ?></p>
<!-- /wp:elite/paragraph -->

	<?php
	echo '<!-- wp:elite/div ' . wp_json_encode( $screen, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . " -->\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded.
	// The background video's saved markup (Elite Div's save: BackgroundMedia).
	echo '<div class="elite-div elite-div--work-screen"><div class="div-inner' . ( $webm || $mp4 ? ' has-div-bg has-div-bg--video' : '' ) . '">';
	if ( $webm || $mp4 ) {
		echo '<div class="div-bg div-bg--video"><video playsinline autoplay muted loop' . ( $poster ? ' poster="' . esc_url( $poster['url'] ) . '"' : '' ) . '>';
		if ( $webm ) {
			echo '<source src="' . esc_url( $webm['url'] . '#t=0.01' ) . '" type="video/webm"/>';
		}
		if ( $mp4 ) {
			echo '<source src="' . esc_url( $mp4['url'] . '#t=0.01' ) . '" type="video/mp4"/>';
		}
		echo '</video></div>';
	}
	echo "</div></div>\n<!-- /wp:elite/div --></div></div>\n<!-- /wp:elite/div -->\n\n";
	?>
<!-- wp:elite/div {"className":"elite-div--work-body"} -->
<div class="elite-div elite-div--work-body"><div class="div-inner"><?php $wp_elite_tags( $tags ); ?><!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php echo esc_html( $name ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $line ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--work-foot"} -->
<div class="elite-div elite-div--work-foot"><div class="div-inner">
	<?php
	$wp_elite_button(
		array(
			'text'      => __( 'Visit the site', 'wp-elite' ),
			'link'      => array(
				'url'           => $url,
				'opensInNewTab' => true,
			),
			'iconEnd'   => 'arrow-up-right',
			'className' => 'elite-button--work-link',
		)
	);
	?>


<!-- wp:elite/paragraph {"className":"elite-paragraph--work-score"} -->
<p class="elite-paragraph elite-paragraph--work-score"><strong><?php echo esc_html( (string) $score ); ?></strong> <?php esc_html_e( 'mobile PageSpeed', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div -->

	<?php
};
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

<!-- wp:elite/div {"className":"elite-div--work-stats"} -->
<div class="elite-div elite-div--work-stats"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--work-stats-label"} -->
<p class="elite-paragraph elite-paragraph--work-stats-label"><?php esc_html_e( 'Same site, two builders: ours vs Elementor Pro', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<?php
$wp_elite_stat( '2×', __( 'lighter pages to download', 'wp-elite' ), __( '351 KB vs 698 KB', 'wp-elite' ) );
$wp_elite_stat( '3.5 s', __( 'sooner fully loaded on a budget phone', 'wp-elite' ), __( '7.1 s vs 10.6 s', 'wp-elite' ) );
$wp_elite_stat( '+50%', __( 'more visitors served by the same hosting', 'wp-elite' ), __( '6–7 vs 4–4.6 pages a second', 'wp-elite' ) );
$wp_elite_button(
	array(
		'text'      => __( 'See the speed test', 'wp-elite' ),
		'link'      => array( 'url' => '/speed-test/' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--work-stats-link',
	)
);
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--work-grid"} -->
<div class="elite-div elite-div--work-grid"><div class="div-inner">
<?php
$wp_elite_site(
	'hearthline',
	array( __( 'Design & build', 'wp-elite' ), __( 'Property search', 'wp-elite' ), __( 'Concept site', 'wp-elite' ) ),
	__( 'Hearthline Realty', 'wp-elite' ),
	__( 'A real estate site with property search, filters and enquiries. Five page types, built on WordPress’s own editor.', 'wp-elite' ),
	'https://demo1.arcnestpreview.com/',
	98
);
$wp_elite_site(
	'quillpay',
	array( __( 'Design & build', 'wp-elite' ), __( 'Payments app', 'wp-elite' ), __( 'Concept site', 'wp-elite' ) ),
	__( 'Quillpay', 'wp-elite' ),
	__( 'A payments app’s site with plans, a plan comparison and a filtered blog. Five page types, with motion that respects reduced-motion settings.', 'wp-elite' ),
	'https://demo2.arcnestpreview.com/',
	98
);
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
