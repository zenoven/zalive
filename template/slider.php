<?php
/**
 * slider template
 */
 global $zAlive_options;
?>

  <div id="zSlider" class="container carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
      <div class="active item">
        <?php if ( !empty( $zAlive_options['slider1_link'] ) ) { ?>
        <a href="<?php echo esc_url ( $zAlive_options['slider1_link'] ) ; ?>"><img src="<?php echo esc_url ( $zAlive_options['slider1_img'] ) ; ?>" alt="" /></a>
        <?php } else { ?>
        <img src="<?php echo esc_url ( $zAlive_options['slider1_img'] ) ; ?>" alt="" />
        <?php } ?>
      </div>
      <div class="item">
        <?php if ( !empty( $zAlive_options['slider2_link'] ) ) { ?>
        <a href="<?php echo esc_url ( $zAlive_options['slider2_link'] ) ; ?>"><img src="<?php echo esc_url ( $zAlive_options['slider2_img'] ) ; ?>" alt="" /></a>
        <?php } else { ?>
        <img src="<?php echo esc_url ( $zAlive_options['slider2_img'] ) ; ?>" alt="" />
        <?php } ?>
      </div>
      <div class="item">
        <?php if ( !empty( $zAlive_options['slider3_link'] ) ) { ?>
        <a href="<?php echo esc_url ( $zAlive_options['slider3_link'] ); ?>"><img src="<?php echo esc_url ( $zAlive_options['slider3_img'] ) ; ?>" alt="" /></a>
        <?php } else { ?>
        <img src="<?php echo esc_url ( $zAlive_options['slider3_img'] ) ; ?>" alt="" />
        <?php } ?>
      </div>
      <div class="item">
        <?php if ( !empty( $zAlive_options['slider4_link'] ) ) { ?>
        <a href="<?php echo esc_url ( $zAlive_options['slider4_link'] ) ; ?>"><img src="<?php echo esc_url ( $zAlive_options['slider4_img'] ); ?>" alt="" /></a>
        <?php } else { ?>
        <img src="<?php echo esc_url ( $zAlive_options['slider4_img'] ) ; ?>" alt="" />
        <?php } ?>
      </div>
    </div>
    <ul class="description hidden-phone">
      <li class="active">
        <strong><?php echo esc_attr ( $zAlive_options['slider1_title'] ) ; ?></strong>
        <p><?php echo $zAlive_options['slider1_content']; ?></p>
      </li>
      <li>
        <strong><?php echo esc_attr ( $zAlive_options['slider2_title'] ) ; ?></strong>
        <p><?php echo $zAlive_options['slider2_content']; ?></p>
      </li>
      <li>
        <strong><?php echo esc_attr ( $zAlive_options['slider3_title'] ) ; ?></strong>
        <p><?php echo $zAlive_options['slider3_content']; ?></p>
      </li>
      <li>
        <strong><?php echo esc_attr ( $zAlive_options['slider4_title'] ) ; ?></strong>
        <p><?php echo $zAlive_options['slider4_content']; ?></p>
      </li>
    </ul>
  </div>