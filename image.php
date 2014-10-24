<?php
/**
 * attachment > image template
 */

get_header(); ?>
  <?php //show sidebar on the left
    if( $zAlive_options['primary_sidebar_layout'] == 2 ) { get_sidebar(); } 
  ?>
    <div id="main">
      <?php if( $zAlive_options['breadcrumb_enabled'] == true ) {zAlive_breadcrumb();} ?>
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class( array('article','clearfix') ); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part( 'template/entry-meta-primary', 'singular' ); ?>
        <div class="entry-content clearfix">
          <?php $image_attributes = wp_get_attachment_image_src($post->ID,'full'); // returns an array ?>
          <?php add_thickbox(); ?>
          <a href="<?php echo $image_attributes[0];?>" class="thickbox" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo wp_get_attachment_image($post->ID,'full');?></a>
          <?php the_content(); ?>
        </div>
      </div>
        <?php wp_reset_postdata();
        endwhile; ?>
      <?php else : ?>
        <?php get_template_part( 'template/content', 'none' ); ?>
      <?php endif; ?>
      <?php comments_template( '', true ); ?>
    </div>
  <?php //show sidebar on the right
    if( $zAlive_options['primary_sidebar_layout'] == 1 ) { get_sidebar(); } 
  ?> 
  <?php get_footer(); ?>