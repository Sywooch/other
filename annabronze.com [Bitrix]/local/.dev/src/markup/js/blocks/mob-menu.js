$(function () {
    $('.js-mob-menu').each(function () {
        var $context = $(this);
        var $opener = $context.find(".js-mob-menu-opener");
        var $wrapper = $context.find(".b-mob-menu__wrapper");

        $opener.on("click", function (e) {
            e.preventDefault();
            var obj = $(this);

            if (obj.hasClass("_opened")) {
                $wrapper.slideUp(function () {
                    obj.removeClass("_opened");
                })
            } else {
                $wrapper.slideDown(function () {
                    obj.addClass("_opened");
                })
            }
        });

        $(".b-mob-menu__item._has-drop>.b-mob-menu__item-text", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);
            var item = obj.closest(".b-mob-menu__item");
            var dropper = item.find(".b-mob-menu__item-drop");

            if (item.hasClass("_dropped")) {
                dropper.slideUp(function () {
                    item.removeClass("_dropped")
                })
            } else {
                dropper.slideDown(function () {
                    item.addClass("_dropped")
                })
            }


        })
    });
})