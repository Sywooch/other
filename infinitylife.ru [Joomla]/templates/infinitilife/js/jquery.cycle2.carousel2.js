/*! carousel transition plugin for Cycle2;  version: 20130528 */
(function($) {
    "use strict";

    $( document ).on('cycle-bootstrap', function( e, opts, API ) {
        if ( opts.fx !== 'carousel2' )
            return;

        API.getSlideIndex = function( el ) {
            var slides = this.opts()._carouselWrap.children();
            var i = slides.index( el );
            return i % slides.length;
        };

        // override default 'next' function
        API.next = function() {
            var count = opts.reverse ? -1 : 1;


            if ( opts.allowWrap === false && ( opts.currSlide + count ) >= opts.slideCount)
                return;
            opts.API.advanceSlide( count );
            opts.API.trigger('cycle-next', [ opts ]).log('cycle-next');
        };

    });


    $.fn.cycle.transitions.carousel2 = {
        // transition API impl
        preInit: function( opts ) {
            opts.hideNonActive = false;

            opts.container.on('cycle-destroyed', $.proxy(this.onDestroy, opts.API));
            // override default API implementation
            opts.API.stopTransition = this.stopTransition;

            // issue #10
            for (var i=0; i < opts.startingSlide; i++) {
                opts.container.append( opts.slides[0] );
            }
        },

        // transition API impl
        postInit: function( opts ) {
            var i, j, slide, pagerCutoffIndex, wrap;
            var vert = opts.carouselVertical;
            if (opts.carouselVisible && opts.carouselVisible > opts.slideCount)
                opts.carouselVisible = opts.slideCount - 1;
            var visCount = opts.carouselVisible || opts.slides.length;
            var slideCSS = { display: vert ? 'block' : 'inline-block', position: 'static' };

            // required styles
            opts.container.css({ position: 'relative', overflow: 'hidden' });
            opts.slides.css( slideCSS );

            opts._currSlide = opts.currSlide;

            // wrap slides in a div; this div is what is animated
            wrap = $('<div class="cycle-carousel-wrap"></div>')
                .prependTo( opts.container )
                .css({ margin: 0, padding: 0, top: 0, left: 0, position: 'absolute' })
                .append( opts.slides );

            opts._carouselWrap = wrap;

            if ( !vert )
                wrap.css('white-space', 'nowrap');

            if ( opts.allowWrap !== false ) {
                // prepend and append extra slides so we don't see any empty space when we
                // near the end of the carousel.  for fluid containers, add even more clones
                // so there is plenty to fill the screen
                // @todo: optimzie this based on slide sizes

                for ( j=0; j < (opts.carouselVisible === undefined ? 2 : 1); j++ ) {
                    for ( i=0; i < opts.slideCount; i++ ) {
                        wrap.append( opts.slides[i].cloneNode(true) );
                    }
                    i = opts.slideCount;
                    while ( i-- ) { // #160, #209
                        wrap.prepend( opts.slides[i].cloneNode(true) );
                    }
                }

                wrap.find('.cycle-slide-active').removeClass('cycle-slide-active');
                opts.slides.eq(opts.startingSlide).addClass('cycle-slide-active');
            }

            if ( opts.pager && opts.allowWrap === false ) {
                // hide "extra" pagers
                pagerCutoffIndex = opts.slideCount - visCount;
                $( opts.pager ).children().filter( ':gt('+pagerCutoffIndex+')' ).hide();
            }

            opts._nextBoundry = opts.slideCount - 1;

            this.prepareDimensions( opts );
        },

        prepareDimensions: function( opts ) {
            var dim, offset, pagerCutoffIndex, tmp, j;
            var vert = opts.carouselVertical;
            var visCount = opts.carouselVisible || opts.slides.length;

            if ( opts.carouselFluid && opts.carouselVisible ) {
                if ( ! opts._carouselResizeThrottle ) {
                    // fluid container AND fluid slides; slides need to be resized to fit container
                    this.fluidSlides( opts );
                }
            }
            else if ( opts.carouselVisible && opts.carouselSlideDimension ) {
                dim = visCount * opts.carouselSlideDimension;
                opts.container[ vert ? 'height' : 'width' ]( dim );
            }
            else if ( opts.carouselVisible ) {
                dim = visCount * $(opts.slides[0])[vert ? 'outerHeight' : 'outerWidth'](true);
                opts.container[ vert ? 'height' : 'width' ]( dim );
            }
            // else {
            //     // fluid; don't size the container
            // }

            opts.carouselOffset = ((opts.container.width() - this.getDim( opts, 0, vert )) / 2);

            offset = ( opts.carouselOffset || 0 );
            if ( opts.allowWrap !== false ) {
                if ( opts.carouselSlideDimension ) {
                    offset -= ( (opts.slideCount + opts.currSlide) * opts.carouselSlideDimension );
                }
                else {
                    // calculate offset based on actual slide dimensions
                    tmp = opts._carouselWrap.children();
                    for (j=0; j < (opts.slideCount + opts.currSlide); j++) {
                        offset -= $(tmp[j])[vert?'outerHeight':'outerWidth'](true);
                    }
                }
            }

            opts._carouselWrap.css( vert ? 'top' : 'left', offset );


            $(window).on('resize load', function(){
                var offset, tmp, j;
                var vert = opts.carouselVertical;

                opts.carouselOffset = ((opts.container.width() - $.fn.cycle.transitions.carousel2.getDim( opts, 0, vert )) / 2);

                offset = ( opts.carouselOffset || 0 );
                if ( opts.allowWrap !== false ) {
                    if ( opts.carouselSlideDimension ) {
                        offset -= ( (opts.slideCount + opts.currSlide) * opts.carouselSlideDimension );
                    }
                    else {
                        // calculate offset based on actual slide dimensions
                        tmp = opts._carouselWrap.children();
                        for (j=0; j < (opts.slideCount + opts.currSlide); j++) {
                            offset -= $(tmp[j])[vert?'outerHeight':'outerWidth'](true);
                        }
                    }
                }

                for(var i = 0; i < opts.currSlide; i++){
                    var currSlide = i+1;
                    var wPre = currSlide <= 0 ? 0 : $.fn.cycle.transitions.carousel2.getDim( opts, currSlide-1, vert );
                    var w = $.fn.cycle.transitions.carousel2.getDim( opts, currSlide, vert );
                    var contW = opts.container.width();

                    offset -= ( ((contW - wPre) / 2) + wPre - ((contW - w) / 2));
                }
                opts._carouselWrap.css( vert ? 'top' : 'left', offset );
            });

        },

        fluidSlides: function( opts ) {
            var timeout;
            var slide = opts.slides.eq(0);
            var adjustment = slide.outerWidth() - slide.width();
            var prepareDimensions = this.prepareDimensions;

            // throttle resize event
            $(window).on( 'resize ', resizeThrottle);

            opts._carouselResizeThrottle = resizeThrottle;
            onResize();

            function resizeThrottle() {
                clearTimeout( timeout );
                timeout = setTimeout( onResize, 20 );
            }

            function onResize() {
                opts._carouselWrap.stop( false, true );
                var slideWidth = opts.container.width() / opts.carouselVisible;
                slideWidth = Math.ceil( slideWidth - adjustment );
                opts._carouselWrap.children().width( slideWidth );
                if ( opts._sentinel )
                    opts._sentinel.width( slideWidth );
                prepareDimensions( opts );
            }
        },

        // transition API impl
        transition: function( opts, curr, next, fwd, callback ) {

            var moveBy = 0, props = {};
            var hops = opts.nextSlide - opts.currSlide;
            var vert = opts.carouselVertical;
            var speed = opts.speed;

            // handle all the edge cases for wrapping & non-wrapping
            if ( opts.allowWrap === false ) {
                fwd = hops > 0;

                var currSlide = opts.currSlide+1;

                if(hops < 0) currSlide = currSlide-1;

                var w, wPre;

                var contW = opts.container.width();

                if(hops <= 1 && hops >=-1) {
                    wPre = currSlide <= 0 ? 0 : this.getDim( opts, currSlide-1, vert );
                    w = this.getDim( opts, currSlide, vert );
                    moveBy = ( ((contW - wPre) / 2) + wPre - ((contW - w) / 2));
                } else {
                    for(var i = opts.currSlide; i < opts.nextSlide; i++){
                        var slide = i+1;
                        wPre = currSlide <= 0 ? 0 : this.getDim( opts, slide-1, vert );
                        w = this.getDim( opts, slide, vert );
                        moveBy = moveBy + ( ((contW - wPre) / 2) + wPre - ((contW - w) / 2));
                    }

                    for(var i = opts.currSlide; i > opts.nextSlide; i--){
                        
                        var slide = i;
                        wPre = currSlide <= 0 ? 0 : this.getDim( opts, slide-1, vert );
                        w = this.getDim( opts, slide, vert );
                        moveBy = moveBy + ( ((contW - wPre) / 2) + wPre - ((contW - w) / 2));
                    }
                }
            }

            props[ vert ? 'top' : 'left' ] = fwd ? ( "-=" + moveBy) : ( "+=" + moveBy);
            
            // throttleSpeed means to scroll slides at a constant rate, rather than
            // a constant speed
            if ( opts.throttleSpeed )
                speed = (moveBy / $(opts.slides[0])[vert ? 'height' : 'width']() ) * opts.speed;

            opts._carouselWrap.animate( props, speed, opts.easing, callback );
        },

        getDim: function( opts, index, vert ) {
            var slide = $( opts.slides[index] );
            return slide[ vert ? 'outerHeight' : 'outerWidth'](true);
        },

        getScroll: function( opts, vert, currSlide, hops ) {
            var i, moveBy = 0;

            if (hops > 0) {
                for (i=currSlide; i < currSlide+hops; i++)
                    moveBy += this.getDim( opts, i, vert);
            }
            else {
                for (i=currSlide; i > currSlide+hops; i--)
                    moveBy += this.getDim( opts, i, vert);
            }
            return moveBy;
        },

        genCallback: function( opts, fwd, vert, callback ) {
            // returns callback fn that resets the left/top wrap position to the "real" slides
            return function() {
                var pos = $(opts.slides[opts.nextSlide]).position();
                var offset = 0 - pos[vert?'top':'left'] + (opts.carouselOffset || 0);
                opts._carouselWrap.css( opts.carouselVertical ? 'top' : 'left', offset );
                callback();
            };
        },

        // core API override
        stopTransition: function() {
            var opts = this.opts();
            opts.slides.stop( false, true );
            opts._carouselWrap.stop( false, true );
        },

        // core API supplement
        onDestroy: function( e ) {
            var opts = this.opts();
            if ( opts._carouselResizeThrottle )
                $( window ).off( 'resize', opts._carouselResizeThrottle );
            opts.slides.prependTo( opts.container );
            opts._carouselWrap.remove();
        }
    };

})(jQuery);
