/*
$(function () {
    $('.js-sections-list').each(function () {
        var $context = $(this);
        $(window).on("resize", function () {
            if (!$context.hasClass("_opened")) {
                var baseOffset = $(".b-catalog-section__sections-item", $context).eq(0).offset().top;
                $(".b-catalog-section__sections-item", $context).each(function () {
                    var currentItem = $(this);
                    var offsetTop = currentItem.offset().top;
                    if (offsetTop > baseOffset) {
                        currentItem.hide();
                    }
                });
            }
        }).resize();

        $(".js-sections-list-toggl", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);

            if (!$context.hasClass("_opened")) {
                $context.addClass("_opened");
                obj.text(obj.data("inversetext"));
                $(".b-catalog-section__sections-item", $context).show();
            } else {
                $context.removeClass("_opened");
                obj.text(obj.data("basetext"));
                $(window).trigger("resize");
            }

        });
    });
})

*/