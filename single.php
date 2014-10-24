<?php
/**
 * single template
 */

get_header(); ?>
  <?php //show sidebar on the left
    if( $zAlive_options['primary_sidebar_layout'] == 2 ) { get_sidebar(); } 
  ?>
    <div id="main">
      <?php if( $zAlive_options['breadcrumb_enabled'] == true ) {zAlive_breadcrumb();} ?>
      <?php if ( have_posts() ) : ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class( array('article','clearfix') ); ?>>
        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();
          get_template_part( 'template/content', get_post_format() );
          wp_reset_postdata();
        endwhile;
        ?>
      </div>
      <?php else : ?>
        <?php get_template_part( 'template/content', 'none' ); ?>
      <?php endif; ?>
      <?php comments_template( '', true ); ?>
    </div>
  <?php //show sidebar on the right
    if( $zAlive_options['primary_sidebar_layout'] == 1 ) { get_sidebar(); } 
  ?> 
  <?php get_footer(); ?>