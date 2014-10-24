<?php
/**
  Template Name: Full Width
 */

get_header('full-width'); ?>

    <div id="main">
      <?php if( $zAlive_options['breadcrumb_enabled'] == true ) {zAlive_breadcrumb();} ?>
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class( array('article','clearfix') ); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part( 'template/entry-meta-primary','page' ); ?>
        <div class="entry-content clearfix">
          <?php the_content(); ?>
          <?php wp_link_pages( array( 'before' => '<div class="content-pager clearfix"><span class="pager_text">' . __( 'Pages: ', 'zAlive' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        </div>
      </div>
        <?php wp_reset_postdata();
        endwhile; ?>
      <?php else : ?>
        <?php get_template_part( 'template/content', 'none' ); ?>
      <?php endif; ?>
      <?php if(comments_open()) {comments_template( '', true );}  ?>
    </div>
  <?php get_footer(); ?>