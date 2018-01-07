$(window).on("load", function () {
    initCardGallery($(document));
    initCardGalleryFancyBox($(document));

})

function initCardGallery($external_context) {
    $('.js-gallery-pager-swiper', $external_context).each(function () {
        var $context = $(this);
        var loop = false;

        var galleryPagerSwiper = new Swiper($context.find(".swiper-container"), {
            loop: loop,
            direction: 'vertical',
            slidesPerView: 4,
            spaceBetween: 63,
            nextButton: $context.find('.js-gallery-pager-next'),
            prevButton: $context.find('.js-gallery-pager-prev')
        })
    });

    $('.js-card-gallery', $external_context).each(function () {
        var $context = $(this);
        var $galleryImg = $(".js-gallery-img", $context);
        var $galleryImgLink = $(".js-gallery-img-link", $context);

        $(".js-gallery-pager-swiper .b-card-gallery__pager-item", $context).unbind("click");
        $(".js-gallery-pager-swiper .b-card-gallery__pager-item", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);
            $(".js-gallery-pager-swiper .b-card-gallery__pager-item", $context).removeClass("_current");
            obj.addClass("_current");

            $galleryImg.css("background-image", 'url(' + obj.data("preview-src") + ')');
            $galleryImgLink.attr("href", obj.data("full-src"));

            initCardGalleryFancyBox($context);

        })

        var galleryPagerSwiper = new Swiper($context.find(".swiper-container"), {
            direction: 'vertical',
            slidesPerView: 4,
            spaceBetween: 63
        })
    });
}

function initCardGalleryFancyBox($external_context) {
    $('.js-gallery-img', $external_context).each(function () {
        var $context = $(this);
        var $galleryImg = $(".js-gallery-img", $context);
        var $galleryImgLink = $(".js-gallery-img-link", $context);

        var $hiddenImages = $(".b-card-gallery__img-hidden", $context);

        $hiddenImages.addClass("js-gallery-fancybox");

        $hiddenImages.each(function () {
            var img = $(this);
            if (img.attr("href") == $galleryImgLink.attr("href")) {
                img.removeClass("js-gallery-fancybox");
            }
        });

        $(".js-gallery-fancybox", $context).fancybox({
            afterShow: function(current, previous) {
                if($(".fancybox-error").length){
                    $(".fancybox-error").html($("#fancybox-error").val());
                }
            }
        });


    });
}