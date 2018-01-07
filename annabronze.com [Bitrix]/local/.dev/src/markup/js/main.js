/*результат генерации bower Js*/
/* //= libs/_vendor.js    - если не хочетс подключать 2 файла, можно всё объединить */

var basketHtml = "";


BX.addCustomEvent('onAjaxSuccess', function(){
    setTimeout(function () {
        initProductCounter($(document)), initProductListCard($(document)), initPopupGallery($(document)), $.fancybox.update();


        if($(".b-basket-table__states").length) { 
            //обновление информера корзины
            var formatedSumm = $(".js-basket-table__total-total").find("b").html();
            var productsCount = $(".js-basket-table__total-total-quantity").html();
            if (formatedSumm == undefined || productsCount == undefined) {
                $(".js-cart-price").html("0");
                $(".js-cart-count").html("(0)");
                $(".b-top-cart").removeClass("_added");
            } else {
                $(".js-cart-price").html(formatedSumm);
                $(".js-cart-count").html("(" + productsCount + ")");
                $(".b-top-cart").addClass("_added");

            }
        }



        $(".js-form__input-coupon").on("change", function () {
            button_basket_reload();
        });




        $(document).on("change, keyup", ".b-basket-table__item .b-counter__input", function (e) {
            var t=$(this);
            check_quantity(t);
        });
        $(document).on("click", ".b-basket-table__item .b-counter__plus, .b-basket-table__item .b-counter__minus", function (e) {
            var t=$(this);
            check_quantity(t);
        });


        function check_quantity(t){
            var quantity = t.parents(".b-basket-table__item").find(".b-counter__input").val();
            var maxQuantity = t.parents(".b-basket-table__item").find(".js-product-counter").attr("data-maxcount");
            t.parents(".b-basket-table__item").find(".js-basket-table__stock-message").css("display","none");
            if( parseInt(quantity) > parseInt(maxQuantity) ){
                t.parents(".b-basket-table__item").find(".js-basket-table__stock-message").css("display","block");
            }


        }

  
        if($(".bx-core-adm-dialog").length == 0){
            //переинициализация styler
            $("select,input[type=checkbox],input[type=radio]").not(".non-styler").styler({
               selectSmartPositioning:false
            });


        }



        $("#basketOrderButton2").on("click", function (e) {
            //e.preventDefault();
            basketHtml = $(".b-layout__inner").html();
            //$(this).click();
        });


        if(basketHtml != ""){
            $(".b-layout__inner").html(basketHtml);
        }


        //проверка существования купона
        $(".js-form__input-coupon").on("keyup keypress blur change", function (e) {
            var coupon = $(this).val();
            if(coupon == ""){ return false; }

            $.post( "/local/include/ajax_is_exist_coupon.php", {coupon: coupon}, function(data) {
 
                if(data == 'N'){
                    $(".b-basket-table__total-coupon .b-form-errors").show();
                    $(".js-form__input-coupon").addClass("input-error");
                }else{
                    $(".b-basket-table__total-coupon .b-form-errors").hide();
                    $(".js-form__input-coupon").removeClass("input-error");
                }

            });


        });

        //убираем прелоадер
        //$(".js-form__preload-container").removeClass("is-loading");

    }, 300);

});




