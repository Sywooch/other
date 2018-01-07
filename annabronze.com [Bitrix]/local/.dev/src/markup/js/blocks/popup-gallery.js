$(function () {
    initPopupGallery($(document));
})

function initPopupGallery($external_context) {
    $('.js-popup-gallery-pager', $external_context).each(function () {
        var $context = $(this);
        var loop = false;

        var desktopParams = {
            loop: loop,
            direction: 'vertical',
            slidesPerView: 4,
            nextButton: $context.find('.js-gallery-pager-next'),
            prevButton: $context.find('.js-gallery-pager-prev')
        };

        params = desktopParams;

        if ($context.hasClass("_is-on-small")) {
            params["direction"] = 'horizontal';
            params["slidesPerView"] = 3;
            params["nextButton"] = false;
            params["prevButton"] = false;
        }


        galleryPagerSwiper = new Swiper($context.find(".swiper-container"), params);
    });

    $('.js-popup-gallery', $external_context).each(function () {
        var $context = $(this);
        var $galleryImg = $(".b-popup-gallery__img", $context);

        $(".js-popup-gallery-pager .b-popup-gallery__pager-item", $context).unbind("click");
        $(".js-popup-gallery-pager .b-popup-gallery__pager-item", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);
            $(".js-popup-gallery-pager .b-popup-gallery__pager-item", $context).removeClass("_current");
            obj.addClass("_current");

            $galleryImg.css({'background-image': 'url(' + obj.data("preview-src") + ')'});
            $galleryImg.find(".js-open-full-photo").attr("href", obj.data("preview-src")).data("current-photo-index", obj.data("pager-index"));

            //$galleryImg.attr("src", obj.data("preview-src"));
            setTimeout(function () {
                $.fancybox.update();
            }, 200);
        })
    });
}