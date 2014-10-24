<?php
/**
 primary entry meta template with ads option and is for singular(single/attachment/page etc.) (displays before the_content)
 */
 global $zAlive_options;
?>        
        <?php get_template_part( 'template/entry-meta-primary' ); ?>
        <?php if($zAlive_options['ads_content'] !='') : ?>
        <div class="clearfix ads-code visible-desktop">
        <?php echo $zAlive_options['ads_content']; ?>
        </div>
        <?php endif;?>