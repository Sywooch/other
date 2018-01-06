(function($) {

  function _initHintsShow() {
    var
      $hints = $('.js-tree-hint'),
      hintsLength = $hints.length;

    setInterval(function() {
      $hints
        .removeClass('active')
        .eq(Math.floor(Math.random() * hintsLength))
        .addClass('active');
    }, 3000);
  }

  _initHintsShow();
  
  $('.flexslider').flexslider({
    animation: "slide",
    prevText: '',
    nextText: ''
  });
  
})(jQuery);

$(function() {
  $("document").on("click", "div.ui-widget-overlay:visible", function() {
    $(".ui-dialog:visible").find(".ui-dialog-content").dialog("close");
  });
  
});
