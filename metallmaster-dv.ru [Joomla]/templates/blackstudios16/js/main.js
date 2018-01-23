$(function() {
    $('.item-page p img, img.fb').each(function (){
        $(this).wrap("<a href="+this.src+" rel=\"group\" class=\"iframe\" "+">");
        k=240;
        var width=$(this).width();
        var height=$(this).height();
        if (width>240||height>240)  {
            if (width >= height) {
                x=k*height/width;
                $(this).width(k);
                $(this).height(x);
            } else {
                x=k*width/height;
                $(this).width(x);
                $(this).height(k);
            }
        }
    });

$("a.iframe").fancybox(
{
    "padding" : 10,
    "imageScale" : true,
    "zoomOpacity" : false,
    "zoomSpeedIn" : 1000,
    "zoomSpeedOut" : 1000,
    "zoomSpeedChange" : 1000,
    "frameWidth" : 300,
    "frameHeight" : 400,
    "overlayShow" : true,
    "overlayOpacity" : 0.5,
    "hideOnContentClick" :false,
    "centerOnScroll" : true
});
$(".pas_menu_1").parent().css({
width: "240",
"font-size": "80%"
});
$(".pas_menu_1").parent().next().addClass("right");
alert (temp);
});
$(".contacts-b").css({
width: "240"
});
$(".contacts-b").parent().css({
width: "240",
});
