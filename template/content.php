<?php
/**
 * content template : detailed
 */
  global $zAlive_options;
?>

	
  <h1 class="entry-title"><?php the_title(); ?></h1>
  <?php get_template_part( 'template/entry-meta-primary', 'singular' ); ?>
  <div class="entry-content clearfix">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="content-pager clearfix"><span class="pager_text">' . __( 'Pages: ', 'zAlive' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
  </div>
  <?php get_template_part( 'template/entry-meta-secondary' ); ?>
<?php if( $zAlive_options['show_post_url'] == true ) : ?>
  <?php get_template_part( 'template/entry-meta-tertiary' ); ?>
<?php endif; ?>
  