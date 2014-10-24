<?php
/**
 * footer template
 */
 global $zAlive_options;
?>
      </div>
    </div>
    <?php 
      //sidebar secondary (footer_widgets.php is replaced with sidebar-secondary.php in version 1.2.2, but the option $zAlive_options['footer_widget_enabled'] is still exist)
      if( $zAlive_options['footer_widget_enabled'] == 1 || ($zAlive_options['footer_widget_enabled'] == 2 && is_front_page() ) ){
        get_sidebar( 'secondary' ); 
      }
    ?>
    <div id="footer">
      <div class="container">
        <div class="copyright-text">
          <?php if($zAlive_options['copyright_content'] !='') { echo $zAlive_options['copyright_content'];} else { ?>
          &copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a> All Rights Reserved.
          <?php } ?>Theme zAlive by <a href="http://www.zenoven.com/" title="zenoven" >zenoven</a>.
        </div>
        
        <ul class="copyright-links">
          <?php 
            if ( has_nav_menu( 'footer_custom_links' ) ) {
              wp_nav_menu( array('theme_location'  => 'footer_custom_links', 'container' => '','depth' => 1 ,'items_wrap' => '%3$s' ) ); 
            } else {
              wp_list_pages('depth=1&title_li=0&sort_column=menu_order&number=4');
            }
          ?>
        </ul>
      </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>