jQuery(document).ready(function($) {
  $('a.top-menu').click(function() {
  $('a.top-menu').toggleClass('active');
  $('ul.menu').slideToggle(200);
  return false;
});

/**

jQuery(document).ready(function($) {
  $('a.top-menu').click(function() {
  $('a.top-menu').toggleClass('active');
  $('ul.menu').slideToggle('500', "easeOutCubic", function () {
        // Animation complete.
          return false;
    });
});

**/

  $(window).resize(function(){
  var w = $(window).width();
  var menu = $('ul.menu');
  
  if(w > 680 && menu.is(':hidden')) {
      menu.removeAttr('style');
    }
	
  }); 
  // FitText shit
  $("#homepage-text").fitText(0.73, { minFontSize: '28px', maxFontSize: '165px' })  

});