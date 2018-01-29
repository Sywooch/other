(function ($) {
    $.fn.timerGallery = function (options) {
        var defaults = {
            easing: 'jswing',
            opacity: 0.5,
            timer: true,
            interval: 5000
        }
        settings = $.extend({}, defaults, options);

        return this.each(function () { /* Plugin Code Here */
            var eas = settings.easing;
            var op = settings.opacity;
            var timer = settings.timer;
            var interval = settings.interval;
            var $this = $(this)
            var li = $this.find('.large_image_holder');
            var links = $this.find('.sub_section li a');
            var th = $this.find('.thumbs')
            var prev = $this.find('.previous');
            var next = $this.find('.next');
            var desc_hold = $this.find('.desc_holder');
            var desc = $this.find('.desc')
            var len = $this.find('.section').size();
            var wid = $this.find('.section').outerWidth();
            var total_width = wid * len;
            var end = wid - total_width;
            var num = 0;
            var urlAndDesc = [];
            var imgArr = []
            var inter



            setUp();

            //sets up dom	


            function setUp() {
                var first = $this.find('.one').attr('href');
                var desc1 = $this.find('.one').attr('rel');
                var last = $this.find('.thumb_holder:last-child .sub_section li:last-child');
                var img = new Image();
                $(links).each(function () {
                    urlAndDesc.push([$(this).attr('href'), $(this).attr('rel')])
                    imgArr.push($(this).attr('href'))
                });
                $(desc_hold).empty().append(desc1).fadeIn('slow')
                $(img).load(function () {
                    $(li).removeClass('loading').append(this);
                }).attr('src', first);
                $(last).addClass('last')
                $(th).width(total_width)
            }

            //timer function
            var swapImages = function () {
                $(li).empty();
                if (num < urlAndDesc.length - 1) {
                    num = num + 1;
                    src = urlAndDesc[num][0];
                    descrip = urlAndDesc[num][1];
                    loadImage(src,time())
                    addDesc(descrip);
                } else {
                    num = 0
                    src = urlAndDesc[num][0];
                    descrip = urlAndDesc[num][1];
                    loadImage(src, addDesc(descrip,time()))
                   ;
                }
            }
			
            // Run our swapImages() function every 5secs
         var time = function () {
               if (interval >= 4000) {
                    inter = setTimeout(swapImages, interval);
                } else {
                    inter = setTimeout(swapImages, 5000);
                }
            }
           if (timer == true) {
                window.onload = function () {
                    time() //run function
                }
            }


            // previous and next buttons for thumbs
            $(prev).click(function () {
                if (th.position().left != 0 && !$(th).is(":animated")) {
                    $(th).animate({
                        left: '+=' + wid
                    }, {
                        duration: 'slow',
                        easing: eas
                    })

                }
            })
            $(next).click(function () {
                if (th.position().left != end && !$(th).is(":animated")) {
                    $(th).animate({
                        left: '-=' + wid
                    }, {
                        duration: 'slow',
                        easing: eas
                    })

                }
            })

            $(links).css('opacity', op);
            $(links).hover(function () {
                $(this).fadeTo('slow', 1);
            }, function () {
                $(this).fadeTo('slow', op)
            })

            $(links).click(function () {
                // checks for class
                if ($(li).attr('class') == 'large_image_holder loading') {
                    return false;
                } else {
                    clearTimeout(inter);
                    $(li).empty();                   
                    var ind = $(this).attr('href');
                    num = jQuery.inArray(ind, imgArr)
                    src = urlAndDesc[num][0];
                    descrip = urlAndDesc[num][1];
                    loadImage(src);
                    addDesc(descrip);

                }
                return false;
            });

            $('.prev_img').click(function () {
                if (!$(th).is(":animated") || $(li).attr('class') == 'large_image_holder loading') {
                    clearTimeout(inter);
                    $(li).empty();
                    if (num == 0) {
                        num = urlAndDesc.length - 1
                        src = urlAndDesc[num][0];
                        descrip = urlAndDesc[num][1];

                    } else {
                        num = num - 1
                        src = urlAndDesc[num][0];
                        descrip = urlAndDesc[num][1];
                    }
                    loadImage(src);
                    addDesc(descrip);
                }

            })

            $('.next_img').click(function () {
                if (!$(th).is(":animated") || $(li).attr('class') == 'large_image_holder loading') {
                    clearTimeout(inter);
                    $(li).empty();
                    if (num == urlAndDesc.length - 1) {
                        num = 0
                        src = urlAndDesc[num][0];
                        descrip = urlAndDesc[num][1];
                    } else {
                        num = num + 1
                        src = urlAndDesc[num][0];
                        descrip = urlAndDesc[num][1];
                    }
                    loadImage(src);
                    addDesc(descrip);
                }

            })
            //description load function


            function addDesc(descrip) {
                if (descrip != '') {
                    $(desc).fadeOut('slow', function () {
                        $(desc_hold).empty().append(descrip);
                        $(desc).fadeIn('slow')
                        
                        
                    })
                } else {
                    $(desc).fadeOut('slow', function(){
                    $(desc_hold).empty()
                    })
                }

            }
            // image load function


            function loadImage(src) {
                var img = new Image();
				$(li).addClass('loading');
                $(img).load(function () {
                    $(this).css('display', 'none'); // .hide() doesn't work in Safari when the element isn't on the DOM already
                    $(this).hide();
                    $(li).removeClass('loading').append(this);
                    $(this).fadeIn();
                }).error(function () {
                    $(li).append("<p>loading...</p>")
                }).attr('src', src);
            }
        });
    }

})(jQuery);