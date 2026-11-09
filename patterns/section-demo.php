<?php
/**
 * Title: Demo video
 * Slug: wp-elite/section-demo
 * Categories: wp-elite, media
 * Keywords: demo, video, showcase
 * Description: "See it in action": an eyebrow, the heading and a line, then a full-width video that grows from a card as it scrolls in. Set the video on the "Video" Elite Div (Background → Video: WebM, MP4 fallback, poster, and a Video description for screen readers, e.g. "Demo: building a page with Arcnest blocks"). Section class elite-section--demo, ID demo.
 *
 * @package WpElite
 */

?>
<!-- wp:elite/section {"containerType":"none","label":"Demo","anchor":"demo","className":"elite-section--demo"} -->
<section class="elite-section alignfull elite-section--demo" id="demo"><div class="section-inner"><!-- wp:elite/div {"className":"elite-div--demo-head"} -->
<div class="elite-div elite-div--demo-head"><div class="div-inner"><!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'See it in action', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Built with blocks, not bloat', 'wp-elite' ); ?><span class="elite-span elite-span--dot">.</span></h2>
<!-- /wp:elite/heading --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--demo-lead"} -->
<p class="elite-paragraph elite-paragraph--demo-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Watch a full page come together in the native WordPress editor with our own block theme. No page builder in sight.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div -->

<!-- wp:elite/div {"className":"elite-div--demo-media","label":"Video"} -->
<div class="elite-div elite-div--demo-media"><div class="div-inner"></div></div>
<!-- /wp:elite/div --></div></section>
<!-- /wp:elite/section -->
