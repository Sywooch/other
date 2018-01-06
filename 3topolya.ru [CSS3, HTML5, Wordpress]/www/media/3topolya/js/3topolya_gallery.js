(function($) {
  var
    _gallerySliderOptions = {
      $FillMode: 1,
      $AutoPlay: false,
      $PauseOnHover: 1,
      $ArrowKeyNavigation: true,
      $SlideDuration: 160,
      $MinDragOffsetToSlide: 20,
      $SlideWidth: 860,
      $SlideHeight: 570,
      $SlideSpacing: 0,
      $DisplayPieces: 1,
      $ParkingPosition: 0,
      $UISearchMode: 1,
      $PlayOrientation: 1,
      $DragOrientation: 1,
      $ThumbnailNavigatorOptions: {
        $Class: $JssorThumbnailNavigator$,
        $ChanceToShow: 2,
        $DisplayPieces: 4,
        $ActionMode: 1,
        $SpacingX: 0
      },
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$,
        $ChanceToShow: 2,
        $Steps: 1
      }
    },
    _galleryTemplateSource = '' +
      '<div id="gallery_slider" class="gallery-slider">' +
      '  <div u="slides" class="gallery-slides">' +
      '    {{#each images}}' +
      '    <div>' +
      '      <img u="image" src="{{imageOriginal}}" />' +
      '      <img u="thumb" src="{{imageThumb}}" />' +
      '    </div>' +
      '    {{/each}}' +
      '  </div>' +
      '<span u="arrowleft" class="jssora03l"></span>' +
      '<span u="arrowright" class="jssora03r"></span>' +
      '  <div u="thumbnavigator" class="gallery-slides-navigator">' +
      '    <div u="slides" style="cursor: default;">' +
      '      <div u="prototype" class="p">' +
      '        <div u="thumbnailtemplate" class="i"></div>' +
      '        <div class="o"></div>' +
      '      </div>' +
      '    </div>' +
      '  </div>' +
      '</div>',
    _galleryTemplate = Handlebars.compile(_galleryTemplateSource),
    _galleryTemplateData = {
      images: []
    },
    _galleryFilledTemplate;

  function _initGallerySlider() {
    var slider = new $JssorSlider$('gallery_slider', _gallerySliderOptions);
  }

  function _formConfigForGallery() {
    var
      $this = $(this),
      i = 0;

    _galleryTemplateData.images.length = 0;

    for(i; i < $this.data('gallery-count'); i++) {
      _galleryTemplateData.images.push({
        imageOriginal: $this.data('gallery-path') + $this.data('gallery-id') + '_' + (i + 1) + '.jpg',
        imageThumb: $this.data('gallery-path') + $this.data('gallery-id') + '_' + (i + 1) + '_thumb.jpg'
      });
    }

    _showPopup();
  }

  function _showPopup() {
    _galleryFilledTemplate = _galleryTemplate(_galleryTemplateData);

    $('.js-dialog-popup').html(_galleryFilledTemplate).dialog({
      modal: true,
      resizable: false,
      draggable: false,
      width: 860,
      show: 200,
      hide: 200,
      dialogClass: 'gallery-popup',
      open: _initGallerySlider,
      close: function() {
        $('.js-dialog-popup').html('');
      }
    });
  }

  $(document)
    .on('click', '.js-gallery-item', _formConfigForGallery)
    .on('click', '.gallery-popup + .ui-widget-overlay', function() {
      $('.js-dialog-popup').dialog('close');
    })
})(jQuery);


