<?php
/**
 * post url template(can be used after entry-meta-secondary in single page)
 */
?>

<div class="entry-meta entry-meta-tertiary">
  <?php  if (function_exists('wp_ozh_yourls_url')) { ?>
  <p><?php _e( 'Short URL for this post : ', 'zAlive' ); ?> <?php wp_ozh_yourls_url(); ?> </p>
  <?php } ?>
  <p><?php _e( 'URL for this post : ', 'zAlive' ); ?><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
</div>