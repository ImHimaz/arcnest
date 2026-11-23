<?php
/**
 * Title: Speed test: server and business
 * Slug: wp-elite/section-speed-server
 * Categories: wp-elite, about
 * Keywords: speed, test, server, hosting, load, chart, business
 * Description: Beyond the phone: a line chart of how long visitors wait as more arrive at once on the same hosting plan (inline SVG in an HTML block: Arcnest in purple, Elementor in grey, each line labelled at its end; hover a point for its value), a line on what it means, then three figures (data saved, accessibility, a study on speed and sales). Section class elite-section--speed-server, ID server.
 *
 * @package WpElite
 */

// Typical wait (median, seconds) at 4, 8 and 16 visitors at once.
$wp_elite_points = array(
	'arcnest'   => array( 0.51, 1.18, 2.40 ),
	'elementor' => array( 0.82, 1.82, 3.80 ),
);
$wp_elite_x      = array( 140, 330, 520 );
$wp_elite_y      = static fn ( float $s ): float => round( 300 - $s * 69, 1 );
$wp_elite_line   = static function ( array $values ) use ( $wp_elite_x, $wp_elite_y ): string {
	$points = array();
	foreach ( $values as $i => $v ) {
		$points[] = $wp_elite_x[ $i ] . ',' . $wp_elite_y( $v );
	}
	return implode( ' ', $points );
};
$wp_elite_dots   = static function ( string $name, array $values, string $color ) use ( $wp_elite_x, $wp_elite_y ): string {
	$out = '';
	foreach ( $values as $i => $v ) {
		$out .= sprintf(
			'<circle cx="%1$d" cy="%2$s" r="5" fill="%3$s" stroke="#fff" stroke-width="2"><title>%4$s: %5$s s with %6$d visitors at once</title></circle>',
			$wp_elite_x[ $i ],
			$wp_elite_y( $v ),
			$color,
			esc_html( $name ),
			number_format( $v, 2 ),
			array( 4, 8, 16 )[ $i ]
		);
	}
	return $out;
};
$wp_elite_grid   = '';
foreach ( array( 0, 1, 2, 3, 4 ) as $wp_elite_s ) {
	$wp_elite_grid .= sprintf( '<line x1="64" x2="600" y1="%1$s" y2="%1$s" stroke="#e7e0ec" stroke-width="1"/><text x="54" y="%2$s" text-anchor="end">%3$d s</text>', $wp_elite_y( $wp_elite_s ), $wp_elite_y( $wp_elite_s ) + 4, $wp_elite_s );
}
$wp_elite_ticks = '';
foreach ( array( 4, 8, 16 ) as $wp_elite_i => $wp_elite_n ) {
	$wp_elite_ticks .= sprintf( '<text x="%1$d" y="324" text-anchor="middle">%2$d</text>', $wp_elite_x[ $wp_elite_i ], $wp_elite_n );
}
$wp_elite_chart = sprintf(
	'<figure class="speed-chart"><svg viewBox="0 0 640 352" role="img" aria-labelledby="speed-chart-title speed-chart-desc"><title id="speed-chart-title">%1$s</title><desc id="speed-chart-desc">%2$s</desc><g class="speed-chart__axis">%3$s%4$s<text x="330" y="346" text-anchor="middle">%5$s</text></g><polyline points="%6$s" fill="none" stroke="#857d8d" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/><polyline points="%7$s" fill="none" stroke="#7b2a9e" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>%8$s%9$s<g class="speed-chart__labels"><text x="534" y="%10$s">Elementor Pro</text><text x="534" y="%11$s" class="speed-chart__value">3.8 s</text><text x="534" y="%12$s">Arcnest</text><text x="534" y="%13$s" class="speed-chart__value">2.4 s</text></g></svg><figcaption>%14$s</figcaption></figure>',
	esc_html__( 'How long a visitor waits as more arrive at once', 'wp-elite' ),
	esc_html__( 'Median wait for the home page on the same hosting plan. With 4, 8 and 16 visitors at once: Arcnest 0.51, 1.18 and 2.40 seconds; Elementor Pro 0.82, 1.82 and 3.80 seconds.', 'wp-elite' ),
	$wp_elite_grid,
	$wp_elite_ticks,
	esc_html__( 'Visitors at the same moment', 'wp-elite' ),
	$wp_elite_line( $wp_elite_points['elementor'] ),
	$wp_elite_line( $wp_elite_points['arcnest'] ),
	$wp_elite_dots( 'Elementor Pro', $wp_elite_points['elementor'], '#857d8d' ),
	$wp_elite_dots( 'Arcnest', $wp_elite_points['arcnest'], '#7b2a9e' ),
	$wp_elite_y( 3.80 ) - 6,
	$wp_elite_y( 3.80 ) + 12,
	$wp_elite_y( 2.40 ) - 6,
	$wp_elite_y( 2.40 ) + 12,
	esc_html__( 'Median wait for the home page, no page cache, on a Namecheap shared hosting plan. Requests sent from the server itself, so only the sites differ.', 'wp-elite' )
);