$(window).on("load", function () {

    $(".js-form__input-coupon").on("change", function () {
        button_basket_reload();
    });

    $(document).on("click",".js-open-full-photo",function(e){
        var obj = $(this);
        var wrapper = obj.closest(".js-popup-gallery");
        var galleryId = obj.closest(".b-popup-gallery__wrapper").data("gallery-id");
        var pagerId = obj.data("current-photo-index");
        e.preventDefault();

        var photoList = [];
        photoList.push({href : obj.attr("href")});
        wrapper.find(".b-popup-gallery__pager-item").each(function(){
            var item = $(this);
            if(item.data("preview-src") != obj.attr("href")){
                photoList.push({href: item.data("preview-src")});
            }
        })
        console.log(photoList);

        $.fancybox.open(photoList, {
            padding : 0,
            afterClose: function(){
                $("#link_open_gallery_"+galleryId).trigger("click");
                $.fancybox({
                    type: 'ajax',
                    href: obj.data("gallery-url"),
                    afterLoad: function (current, previous) {
                        setTimeout(function () {
                            initProductCounter($(document));
                            initProductListCard($(document));
                            initPopupGallery($(document));
                            $.fancybox.update();
                            $(".js-pager-index-"+pagerId).trigger("click");

                        },300);

                    }
                });
            }
        });

    });

    $(".fancybox").fancybox({
        afterShow: function(current, previous) {
            if($(".fancybox-error").length){
                $(".fancybox-error").html($("#fancybox-error").val());
            }
        }
    });
    $("select,input[type=checkbox],input[type=radio]").not(".non-styler").styler({
        selectSmartPositioning: false
    });


    $('.js-content-title').each(function () {
        var $context = $(this);


        var titleTextWidth = $context.find(".b-title__title").width();
        if ($context.hasClass("_no-lines")) {
            $context.find("._title").width(titleTextWidth).before('<div class="b-title__row _first"></div>');
            $context.find("._title").width(titleTextWidth).after('<div class="b-title__row _last"></div>');
        } else {
            $context.find("._title").width(titleTextWidth).before('<div class="b-title__row _first"><div class="b-layout__line"></div></div>');
            $context.find("._title").width(titleTextWidth).after('<div class="b-title__row _last"><div class="b-layout__line"></div></div>');
        }
    });


    if ($(".b-catalog-list__item").length) {
        $(".b-catalog-list__item").matchHeight();
    }

    if ($(".b-main-top__sections").length) {
        var moreText = $(".b-main-top__sections").data("moretext");
        $(".b-main-top__sections").flexMenu({
            "linkText": "<span>" + moreText + "</span>",
            "linkTextAll": "Показать все разделы"
        });
    }

    /*overwrite fancybox defaults*/
    if ($(window).width() < 760) {
        $.fancybox.defaults.padding = [35, 15, 35, 15];
        $.fancybox.defaults.margin = 0;
    } else {
        $.fancybox.defaults.padding = 35;
        $.fancybox.defaults.margin = 0;
    }


    $(document).on("change, keyup", ".b-basket-table__item .b-counter__input", function (e) {
        var t = $(this);
        check_quantity(t);
    });
    $(document).on("click", ".b-basket-table__item .b-counter__plus, .b-basket-table__item .b-counter__minus", function (e) {
        var t = $(this);
        check_quantity(t);
    });


    function check_quantity(t) {
        var quantity = t.parents(".b-basket-table__item").find(".b-counter__input").val();
        var maxQuantity = t.parents(".b-basket-table__item").find(".js-product-counter").attr("data-maxcount");
        t.parents(".b-basket-table__item").find(".js-basket-table__stock-message").css("display", "none");
        if (parseInt(quantity) > parseInt(maxQuantity)) {
            t.parents(".b-basket-table__item").find(".js-basket-table__stock-message").css("display", "block");
        }


    };


    $(".js-catalog-section__sections-item").on("click", function () {
        $("#catalog_filter").find("input:checkbox").removeAttr("checked");


        $(this).parents(".js-container__control").find('input[type="checkbox"]').attr("checked", "checked");

        $("#set_filter").click();
    });


    $("#basketOrderButton2").on("click", function (e) {
        //e.preventDefault();
        basketHtml = $(".b-layout__inner").html();
        //$(this).click();
    });

    $("#order_form_div button[name='submitbutton']").on("click", function (e) {
        //e.preventDefault();
        orderHtml = $(".b-layout__inner").html();
        //$(this).click();
    });

    //проверка существования купона
    $(".js-form__input-coupon").on("keyup keypress blur change", function (e) {
        var coupon = $(this).val();
        if (coupon == "") {
            return false;
        }

        $.post("/local/include/ajax_is_exist_coupon.php", {coupon: coupon}, function (data) {


            if (data == 'N') {
                $(".b-basket-table__total-coupon .b-form-errors").show();
                $(".js-form__input-coupon").addClass("input-error");
            } else {
                $(".b-basket-table__total-coupon .b-form-errors").hide();
                $(".js-form__input-coupon").removeClass("input-error");
            }

        });


    });


/*
    validate.extend(validate.validators.datetime, {
        // The value is guaranteed not to be null or undefined but otherwise it
        // could be anything.
        parse: function (value, options) {
            return +moment.utc(value);
        },
        // Input is a unix timestamp
        format: function (value, options) {
            var format = options.dateOnly ? "YYYY-MM-DD" : "YYYY-MM-DD hh:mm:ss";
            return moment.utc(value).format(format);
        }
    });

    // These are the constraints used to validate the form
    var constraints = {
        email: {
            // Email is required
            presence: true,
            // and must be an email (duh)
            email: true
        },
        password: {
            // Password is also required
            presence: true,
            // And must be at least 5 characters long
            length: {
                minimum: 5
            }
        },
        "confirm-password": {
            // You need to confirm your password
            presence: true,
            // and it needs to be equal to the other password
            equality: {
                attribute: "password",
                message: "^The passwords does not match"
            }
        },
        username: {
            // You need to pick a username too
            presence: true,
            // And it must be between 3 and 20 characters long
            length: {
                minimum: 3,
                maximum: 20
            },
            format: {
                // We don't allow anything that a-z and 0-9
                pattern: "[a-z0-9]+",
                // but we don't care if the username is uppercase or lowercase
                flags: "i",
                message: "can only contain a-z and 0-9"
            }
        },
        birthdate: {
            // The user needs to give a birthday
            presence: true,
            // and must be born at least 18 years ago
            date: {
                latest: moment().subtract(18, "years"),
                message: "^You must be at least 18 years old to use this service"
            }
        },
        country: {
            // You also need to input where you live
            presence: true,
            // And we restrict the countries supported to Sweden
            inclusion: {
                within: ["SE"],
                // The ^ prevents the field name from being prepended to the error
                message: "^Sorry, this service is for Sweden only"
            }
        },
        zip: {
            // Zip is optional but if specified it must be a 5 digit long number
            format: {
                pattern: "\\d{5}"
            }
        },
        "number-of-children": {
            presence: true,
            // Number of children has to be an integer >= 0
            numericality: {
                onlyInteger: true,
                greaterThanOrEqualTo: 0
            }
        }
    };

    // Hook up the form so we can prevent it from being posted
    var form = document.querySelector("form#main");
    form.addEventListener("submit", function (ev) {
        ev.preventDefault();
        handleFormSubmit(form);
    });

    // Hook up the inputs to validate on the fly
    var inputs = document.querySelectorAll("input, textarea, select")
    for (var i = 0; i < inputs.length; ++i) {
        inputs.item(i).addEventListener("change", function (ev) {
            var errors = validate(form, constraints) || {};
            showErrorsForInput(this, errors[this.name])
        });
    }

    function handleFormSubmit(form, input) {
        // validate the form aainst the constraints
        var errors = validate(form, constraints);
        // then we update the form to reflect the results
        showErrors(form, errors || {});
        if (!errors) {
            showSuccess();
        }
    }

    // Updates the inputs with the validation errors
    function showErrors(form, errors) {
        // We loop through all the inputs and show the errors for that input
        _.each(form.querySelectorAll("input[name], select[name]"), function (input) {
            // Since the errors can be null if no errors were found we need to handle
            // that
            showErrorsForInput(input, errors && errors[input.name]);
        });
    }

    // Shows the errors for a specific input
    function showErrorsForInput(input, errors) {
        // This is the root of the input
        var formGroup = closestParent(input.parentNode, "form-group")
        // Find where the error messages will be insert into
            , messages = formGroup.querySelector(".messages");
        // First we remove any old messages and resets the classes
        resetFormGroup(formGroup);
        // If we have errors
        if (errors) {
            // we first mark the group has having errors
            formGroup.classList.add("has-error");
            // then we append all the errors
            _.each(errors, function (error) {
                addError(messages, error);
            });
        } else {
            // otherwise we simply mark it as success
            formGroup.classList.add("has-success");
        }
    }

    // Recusively finds the closest parent that has the specified class
    function closestParent(child, className) {
        if (!child || child == document) {
            return null;
        }
        if (child.classList.contains(className)) {
            return child;
        } else {
            return closestParent(child.parentNode, className);
        }
    }

    function resetFormGroup(formGroup) {
        // Remove the success and error classes
        formGroup.classList.remove("has-error");
        formGroup.classList.remove("has-success");
        // and remove any old messages
        _.each(formGroup.querySelectorAll(".help-block.error"), function (el) {
            el.parentNode.removeChild(el);
        });
    }

    // Adds the specified error with the following markup
    // <p class="help-block error">[message]</p>
    function addError(messages, error) {
        var block = document.createElement("p");
        block.classList.add("help-block");
        block.classList.add("error");
        block.innerText = error;
        messages.appendChild(block);
    }

    function showSuccess() {
        // We made it \:D/
        alert("Success!");
    }

 */
});

