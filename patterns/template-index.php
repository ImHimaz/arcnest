<?php
/**
 * Title: Blog
 * Slug: wp-elite/template-index
 * Inserter: no
 * Description: The main content of the index template: a title and the latest posts.
 *
 * @package WpElite
 */

?>
<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group">
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Latest posts', 'wp-elite' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:pattern {"slug":"wp-elite/template-query-grid"} /-->
</main>
<!-- /wp:group -->
