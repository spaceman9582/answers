jQuery.noConflict();
(function($) {

  $.fn.menumaker = function(options) {

      var lshmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function(i) {
		if($(this).find("#menu-button").length ==0){
			lshmenu.prepend('<div id="menu-button">' + settings.title + '</div>');


        $(this).find("#menu-button").on('click', function(){

          $(this).toggleClass('menu-opened animated bounceInRight');
          var mainmenu = $(this).parent().find('ul');
          mainmenu.toggle();
        });
}
        lshmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          lshmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          lshmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else lshmenu.addClass('dropdown');

        if (settings.sticky === true) lshmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 800) {
            lshmenu.find('ul').show();
          }

          if ($(window).width() <= 800) {
            lshmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$("#topmenu").menumaker({
   title: "Menu",
   format: "multitoggle"
});

$("#main-menu").menumaker({
   title: "Menu",
   format: "multitoggle"
});

});
})( jQuery );