function button_basket_reload(){
    //отображает кнопку обновления корзины

    $(".js-basket-table__btn1").css("display","none");
    $(".js-basket-table__btn2").css("display","block");


}

BX.showWait = function(node, msg) {
    $(".js-form__preload-container").addClass("is-loading");
};
BX.closeWait = function(node, obMsg) {
    $(".js-form__preload-container").removeClass("is-loading");
};







var lastWait = [];
/* non-xhr loadings */
BX.showWait = function (node, msg)
{
    node = BX(node) || document.body || document.documentElement;
    msg = msg || BX.message('JS_CORE_LOADING');

    var container_id = node.id || Math.random();

    var obMsg = node.bxmsg = document.body.appendChild(BX.create('DIV', {
        props: {
            id: 'wait_' + container_id,
            className: 'bx-core-waitwindow'
        },
        text: msg
    }));

    setTimeout(BX.delegate(_adjustWait, node), 10);

    $('.js-form__preload-container').show();
    lastWait[lastWait.length] = obMsg;
    return obMsg;
};

BX.closeWait = function (node, obMsg)
{
    $('.js-form__preload-container').hide();
    if (node && !obMsg)
        obMsg = node.bxmsg;
    if (node && !obMsg && BX.hasClass(node, 'bx-core-waitwindow'))
        obMsg = node;
    if (node && !obMsg)
        obMsg = BX('wait_' + node.id);
    if (!obMsg)
        obMsg = lastWait.pop();

    if (obMsg && obMsg.parentNode)
    {
        for (var i = 0, len = lastWait.length; i < len; i++)
        {
            if (obMsg == lastWait[i])
            {
                lastWait = BX.util.deleteFromArray(lastWait, i);
                break;
            }
        }

        obMsg.parentNode.removeChild(obMsg);
        if (node)
            node.bxmsg = null;
        BX.cleanNode(obMsg, true);
    }
};

