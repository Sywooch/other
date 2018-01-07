$(function () {
    $('.js-search-line').each(function () {
        var $context = $(this);
        var $dropper = $context.find(".js-search-line-dropper");

        $(".js-search-line-open", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);

            if ($dropper.is(":visible")) {
                $context.find(".js-search-line-dropper").slideUp(function () {
                    $context.removeClass("_current");
                });
            } else {
                $context.find(".js-search-line-dropper").slideDown(function () {
                    $context.addClass("_current");
                });
            }

        });

        $(".js-search-line-close", $context).on("click", function (e) {
            e.preventDefault();
            var obj = $(this);
            $context.find(".js-search-line-dropper").slideUp(function () {
                $context.removeClass("_current");
            });
        });
    });
})