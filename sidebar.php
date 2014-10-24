<?php
/**
 * right sidebar template
 */
?>  
  <div id="sidebar" class="visible-desktop">
  <?php 
  if(is_active_sidebar('sidebar')){
    dynamic_sidebar('sidebar'); 
  } else { ?>
    <?php //recent comments widget from zAlive ?>
    <div id="zalive_widget_recentcomments" class="widget widget_zalive_widget_recentcomments">
      <h3 class="widget-title  widget_primary_title"><?php _e('Recent Comments','zAlive') ?><b class="caret"></b></h3>
      <ul><?php zAlive_recentComments(7,40,50) ?></ul>
    </div>
    <?php 
      $zAlive_widget_args = array( 'before_title' => '<h3 class="widget-title  widget_primary_title">', 'after_title' => '<b class="caret"></b></h3>');
      
      //WP_Widget_Recent_Posts
      the_widget( 'WP_Widget_Recent_Posts',null,$zAlive_widget_args ); 

      //WP_Widget_Categories
      the_widget( 'WP_Widget_Categories','hierarchical=1',$zAlive_widget_args ); 

      //WP_Widget_Pages
      the_widget( 'WP_Widget_Pages',null,$zAlive_widget_args ); 
      
      //WP_Widget_Archives
      the_widget( 'WP_Widget_Archives',null,$zAlive_widget_args ); 
      
      //WP_Widget_Tag_Cloud
      the_widget( 'WP_Widget_Tag_Cloud',null,$zAlive_widget_args ); 

      //WP_Widget_Meta
      the_widget( 'WP_Widget_Meta',null,$zAlive_widget_args ); 
    ?> 
  <?php }?>
  </div>