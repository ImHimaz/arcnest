<?php
/**
 * Title: Services
 * Slug: wp-elite/section-services
 * Categories: wp-elite, featured
 * Keywords: services, cards, design, rebuild, care, white-label
 * Description: "Everything your website needs": the heading beside a line, then four service cards (an icon, a number, the title, a one-line promise, a line, three points and a link to the service's page; the whole card is clickable). Design & build is purple. Two across from laptops, stacked below; they rise in one by one. Section class elite-section--services, ID services.
 *
 * @package WpElite
 */

/**
 * One service card.
 *
 * @param array{icon: string, num: string, title: string, tag: string, text: string, points: list<string>, link: string, url: string, featured?: bool} $card The card.
 */
$wp_elite_service = static function ( array $card ): void {
	$class = empty( $card['featured'] ) ? 'elite-div--service' : 'elite-div--service elite-div--service-featured';
	?>
<!-- wp:elite/div {"className":"<?php echo esc_attr( $class ); ?>"} -->
<div class="elite-div <?php echo esc_attr( $class ); ?>"><div class="div-inner"><!-- wp:elite/div {"className":"elite-div--service-top"} -->
<div class="elite-div elite-div--service-top"><div class="div-inner"><!-- wp:elite/icon {"icon":"<?php echo esc_attr( $card['icon'] ); ?>","size":{"desktop":28}} /-->

<!-- wp:elite/paragraph {"className":"elite-paragraph--service-num"} -->
<p class="elite-paragraph elite-paragraph--service-num"><?php echo esc_html( $card['num'] ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/heading {"level":3,"textStyle":"title-3"} -->
<h3 class="elite-heading" style="font-family:var(--text-title-3-font-family);font-size:var(--text-title-3-font-size);font-weight:var(--text-title-3-font-weight);line-height:var(--text-title-3-line-height);letter-spacing:var(--text-title-3-letter-spacing);text-transform:var(--text-title-3-text-transform)"><?php echo esc_html( $card['title'] ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--service-tag"} -->
<p class="elite-paragraph elite-paragraph--service-tag"><?php echo esc_html( $card['tag'] ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--service-text"} -->
<p class="elite-paragraph elite-paragraph--service-text"><?php echo esc_html( $card['text'] ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--service-points"} -->
<ul class="wp-block-list core-list--service-points">
	<?php foreach ( $card['points'] as $index => $point ) : ?>
		<?php echo $index ? "\n\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $point ); ?></li>
<!-- /wp:list-item -->
	<?php endforeach; ?>
</ul>
<!-- /wp:list -->

	<?php
	echo '<!-- wp:elite/button ' . wp_json_encode(
		array(
			'text'      => $card['link'],
			'link'      => array( 'url' => $card['url'] ),
			'iconEnd'   => 'arrow-right',
			'className' => 'elite-button--service-link',
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
	) . ' /-->'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block attributes, JSON-encoded. 
	?>
	</div></div>
<!-- /wp:elite/div -->
	<?php
};
?>
<!-- wp:elite/section {"label":"Services","anchor":"services","className":"elite-section--services"} -->
<section class="elite-section alignfull elite-section--services" id="services"><div class="section-inner"><div class="container"><!-- wp:elite/row {"className":"elite-row--services-head"} -->
<div class="elite-row row elite-row--services-head"><!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":7}}} -->
<div class="elite-column col-12 col-lg-7"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Services', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Everything your website needs, from first design to every update after', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/column -->

<!-- wp:elite/column {"size":{"mobile":{"width":12},"laptop":{"width":4,"offset":1}}} -->
<div class="elite-column col-12 col-lg-4 offset-lg-1"><div class="column-inner"><!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--services-lead"} -->
<p class="elite-paragraph elite-paragraph--services-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Fixed scope and a fixed price, agreed before we start. You review every step on a private staging site.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/column --></div>
<!-- /wp:elite/row -->

<!-- wp:elite/div {"className":"elite-div--services-grid"} -->
<div class="elite-div elite-div--services-grid"><div class="div-inner">
<?php
$wp_elite_service(
	array(
		'icon'     => 'layers',
		'num'      => '01',
		'title'    => __( 'Design & build', 'wp-elite' ),
		'tag'      => __( 'A new website, designed around how your customers buy.', 'wp-elite' ),
		'text'     => __( 'From the message on your home page to the last form field, we plan, design and build a site that makes it easy to say yes.', 'wp-elite' ),
		'points'   => array( __( 'Strategy, copy structure and UX', 'wp-elite' ), __( 'Custom design in your brand', 'wp-elite' ), __( 'Lead capture, booking and tracking set up', 'wp-elite' ) ),
		'link'     => __( 'Design & build', 'wp-elite' ),
		'url'      => '/design-and-build/',
		'featured' => true,
	)
);
echo "\n\n";
$wp_elite_service(
	array(
		'icon'   => 'refresh',
		'num'    => '02',
		'title'  => __( 'Rebuild without a page builder', 'wp-elite' ),
		'tag'    => __( 'Keep your design. Lose the page builder.', 'wp-elite' ),
		'text'   => __( 'We rebuild your Elementor, Divi or WPBakery site on WordPress’s own editor. It looks the same, loads faster and has no licence to renew.', 'wp-elite' ),
		'points' => array( __( 'Same design, or improved where it helps', 'wp-elite' ), __( 'Before-and-after speed report', 'wp-elite' ), __( 'Your content and SEO carried over', 'wp-elite' ) ),
		'link'   => __( 'Rebuild your site', 'wp-elite' ),
		'url'    => '/rebuild/',
	)
);
echo "\n\n";
$wp_elite_service(
	array(
		'icon'   => 'shield-check',
		'num'    => '03',
		'title'  => __( 'Care plans', 'wp-elite' ),
		'tag'    => __( 'Your site stays fast, secure and up to date.', 'wp-elite' ),
		'text'   => __( 'Monthly updates, backups and monitoring, plus small changes when you need them. Stop any time: your site keeps working without us.', 'wp-elite' ),
		'points' => array( __( 'Updates, backups and uptime checks', 'wp-elite' ), __( 'Speed and Core Web Vitals monitoring', 'wp-elite' ), __( 'Content edits each month', 'wp-elite' ) ),
		'link'   => __( 'See care plans', 'wp-elite' ),
		'url'    => '/care-plans/',
	)
);
echo "\n\n";
$wp_elite_service(
	array(
		'icon'   => 'users',
		'num'    => '04',
		'title'  => __( 'White-label development', 'wp-elite' ),
		'tag'    => __( 'Your agency’s build team, under your brand.', 'wp-elite' ),
		'text'   => __( 'You design and manage the client. We turn your Figma into fast, pixel-perfect WordPress, and the client never hears our name.', 'wp-elite' ),
		'points' => array( __( 'Figma to WordPress, pixel-perfect', 'wp-elite' ), __( 'NDA and your brand by default', 'wp-elite' ), __( 'Overlap with US, UK and AU hours', 'wp-elite' ) ),
		'link'   => __( 'Partner with us', 'wp-elite' ),
		'url'    => '/white-label/',
	)
);
?>
</div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
