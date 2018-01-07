$(function () {
    initProductCounter($(document));
});

function initProductCounter($external_context) {
    $('.js-product-counter', $external_context).each(function () {
        var $context = $(this);
        var $plus = $(".b-counter__plus", $context);
        var $minus = $(".b-counter__minus", $context);
        var $input = $(".b-counter__input", $context);
        var maxCount = $context.data("maxcount");

        $plus.unbind("click");
        $plus.on("click", function (e) {

            e.preventDefault();
            if($(this).hasClass("disabled")){
               return false;
            }
            var currentVal = parseInt($input.val());
            //if (maxCount >= currentVal + 1)
            $input.val(currentVal + 1);

            button_basket_reload();
        })

        $minus.unbind("click");
        $minus.on("click", function (e) {
            e.preventDefault();
            if($(this).hasClass("disabled")){
                return false;
            }
            var currentVal = parseInt($input.val());
            if (currentVal > 1)
                $input.val(currentVal - 1);
            button_basket_reload();
        })

        $input.unbind("change");
        $input.on("change", function () {
            if (!$.isNumeric($input.val())) {
                $input.val(1);
            } else {
                //if ($input.val() > maxCount) {
                //    $input.val(maxCount);
                //   }else if($input.val() < 0){

                if($input.val() <= 0){
                    $input.val(1);
                }
            }
            button_basket_reload();
        })





    });
}