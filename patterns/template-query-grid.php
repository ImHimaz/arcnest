<?php
/**
 * Title: Posts grid
 * Slug: wp-elite/template-query-grid
 * Inserter: no
 * Description: The posts of the page shown (blog, archive, search) in a grid, with pagination; used by the index, archive and search templates.
 *
 * @package WpElite
 */

?>
<!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:post-title {"isLink":true,"fontSize":"title-5"} /-->

<!-- wp:post-excerpt {"excerptLength":24} /-->

<!-- wp:post-date {"fontSize":"small"} /-->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php esc_html_e( 'Nothing found.', 'wp-elite' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