/**
 * One figure: a big number, a line under it and an optional source link.
 *
 * @param string $number The figure.
 * @param string $text   What it means.
 * @param string $source Optional source link (HTML).
 */
$wp_elite_figure = static function ( string $number, string $text, string $source = '' ): void {
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":4}}} -->
<div class="elite-column col-12 col-md-4"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--speed-figure"} -->
<div class="elite-div elite-div--speed-figure"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--speed-figure-number"} -->
<p class="elite-paragraph elite-paragraph--speed-figure-number"><?php echo esc_html( $number ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo wp_kses( $text . ( '' !== $source ? ' ' . $source : '' ), array( 'a' => array( 'href' => true ) ) ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Speed test server and business","anchor":"server","className":"elite-section--speed-server"} -->
<section class="elite-section alignfull elite-section--speed-server" id="server"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Beyond the phone', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'What it means for the business', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/row {"flex":{"desktop":{"align":"center"}},"className":"elite-row--speed-server"} -->
<div class="elite-row row has-e-align elite-row--speed-server" style="--e-align:center"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}}} -->
<div class="elite-column col-12 col-lg-7"><div class="column-inner"><!-- wp:html -->
<?php echo $wp_elite_chart; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Built and escaped above. ?>
<!-- /wp:html --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4,"offset":1}}} -->
<div class="elite-column col-12 col-lg-4 offset-lg-1"><div class="column-inner"><!-- wp:elite/heading {"level":3,"textStyle":"title-4"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-4-font-family);font-size:var(--text-title-4-font-size);font-weight:var(--text-title-4-font-weight);line-height:var(--text-title-4-line-height);letter-spacing:var(--text-title-4-letter-spacing);text-transform:var(--text-title-4-text-transform)"><?php esc_html_e( 'The same hosting serves more visitors', 'wp-elite' ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--speed-server-text"} -->
<p class="elite-paragraph elite-paragraph--speed-server-text"><?php esc_html_e( 'From about four visitors at once, the hosting plan runs at its limit and everyone waits longer. Our site keeps the waits shorter and serves about 50% more pages a second. A launch, a newsletter or an ad campaign stays on the plan you have for longer.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row -->

<!-- wp:elite/row {"className":"elite-row--speed-figures"} -->
<div class="elite-row row elite-row--speed-figures">
<?php
$wp_elite_figure( __( '3.5 GB', 'wp-elite' ), __( 'less to send for every 10,000 first visits to the home page: 347 KB a visit (698 KB against 351 KB), before any caching.', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( __( '100 vs 88', 'wp-elite' ), __( 'Accessibility score on the home page. The European Accessibility Act has applied to many businesses selling to EU consumers since 28 June 2025.', 'wp-elite' ) );
echo "\n";
$wp_elite_figure( __( '8.4%', 'wp-elite' ), __( 'more retail conversions from a mobile site just 0.1 s faster, in a 2020 Deloitte study of 37 brands for Google.', 'wp-elite' ), '<a href="https://web.dev/case-studies/milliseconds-make-millions">' . esc_html__( 'The study', 'wp-elite' ) . '</a>' );
?>
</div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
