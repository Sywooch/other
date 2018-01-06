(function($) {
  var _articleSlidersOptions = {
    $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
    $AutoPlaySteps: 3,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
    $AutoPlayInterval: 6000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
    $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

    $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
    $SlideDuration: 160,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
    $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
    $SlideWidth: 230,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
    $SlideHeight: 175,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
    $SlideSpacing: 16, 					                //[Optional] Space between each slide in pixels, default value is 0
    $DisplayPieces: 3,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
    $ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
    $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
    $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
    $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)



    $ArrowNavigatorOptions: {
      $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
      $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
      $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
      $Steps: 3                                       //[Optional] Steps to go for each navigation request, default value is 1
    }
  };

  function _initArticleSliders() {
    $('.js-article-slider').each(function() {
      var article_slider = new $JssorSlider$($(this).attr('id'), _articleSlidersOptions);
    });
  }
  
  _initArticleSliders();
  
  $('.flexslider').flexslider({
    animation: "slide",
    prevText: '',
    nextText: ''
  });
  
  /*function _initYandexMap() {
    mapInit = ymaps.ready(function() {
      var
        map,
        placemark;

      map = new ymaps.Map ('ymap', {
        center: [55.81451106, 37.35316291],
        zoom: 16
      });

      placemark = new ymaps.Placemark ([55.81416068, 37.35174670], {}, {});
      map.geoObjects.add(placemark);
      map.controls.remove('default');
    });
  }
  
  
  if ($('#ymap').length) {
    _initYandexMap();
  }*/
})(jQuery);