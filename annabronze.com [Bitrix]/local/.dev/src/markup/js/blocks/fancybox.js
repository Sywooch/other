$(function () {
    $(document).on("click", "a.open-ajax", function (e) {
        e.preventDefault();

        if($(this).hasClass("disabled")){
            return false;
        }

        var obj = $(this);

        var t = $(this);
        var offerName=t.parents(".js-product-list-card").find(".js-catalog-list__item-title").html();
        var offerPricePrint=t.parents(".js-product-list-card").find(".js-catalog-list__item-price").html();
        //var offerPicture=t.parents(".js-product-list-card").find(".js-product-list-card-img").css("background-image");

        //var quantity=t.parents(".js-product-list-card").find("input[type='hidden'].js-offer").attr("data-quantity");
        var colors=t.parents(".js-product-list-card").find(".b-catalog-list__item-colors").html();
        var offerId=t.parents(".js-product-list-card").find("#offer_id").attr("data-id");

        var offerPicture=t.parents(".js-product-list-card").find("input[type='hidden'].js-offer#offer_"+offerId).attr("data-picture-popup");

        var quantity=t.parents(".js-product-list-card").find("input[type='hidden'].js-offer#offer_"+offerId).attr("data-quantity");
        var inBasket = t.parents(".js-product-list-card").find("input[type='hidden'].js-offer#offer_"+offerId).attr("data-in-basket");

        var detailPage = t.parents(".js-product-list-card").find("input[type='hidden'].js-offer#offer_"+offerId).attr("data-detail-page");


        $.fancybox({
            type: 'ajax',
            href: obj.attr("href"),
            afterLoad: function (current, previous) {
                setTimeout(function () {
                    initProductCounter($(document));
                    initProductListCard($(document));
                    initPopupGallery($(document));
                    $.fancybox.update();

                    offerName = "<a href='"+detailPage+"'>"+offerName+"</a>"
                    $("#popCard").find(".js-popup-card__title").html(offerName);

                    $("#popCard").find(".js-product-card__prices-price").html(offerPricePrint);
                    $("#popCard").find(".js-product-list-card-img").css("background-image","url("+offerPicture+")");
                    $("#popCard").find(".js-product-card__stock").children("b").html(quantity);
                    $("#popCard").find(".js-product-counter").attr("data-maxcount",quantity);
                    $("#popCard").find(".js-colors__container").html(colors);
                    $("#popCard").find("#offer_id").attr("data-id",offerId);
                    $(".js-product-card__stock-message").css("display","none");

              
                    if(inBasket == "Y"){
                        $("#popCard").find(".add").hide();
                        $("#popCard").find(".added").show();

                    }else{
                        $("#popCard").find(".add").show();
                        $("#popCard").find(".added").hide();

                    }

                    if( parseInt(quantity) < parseInt($(".b-counter__input").val()) ){
                        $(".js-product-card__stock-message").css("display","block");
                    }

                    $("#popCard").find(".b-colors__item").unbind("click"),
                        $("#popCard").find(".b-colors__item").on("click", function (n) {
                            n.preventDefault();



                            var i = $(this);
                            $("#popCard").find(".b-colors__item").removeClass("_current"), i.addClass("_current");

                            var numberOffer=i.attr("data-id");


                            var offerName=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-name");
                            var offerPricePrint=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-price-print");
                            var offerId=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-offer-id");

                            var offerPicture=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-picture-popup");

                            var quantity=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-quantity");
                            var quantityInBasket=t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-quantity-in-basket");
                            quantityInBasket = parseInt(quantityInBasket);

                            var detailPage = t.parents(".js-product-list-card").find("input[data-id='"+numberOffer+"']").attr("data-detail-page");

                            offerName = "<a href='"+detailPage+"'>"+offerName+"</a>"

                            $("#popCard").find(".js-popup-card__title").html(offerName);
                            $("#popCard").find(".js-product-card__prices-price").html(offerPricePrint);
                            $("#popCard").find(".js-product-list-card-img").css("background-image","url("+offerPicture+")");
                            $("#popCard").find("#offer_id").attr("data-id",offerId);

                            $("#popCard").find(".js-product-card__stock").children("b").html(quantity);
                            $("#popCard").find(".js-product-counter").attr("data-maxcount",quantity);

                            $(".js-product-card__stock-message").css("display","none");
                            if( parseInt(quantity) < parseInt($(".b-counter__input").val()) ){
                                $(".js-product-card__stock-message").css("display","block");
                            }



                            var inBasket=$(".js-offer#offer_"+offerId).attr("data-in-basket");

                            if(inBasket == "N"){

                                $("#popCard").find(".b-product-card__btn .add").css("display","block");
                                $("#popCard").find(".b-product-card__btn .added").css("display","none");

                                $("#popCard").find(".b-counter__input").removeAttr("disabled");
                                $("#popCard").find(".b-counter__plus").removeClass("disabled");
                                $("#popCard").find(".b-counter__minus").removeClass("disabled");

                                //сброс счётчика количества на 1
                                $("#popCard").find(".b-counter__input").val("1");

                            }else{

                                $("#popCard").find(".b-product-card__btn .add").css("display","none");
                                $("#popCard").find(".b-product-card__btn .added").css("display","block");

                                
                                $("#popCard").find(".b-counter__input").attr("disabled", "disabled");
                                $("#popCard").find(".b-counter__plus").addClass("disabled");
                                $("#popCard").find(".b-counter__minus").addClass("disabled");

                                //кол-во данного товара в корзине
                                $("#popCard").find(".b-counter__input").val(quantityInBasket);

                            }



                        })


                    //получить информацию по скидкам
                    $.post( "/local/include/ajax_get_discounts.php", function(data) {
                        
                        var obj = jQuery.parseJSON(data);
                        $(".js-discount-active").html(obj.current_discount);

                        if(obj.next_discount=="" || obj.next_discount==null){
                            $(".js-hide-next-discount").css("display","none");
                        }else{
                            $(".js-discount-next").html(obj.next_discount);
                            $(".js-summ").html(obj.sum);
                        }
                    });


                     


                }, 300);
            }
        });

    });




    $(document).on("click", "a.js-add-ro-cart", function (e) {
        e.preventDefault();
        var t = $(this);
        var offerId=$(this).parents("#popCard").find("#offer_id").attr("data-id");
        var offerCount=$(this).parents("#popCard").find(".b-counter__input").val();
         

        if(languageId == "en"){
            var url = "/en/local/include/ajax_offer_to_basket.php";
        }else{
            var url = "/local/include/ajax_offer_to_basket.php";
        }

        $.post( url, { offerId: offerId, offerCount: offerCount }, function(data) {

            var data=JSON.parse(data);
            //t.parents("#popCard").find(".b-product-card__btn").html("<span class='btn _full js-add-ro-cart'>"+data.mess+"</span>");


            t.parents("#popCard").find(".b-product-card__btn .add").css("display","none");
            t.parents("#popCard").find(".b-product-card__btn .added").css("display","block");



            //обновление информера корзины
            $(".js-cart-count").html("("+data.cart_num+")");
            $(".js-cart-price").html(data.cart_sum);
            if(!$(".b-top-cart").hasClass("_added")){
                $(".b-top-cart").addClass("_added");
            }


            //t.parents("#popCard").find(".b-counter__input").val("1");
            var count = t.parents("#popCard").find(".b-counter__input").val();

            $(".js-offer#offer_"+offerId).attr("data-in-basket","Y");
            $(".js-offer#offer_"+offerId).attr("data-quantity-in-basket",count);

            $(".js-product-list-card[data-offer-id='"+offerId+"']").find(".b-catalog-list__item-btn.no_added").hide();
            $(".js-product-list-card[data-offer-id='"+offerId+"']").find(".b-catalog-list__item-btn.added").show();



            t.parents("#popCard").find(".b-counter__input").attr("disabled", "disabled");
            t.parents("#popCard").find(".b-counter__plus").addClass("disabled");
            t.parents("#popCard").find(".b-counter__minus").addClass("disabled");


            if(languageId == "en"){
                var url = "/en/basket/";
            }else{
                var url = "/basket/";
            }

            $.post( url, { BasketRefresh: "1" }, function(data) {

                //получить информацию по скидкам
                $.post( "/local/include/ajax_get_discounts.php", function(data) {
                    //alert(data);
                    var obj = jQuery.parseJSON(data);
                    $(".js-discount-active").html(obj.current_discount);

                    if(obj.next_discount=="" || obj.next_discount==null){
                        $(".js-hide-next-discount").css("display","none");
                    }else{
                        $(".js-discount-next").html(obj.next_discount);
                        $(".js-summ").html(obj.sum);
                    }
                });

            });





            //setTimeout(function () {
            //    $.fancybox.close();
            //}, 300);

        });





    });



    $(document).on("change, keyup", "#popCard .b-counter__input", function (e) {

        check_quantity();
    });
    $(document).on("click", "#popCard .b-counter__plus, #popCard .b-counter__minus", function (e) {

        check_quantity();
    });


    function check_quantity(){
        var quantity = $("#popCard").find(".b-counter__input").val();
        var maxQuantity = $("#popCard").find(".js-product-counter").attr("data-maxcount");

        $("#popCard").find(".js-product-card__stock-message").css("display","none");
        if( parseInt(quantity) > parseInt(maxQuantity) ){
            $("#popCard").find(".js-product-card__stock-message").css("display","block");
        }

        $("#popCard").find(".b-product-card__btn .add").css("display","block");
        $("#popCard").find(".b-product-card__btn .added").css("display","none");


    }



})