function _adjustWait()
{
    if (!this.bxmsg)
        return;

    var arContainerPos = BX.pos(this),
        div_top = arContainerPos.top;

    if (div_top < BX.GetDocElement().scrollTop)
        div_top = BX.GetDocElement().scrollTop + 5;

    this.bxmsg.style.top = (div_top + 5) + 'px';

    if (this == BX.GetDocElement())
    {
        this.bxmsg.style.right = '5px';
    }
    else
    {
        this.bxmsg.style.left = (arContainerPos.right - this.bxmsg.offsetWidth - 5) + 'px';
    }
}

//слайдер на детальной товара для мобильных
function initProductDetailMobileSlider(){
    $('.js-swiper-full').each(function () {
        var $context = $(this);
        var loop = false;
        if ($context.data("loop")) {
            loop = true;
        }
        var mySwiper = new Swiper($context.find(".swiper-container"), {
            loop: loop,
            autoplay: $context.data("time"),
            nextButton: $context.find('.js-swiper-button-next'),
            prevButton: $context.find('.js-swiper-button-prev')
        })

    });
    $('.js-collection-swiper').each(function () {
        var $context = $(this);
        var loop = false;
        if ($context.data("loop")) {
            loop = true;
        }
        var mySwiper = new Swiper($context.find(".swiper-container"), {
            loop: loop,
            slidesPerView: 4,
            autoplay: $context.data("time"),
            nextButton: $context.find('.js-swiper-button-next'),
            prevButton: $context.find('.js-swiper-button-prev'),
            breakpoints: {
                1250: {
                    slidesPerView: 3
                },
                760: {
                    slidesPerView: 1
                }
            }
        })

    });




}

