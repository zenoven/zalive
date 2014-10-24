(function($){
  $(function(){
    //object zAlive_i18n (contains all text string for translation) is defined in wp_localize_script(in functions.php )

    //top nav bar menu
    $('.navbar .nav').show(0);
    $('#header .nav>li:has(ul)').each(function(){
      $(this).addClass('dropdown').children('a').addClass('dropdown-toggle').attr('data-toggle','dropdown').attr('data-hover','dropdown').attr('data-delay','100').attr('data-close-others','false').append(' <b class="caret"></b>');
      $(this).children('ul').addClass('dropdown-menu');
    });
    
    //show site tagline(description) if it's hidden by option 
    if( $('.tagline-hidden').length != 0 ){
      $('#header .brand').hover(function(){
        $('.tagline-hidden').animate({'top':'+=35'});
      },function(){
        $('.tagline-hidden').animate({'top':'-=35'});
      });
    }
    
    
    //slider
    if($('#zSlider').length != 0){
      $('#zSlider').carousel({interval: parseInt(zAlive_i18n.slider_pause_time) }).bind('slid',function(){
        $('#zSlider .description li.active').removeClass('active');
        $('#zSlider .description li:eq(' + $('#zSlider .carousel-inner .active').index('#zSlider .carousel-inner .item') + ')').addClass('active');
      });
      $('#zSlider .description li').click(function(){
        $('#zSlider').carousel($(this).index('#zSlider .description li'));
      });
      $('#zSlider .description li').hover(
        function(){$(this).addClass('over')},
        function(){$(this).removeClass('over')}
      );
    }
    
    //set custom hot commented articles and random articles widget visible only on desktop 
    $('#sidebar .widget_zalive_widget_mostcommentedandrandomarticles').addClass('visible-desktop');
    
    //set custom recent comments widget visible only on desktop 
    $('.widget_zalive_widget_recentcomments img').addClass('visible-desktop');
    
    //gotop
    if($.isFunction($.scrollUp)){
      $.scrollUp({
        scrollName: 'goTop', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: zAlive_i18n.gotop, // Text for element
        activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
      });
    }
    
    
    //if zAlive recent comments widget is enabled,set its width automaticlly
    if($('.widget_zalive_widget_recentcomments').length != 0){
      function setSidebarCommentWidth(){
        var e = $('.widget_zalive_widget_recentcomments');
        e.find('.comment-data').css('width', e.find('img.avatar').css('display')=='none' ? '100%' : e.find('li').width() - e.find('img.avatar').width() - 8);
      }
      setSidebarCommentWidth();
      $(window).bind('resize load',function(){
        setSidebarCommentWidth();
      });
    }
    
    //beautify the form and submit button on respond form
    $('#respond .form-submit').addClass('row-fluid').prepend('<div class="span2 divider"></div>');
    $('#respond  #submit').addClass('btn pull-left');
    
    //submit comment by using Ctrl+Enter shortcut
    $('#commentform').keypress(function(e){
      if(e.ctrlKey && e.which == 13 || e.which == 10) {
        $('#submit').click();
      }
    });
    
  });
})(jQuery);