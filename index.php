<?php
/**
 * The main template file.
 */
 global $zAlive_options;
get_header(); ?>
<?php if( ! ( is_front_page() && $zAlive_options['hide_posts_and_primary_sidebar'] == true ) ) : ?>
    <?php //show sidebar on the left
      if( $zAlive_options['primary_sidebar_layout'] == 2 ) { get_sidebar(); } 
    ?>
    <div id="main">
      <?php if( $zAlive_options['breadcrumb_enabled'] == true ) {zAlive_breadcrumb();} ?>
      <?php if ( have_posts() ) : ?>
      <ul class="articles clearfix">
        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();
          printf('<li id="post-%2$s" class="article %1$s"> ',implode(' ', get_post_class()), get_the_ID() );
          get_template_part( 'template/content', 'brief' );
          echo '</li>';
          wp_reset_postdata();
        endwhile;
        ?>
      </ul>
      <?php else : ?>
        <?php get_template_part( 'template/content', 'none' ); ?>
      <?php endif; ?>
      <?php if ( function_exists('wp_pagenavi') ) : ?>
        <?php wp_pagenavi(); ?>
      <?php else : ?>
        <div class="list-pager clearfix">
          <?php previous_posts_link( __( 'Previous Page', 'zAlive' ) ); ?>
          <?php next_posts_link( __( 'Next Page', 'zAlive' ) ); ?>
        </div>
        
      <?php endif; ?>
    </div>
    <?php //show sidebar on the right
      if( $zAlive_options['primary_sidebar_layout'] == 1 ) { get_sidebar(); } 
    ?>
<?php endif; ?>
  <?php get_footer(); ?>