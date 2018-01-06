(function($) {

  function _showPromoPopup() {
    $('.js-dialog-popup')
      .html($('#promo_popup').html())
      .dialog({
        modal: true,
        resizable: false,
        draggable: false,
        width: 600,
        show: 200,
        hide: 200,
        dialogClass: 'promo-popup',
        open: function() {
          $.cookie('isPromoPopupClosed', 1, {expires: 1, path: '/'});
        },
        close: function() {
          $('.js-dialog-popup').html('');
        }
      });
  }

  function _initTimeout() {
    setTimeout(_showPromoPopup, 10000);
  }

  if (!$.cookie('isPromoPopupClosed')) {
    _initTimeout();
  }
  
  /*_initTimeout();*/

})(jQuery);
