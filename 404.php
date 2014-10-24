<?php
/**
  404 template
 */

get_header(); ?>
  <?php //show sidebar on the left
    if( $zAlive_options['primary_sidebar_layout'] == 2 ) { get_sidebar(); } 
  ?>
    <div id="main">
      <?php if( $zAlive_options['breadcrumb_enabled'] == true ) {zAlive_breadcrumb();} ?>
      <div class="article result-nothing-found clearfix">	
        <h1 class="entry-title"><?php _e('Error 404,Page Not Found','zAlive')?></h1>
        <div class="entry-content clearfix">
          <p class="error-text"><?php _e('We&rsquo;re sorry but the page is not existed or deleted by the administrator. Perhaps searching can help.','zAlive')?></p>
          <?php get_search_form(); ?>
          <p>
            <?php _e('Or you may want to : ','zAlive')?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php _e('Back to Home ','zAlive')?></a>
          </p>
        </div>
      </div>
    </div>
  <?php //show sidebar on the right
    if( $zAlive_options['primary_sidebar_layout'] == 1 ) { get_sidebar(); } 
  ?> 
  <?php get_footer(); ?>