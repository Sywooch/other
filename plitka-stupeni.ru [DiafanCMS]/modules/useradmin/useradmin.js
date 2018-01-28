var useradmin=0;

$(document).ready(function () {

    useradmin=parseInt($.cookie('useradmin'),10);

    $.ajax({
        url:window.location.href,
        type:"POST",
        dataType:"html",
        data:{ module:'useradmin', ajax:1 },
        success:(function (response) {
            $("body").prepend(response);

            if(useradmin)
            {
				show_panel();
            }

        })
    });

    $(".useradmin_contener").live('mouseover', function () {
        if (useradmin) {
            $(this).addClass("useradmin_active");
            return false;
        }
    });
    $(".useradmin_contener").live('mouseout', function () {
        if (useradmin) {
            $(this).removeClass("useradmin_active");
            return false;
        }
    });
    $(".useradmin_contener").live('click', function () {
        if (useradmin) {
            $.prettyPhoto.open($(this).attr('href'));
            return false;
        }
    });

    $(".useradmin_panel span.go_edit").live('click', function () {
        if (useradmin) {
            useradmin = 0;
            $(".useradmin_panel span.go_edit").removeClass("red");
			$(".useradmin_meta").hide();
			$(".useradmin_panel").css("height", "52px").css("margin-top", "-52px").removeClass("useradmin_panel_meta");
			$("body").css("padding-top", "52px");
        }
        else {
            useradmin = 1;
			show_panel();
        }
        $.cookie('useradmin',useradmin);

    });
    
    $("title").attr('useradmin', str_replace('keywords', 'title_meta', $("meta[name=keywords]").attr('useradmin')));
});

function show_panel()
{
	$(".useradmin_panel span.go_edit").addClass("red");
	$(".useradmin_meta").show();
	$(".useradmin_meta").html(
		'<table><tr><td class="useradmin_meta_first_td"><span class="useradmin_contener" href="'+$("title").attr("useradmin")+'">title:</span></td><td><span class="useradmin_contener" href="'+$("title").attr("useradmin")+'">'+$("title").text()+'</span></td></tr>'
		+
		'<tr><td class="useradmin_meta_first_td"><span class="useradmin_contener" href="'+$("meta[name=keywords]").attr("useradmin")+'">keywords:</span></td><td><span class="useradmin_contener" href="'+$("meta[name=keywords]").attr("useradmin")+'">'+$("meta[name=keywords]").attr("content")+'</span></td></tr>'
		+
		'<tr><td class="useradmin_meta_first_td"><span class="useradmin_contener" href="'+$("meta[name=description]").attr("useradmin")+'">description:</span></td><td><span class="useradmin_contener" href="'+$("meta[name=description]").attr("useradmin")+'">'+$("meta[name=description]").attr("content")+'</span></td></tr></table>'
	);
	var height = $(".useradmin_meta").height() + 62;
	$(".useradmin_panel").css("height", height + "px").css("margin-top", "-"+height+"px").addClass("useradmin_panel_meta");
	$("body").css("padding-top", height + "px");
	
}