<?php
/**
 * content template: brief
 */
  global $zAlive_options;
?>

	
  <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
  <?php get_template_part( 'template/entry-meta-primary' ); ?>
  <div class="entry-content clearfix">
    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
      <div class="entry-thumbnail"><?php the_post_thumbnail('zAlive-thumbnail'); ?></div>
    <?php } ?>
    
    <?php if ( $zAlive_options['excerpt_enabled'] || has_excerpt() ) { 
        the_excerpt();
    } else { 
        the_content(esc_attr($zAlive_options['excerpt_text']),false); 
    } ?>
  </div>
