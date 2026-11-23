<?php
/**
 * Title: Founder
 * Slug: wp-elite/section-team
 * Categories: wp-elite, team
 * Keywords: team, founder, about, person
 * Description: "Who you'll work with": the founder's photo (the "arcnest-founder-portrait" image from the Media Library, with a lime block behind it) beside an eyebrow, a quote, the name and role, three short facts and a button to book a call. Section class elite-section--team, ID team.
 *
 * @package WpElite
 */

/**
 * One fact: a big line and a small one.
 *
 * @param string $big   Big line.
 * @param string $small Small line.
 */
$wp_elite_fact = static function ( string $big, string $small ): void {
	?>
<!-- wp:elite/div {"className":"elite-div--founder-fact"} -->
<div class="elite-div elite-div--founder-fact"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--founder-fact-big"} -->
<p class="elite-paragraph elite-paragraph--founder-fact-big"><?php echo esc_html( $big ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph -->
<p class="elite-paragraph"><?php echo esc_html( $small ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->
	<?php
};

$wp_elite_photo = get_posts(
	array(
		'name'           => 'arcnest-founder-portrait',
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'posts_per_page' => 1,
		'fields'         => 'ids',
	)
);
$wp_elite_image = array(
	'images'    => array(),
	'ratio'     => array( 'desktop' => '4/4.6' ),
	'className' => 'elite-image--founder',
);
if ( $wp_elite_photo ) {
	$wp_elite_image['images']['desktop'] = array(
		'id'  => (int) $wp_elite_photo[0],
		'url' => (string) wp_get_attachment_url( (int) $wp_elite_photo[0] ),
		'alt' => __( 'Himaz Hussain, founder of Arcnest', 'wp-elite' ),
	);
}
?>
<!-- wp:elite/section {"label":"Founder","anchor":"team","className":"elite-section--team"} -->
<section class="elite-section alignfull elite-section--team" id="team"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--founder"} -->
<div class="elite-row row elite-row--founder"><!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":5}},"className":"elite-column--founder-photo"} -->
<div class="elite-column col-12 col-md-5 elite-column--founder-photo"><div class="column-inner"><?php echo '<!-- wp:elite/image ' . wp_json_encode( $wp_elite_image, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP ) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. ?></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"tablet":{"width":7},"laptop":{"width":6,"offset":1}}} -->
<div class="elite-column col-12 col-md-7 col-lg-6 offset-lg-1"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Who you’ll work with', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--founder-quote"} -->
<p class="elite-paragraph elite-paragraph--founder-quote"><?php esc_html_e( '“You work with me directly, not an account manager. I write the code and review every line that ships.”', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--founder-name"} -->
<p class="elite-paragraph elite-paragraph--founder-name"><strong><?php esc_html_e( 'Himaz Hussain', 'wp-elite' ); ?></strong> <?php esc_html_e( 'Founder and lead WordPress developer', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--founder-facts"} -->
<div class="elite-div elite-div--founder-facts"><div class="div-inner">
<?php
$wp_elite_fact( __( '8 years', 'wp-elite' ), __( 'building WordPress sites', 'wp-elite' ) );
echo "\n";
$wp_elite_fact( __( 'US clients', 'wp-elite' ), __( 'day to day, most recently', 'wp-elite' ) );
echo "\n";
$wp_elite_fact( __( '1 contact', 'wp-elite' ), __( 'from first call to launch', 'wp-elite' ) );
?>
</div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--founder-actions"} -->
<div class="elite-div elite-div--founder-actions"><div class="div-inner">
<?php
echo '<!-- wp:elite/button ' . wp_json_encode(
	array(
		'text'      => __( 'Book a 30-minute call', 'wp-elite' ),
		'link'      => array( 'url' => '/contact/?call=1' ),
		'iconEnd'   => 'arrow-right',
		'className' => 'elite-button--secondary',
	),
	JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. 
?>

<?php
echo '<!-- wp:elite/button ' . wp_json_encode(
	array(
		'text'      => 'LinkedIn',
		'link'      => array(
			'url'           => 'https://www.linkedin.com/in/imhimaz/',
			'opensInNewTab' => true,
		),
		'className' => 'elite-button--outline',
	),
	JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. 
?>
</div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row --></div></div></section>
<!-- /wp:elite/section -->
