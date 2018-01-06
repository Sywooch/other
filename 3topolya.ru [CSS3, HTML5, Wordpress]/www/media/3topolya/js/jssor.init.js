jQuery(document).ready(function($) {
  var
    _SlideshowTransitions,
    options,
    reviewsSlider;

  _SlideshowTransitions = [{
    $Duration: 1400,
    x: 0.25,
    $Zoom: 1.5,
    $Easing: {
      $Left: $JssorEasing$.$EaseInWave,
      $Zoom: $JssorEasing$.$EaseInSine
    },
    $Opacity: 2,
    $ZIndex: -10,
    $Brother: {
      $Duration: 1400,
      x: -0.25,
      $Zoom: 1.5,
      $Easing: {
        $Left: $JssorEasing$.$EaseInWave,
        $Zoom: $JssorEasing$.$EaseInSine
      },
      $Opacity: 2,
      $ZIndex: -10
    }
  }];

  options = {
    $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
    $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
    $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
    $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

    $ArrowKeyNavigation: true,   			                  //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
    $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
    $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
    //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
    //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
    $SlideSpacing: 0, 					                        //[Optional] Space between each slide in pixels, default value is 0
    $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
    $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
    $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
    $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
    $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

    $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
      $Class: $JssorSlideshowRunner$,                   //[Required] Class to create instance of slideshow
      $Transitions: _SlideshowTransitions,              //[Required] An array of slideshow transitions to play slideshow
      $TransitionsOrder: 1,                             //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
      $ShowLink: true                                   //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
    },

    $ArrowNavigatorOptions: {
      $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
      $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
      $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
    }
  };

  reviewsSlider = new $JssorSlider$('articles_slider', options);

});