<?php
/**
 * Title: Case study: intro
 * Slug: wp-elite/section-case-hero
 * Categories: wp-elite, banner
 * Keywords: case study, client, project, intro
 * Description: A case study's intro, in the speed test intro's design (dark purple, centred): a badge with the sector, the headline result, a line on the project and its facts as pills (client, services, timeline, before → after). Replace every [placeholder]. Section class elite-section--speed-hero.
 *
 * @package WpElite
 */

$wp_elite_facts = array(
	__( 'Client: [Client name]', 'wp-elite' ),
	__( 'Services: [Page builder → blocks rebuild]', 'wp-elite' ),
	__( 'Timeline: [3 weeks]', 'wp-elite' ),
	__( 'Before: [Elementor Pro] → After: Arcnest blocks', 'wp-elite' ),
);
?>
<!-- wp:elite/section {"label":"Case study intro","className":"elite-section--speed-hero"} -->
<section class="elite-section alignfull elite-section--speed-hero"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"className":"elite-paragraph--speed-badge"} -->
<p class="elite-paragraph elite-paragraph--speed-badge"><strong><?php esc_html_e( 'Case study', 'wp-elite' ); ?></strong> <?php esc_html_e( '[Sector, e.g. Dental clinic, UK]', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"level":1,"textStyle":"title-1"} -->
<h1 class="elite-heading" style="font-family:var(--text-title-1-font-family);font-size:var(--text-title-1-font-size);font-weight:var(--text-title-1-font-weight);line-height:var(--text-title-1-line-height);letter-spacing:var(--text-title-1-letter-spacing);text-transform:var(--text-title-1-text-transform)"><?php esc_html_e( '[Client name]: [the headline result, e.g. mobile score from 38 to 94]', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h1>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--speed-lead"} -->
<p class="elite-paragraph elite-paragraph--speed-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( '[Two sentences: who the client is, what their site had to do, and why they came to us.]', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:list {"className":"core-list--speed-facts"} -->
<ul class="wp-block-list core-list--speed-facts">
	<?php foreach ( $wp_elite_facts as $wp_elite_index => $wp_elite_fact ) : ?>
		<?php echo $wp_elite_index ? "\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $wp_elite_fact ); ?></li>
<!-- /wp:list-item -->
	<?php endforeach; ?>
</ul>
<!-- /wp:list --></div></div></section>
<!-- /wp:elite/section -->
