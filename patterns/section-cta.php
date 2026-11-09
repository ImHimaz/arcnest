<?php
/**
 * Title: Call to action
 * Slug: wp-elite/section-cta
 * Categories: wp-elite, call-to-action
 * Keywords: cta, call to action, button
 * Description: Contrasting band with a heading and button that fades up into view (section class elite-section--cta).
 *
 * @package WpElite
 */

?>
<!-- wp:group {"align":"full","className":"elite-section--cta","backgroundColor":"primary","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull elite-section--cta has-base-color has-primary-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Ready to talk?', 'wp-elite' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-base-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Contact us', 'wp-elite' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
