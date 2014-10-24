<?php
/**
 * content template for nothing found
 */
?>

	<div class="article result-nothing-found clearfix">
    <h1 class="entry-title"><?php _e( 'Nothing found', 'zAlive' ); ?></h1>
    <div class="entry-content clearfix">
      <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
      <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'zAlive' ), admin_url( 'post-new.php' ) ); ?></p>
      <?php elseif ( is_search() ) : ?>
      <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'zAlive' ); ?></p>
      <?php get_search_form(); ?>
      <?php else : ?>
      <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'zAlive' ); ?></p>
      <?php get_search_form(); ?>
      <?php endif; ?>
    </div>
  </div>