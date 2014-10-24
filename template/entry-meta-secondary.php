<?php
/**
 secondary entry meta template (display after the_content)
 */
?>        
        <div class="entry-meta entry-meta-secondary clearfix">
          <div class="container-s container-category clearfix">
            <span class="info-category info-icon"><?php _e('Posted in','zAlive'); ?>&nbsp;:&nbsp;</span>
            <?php the_category(' , '); ?>
          </div>
          <div class="container-s container-tag clearfix">
            <span class="info-tag info-icon"><?php _e('Tags','zAlive'); ?>&nbsp;:&nbsp;</span>
            <?php the_tags('',' , '); ?>
          </div>
        </div>