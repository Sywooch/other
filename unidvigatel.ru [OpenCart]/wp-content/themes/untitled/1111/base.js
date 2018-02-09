function add_js(js_src) {
    var script_element = document.createElement("script");
    script_element.type = "text/javascript";
    script_element.setAttribute('src', js_src);
    document.getElementsByTagName('head')[0].appendChild(script_element);
}

$(document).ready(function() {
    $.each($('.skype_icon'), function(i, skype_icon) {
        var skype_login = skype_icon.getAttribute('id').replace(/^skype_/, '');
        skype_icon.setAttribute('src', 'http://mystatus.skype.com/smallicon/' + skype_login);
    });
    add_js('http://download.skype.com/share/skypebuttons/js/skypeCheck.js');

    $.each($('.icq_icon'), function(i, icq_icon) {
        var uin = icq_icon.getAttribute('id').replace(/^uin_/, '');
        icq_icon.setAttribute('src', 'http://status.icq.com/online.gif?img=5&icq=' + uin);
    });

    var webim_button = $('#webim');
    webim_button.click(function() {
		if (navigator.userAgent.toLowerCase().indexOf('opera') != -1 && window.event.preventDefault) window.event.preventDefault();
		var newWindow = window.open('http://lite.webim.ru/specpromsnabural/webim/client.php?locale=ru', 'webim_', 'toolbar=0,scrollbars=0,location=0,menubar=0,width=600,height=420,resizable=1');
		if (newWindow != null) {
			newWindow.focus();
			newWindow.opener = window;
		}
		return false;
	});
    $('img', webim_button).attr('src', 'http://lite.webim.ru/specpromsnabural/webim/button.php?image=webim&lang=ru');

    var spare_table = $('#spare_parts');
    if (spare_table.length) {
        if (!$.browser.msie) {
            var spare_image_container = $('#spare_image');
            var spare_image_width = $('img', spare_image_container).attr('width');
            if (spare_image_width > spare_image_container.width()) {
                spare_image_container.css('overflow-x', 'scroll');
            }
            var spare_parts_container = $('#spare_parts_wrapper');
            if (spare_table.width() > spare_parts_container.width()) {
                spare_parts_container.css('overflow-x', 'scroll');
            }
        }

        var labels = $('.spare_part_label');

        var first_row = spare_table.find('tr:first').get();
        var rows = spare_table.find('tr:gt(0)').get();
        rows.sort(function (row_1, row_2) {
            var row1 = $(row_1);
            var row2 = $(row_2);
            var label_link1 = parseInt(row1.find('td:eq(0)').text());
            var label_link2 = parseInt(row2.find('td:eq(0)').text());
            if (label_link1 < label_link2) return -1;
            if (label_link1 > label_link2) return 1;
            if (label_link1 == label_link2) {
                var spare_number1 = row1.find('td:eq(1)').text().toUpperCase();
                var spare_number2 = row2.find('td:eq(1)').text().toUpperCase();
                if (spare_number1 < spare_number2) return -1;
                if (spare_number1 > spare_number2) return 1;
                return 0;
            }
        });
        $.each(rows, function(index, row) {
            if (index % 2 == 1) {
                row.className = row.className.replace(/odd/g, 'even');
            }
            else {
                row.className = row.className.replace(/even/g, 'odd');
            }
        });
        spare_table.html(first_row).append(rows);

        labels.hover(function() {
                var label = $(this);
                label.addClass('highlighted');
                $('tr.' + label.attr('id'), spare_table).addClass('highlighted');
            },
            function() {
                var label = $(this);
                label.removeClass('highlighted');
                $('tr.' + label.attr('id'), spare_table).removeClass('highlighted');
        }).click(function() {
            var label = $(this);
            labels.filter('.selected').removeClass('selected');
            label.addClass('selected');

            $('tr.selected', spare_table).removeClass('selected');
            $('tr.' + label.attr('id'), spare_table).addClass('selected');
        });

        $("tr[class*='label_']", spare_table).hover(function() {
                var row = $(this);
                row.addClass('highlighted');
                find_related_label(row).addClass('highlighted');
            }, function() {
                var row = $(this);
                row.removeClass('highlighted');
                find_related_label(row).removeClass('highlighted');
            }).click(function() {
                find_related_label($(this)).click();
        });

        function find_related_label(spare_part) {
            var related_label_id = spare_part.attr('class').match(/label_[0-9]+/g);
            return $('#' + related_label_id);
        }
    }

    var gallery = $('#gallery');
    if (gallery.length) {
        gallery.adGallery({
            width: 585,
            height: 439,
            thumb_opacity: 0.6,
            effect: 'fade',
            slideshow: {enable: false},
            loader_image: '/media/base/js/ad-gallery/loader.gif',
            display_back_and_forward: ($('.ad-thumb-list li').length > 6),
            callbacks: {
               init: function() {
                   this.preloadImage(0);
                   this.preloadImage(1);
                   this.preloadImage(2);
               }
            }
        });
    }

    function translate_fancy_controls() {
        $('#fancybox-left').attr('title', 'Предыдущее изображение');
        $('#fancybox-right').attr('title', 'Следующее изображение');
        $('#fancybox-close, #fancybox-overlay').attr('title', 'Закрыть');
    }

    var fancy = $('.fancy');
    if(fancy.length) {
         fancy.fancybox({
             width:600,
             height:540,
             autoScale:false,
             autoDimensions:false,
             margin:0,
             padding:0,
             titlePosition:'inside',
             onStart: translate_fancy_controls
         });
    }

    // fancybox gallery
    var fancy_gallery_links = $("a[rel=fancy_gallery]");
    if(fancy_gallery_links.length) {
        fancy_gallery_links.fancybox({
            transitionIn: 'none',
            transitionOut: 'none',
            titlePosition: 'inside',
            titleFormat: function(title, currentArray, currentIndex, currentOpts) {
                var result = title;
                if(currentArray.length > 1) {
                    if (result) {
                        result += '<br>';
                    }
                    result += 'Изображение ' + (currentIndex + 1) + ' из ' + currentArray.length;
                }
                return result;
            },
            onStart: translate_fancy_controls
        });
    }
});