(function($) {
    
  if ( ( $('.zoomer').length ) || ( $('.singlezoom').length ) ) {
    
    $('.items.zoom, .singlezoom').magnificPopup({
      delegate: 'a',
      type: 'image',
      closeOnContentClick: true,
      closeBtnInside: true,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
        verticalFit: true,
        horizontalFit: true,

        tError: '<a href="%url%">Картинка #%curr%</a> не загружена.',
        titleSrc: function(item) {
          var titleattr = item.el.attr('title');
          if (typeof titleattr !== typeof undefined && titleattr !== false) {
            return item.el.attr('title') + '<small>' + item.el.attr('data-loc') + '</small>';
          } else return '';
          
        }
        
      },
      gallery: {
        enabled: false
      },
      zoom: {
        enabled: true,
        duration: 300, // don't forget to change the duration also in CSS
        opener: function(element) {
          return element.find('img');
        }
      }
      
    });
      
  }

})(jQuery);