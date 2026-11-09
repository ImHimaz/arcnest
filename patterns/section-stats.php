<?php
/**
 * Title: Stats
 * Slug: wp-elite/section-stats
 * Categories: wp-elite, about
 * Keywords: stats, numbers, counters, figures
 * Description: Four big numbers with a short line each (Elite Counters: the larger ones count up as they scroll in), each after a lilac rule; four across from laptops, two by two below. Section class elite-section--stats.
 *
 * @package WpElite
 */

/**
 * One stat: its number (an Elite Counter) and what it means.
 *
 * @param array<string, mixed> $counter Counter attributes (end, prefix, suffix, animate).
 * @param string               $caption What it means.
 */
$wp_elite_stat = static function ( array $counter, string $caption ): void {
	$counter += array(
		'duration'  => 1400,
		'className' => 'elite-counter--stat-value',
	);
	?>
<!-- wp:elite/column {"size":{"mobile":{"width":6},"laptop":{"width":3}}} -->
<div class="elite-column col-6 col-lg-3"><div class="column-inner"><!-- wp:elite/div {"className":"elite-div--stat"} -->
<div class="elite-div elite-div--stat"><div class="div-inner"><!-- wp:elite/counter <?php echo wp_json_encode( $counter, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ); ?> /-->

<!-- wp:elite/paragraph {"className":"elite-paragraph--stat-caption"} -->
<p class="elite-paragraph elite-paragraph--stat-caption"><?php echo esc_html( $caption ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Stats","className":"elite-section--stats"} -->
<section class="elite-section alignfull elite-section--stats"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--stats-grid"} -->
<div class="elite-row row elite-row--stats-grid">
<?php
$wp_elite_stat(
	array(
		'end'     => 1,
		'prefix'  => '<',
		'suffix'  => 's',
		'animate' => false,
	),
	__( 'Load time we target on every site we build', 'wp-elite' )
);
echo "\n";
$wp_elite_stat(
	array(
		'end'    => 95,
		'suffix' => '+',
	),
	__( 'Mobile PageSpeed score we aim for on every page', 'wp-elite' )
);
echo "\n";
$wp_elite_stat(
	array(
		'end'     => 0,
		'animate' => false,
	),
	__( 'Page builders. Native WordPress blocks only', 'wp-elite' )
);
echo "\n";
$wp_elite_stat(
	array(
		'end'    => 24,
		'suffix' => 'h',
	),
	__( 'Maximum reply time on working days', 'wp-elite' )
);
?>
</div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
