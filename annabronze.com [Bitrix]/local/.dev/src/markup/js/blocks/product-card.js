$(function () {
    initProductCard($(document));
});

function initProductCard($external_context) {


        $(".b-product-card .b-colors__item").unbind("click");
        $(".b-product-card .b-colors__item").on("click", function (e) {

            e.preventDefault();

            var $item = $(this);

            $(".b-product-card .b-colors__item").removeClass("_current");
            $item.addClass("_current");


            //var currentColorId = $item.data("id");
            //$img.data("current-color-index", currentColorIndex);
            //$img.css("background-image", 'url(' + $img.data("color-img-index-" + currentColorIndex) + ')');

            var numberOffer=$(this).attr("data-id");

            var offerName=$(".js-offer[data-id='"+numberOffer+"']").attr("data-name");
            var offerPricePrint=$(".js-offer[data-id='"+numberOffer+"']").attr("data-price-print");
            var offerQuantity=$(".js-offer[data-id='"+numberOffer+"']").attr("data-quantity");
            var offerId=$(".js-offer[data-id='"+numberOffer+"']").attr("data-offer-id");

            var offerParams=$("#offer-params_"+offerId).html();

            var offerArticle=$(".js-offer[data-id='"+numberOffer+"']").attr("data-article");
            var offerQuantityInBasket=$(".js-offer[data-id='"+numberOffer+"']").attr("data-quantity-in-basket");
            offerQuantityInBasket = parseInt(offerQuantityInBasket);




            $(".js-product-card__article").find("span").html(offerArticle);
            $(".js-product-card__title").html(offerName);
            $(".js-product-card__prices-price").html(offerPricePrint);
            $(".js-product-card__stock").find("b").html(offerQuantity);
            $(".b-product-card__params").html(offerParams);
            $("#offer_id").attr("data-id",offerId);
            $(".b-product-card__prices-counter .js-product-counter").attr("data-maxcount",offerQuantity);
            $(".b-product-card").find(".js-product-card__stock-message").css("display","none");
            if( $(".b-product-card__prices-counter .b-counter__input").val() > parseInt(offerQuantity) ){

                $(".b-product-card").find(".js-product-card__stock-message").css("display","block");
            }


            $('[data-image]', "#offer-images_"+offerId).each(function () {
                var image=$(this).attr("data-image");
                $(this).css("background-image", "url("+image+")");
            });

            var imagesContent=$("#offer-images_"+offerId).html();
            $(".js-product-card__left").html(imagesContent);

            initCardGallery($(document));
            initCardGalleryFancyBox($(document));

            var inBasket=$(".js-offer#offer_"+offerId).attr("data-in-basket");

            if(inBasket == "N"){

                $(".b-product-card__btn .add").css("display","block");
                $(".b-product-card__btn .buttonAdded").css("display","none");

                $(".b-counter__input").removeAttr("disabled");
                $(".b-counter__plus").removeClass("disabled");
                $(".b-counter__minus").removeClass("disabled");

                $(".b-counter__input").val("1");


            }else{

                $(".b-product-card__btn .add").css("display","none");
                $(".b-product-card__btn .buttonAdded").css("display","block");

                $(".b-counter__input").attr("disabled", "disabled");
                $(".b-counter__plus").addClass("disabled");
                $(".b-counter__minus").addClass("disabled");

                $(".b-counter__input").val(offerQuantityInBasket);


            }


            //кнопки социальных сетей
            //редактирование мета тегов в шапке


            var metaTitle = $("#social-offer_"+offerId).attr("data-title");
            var metaUrl = $("#social-offer_"+offerId).attr("data-url");
            var metaImage = $("#social-offer_"+offerId).attr("data-image");

            document.title = metaTitle;


            $("meta[property='og:title']").attr('content',metaTitle);
            $("meta[property='og:url']").attr('content',metaUrl);
            $("meta[property='og:image']").attr('content',metaImage);

            $("meta[itemprop='name']").attr('content',metaTitle);
            $("meta[itemprop='image']").attr('content',metaImage);

            $("meta[name='twitter:title']").attr('content',metaTitle);
            $("meta[name='twitter:image:src']").attr('content',metaImage);


            $(".js-footer__socials-item-container").addClass("hidden");
            $(".js-footer__socials-item-main-container").addClass("hidden");
            $(".js-footer__socials-item-container-offer_"+offerId).removeClass("hidden");


            //преинициализация слайдера для мобильных

            //var t = $(this);
            initProductDetailMobileSlider();
            //////////







        });






}


$(document).on("click", ".b-product-card a.js-add-ro-cart", function (e) {
    e.preventDefault();
    var t = $(this);
    var offerId=$("#offer_id").attr("data-id");
    var offerCount=$(".b-counter__input").val();

    if(languageId == "en"){
        var url = "/en/local/include/ajax_offer_to_basket.php";
    }else{
        var url = "/local/include/ajax_offer_to_basket.php";
    }

    $.post( url, { offerId: offerId, offerCount: offerCount }, function(data) {

        var data=JSON.parse(data);
        //$(".b-product-card__btn").html("<span class='btn _full js-add-ro-cart'>"+data.mess+"</span>");

        $(".b-product-card__btn .add").css("display","none");
        $(".b-product-card__btn .buttonAdded").css("display","block");

        //обновление информера корзины
        $(".js-cart-count").html("("+data.cart_num+")");
        $(".js-cart-price").html(data.cart_sum);



        $(".js-offer#offer_"+offerId).attr("data-in-basket","Y");
        $(".js-offer#offer_"+offerId).attr("data-quantity-in-basket", offerCount);

        $(".b-counter__input").attr("disabled", "disabled");
        $(".b-counter__plus").addClass("disabled");
        $(".b-counter__minus").addClass("disabled");

        $(".b-counter__input").val(offerCount);



    });





});


$(document).on("change, keyup", ".b-product-card .b-counter__input", function (e) {

    check_quantity();
});
$(document).on("click", ".b-product-card .b-counter__plus, .b-product-card .b-counter__minus", function (e) {

    check_quantity();
});


function check_quantity(){

    var quantity = $(".b-product-card").find(".b-counter__input").val();
    var maxQuantity = $(".b-product-card").find(".js-product-counter").attr("data-maxcount");
    $(".b-product-card").find(".js-product-card__stock-message").css("display","none");

    if( parseInt(quantity) > parseInt(maxQuantity) ){

        $(".b-product-card").find(".js-product-card__stock-message").css("display","block");
    }
}

