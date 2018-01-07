$(function () {
    $('.js-faq').each(function () {
        var $context = $(this);


        $(".b-faq__item-title", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);
            var item = obj.closest(".b-faq__item");
            var $dropper = item.find(".b-faq__item-answer");

            if (item.hasClass("_opened")) {
                $dropper.slideUp(function () {
                    item.removeClass("_opened");
                });
            } else {
                $dropper.slideDown(function () {
                    item.addClass("_opened");
                });
            }

        });
    });
})