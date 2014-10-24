<?php
function zAlive_options_func(){
  if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
?>
<div class="wrap">
    <div id="icon-options-general" class="icon32"><br /></div>
    <h2><?php _e('zAlive Theme Settings','zAlive'); ?></h2>
    <?php if (false !== $_REQUEST['settings-updated']) : ?>
    <div class="updated"> <p><strong><?php _e('All settings saved.','zAlive') ?></strong></p></div>
    <?php endif; ?>
    <form name="myform" method="post" action="options.php">
      <?php 
        settings_fields('zAlive_options');
        global $zAlive_options; 
      ?>
      <br />
      <h3><?php _e('General','zAlive') ?></h3>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[redirect_comment_enabled]"><?php _e('Open Comment Author Link In New Window','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[redirect_comment_enabled]"><input name="zAlive_theme_options[redirect_comment_enabled]" type="checkbox" id="zAlive_theme_options[redirect_comment_enabled]" value="1" <?php checked( $zAlive_options['redirect_comment_enabled'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[wp_pagenavi_style_enabled]"><?php _e('Enable zAlive WP-PageNavi Style','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[wp_pagenavi_style_enabled]"><input name="zAlive_theme_options[wp_pagenavi_style_enabled]" type="checkbox" id="zAlive_theme_options[wp_pagenavi_style_enabled]" value="1" <?php checked( $zAlive_options['wp_pagenavi_style_enabled'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[excerpt_enabled]"><?php _e('Automatic Excerpt In List Page','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[excerpt_enabled]"><input name="zAlive_theme_options[excerpt_enabled]" type="checkbox" id="zAlive_theme_options[excerpt_enabled]" value="1" <?php checked( $zAlive_options['excerpt_enabled'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[excerpt_length]"><?php  _e('Automatic Excerpt Length(in word)','zAlive');?></label></th>
          <td><input type="text" class="regular-text" name="zAlive_theme_options[excerpt_length]" id="zAlive_theme_options[excerpt_length]" value="<?php echo  esc_attr($zAlive_options['excerpt_length']); ?>" /> </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[excerpt_text]"><?php  _e('Text for "Read More"','zAlive');?></label></th>
          <td><input type="text" class="regular-text" name="zAlive_theme_options[excerpt_text]" id="zAlive_theme_options[excerpt_text]" value="<?php echo  esc_attr($zAlive_options['excerpt_text']); ?>" /> </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[ads_content]"><?php _e('Advertisement Code(in content page)','zAlive') ?></label></th>
          <td><textarea rows="5" cols="45" name="zAlive_theme_options[ads_content]" class="zregular-text" id="zAlive_theme_options[ads_content]" ><?php echo esc_html($zAlive_options['ads_content']); ?></textarea></td>
        </tr>
      </table>
      <br />
      <h3><?php _e('Layout','zAlive') ?></h3>
      <table class="form-table bottom_widget grouped">
      <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[hide_posts_and_primary_sidebar]"><?php _e('Hide Posts List And Primary Sidebar In Homepage','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[hide_posts_and_primary_sidebar]"><input name="zAlive_theme_options[hide_posts_and_primary_sidebar]" type="checkbox" id="zAlive_theme_options[hide_posts_and_primary_sidebar]" value="1" <?php checked( $zAlive_options['hide_posts_and_primary_sidebar'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Primary Sidebar Layout','zAlive') ?></th>
          <td>
            <select name="zAlive_theme_options[primary_sidebar_layout]" id="zAlive_theme_options[primary_sidebar_layout]" cval="<?php echo $zAlive_options['primary_sidebar_layout']; ?>">
              <option value="1" <?php selected($zAlive_options['primary_sidebar_layout'],1); ?> ><?php _e('Shown On The Right','zAlive') ?></option>
              <option value="2" <?php selected($zAlive_options['primary_sidebar_layout'],2); ?> ><?php _e('Shown On The Left','zAlive') ?></option>
              <option value="0" <?php selected($zAlive_options['primary_sidebar_layout'],0); ?> ><?php _e('Hidden','zAlive') ?></option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[show_tagline_directly]"><?php _e('Show Tagline Directly','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[show_tagline_directly]"><input name="zAlive_theme_options[show_tagline_directly]" type="checkbox" id="zAlive_theme_options[show_tagline_directly]" value="1" <?php checked( $zAlive_options['show_tagline_directly'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[header_searchbox_enabled]"><?php _e('Header Searchbox','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[header_searchbox_enabled]"><input name="zAlive_theme_options[header_searchbox_enabled]" type="checkbox" id="zAlive_theme_options[header_searchbox_enabled]" value="1" <?php checked( $zAlive_options['header_searchbox_enabled'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[breadcrumb_enabled]"><?php _e('Breadcrumb(Path) Navigation','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[breadcrumb_enabled]"><input name="zAlive_theme_options[breadcrumb_enabled]" type="checkbox" id="zAlive_theme_options[breadcrumb_enabled]" value="1" <?php checked( $zAlive_options['breadcrumb_enabled'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[show_gotop]"><?php _e('Show "GoTop" When Scrolling','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[show_gotop]"><input name="zAlive_theme_options[show_gotop]" type="checkbox" id="zAlive_theme_options[show_gotop]" value="1" <?php checked( $zAlive_options['show_gotop'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[show_post_url]"><?php _e('Show Post URL In Post Page','zAlive') ?></label></th>
          <td><label for="zAlive_theme_options[show_post_url]"><input name="zAlive_theme_options[show_post_url]" type="checkbox" id="zAlive_theme_options[show_post_url]" value="1" <?php checked( $zAlive_options['show_post_url'], true ); ?>> <?php _e('Enable','zAlive') ?></label></td>
        </tr>
      </table>
      <br />
      <h3><?php _e('Slider','zAlive') ?></h3>
      <table class="form-table bottom_widget grouped">
        <tr valign="top">
          <th scope="row"><?php _e('Enable Or Not','zAlive') ?></th>
          <td>
            <select name="zAlive_theme_options[slider_enabled]" id="zAlive_theme_options[slider_enabled]" class="controlor" cval="<?php echo $zAlive_options['slider_enabled']; ?>">
              <option value="1" <?php selected($zAlive_options['slider_enabled'],1); ?> ><?php _e('Enable','zAlive') ?></option>
              <option value="2" <?php selected($zAlive_options['slider_enabled'],2); ?> ><?php _e('Enable In Home Page','zAlive') ?></option>
              <option value="0" <?php selected($zAlive_options['slider_enabled'],0); ?> ><?php _e('Disable','zAlive') ?></option>
            </select>
          </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider_pause_time]"><?php _e('Pause Time(in millisecond)','zAlive');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider_pause_time]" id="zAlive_theme_options[slider_pause_time]" value="<?php echo esc_attr($zAlive_options['slider_pause_time']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider1_img]"><?php printf(__('Slider%s Image','zAlive'),'1');?></label></th>
          <td>
            <?php if(!empty($zAlive_options['slider1_img'])) {
              echo '<img class="img_preview" src="' . $zAlive_options['slider1_img'] .'" alt="" /><br />' ;
            } else { ?>
              <img class="img_preview img_preview_none" src="<?php echo get_template_directory_uri(); ?>/img/img-preview-default.jpg" /><br />
            <?php } ?>
            <input type="text" class="regular-text zregular-text img_url" name="zAlive_theme_options[slider1_img]" id="zAlive_theme_options[slider1_img]" value="<?php echo esc_url($zAlive_options['slider1_img']); ?>" /> 
            <input type="button" class="img_upload_button" value="<?php _e('Select Image','zAlive');?>" /><span class="description"> / <?php _e('or enter the image URL here','zAlive');?></span>
          </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider1_title]"><?php printf(__('Slider%s Title','zAlive'),'1');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider1_title]" id="zAlive_theme_options[slider1_title]" value="<?php echo esc_attr($zAlive_options['slider1_title']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider1_content]"><?php printf(__('Slider%s Content','zAlive'),'1');?></label></th>
          <td><textarea rows="5" cols="45" name="zAlive_theme_options[slider1_content]" class="zregular-text" id="zAlive_theme_options[slider1_content]" ><?php echo esc_html($zAlive_options['slider1_content']); ?></textarea></td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider1_link]"><?php printf(__('Slider%s Link URL','zAlive'),'1');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider1_link]" id="zAlive_theme_options[slider1_link]" value="<?php echo esc_url($zAlive_options['slider1_link']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider2_img]"><?php printf(__('Slider%s Image','zAlive'),'2');?></label></th>
          <td>
            <?php if(!empty($zAlive_options['slider2_img'])) {
              echo '<img class="img_preview" src="' . $zAlive_options['slider2_img'] .'" alt="" /><br />' ;
            } else { ?>
              <img class="img_preview img_preview_none" src="<?php echo get_template_directory_uri(); ?>/img/img-preview-default.jpg" /><br />
            <?php } ?>
            <input type="text" class="regular-text zregular-text img_url" name="zAlive_theme_options[slider2_img]" id="zAlive_theme_options[slider2_img]" value="<?php echo esc_url($zAlive_options['slider2_img']); ?>" /> 
            <input type="button" class="img_upload_button" value="<?php _e('Select Image','zAlive');?>" /><span class="description"> / <?php _e('or enter the image URL here','zAlive');?></span>
          </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider2_title]"><?php printf(__('Slider%s Title','zAlive'),'2');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider2_title]" id="zAlive_theme_options[slider2_title]" value="<?php echo esc_attr($zAlive_options['slider2_title']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider2_content]"><?php printf(__('Slider%s Content','zAlive'),'2');?></label></th>
          <td><textarea rows="5" cols="45" name="zAlive_theme_options[slider2_content]" class="zregular-text" id="zAlive_theme_options[slider2_content]" ><?php echo esc_html($zAlive_options['slider2_content']); ?></textarea></td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider2_link]"><?php printf(__('Slider%s Link URL','zAlive'),'2');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider2_link]" id="zAlive_theme_options[slider2_link]" value="<?php echo esc_url($zAlive_options['slider2_link']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider3_img]"><?php printf(__('Slider%s Image','zAlive'),'3');?></label></th>
          <td>
            <?php if(!empty($zAlive_options['slider3_img'])) {
              echo '<img class="img_preview" src="' . $zAlive_options['slider3_img'] .'" alt="" /><br />' ;
            } else { ?>
              <img class="img_preview img_preview_none" src="<?php echo get_template_directory_uri(); ?>/img/img-preview-default.jpg" /><br />
            <?php } ?>
            <input type="text" class="regular-text zregular-text img_url" name="zAlive_theme_options[slider3_img]" id="zAlive_theme_options[slider3_img]" value="<?php echo esc_url($zAlive_options['slider3_img']); ?>" /> 
            <input type="button" class="img_upload_button" value="<?php _e('Select Image','zAlive');?>" /><span class="description"> / <?php _e('or enter the image URL here','zAlive');?></span>
          </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider3_title]"><?php printf(__('Slider%s Title','zAlive'),'3');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider3_title]" id="zAlive_theme_options[slider3_title]" value="<?php echo esc_attr($zAlive_options['slider3_title']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider3_content]"><?php printf(__('Slider%s Content','zAlive'),'3');?></label></th>
          <td><textarea rows="5" cols="45" name="zAlive_theme_options[slider3_content]" class="zregular-text" id="zAlive_theme_options[slider3_content]" ><?php echo esc_html($zAlive_options['slider3_content']); ?></textarea></td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider3_link]"><?php printf(__('Slider%s Link URL','zAlive'),'3');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider3_link]" id="zAlive_theme_options[slider3_link]" value="<?php echo esc_url($zAlive_options['slider3_link']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider4_img]"><?php printf(__('Slider%s Image','zAlive'),'4');?></label></th>
          <td>
            <?php if(!empty($zAlive_options['slider4_img'])) {
              echo '<img class="img_preview" src="' . $zAlive_options['slider4_img'] .'" alt="" /><br />' ;
            } else { ?>
              <img class="img_preview img_preview_none" src="<?php echo get_template_directory_uri(); ?>/img/img-preview-default.jpg" /><br />
            <?php } ?>
            <input type="text" class="regular-text zregular-text img_url" name="zAlive_theme_options[slider4_img]" id="zAlive_theme_options[slider4_img]" value="<?php echo esc_url($zAlive_options['slider4_img']); ?>" /> 
            <input type="button" class="img_upload_button" value="<?php _e('Select Image','zAlive');?>" /><span class="description"> / <?php _e('or enter the image URL here','zAlive');?></span>
          </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider4_title]"><?php printf(__('Slider%s Title','zAlive'),'4');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider4_title]" id="zAlive_theme_options[slider4_title]" value="<?php echo esc_attr($zAlive_options['slider4_title']); ?>" /> </td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider4_content]"><?php printf(__('Slider%s Content','zAlive'),'4');?></label></th>
          <td><textarea rows="5" cols="45" name="zAlive_theme_options[slider4_content]" class="zregular-text" id="zAlive_theme_options[slider4_content]" ><?php echo esc_html($zAlive_options['slider4_content']); ?></textarea></td>
        </tr>
        <tr valign="top" class="controled">
          <th scope="row"><label for="zAlive_theme_options[slider4_link]"><?php printf(__('Slider%s Link URL','zAlive'),'4');?></label></th>
          <td><input type="text" class="regular-text zregular-text" name="zAlive_theme_options[slider4_link]" id="zAlive_theme_options[slider4_link]" value="<?php echo esc_url($zAlive_options['slider4_link']); ?>" /> </td>
        </tr>
      </table>
      <br />
      <h3><?php _e('Secondary Sidebar','zAlive') ?></h3>
      <table class="form-table bottom_widget grouped">
        <tr valign="top">
          <th scope="row"><?php _e('Enable Or Not','zAlive') ?></th>
          <td>
            <select name="zAlive_theme_options[footer_widget_enabled]" id="zAlive_theme_options[footer_widget_enabled]" class="controlor" cval="<?php echo $zAlive_options['footer_widget_enabled']; ?>">
              <option value="1" <?php selected($zAlive_options['footer_widget_enabled'],1); ?> ><?php _e('Enable','zAlive') ?></option>
              <option value="2" <?php selected($zAlive_options['footer_widget_enabled'],2); ?> ><?php _e('Enable In Home Page','zAlive') ?></option>
              <option value="0" <?php selected($zAlive_options['footer_widget_enabled'],0); ?> ><?php _e('Disable','zAlive') ?></option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Secondary Sidebar','zAlive'); ?></th>
          <td><p class="description"><?php  _e('Set in : <code>&nbsp;WordPress Admin > Appearance > Widgets&nbsp;</code>','zAlive');?></p></td>
        </tr>
      </table>
      <br />
      <h3><?php _e('Footer','zAlive'); ?></h3>
      <table class="form-table bottom_widget">
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[copyright_content]"><?php _e('Copyright Text','zAlive'); ?></label></th>
          <td><textarea rows="6" cols="45" name="zAlive_theme_options[copyright_content]" id="zAlive_theme_options[copyright_content]" ><?php echo esc_html($zAlive_options['copyright_content']); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Custom Links','zAlive'); ?></th>
          <td><p class="description"><?php  _e('Set in : <code>&nbsp;WordPress Admin > Appearance > Menus&nbsp;</code>','zAlive');?></p></td>
        </tr>
      </table>
      <br />
      <h3><?php _e('Custom CSS Styles And Scripts','zAlive'); ?></h3>
      <table class="form-table bottom_widget">
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[inline_css]"><?php _e('Custom CSS Style','zAlive'); ?></label></th>
          <td><textarea rows="10" cols="80" name="zAlive_theme_options[inline_css]" id="zAlive_theme_options[inline_css]" ><?php echo esc_html($zAlive_options['inline_css']); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[inline_js_header]"><?php _e('Header Custom Scripts','zAlive'); ?></label></th>
          <td><textarea rows="10" cols="80" name="zAlive_theme_options[inline_js_header]" id="zAlive_theme_options[inline_js_header]" ><?php echo esc_html($zAlive_options['inline_js_header']); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="zAlive_theme_options[inline_js_footer]"><?php _e('Footer Custom Scripts','zAlive'); ?></label></th>
          <td><textarea rows="10" cols="80" name="zAlive_theme_options[inline_js_footer]" id="zAlive_theme_options[inline_js_footer]" ><?php echo esc_html($zAlive_options['inline_js_footer']); ?></textarea></td>
        </tr>
      </table>
      <p class="submit">
        <?php submit_button( __( 'Save Changes', 'zAlive' ), 'primary', 'zAlive_theme_options[submit]', false ,array( 'id' => 'submitThemeOptions' )); ?>
        <?php submit_button( __( 'Restore Defaults', 'zAlive' ), 'secondary', 'zAlive_theme_options[reset]', false ,array( 'id' => 'resetThemeOptions' ) ); ?>
      </p>
    </form>
</div>
<?php }?>