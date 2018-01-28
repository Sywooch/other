/**
 * Created by GSU on 25.06.2017.
 */
$(window).load(function () {

    $(".js-background").each(function(){
        $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
    });

    $(".js-img").each(function(){
        $(this).attr("src", $(this).attr("data-image"));
    });

    $(".js-gallery-img img").each(function(){
        $(this).attr("src", $(this).attr("data-image"));
    });

    $(".js-current-project-image").each(function(){
        $(this).attr("src", $(this).attr("data-image"));
    });

    $(".js-cover-background").each(function(){
        $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
    });
    $(".js-owl-bg-img").each(function(){
        $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
    });


    $(".js-cover-background").each(function(){
        $(this).css("backgroundImage", "url("+$(this).attr("data-image")+")");
    });
    $(".js-vc-skill-image").each(function(){
        $(this).attr("src", $(this).attr("data-image"));
    });


});