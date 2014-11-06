<?php 
  $zAlive_options = zAlive_getThemeOptions();

  //setup theme
  function zAlive_theme_setup() {
    load_theme_textdomain('zAlive', get_template_directory() . '/languages');
   
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'zAlive-thumbnail', 150, 120, true); 
    add_theme_support( 'nav-menus');
    add_theme_support( 'post-formats', array( 'aside', 'gallery' ,'link' , 'image' , 'quote' , 'status' , 'video' , 'audio' , 'chat') );
    add_theme_support( 'automatic-feed-links' );
    
    register_nav_menus( array(
      'top_nav_menu' => __( 'Top Nav Menu' , 'zAlive' ),
      'footer_custom_links' => __( 'Footer Custom Links' , 'zAlive' )
    ));
    
    register_sidebar(array(   
      'name'=>__('Primary Sidebar','zAlive'),   
      'id'=>'sidebar',   
      'before_widget' => '<div id="%1$s" class="widget %2$s">',   
      'after_widget' => '</div>',   
      'before_title' => '<h3 class="widget-title widget_primary_title">',   
      'after_title' => '<b class="caret"></b></h3>'   
    )); 
    
    register_sidebar(array(   
      'name'=>__('Secondary Sidebar','zAlive'),   
      'id'=>'sidebar-secondary',   
      'before_widget' => '<div id="%1$s" class="widget %2$s widget_secondary span3">',   
      'after_widget' => '</div>',   
      'before_title' => '<h4 class="widget-title">',   
      'after_title' => '<b class="line"></b></h4>'   
    ));

    if ( ! isset( $content_width ) ){
      $content_width = 754;
    }
    add_theme_support( 'custom-background', array(
      'default-color'          => '',
      'default-image'          => '',
      'wp-head-callback'       => '_custom_background_cb',
      'admin-head-callback'    => '',
      'admin-preview-callback' => '',
      ) 
    );
    add_editor_style( 'css/bootstrap.min.css' );
    add_editor_style( 'css/editor-style.css' );
  }
  add_action ('after_setup_theme', 'zAlive_theme_setup');  
  
  function zAlive_add_mobile_device_class($classes) {
    if(wp_is_mobile()){
      $classes[] = 'is-mobile';
    }
    return $classes;
  }
  // add 'is-mobile' class to body
  add_filter('body_class', 'zAlive_add_mobile_device_class');

  //rewrite title(Adopted from Twenty Twelve)
  function zAlive_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
      return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
      $title = "$title $sep " . sprintf( __( 'Page %s', 'zAlive' ), max( $paged, $page ) );

    return $title;
  }
  add_filter( 'wp_title', 'zAlive_wp_title', 10, 2 );
  
  //breadcrumb nav
  function zAlive_breadcrumb(){
    global $wp_query; 
    if ( !is_home() && !is_front_page() ){ 
      // Start the UL
      echo '<ul class="breadcrumb">';
      // Add the Home link
      echo '<li>' . __( 'You are here' , 'zAlive' ) . '&nbsp;:&nbsp;</li><li><a href="'. esc_url( home_url( '/' ) ) .'">'. get_bloginfo('name') .'</a></li>'; 
      if ( is_single() )
      {
          $category = get_the_category();
          if(count($category)!=0){    //attachment page : array length of $category is 0
            $category_id = get_cat_ID( $category[0]->cat_name ); 
            echo '<li> <span class="divider">/</span>'. get_category_parents( $category_id, TRUE, " <span class=\"divider\">/</span>" ) ."</li>";
            echo '<li class="active">'.the_title('','', FALSE) ."</li>";
          }else{
            echo '<li class="active"> <span class="divider">/</span>'.the_title('','', FALSE) ."</li>";
          }
          
      }
      elseif ( is_page() )
      {
          $post = $wp_query->get_queried_object(); 
          if ( $post->post_parent == 0 ){ 
              echo "<li class=\"active\"> <span class=\"divider\">/</span>".the_title('','', FALSE)."</li>"; 
          } else {
              $title = the_title('','', FALSE);
              $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
              array_push($ancestors, $post->ID); 
              foreach ( $ancestors as $ancestor ){
                  if( $ancestor != end($ancestors) ){
                      echo '<li> <span class="divider">/</span><a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                  } else {
                      echo '<li class="active"> <span class="divider">/</span>'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
                  }
              }
          }
      }
      elseif ( is_category() )
      {
          $catTitle = single_cat_title( "", false );
          $cat = get_cat_ID( $catTitle );
          echo "<li> <span class=\"divider\">/</span>". get_category_parents( $cat, TRUE, " <span class=\"divider\">/</span>" ) ."</li>";
      }
      elseif ( is_tag() )
      {
          $tagTitle = single_tag_title( "", false ); 
          echo "<li class=\"active\"> <span class=\"divider\">/</span>";
          printf( __('Posts with tag [ <strong> %s </strong> ] ','zAlive'),$tagTitle);
          echo "</li>";
      }
      elseif ( is_search() ) { 
          echo "<li class=\"active\"> <span class=\"divider\">/</span>";
          printf(__('Search result for [ <strong> %s </strong> ] ','zAlive'),get_search_query());
          echo "</li>";
      }
      elseif ( is_404() )
      {
          echo "<li class=\"active\"> <span class=\"divider\">/</span>" . __('Error 404,Page Not Found','zAlive') . "</li>";
      }
      elseif ( is_author() )
      {
          $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
          echo "<li class=\"active\"> <span class=\"divider\">/</span> ";
          printf(__('Posts from author [ <strong> %s </strong> ] ','zAlive'), $curauth->nickname );
          echo "</li>";
      }
      elseif ( is_day() )
      {
          $dateTitle = get_the_time(__('Y/m/d','zAlive')) ;
          echo "<li class=\"active\"> <span class=\"divider\">/</span> ";
          printf(__('Daily archives for <strong> %s </strong>','zAlive'),$dateTitle);
          echo "</li>";
      }
      elseif ( is_month() )
      {
          $dateTitle = get_the_time(__('Y/m','zAlive')) ;
          echo "<li class=\"active\"> <span class=\"divider\">/</span> ";
          printf(__('Monthly archives for <strong> %s </strong>','zAlive'),$dateTitle);
          echo "</li>";
      }
      elseif ( is_year() )
      {
          $dateTitle = get_the_time(__('Y','zAlive')) ;
          echo "<li class=\"active\"> <span class=\"divider\">/</span> ";
          printf(__('Yearly archives for <strong> %s </strong>','zAlive'),$dateTitle);
          echo "</li>";
      }
      
      // End the UL
      echo "</ul>";
    }
  }

  add_filter( 'the_title', 'zAlive_title_filte' );
 
	// title filter for post untitled
	function zAlive_title_filte($title) {
		if ($title == '') {
      return __('Untitled Post','zAlive');
		} else {
      return $title;
		}
	}
  
  //set automatic excerpt length (if automatic excerpt is enabled)
  function zAlive_excerpt_length( $length ) {
    global $zAlive_options;
    return $zAlive_options['excerpt_length'];
  }
  add_filter( 'excerpt_length', 'zAlive_excerpt_length');
  
  //empty original '[...]' txt  (when automatic excerpt is enabled or posts have 'more' tag, '[...]' will display after excerpt)
  function zAlive_excerpt_more( $more ) {
    return '';
  }
  add_filter('excerpt_more', 'zAlive_excerpt_more');

  //add custom 'Read More' link after excerpt
  function zAlive_excerpt_read_more_link($output) {
    global $zAlive_options;
    $excerpt_text = trim ( esc_attr ( $zAlive_options['excerpt_text'] ) ) ;
    if(empty( $excerpt_text ) ){
      return $output;
    }else{
      return $output . '<a class="more-link" rel="nofollow" href="'. get_permalink( get_the_ID() ) . '">'. esc_attr($zAlive_options['excerpt_text']) .'</a>';
    }
  }
  add_filter('the_excerpt', 'zAlive_excerpt_read_more_link');
    
  //recent comments with avatar(this function is only be used in widget)
  function zAlive_recentComments($count,$avatarSize,$excerptLength){
    //ensure all the inputs are valid
    $count = is_int($count) ? absint($count) : 7; //limit the count of items to output
    $avatarSize = is_int($avatarSize) ? absint($avatarSize) : 40; //get the avatar size
    $excerptLength = is_int($excerptLength) ? absint($excerptLength) : 50; //excerpt length of each comment
    
    $comments;
    if( $count != 0 ){
      $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $count + 30, 'status' => 'approve', 'post_status' => 'publish' ) ) );//plus 30 is to minimize the chance that $count is much smaller than the length of $comments,because $comments may have comments of pingback/trackback and comment be on the password protected.
    }
    $valid_comments_number = 0;
    $output = '';
    if( !empty ( $comments ) ){
      foreach ($comments as $comment) {
        //if comment is not pingback or trackback and comment is not on the password protected
        $post = get_post( $comment->comment_post_ID );
        if( empty ($comment->comment_type ) && empty ( $post->post_password ) ){
          $output .= '<li class="clearfix">'. get_avatar($comment, $avatarSize) .'<div class="comment-data"><a class="title" href="' . get_permalink($comment->comment_post_ID) . "#comment-" . $comment->comment_ID . '" title="on ' . strip_tags( $post->post_title) . '">' . wp_html_excerpt( strip_tags ( $comment->comment_content), $excerptLength ) . '</a>' .'<span class="comment_author detailed visible-desktop">From <span class="author">' . $comment->comment_author . '</span>&nbsp;&nbsp;<span class="date">' . $comment->comment_date . "</span></span></div></li>\n";
          $valid_comments_number++;
          if( $valid_comments_number == $count )
            break;
        }
      }
    }
    $output = convert_smilies($output);
    echo $output;
  }
  
  //most commented articles
  function zAlive_mostCommentedArticles($count){
    //ensure all the inputs are valid
    $count = is_int($count) ? absint($count) : 10; //limit the count of items to output
    
    $queryObject = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count , 'no_found_rows' => true, 'post_status' => 'publish', 'orderby' => 'comment_count' ) ) ); 

    if ($queryObject->have_posts()) {
      while ($queryObject->have_posts()) {
        $queryObject->the_post();
        $commentcount = get_comments_number();
        ?>
          <li><a href="<?php echo get_permalink( get_the_ID() ); ?>" title="<?php the_title_attribute() ?>"><?php the_title() ?></a><span class="detailed comment-number"> (<a href="<?php comments_link(); ?>"><?php printf( _n( '1 Comment', '%s Comments', $commentcount, 'zAlive' ), $commentcount );  ?></a>)</span></li>
        <?php 
      }
    }
    wp_reset_postdata();
  }
  
  //random articles
  function zAlive_randomArticles($count){
    //ensure all the inputs are valid
    $count = is_int($count) ? absint($count) : 10; //limit the count of items to output
    
    $queryObject = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $count , 'no_found_rows' => true, 'post_status' => 'publish', 'orderby' => 'rand' ) ) );
    
    if ($queryObject->have_posts()) {
      while ($queryObject->have_posts()) {
        $queryObject->the_post();
        ?>
        <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
        <?php
      }
    }
    wp_reset_postdata();
  }
  
  //custom search widget
  class zAlive_widget_search extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Search Widget From zAlive','zAlive') );
      parent::__construct('zAlive_widget_search', __('Search(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      echo '<form role="search" method="get" class="row-fluid" action="' . esc_url( home_url( '/' ) ) . '"><div><input type="text" placeholder="' . __('Type and search...','zAlive') . '" value="" name="s" id="s" class="span8" /><input type="submit" value="' . __('Search','zAlive') . '" class="btn span4 pull-right" /></div></form>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      return $instance;
    }
    function form($instance) {
      $instance = wp_parse_args((array) $instance, array('title' => __('Search','zAlive') ));
      $title = esc_attr( $instance['title'] );
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  // custom recent comments widget
  class zAlive_widget_recentComments extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Recent Comments Widget From zAlive','zAlive'));
      parent::__construct('zAlive_widget_recentComments', __('Recent Comments(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      echo '<ul>';
      zAlive_recentComments($instance['limit'],$instance['avatarSize'],$instance['excerptLength']);
      echo '</ul>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = absint($new_instance['limit']);
      $instance['avatarSize'] = absint($new_instance['avatarSize']);
      $instance['excerptLength'] = absint($new_instance['excerptLength']);
      return $instance;
    }
    function form($instance) {
      $instance = wp_parse_args((array) $instance, array('title' => __('Recent Comments','zAlive'), 'limit' => 7,'avatarSize' => 40,'excerptLength' => 50));
      $title = esc_attr($instance['title']);
      $limit = isset($instance['limit']) ? absint($instance['limit']) : 7;
      $avatarSize = isset($instance['avatarSize']) ? absint($instance['avatarSize']) : 40;
      $excerptLength = isset($instance['excerptLength']) ? absint($instance['excerptLength']) : 50;
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Comments Count','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('avatarSize'); ?>"><?php _e('Avatar Size','zAlive');?>(px)&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('avatarSize'); ?>" name="<?php echo $this->get_field_name('avatarSize'); ?>" type="text" value="<?php echo $avatarSize; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('excerptLength'); ?>"><?php _e('Maximum Count Of Comment Characters','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('excerptLength'); ?>" name="<?php echo $this->get_field_name('excerptLength'); ?>" type="text" value="<?php echo $excerptLength; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  //custom most commented articles widget
  class zAlive_widget_mostCommentedArticles extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Most Commented Posts Widget From zAlive','zAlive'));
      parent::__construct('zAlive_widget_mostCommentedArticles', __('Most Commented Posts(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      
      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      echo '<ul>';
      zAlive_mostCommentedArticles($instance['limit']);
      echo '</ul>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = absint($new_instance['limit']);
      return $instance;
    }
    function form($instance) {      
      $instance = wp_parse_args((array) $instance, array('title' => __('Most Commented Posts','zAlive'), 'limit' => 10));
      $title = esc_attr($instance['title']);
      $limit = isset($instance['limit']) ? absint($instance['limit']) : 10;
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Post Count','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  //custom random articles widget
  class zAlive_widget_randomArticles extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Random Posts Widget From zAlive','zAlive'));
      parent::__construct('zAlive_widget_randomArticles', __('Random Posts(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      
      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      echo '<ul>';
      zAlive_randomArticles($instance['limit']);
      echo '</ul>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['limit'] = absint($new_instance['limit']);
      return $instance;
    }
    function form($instance) {      
      $instance = wp_parse_args((array) $instance, array('title' => __('Random Posts','zAlive'), 'limit' => 10));
      $title = esc_attr($instance['title']);
      $limit = isset($instance['limit']) ? absint($instance['limit']) : 10;
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Post Count','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  //custom hot commented articles and random articles widget (in two tabs)
  class zAlive_widget_mostCommentedAndRandomArticles extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Most Commented & Random Posts Widget From zAlive (with tab switch )','zAlive'));
      parent::__construct('zAlive_widget_mostCommentedAndRandomArticles', __('Most Commented & Random Posts(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title_hot = apply_filters( 'widget_title', empty( $instance['title_hot'] ) ? '' : $instance['title_hot'], $instance, $this->id_base );
      $title_random = apply_filters( 'widget_title', empty( $instance['title_random'] ) ? '' : $instance['title_random'], $instance, $this->id_base );
      echo $before_widget;
      ?>
      <ul class="nav nav-tabs row-fluid">
        <li class="widget-title span6 active"><a href="#hot-article" data-toggle="tab"><?php echo $title_hot; ?><b class="caret"></b></a></li>
        <li class="widget-title span6"><a href="#random-article" data-toggle="tab" ><?php echo $title_random; ?><b class="caret"></b></a></li>
      </ul>
      <div class="tab-content">
        <ul class="tab-pane active" id="hot-article">
          <?php zAlive_mostCommentedArticles($instance['limit_hot']); ?>
        </ul>
        <ul class="tab-pane" id="random-article">
          <?php zAlive_randomArticles($instance['limit_random']); ?>
        </ul>
      </div>
      <?php
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title_hot'] = strip_tags($new_instance['title_hot']);
      $instance['title_random'] = strip_tags($new_instance['title_random']);
      $instance['limit_hot'] = absint($new_instance['limit_hot']);
      $instance['limit_random'] = absint($new_instance['limit_random']);
      return $instance;
    }
    function form($instance) {
      $instance = wp_parse_args((array) $instance, array('title_hot' => _x('Most Commented','Most Commented Posts','zAlive'), 'title_random' => __('Random Posts','zAlive'), 'limit_hot' => 10, 'limit_random' => 10));
      $title_hot = esc_attr($instance['title_hot']);
      $title_random = esc_attr($instance['title_random']);
      $limit_hot = isset($instance['limit_hot']) ? absint($instance['limit_hot']) : 10;
      $limit_random = isset($instance['limit_random']) ? absint($instance['limit_random']) : 10;
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title_hot'); ?>"><?php _e('Title(Most Commented Posts)','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title_hot'); ?>" name="<?php echo $this->get_field_name('title_hot'); ?>" type="text" value="<?php echo $title_hot; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit_hot'); ?>"><?php _e('Count(Most Commented Posts)','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('limit_hot'); ?>" name="<?php echo $this->get_field_name('limit_hot'); ?>" type="text" value="<?php echo $limit_hot; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title_random'); ?>"><?php _e('Title(Random Posts)','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title_random'); ?>" name="<?php echo $this->get_field_name('title_random'); ?>" type="text" value="<?php echo $title_random; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit_random'); ?>"><?php _e('Count(Random Posts)','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('limit_random'); ?>" name="<?php echo $this->get_field_name('limit_random'); ?>" type="text" value="<?php echo $limit_random; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  // custom social links widget
  class zAlive_widget_social_links extends WP_Widget {
    function __construct() {
      $widget_ops = array('description' => __('Social Links Widget From zAlive','zAlive'));
      parent::__construct('zAlive_widget_social_links', __('Social Links(zAlive)','zAlive'), $widget_ops);
    }
    function widget($args, $instance) {
      extract($args);
      $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
      $email = empty( $instance['email'] ) ? '' : '<p>Email:&nbsp;<a title="' . __('Contact Email','zAlive') . '" href="mailto:' . sanitize_email($instance['email']) . '" class="email" >' . sanitize_email($instance['email']) . '</a></p>';
      $rss = empty( $instance['rss'] ) ? '' : '<a target="_blank" title="' . __('RSS','zAlive') . '" href="' . esc_url ($instance['rss']) . '" class="social-link"><span class="social-icon social-icon-rss"></span></a>';
      $twitter = empty( $instance['twitter'] ) ? '' : '<a target="_blank" title="' . __('Twitter','zAlive') . '" href="' . esc_url ($instance['twitter']) . '" class="social-link"><span class="social-icon social-icon-twitter"></span></a>';
      $facebook = empty( $instance['facebook'] ) ? '' : '<a target="_blank" title="' . __('Facebook','zAlive') . '" href="' . esc_url ($instance['facebook']) . '" class="social-link"><span class="social-icon social-icon-facebook"></span></a>';
      $googleplus = empty( $instance['googleplus'] ) ? '' : '<a target="_blank" title="' . __('Google Plus','zAlive') . '" href="' . esc_url ($instance['googleplus']) . '" class="social-link"><span class="social-icon social-icon-google-plus"></span></a>';
      $youtube = empty( $instance['youtube'] ) ? '' : '<a target="_blank" title="' . __('YouTube','zAlive') . '" href="' . esc_url ($instance['youtube']) . '" class="social-link"><span class="social-icon social-icon-youtube"></span></a>';
      $linkedin = empty( $instance['linkedin'] ) ? '' : '<a target="_blank" title="' . __('Linkedin','zAlive') . '" href="' . esc_url ($instance['linkedin']) . '" class="social-link"><span class="social-icon social-icon-linkedin"></span></a>';
      $pinterest = empty( $instance['pinterest'] ) ? '' : '<a target="_blank" title="' . __('Pinterest','zAlive') . '" href="' . esc_url ($instance['pinterest']) . '" class="social-link"><span class="social-icon social-icon-pinterest"></span></a>';
      $myspace = empty( $instance['myspace'] ) ? '' : '<a target="_blank" title="' . __('Myspace','zAlive') . '" href="' . esc_url ($instance['myspace']) . '" class="social-link"><span class="social-icon social-icon-myspace"></span></a>';
      $deviantart = empty( $instance['deviantart'] ) ? '' : '<a target="_blank" title="' . __('deviantART','zAlive') . '" href="' . esc_url ($instance['deviantart']) . '" class="social-link"><span class="social-icon social-icon-deviantart"></span></a>';
      $flickr = empty( $instance['flickr'] ) ? '' : '<a target="_blank" title="' . __('Flickr','zAlive') . '" href="' . esc_url ($instance['flickr']) . '" class="social-link"><span class="social-icon social-icon-flickr"></span></a>';
      $soundcloud = empty( $instance['soundcloud'] ) ? '' : '<a target="_blank" title="' . __('SoundCloud','zAlive') . '" href="' . esc_url ($instance['soundcloud']) . '" class="social-link"><span class="social-icon social-icon-soundcloud"></span></a>';
      $vimeo = empty( $instance['vimeo'] ) ? '' : '<a target="_blank" title="' . __('Vimeo','zAlive') . '" href="' . esc_url ($instance['vimeo']) . '" class="social-link"><span class="social-icon social-icon-vimeo"></span></a>';
      $tumblr = empty( $instance['tumblr'] ) ? '' : '<a target="_blank" title="' . __('Tumblr','zAlive') . '" href="' . esc_url ($instance['tumblr']) . '" class="social-link"><span class="social-icon social-icon-tumblr"></span></a>';
      $orkut = empty( $instance['orkut'] ) ? '' : '<a target="_blank" title="' . __('Orkut','zAlive') . '" href="' . esc_url ($instance['orkut']) . '" class="social-link"><span class="social-icon social-icon-orkut"></span></a>';
      $vkontakte = empty( $instance['vkontakte'] ) ? '' : '<a target="_blank" title="' . __('VKontakte','zAlive') . '" href="' . esc_url ($instance['vkontakte']) . '" class="social-link"><span class="social-icon social-icon-vkontakte"></span></a>';
      $weibo = empty( $instance['weibo'] ) ? '' : '<a target="_blank" title="' . __('Weibo','zAlive') . '" href="' . esc_url ($instance['weibo']) . '" class="social-link"><span class="social-icon social-icon-weibo"></span></a>';
      echo $before_widget;
      if(!empty($title)){
        echo $before_title.$title.$after_title;
      }
      if(!empty($email)){
        echo $email;
      }
      echo '<p>';
      echo $rss;
      echo $twitter;
      echo $facebook;
      echo $googleplus;
      echo $youtube;
      echo $linkedin;
      echo $pinterest;
      echo $myspace;
      echo $deviantart;
      echo $flickr;
      echo $soundcloud;
      echo $vimeo;
      echo $tumblr;
      echo $orkut;
      echo $vkontakte;
      echo $weibo;
      echo '</p>';
      echo $after_widget;
    }
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['email'] = is_email($new_instance['email']) ? sanitize_email($new_instance['email']) : '' ;
      $instance['rss'] = esc_url_raw($new_instance['rss']);
      $instance['twitter'] = esc_url_raw($new_instance['twitter']);
      $instance['facebook'] = esc_url_raw($new_instance['facebook']);
      $instance['googleplus'] = esc_url_raw($new_instance['googleplus']);
      $instance['youtube'] = esc_url_raw($new_instance['youtube']);
      $instance['linkedin'] = esc_url_raw($new_instance['linkedin']);
      $instance['pinterest'] = esc_url_raw($new_instance['pinterest']);
      $instance['myspace'] = esc_url_raw($new_instance['myspace']);
      $instance['deviantart'] = esc_url_raw($new_instance['deviantart']);
      $instance['flickr'] = esc_url_raw($new_instance['flickr']);
      $instance['soundcloud'] = esc_url_raw($new_instance['soundcloud']);
      $instance['vimeo'] = esc_url_raw($new_instance['vimeo']);
      $instance['tumblr'] = esc_url_raw($new_instance['tumblr']);
      $instance['orkut'] = esc_url_raw($new_instance['orkut']);
      $instance['vkontakte'] = esc_url_raw($new_instance['vkontakte']);
      $instance['weibo'] = esc_url_raw($new_instance['weibo']);
      return $instance;
    }
    function form($instance) {
      $instance = wp_parse_args((array) $instance, array('title' => 'Follow Me', 'email' => '','twitter' => '','facebook' => '', 'googleplus' => '' ,'rss' => get_bloginfo( 'rss2_url' ) ));
      $title = esc_attr($instance['title']);
      $email = isset($instance['email']) ? sanitize_email($instance['email']) : '' ;
      $rss = isset($instance['rss']) ? esc_url($instance['rss']) : '';
      $twitter = isset($instance['twitter']) ? esc_url($instance['twitter']) : '';
      $facebook = isset($instance['facebook']) ? esc_url($instance['facebook']) : '';
      $googleplus = isset($instance['googleplus']) ? esc_url($instance['googleplus']) : '';
      $youtube = isset($instance['youtube']) ? esc_url($instance['youtube']) : '';
      $linkedin = isset($instance['linkedin']) ? esc_url($instance['linkedin']) : '';
      $pinterest = isset($instance['pinterest']) ? esc_url($instance['pinterest']) : '';
      $myspace = isset($instance['myspace']) ? esc_url($instance['myspace']) : '';
      $deviantart = isset($instance['deviantart']) ? esc_url($instance['deviantart']) : '';
      $flickr = isset($instance['flickr']) ? esc_url($instance['flickr']) : '';
      $soundcloud = isset($instance['soundcloud']) ? esc_url($instance['soundcloud']) : '';
      $vimeo = isset($instance['vimeo']) ? esc_url($instance['vimeo']) : '';
      $tumblr = isset($instance['tumblr']) ? esc_url($instance['tumblr']) : '';
      $orkut = isset($instance['orkut']) ? esc_url($instance['orkut']) : '';
      $vkontakte = isset($instance['vkontakte']) ? esc_url($instance['vkontakte']) : '';
      $weibo = isset($instance['weibo']) ? esc_url($instance['weibo']) : '';
      ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Contact Email','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google Plus','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" type="text" value="<?php echo $googleplus; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $pinterest; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('myspace'); ?>"><?php _e('Myspace','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" type="text" value="<?php echo $myspace; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('deviantART','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" type="text" value="<?php echo $deviantart; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('SoundCloud','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" name="<?php echo $this->get_field_name('soundcloud'); ?>" type="text" value="<?php echo $soundcloud; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo $tumblr; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orkut'); ?>"><?php _e('Orkut','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('orkut'); ?>" name="<?php echo $this->get_field_name('orkut'); ?>" type="text" value="<?php echo $orkut; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('vkontakte'); ?>"><?php _e('VKontakte','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('vkontakte'); ?>" name="<?php echo $this->get_field_name('vkontakte'); ?>" type="text" value="<?php echo $vkontakte; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('weibo'); ?>"><?php _e('Weibo','zAlive');?>&nbsp;:&nbsp;<input class="widefat" id="<?php echo $this->get_field_id('weibo'); ?>" name="<?php echo $this->get_field_name('weibo'); ?>" type="text" value="<?php echo $weibo; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
      <?php
    }
  }
  
  
  // Adopted from Responsive theme
  function zAlive_inline_css() {
    global $zAlive_options;
    if( !empty( $zAlive_options['inline_css'] ) ) {
        echo '<!-- zAlive Custom CSS Style Begin -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
        echo $zAlive_options['inline_css'] . "\n";
        echo '</style>' . "\n";
        echo '<!-- zAlive Custom CSS Style End -->' . "\n";
    }
  }
  add_action( 'wp_head', 'zAlive_inline_css', 110 );
  
  // Adopted from Responsive theme
  function zAlive_inline_js_header() {
    global $zAlive_options;
    if( !empty( $zAlive_options['inline_js_header'] ) ) {
      echo '<!-- zAlive Header Custom Scripts Begin -->' . "\n";
      echo $zAlive_options['inline_js_header'];
      echo '<!-- zAlive Header Custom Scripts End -->' . "\n";
    }
  }
  add_action( 'wp_head', 'zAlive_inline_js_header' );
  
  // Adopted from Responsive theme
  function zAlive_inline_js_footer() {
    global $zAlive_options;
    if( !empty( $zAlive_options['inline_js_footer'] ) ) {
      echo '<!-- zAlive Footer Custom Scripts Begin -->' . "\n";
      echo $zAlive_options['inline_js_footer'];
      echo '<!-- zAlive Footer Custom Scripts End -->' . "\n";
    }
  }
  add_action( 'wp_footer', 'zAlive_inline_js_footer' );

  //init widget
  function zAlive_widget_init() {
    register_widget('zAlive_widget_recentComments');    //recent comments widget
    register_widget('zAlive_widget_mostCommentedArticles');  //most commented articles widget
    register_widget('zAlive_widget_randomArticles');  //random articles widget
    register_widget('zAlive_widget_mostCommentedAndRandomArticles');  //most commented articles and random articles widget
    unregister_widget('WP_Widget_Search');//remove default search widget
    register_widget('zAlive_widget_search');//add zAlive search widget
    register_widget('zAlive_widget_social_links');//add zAlive search widget
  }
  add_action('widgets_init', 'zAlive_widget_init');
  
  //register and load CSS/JS files
  function zAlive_scriptsAndStyles() {
    global $zAlive_options;
    //styles
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css', array( 'bootstrap' ) );
    //replace the second argument with get_stylesheet_uri so that user can build a child theme
    wp_enqueue_style( 'zAlive-style', get_stylesheet_uri(), array( 'bootstrap','bootstrap-responsive' ) );
    if ( $zAlive_options['wp_pagenavi_style_enabled']==true){
      wp_enqueue_style( 'zAlive-wp-pagenavi-style', get_template_directory_uri() . '/css/zAlive_wp_pagenavi.css', array( 'zAlive-style' )  );
    }

    //scripts
    wp_enqueue_script( 'jquery', false, array(), false, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '2.3.2', true );
    if( $zAlive_options['show_gotop'] == true ){
      wp_enqueue_script( 'scrollUp', get_template_directory_uri() . '/js/jquery.scrollUp.min.js', array('jquery'), '1.1.0', true );
    }
    wp_enqueue_script( 'function', get_template_directory_uri() . '/js/function.js', array('jquery','bootstrap'), false, true ); 
    wp_localize_script( 'function', 'zAlive_i18n', array ('gotop' => __('Go Top', 'zAlive') ,'slider_pause_time' => $zAlive_options['slider_pause_time']) );
    wp_enqueue_script( 'twitter-bootstrap-hover-dropdown', get_template_directory_uri() . '/js/twitter-bootstrap-hover-dropdown.min.js', array('jquery','bootstrap'), false, true );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
      wp_enqueue_script( 'comment-reply' );
    }     
  }
  add_action( 'wp_enqueue_scripts', 'zAlive_scriptsAndStyles' );


  // Template for comments and pingbacks.
  function zAlive_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
      // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <p>
        <span class="ping-title"><?php _e( 'Pingback: ', 'zAlive' ); ?></span>
        <a class="ping-link" href="<?php echo esc_url( $comment->comment_author_url ) ; ?>"><?php comment_author(); ?> </a>
        <span class="delimiter">/</span>
        <?php
          printf( '<time class="ping-time" datetime="%1$s">%2$s</time>',
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( __( '%1$s at %2$s', 'zAlive' ), get_comment_date(), get_comment_time() )
          );
        ?>
        <?php edit_comment_link( __( '(Edit)', 'zAlive' ), '<span class="edit-link">', '</span>' ); ?>
        
      </p>
    <?php
        break;
      default :
      // Proceed with normal comments.
      global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <div id="comment-<?php comment_ID(); ?>" class="comment comment-parent clearfix">
        <div class="comment-meta comment-avatar pull-left">
          <?php echo get_avatar( $comment, 48 ); ?>
        </div>
        <div class="comment-body">
          <div class="comment-info comment-author vcard">
            <?php
              printf( '<cite class="fn">%1$s <span>/ %2$s</span></cite>',
                get_comment_author_link(),
                // If current post author is also comment author, make it known visually.
                ( $comment->user_id === $post->post_author ) ? __( 'Post Author', 'zAlive' ) : ''
              );
              printf( '<time datetime="%1$s">%2$s</time>',
                get_comment_time( 'c' ),
                /* translators: 1: date, 2: time */
                sprintf( __( '%1$s at %2$s', 'zAlive' ), get_comment_date(), get_comment_time() )
              );
            ?>
          </div><!-- .comment-meta -->

          <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation alert alert-info clearfix"><?php _e( 'Your comment is awaiting moderation.', 'zAlive' ); ?></p>
          <?php endif; ?>

          <div class="comment-content comment clearfix">
            <?php comment_text(); ?>
            
          </div><!-- .comment-content -->

          <div class="function-bar">
            <?php edit_comment_link( __( 'Edit', 'zAlive' ) ); ?>
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'zAlive' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div><!-- .reply -->
        </div>
      </div><!-- #comment-## -->
    <?php
      break;
      echo '</li>';
    endswitch; // end comment_type check
    wp_reset_postdata();
  }
  
  //get theme options
  function zAlive_getThemeOptions() {
    // Globalize the variable that holds the Theme options
    global $zAlive_options;
    // Parse array of option defaults against user-configured Theme options
    $zAlive_options = wp_parse_args( get_option( 'zAlive_theme_options', array() ), zAlive_getDefaultThemeOptions() );
    // Return parsed args array
    return $zAlive_options;
  }
  
  //get default theme options
  function zAlive_getDefaultThemeOptions() {
    $options = array(
      'hide_posts_and_primary_sidebar' => false ,              //Hide Posts List And Primary Sidebar In Homepage
      'show_tagline_directly' => false ,              //Show tagline directly
      'header_searchbox_enabled' => true ,              //Enable the header searchbox
      'breadcrumb_enabled' => true ,              //Breadcrumb navigation
      'primary_sidebar_layout' => 1 ,              //Primary sidebar layout:0 for hidden, 1 for right side(default), 2 left side  
      'redirect_comment_enabled' => true ,              //Open Comment Author Link In New Window
      'wp_pagenavi_style_enabled' => true ,             //enable zAlive WP-PageNavi Style
      'inline_css'				=> '',                  //custom css
      'inline_js_header'	=> '',              //custom js in header
      'inline_js_footer'	=> '',              //custom js in footer
      'show_post_url' => true ,             //Show Post URL In Post Page
      'show_gotop' => true ,              //Show Go Top When Scrolling
      'excerpt_enabled' => false ,              //Show excerpt in list page
      'excerpt_length' => 100 ,              //excerpt length
      'excerpt_text' => '[Read More...]' ,              //Text for "Read More"
      'ads_content' => '',                           //advertisement content
      'slider_enabled' => 2,              //enable zAlive slider (0:disabled,1:enabled in home,2:enalbed)
      'slider1_img' => get_template_directory_uri() . '/img/features_img_1.jpg',                         //zAlive slider1 image
      'slider1_title' => 'Slider1 Title',                     //zAlive slider1 title
      'slider1_content' => 'Slider1 Content',                 //zAlive slider1 content
      'slider1_link' => '',                       //zAlive slider1 link
      'slider2_img' => get_template_directory_uri() . '/img/features_img_2.jpg',                        //zAlive slider2 image
      'slider2_title' => 'Slider2 Title',                      //zAlive slider2 title
      'slider2_content' => 'Slider2 Content',                //zAlive slider2 content
      'slider2_link' => '',                       //zAlive slider2 link
      'slider3_img' => get_template_directory_uri() . '/img/features_img_3.jpg',                         //zAlive slider3 image
      'slider3_title' => 'Slider3 Title',                     //zAlive slider3 title
      'slider3_content' => 'Slider3 Content',                //zAlive slider3 content
      'slider3_link' => '',                       //zAlive slider3 link
      'slider4_img' => get_template_directory_uri() . '/img/features_img_4.jpg',                         //zAlive slider4 image
      'slider4_title' => 'Slider4 Title',                     //zAlive slider4 title
      'slider4_content' => 'Slider4 Content',                //zAlive slider4 content
      'slider4_link' => '',                       //zAlive slider4 link
      'footer_widget_enabled' => 0,     //enable footer widget(secondary sidebar) (0:disabled,1:enabled in home,2:enalbed)
      'copyright_content' => '',             //copyright content
      'slider_pause_time' => 3000         //how long each slide will show(in millisecond)
    ); //default value
    return $options ;
  }

  //update theme options
  function zAlive_updateThemeOptions($options) {
    update_option('zAlive_theme_options', $options);
  }

  require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'template/options.php';//function zAlive_options_func is in this page
  
  //init theme options
  add_action('admin_init', 'zAlive_initThemeOptions');
  function zAlive_initThemeOptions() {
    register_setting('zAlive_options', 'zAlive_theme_options', 'zAlive_validateThemeOptions');
  }
  
  //validate and sanitize values
  function zAlive_validateThemeOptions($input){
    global $zAlive_options;
    $defaults = zAlive_getDefaultThemeOptions();

    if (isset($input['reset'])){
      $input = $defaults;
    } else {
      // checkbox (value is 1 if checked )
      foreach (array(
        'hide_posts_and_primary_sidebar',
        'show_tagline_directly',
        'header_searchbox_enabled',
        'breadcrumb_enabled',
        'redirect_comment_enabled',
        'wp_pagenavi_style_enabled',
        'show_post_url',
        'show_gotop',
        'excerpt_enabled'
        ) as $checkbox) {
        if (!isset($input[$checkbox]))
          $input[$checkbox] = null;
          $input[$checkbox] = ( $input[$checkbox] == 1 ? true : false );
      }
      
      //text input 
      foreach ( array(
        'slider1_title',
        'slider2_title',
        'slider3_title',
        'slider4_title',
        'excerpt_text'
        ) as $text ) {
        $input[$text] = wp_kses_stripslashes($input[$text]);
      }
      
      //textarea (html is allowded)
      foreach ( array(
        'ads_content',
        'slider1_content',
        'slider2_content',
        'slider3_content',
        'slider4_content',
        'copyright_content',
        'inline_css',                  
        'inline_js_header',
        'inline_js_footer'
        ) as $content ) {
        $input[$content] = $input[$content] === $defaults[$content] ? $defaults[$content] : wp_kses_stripslashes($input[$content] ) ;
      }
      
      //url: image address ,default address will be used if left blank
      foreach ( array(
        'slider1_img',
        'slider2_img',
        'slider3_img',
        'slider4_img'
        ) as $url ) {
        $input[$url] = empty($input[$url]) ? $defaults[$url] : esc_url_raw($input[$url]);
      }
      
      //url: slider link and social link
      foreach ( array(
        'slider1_link',
        'slider2_link',
        'slider3_link',
        'slider4_link',
        ) as $url ) {
        $input[$url] = esc_url_raw($input[$url]);
      }
      
      //slider_enabled , footer_widget_enabled , primary_sidebar_layout values are 0,1,2 
      $input['slider_enabled'] = (int)$input['slider_enabled'];
      $input['footer_widget_enabled'] = (int)$input['footer_widget_enabled'];
      $input['primary_sidebar_layout'] = (int)$input['primary_sidebar_layout'];
      
      //should be positive integer
      $input['excerpt_length'] = is_numeric($input['excerpt_length']) ? absint($input['excerpt_length']) : $defaults['excerpt_length'];
      $input['slider_pause_time'] = is_numeric($input['slider_pause_time']) ? absint($input['slider_pause_time']) : $defaults['slider_pause_time'];
    }
    return $input;
  }
  
  
  //add theme options menu
  add_action('admin_menu', 'zAlive_addThemePage');
  function zAlive_addThemePage(){
    add_theme_page(__('zAlive Theme Settings','zAlive'), __('Theme Options','zAlive'), 'edit_theme_options', 'theme_options', 'zAlive_options_func');
  }
    
  function zAlive_adminScriptsAndStyles() {
    //styles
    wp_enqueue_style('thickbox');
    wp_enqueue_style( 'zAlive-theme-options', get_template_directory_uri() . '/css/theme-options.css' );
    //scripts
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script( 'zAlive-theme-options', get_template_directory_uri() . '/js/theme-options.js' );
    wp_localize_script( 'zAlive-theme-options', 'zAlive_theme_options_i18n', 
      array (
        'reset_warning' => __('All settings will be set to default.Do you want to restore anyway ?', 'zAlive') 
        ,'template_uri' => get_template_directory_uri() 
      ) 
    );
  }
  add_action('admin_print_styles-appearance_page_theme_options', 'zAlive_adminScriptsAndStyles');
  
  //Open Comment Author Link In New Window
  function zAlive_openCommentAuthorLinkInNewWindow() {
    global $comment;
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
      $return = $author;
    else
      $return = "<a href='$url' rel='external nofollow' target='_blank'>$author</a>";
    return $return;
  }
  if($zAlive_options['redirect_comment_enabled']==true){
    add_filter('get_comment_author_link', 'zAlive_openCommentAuthorLinkInNewWindow');
  }

?>
