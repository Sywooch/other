$(function () {
    initProductListCard($(document));
});

function initProductListCard($external_context) {
    $('.js-product-list-card', $external_context).each(function () {
        var $context = $(this);
        var $colors = $(".js-product-list-card-colors", $context);
        var $img = $(".js-product-list-card-img", $context);

        $(".b-catalog-list__item-link", $context).unbind("mouseenter");
        $(".b-catalog-list__item-link", $context).unbind("mouseleave");
        $(".b-catalog-list__item-link", $context).unbind("click");
        $(".b-catalog-list__item-btn", $context).unbind("click");
        $(".b-catalog-list__item-btn", $context).unbind("mouseleave");
        $(".b-catalog-list__item-btn", $context).on("mouseenter", function () {
            setTimeout(function(){
                $context.addClass("_is-hovered");
            },100);
        });
        $(".b-catalog-list__item-link", $context).on("mouseenter", function () {
            setTimeout(function(){
                $context.addClass("_is-hovered");
            },100);
        });
        $(".b-catalog-list__item-link", $context).on("mouseleave", function () {
            setTimeout(function(){
                $context.removeClass("_is-hovered");
            },100);
        });


        $(".b-catalog-list__item-link,.b-catalog-list__item-btn", $context).on("click", function (e) {
            if (!$context.hasClass("_is-hovered")) {
                return false;
            }
        });



        $("div.b-colors__item", $context).unbind("click");
        $("div.b-colors__item", $context).on("click", function (e) {
            //e.preventDefault();
            var $item = $(this);

            $(".b-colors__item", $context).removeClass("_current");
            $item.addClass("_current");


            var currentColorIndex = $item.data("color-index");
            $img.data("current-color-index", currentColorIndex);
            $img.css("background-image", 'url(' + $img.data("color-img-index-" + currentColorIndex) + ')');

            var numberOffer = $(this).attr("data-id");

            var offerName = $(this).parents(".js-product-list-card").find("input[data-id='" + numberOffer + "']").attr("data-name");
            var offerPricePrint = $(this).parents(".js-product-list-card").find("input[data-id='" + numberOffer + "']").attr("data-price-print");
            var offerPicture = $(this).parents(".js-product-list-card").find("input[data-id='" + numberOffer + "']").attr("data-picture");
            var offerId = $(this).parents(".js-product-list-card").find("input[data-id='" + numberOffer + "']").attr("data-offer-id");
            var offerInBasket = $(this).parents(".js-product-list-card").find("input[data-id='" + numberOffer + "']").attr("data-in-basket");

            $(this).parents(".js-product-list-card").find(".js-catalog-list__item-title").html(offerName);
            $(this).parents(".js-product-list-card").find(".js-catalog-list__item-price").html(offerPricePrint);
            $(this).parents(".js-product-list-card").find(".js-product-list-card-img").css("background-image", "url(" + offerPicture + ")");
            $(this).parents(".js-product-list-card").find("#offer_id").attr("data-id", offerId);

            if(offerInBasket == "Y"){
                $(this).parents(".js-product-list-card").find(".added").css("display","block");
                $(this).parents(".js-product-list-card").find(".no_added").css("display","none");

            }else{
                $(this).parents(".js-product-list-card").find(".added").css("display","none");
                $(this).parents(".js-product-list-card").find(".no_added").css("display","block");
            }

            //смена ссылки
            var detailPageUrl = $(this).parents(".js-product-list-card").find("#detail_page_url").attr("data-id");
            var offerId = $(this).parents(".js-product-list-card").find("#offer_id").attr("data-id");


            detailPageUrl = detailPageUrl + "?offer=" + offerId;
            $(this).parents(".js-product-list-card").find("a.b-catalog-list__item-link").attr("href", detailPageUrl);

            $(this).parents(".js-product-list-card").attr("data-offer-id", offerId);

        });
    });
}


