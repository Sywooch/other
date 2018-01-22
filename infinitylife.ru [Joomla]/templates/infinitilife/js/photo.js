jQuery(function($) {

    var offset_top, banner_offset_top;

    $(document).ready(function ($) {

        offset_top = $(".photocontent-center").offset().top;
        banner_offset_top = $(".photobanner").offset().top;
        update();
    });
    $( window ).resize(function(event) {
        update();
        setTimeout(function () {
            update();
        }, 100);
    });

    $( window ).scroll(function(){
        update();
    });


    function update(){
        $(".photocontent-bottom ul.container>li.thumb a").height($(".photocontent-bottom ul.container>li.thumb a").width());

        var scrollTop = $(window).scrollTop() + $(".header").height() + $(".photocontent-center").height();
        if (scrollTop >= banner_offset_top) {
            $(".photocontent-bottom").css({ 'margin-top': $(".photocontent-center").height() });
        } else if (scrollTop <= banner_offset_top) {
            $(".photocontent-bottom").css({ 'margin-top': 0 });
        }

        processScroll(".photocontent-center", "menu-fixed", offset_top, $(".header").height());
    }

    function processScroll(element, eclass, offset_top, offset_menu) {
        var scrollTop = $(window).scrollTop() + offset_menu;
        if($(element).height()< $(window).height()){

            if (scrollTop >= offset_top) {
                $(element).addClass(eclass);
            } else if (scrollTop <= offset_top) {
                $(element).removeClass(eclass);
            }
        }
    }
});
