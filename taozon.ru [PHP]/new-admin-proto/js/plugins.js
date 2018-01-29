// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

/*  customize dataTable */
$(document).ready( function () {

    $('#data_table').dataTable( {
        //"bInfo": false, //disable table info
        //"bPaginate": false, //disable pagination
        //"bLengthChange": false, //disable electing items per page
        "oLanguage": { // localization
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Вывести _MENU_",
            "sZeroRecords":  "Записи отсутствуют.",
            "sInfo":         "Показано с _START_ по _END_ из _TOTAL_ записей",
            "sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix":  "",
            "sSearch":       "Поиск по содержанию",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Первая",
                "sPrevious": "",
                "sNext": "",
                "sLast": "Последняя"
            }
        }
    } );

    /* tables only with sorting */
    $('.data_table_sorting').dataTable( {
        "bInfo": false, //disable table info
        "bPaginate": false, //disable pagination
        "bLengthChange": false, //disable electing items per page
        "bFilter": false, //disable filtering
//        "bSort": false, //disable sorting
        "oLanguage": { // localization
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Вывести _MENU_",
            "sZeroRecords":  "Записи отсутствуют.",
            "sInfo":         "Показано с _START_ по _END_ из _TOTAL_ записей",
            "sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix":  "",
            "sSearch":       "Поиск по содержанию",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Первая",
                "sPrevious": "",
                "sNext": "",
                "sLast": "Последняя"
            }
        }
    } );

} );



// scrolling event
$(window).scroll(function() {
    // this for hide/show button to-top
    if($(this).scrollTop() > 200) {
        $('a[rel=go_to_top]').fadeIn('slow');
    } else {
        $('a[rel=go_to_top]').fadeOut('slow');
    }
});

// scroll to top
$('a[rel=go_to_top]').click(function(e) {
    e.preventDefault();
    $('body,html').animate({
        scrollTop:0
    }, 'slow');
});



$(document).ready( function () {

    // fixing sub nav to the top
    /*$('.ot_sub_nav').waypoint('sticky', {
        wrapper: '<div class="sticky_ot_sub_nav" />',
        stuckClass: 'stuck',
        offset: 75
    });*/

    // fixing order sidebar to the top
    /*$('.ot_order_sidebar .well').waypoint('sticky', {
        wrapper: '<div class="sticky_order_sidebar" />',
        stuckClass: 'stuck',
        offset: 75 // Apply "stuck" when element 75px from top
    });*/

    // fixing support page sidebar to the top
    $('.ot_support_view_topic').portamento({
        wrapper: $('#wrapper'), // set #wrapper as the bottom boundary
        //gap: 14
    });

    /* tabdrop */
    $('.ot_sub_nav .nav-tabs').tabdrop()

    /* fix tables header to the top  */
    var tableElement = $('#data_table, .data_table_sorting');
    if(tableElement.length){
        var oTable = tableElement.dataTable();
    }

    if(typeof oTable !== 'undefined'){
        new FixedHeader( oTable, {
            "offsetTop": 0
        } );
    }

} );


// control box
// collapse a box
$('.header-control [data-box=collapse]').click(function(){
    var collapse = $(this),
        box = collapse.parent().parent().parent();

    collapse.find('i').toggleClass('icon-caret-up icon-caret-down'); // change icon
    box.find('.box-body').slideToggle(); // toggle body box
});

// collapse a blinked box
$('.box-blinked .box-header [data-box=collapse]').click(function(){
    var collapse = $(this),
        box = collapse.parent().parent();
//    collapse.parent().find('i').toggleClass('icon-minus icon-plus'); // change icon
    collapse.parent().find('i').toggleClass('icon-caret-down icon-caret-right'); // change icon
//    collapse.parent().find('i').toggleClass('icon-plus-sign icon-minus-sign'); // change icon
    box.find('.box-body').slideToggle(); // toggle body box
    return false;
});

// blinked spoiler
$('.ot-spoiler').click(function(){
    $(this).toggleClass("opened");
});

$('.ot-spoiler-iconed').click(function(){
    $(this).find('i').toggleClass('icon-caret-down icon-caret-right'); // change icon
});

// show sublist at ot_sortable_list pattern
$('.ot_sortable_sublist_spoiler').click(function(){
    $(this).find('i:nth-child(2)').toggleClass('icon-caret-right icon-caret-down'); // change icon
});



//bootstrap-editable init
$.fn.editable.defaults.mode = 'inline'; //turn to inline mode
$(document).ready( function () {

    $('.ot_inline_text_editable').editable({
        emptytext: 'Не заполнено'
    });

    $('.ot_inline_select_editable').editable({
        type: 'select',
        value: 1,
        source: [
            {value: 1, text: 'Отображать'},
            {value: 2, text: 'Скрывать'},
        ]
    });

    $('.ot_inline_select_editable_pure').editable({
        type: 'select',
        value: 1,
        showbuttons: false,
        source: [
            {value: 1, text: 'Отображать'},
            {value: 2, text: 'Скрывать'},
        ]
    });

    $('.ot_inline_textarea_editable').editable({
        url: '/post',
        title: 'Enter comments',
        rows: 5,
        emptytext: 'Не заполнено'
    });

    $(function(){
        $('.ot_inline_date_editable').editable({
                format: 'yyyy-mm-dd',
                viewformat: 'dd/mm/yyyy',
                emptytext: 'Не установлено',
                datepicker: {
                    weekStart: 1
                }
            }
        );
    });

    $(function(){
        $('.ot_inline_checklist_editable').editable({
            emptytext: 'Не установлено',
            source: [
                {value: 1, text: '1-й уровень'},
                {value: 2, text: '2-й уровень'},
                {value: 3, text: '3-й уровень'}
            ]
        });
    });

    /* adding user to discount list */
    $(function(){

        $('.ot-typehead-users').editable({
            mode: 'popup',
            title: 'Начните печатать логин...',
            placeholder: 'Start typing an user login',
            emptytext : '',
            inputclass: 'input-medium',
            source: [
                {value: 'gb', text: 'VasiaPupkin'},
                {value: 'us', text: 'NikitaGigurda'},
                {value: 'ru', text: 'qweqwe-385'},
                {value: 'cn', text: 'ChuckNorris'},
                {value: 'em', text: 'EdwardMurphy'}
                ]
            });

        $('.ot_change_product_price').editable({
            placeholder: 'Введите новую цену товара',
            mode: 'popup',
            emptytext : '',
            inputclass: 'input-mini',
            source: []
        });

        $('.ot_change_product_weight').editable({
            placeholder: 'Введите новый вес товара',
            mode: 'inline',
            emptytext : '',
            inputclass: 'input-mini',
            source: []
        });

        $('.ot_change_product_config').editable({
            type: 'select',
            mode: 'popup',
            value: 1,
            source: [
                {value: 1, text: '1189 мандариновый'},
                {value: 2, text: '1139 апельсиновый'},
                {value: 3, text: '1333 незрелый плод авокадо'}
            ]
        });

        $('.ot_currency_rate_sync').editable({
            type: 'select',
            mode: 'inline',
            inputclass: 'input-xlarge',
            value: 1,
            source: [
                {value: 1, text: 'Синхронизируются с ЦБ РФ'},
                {value: 2, text: 'Синхронизируются с google'},
                {value: 3, text: 'Синхронизируются с Хабом'},
                {value: 4, text: 'Без синхронизации (задаются вручную)'}
            ]
        });

        $('.ot_inline_popup_text_editable').editable({
            emptytext: 'Не заполнено',
            mode: 'popup'
        });


        $('.ot_sortable_list_editable').editable({
            emptytext: 'Не заполнено',
            type: 'text',
            mode: 'inline',
            inputclass: 'input-block-level',
            clear: false
        });
        $('.ot_editable_name .icon-pencil').click(function( e ) {
            e.stopPropagation();
            e.preventDefault();
            var globalBtnTpl = $.fn.editableform.buttons;
            $.fn.editableform.buttons = '<button type="submit" class="btn editable-submit btn-mini" title="Сохранить"><i class="icon-ok"></i></button>';//modify buttons style
            $('.ot_sortable_list_editable').editable('toggle');
            $.fn.editableform.buttons = globalBtnTpl;
        });

        $('.ot_chose_product_editable').editable({
            type: 'text',
            mode: 'inline',
            clear: false,
//            emptytext: 'Выбрать существующий товар',
            escape: true,
            placeholder: 'Введите ссылку на товар на сайте',
//            inputclass: 'input-block-level'
            inputclass: 'input-xxlarge'
        });

        $('.ot_cat_filters_editable').editable({
            type: 'text',
            mode: 'inline',
            clear: false,
            inputclass: 'input-large',
        });

        $('.ot_cat_nav_elements_editable').editable({
            type: 'text',
            mode: 'inline',
            clear: false,
            emptytext: 'Все',
            inputclass: 'input-mini'
        });

        $('.ot_cat_nav_style_editable').editable({
            type: 'select',
            mode: 'inline',
            clear: false,
            emptytext: 'Все',
            inputclass: 'input-medium',
            value: 1,
            source: [
                {value: 1, text: 'Статическая (список категорий)'},
                {value: 2, text: 'Выпадающая (два уровня)'},
                {value: 3, text: 'Выпадающая (три уровня)'},
            ]
        });

    });



    //sortable elements
    $(".ot_sortable_list").sortable({
        handle: 'i.icon-move'
        });

    $(".ot_sortable").sortable({
        handle: '.sortable_handler'
    });

    $/*(".ot_sortable_rows").sortable({
        handle: '.handler'
    });

    $(".ot_sortable_cols").sortable({
        handle: '.handler'
    });*/



    var adjustment
    $(".ot_sort_n_drop").sortable({
//        handle: 'i.icon-move',
//        group: 'simple_with_animation',
//        pullPlaceholder: false,

        // animation on drop
        onDrop: function  (item, targetContainer, _super) {
            var clonedItem = $('<li/>').css({height: 0})
            item.before(clonedItem)
            clonedItem.animate({'height': item.height()})

            item.animate(clonedItem.position(), function  () {
                clonedItem.detach()
                _super(item)
            })
        },

        // set item relative to cursor position
        onDragStart: function ($item, container, _super) {
            var offset = $item.offset(),
                pointer = container.rootGroup.pointer

            adjustment = {
                left: pointer.left - offset.left,
                top: pointer.top - offset.top
            }

            _super($item, container)
        },
        onDrag: function ($item, position) {
            $item.css({
                left: position.left - adjustment.left,
                top: position.top - adjustment.top
            })
        }
    })

} );

/* select2 */
var preload_data = [
    { id: 'ru', text: 'Русский (Russian)', locked: true},
    { id: 'en', text: 'English (English)'},
    { id: 'mn', text: 'Монгол хэл (Mongolian)'},
    { id: 'cn', text: '??? (Chinese)'},
    { id: 'es', text: 'Espa?ol (Spanish)'},
    { id: 'de', text: 'Deutsch (German)' },
    { id: 'pt', text: 'Portugu?s (Portuguese)' },
    { id: 'bg', text: 'Български (Bulgarian)' },
    { id: 'il', text: '????? (Hebrew)'},
    { id: 'am', text: '??????? (Armenian)' },
    { id: 'saha', text: 'Саха тыла (Yakut)' },
    { id: 'pl', text: 'Jezyk polski, polszczyzna (Polish)' },
    { id: 'ge', text: '??????? ??? (Georgian)' }
];

$(document).ready(function () {
    $('#showcase_languages').select2({
        multiple: true,
        placeholder: 'Select a State',
        query: function (query){
            var data = {results: []};

            $.each(preload_data, function(){
                if(query.term.length == 0 || this.text.toUpperCase().indexOf(query.term.toUpperCase()) >= 0 ){
                    data.results.push({id: this.id, text: this.text });
                }
            });

            query.callback(data);
        }
    });
    $('#showcase_languages').select2('data', preload_data )
});

//$(document).ready(function() { $(".ot_form select").select2(); }); // Это бы для внешнего вида только, без поиска
$(document).ready(function() { $(".select_searched_list").select2(); }); // А это бы, когда актуален поиск по списку

// a variable for typehead list
var typeahead_list = ['PHP', 'MySQL', 'SQL', 'PostgreSQL', 'HTML', 'CSS', 'HTML5', 'CSS3', 'JSON'];
var typeahead_brands_list = ['Adidas (id-11509, 80 765 890 товаров)', 'Gap', 'Ecco', 'Benetton', 'Dunhill', 'Puma', 'Abibas/艾丹戴维斯', 'Sreebok/锐步', 'Nike/耐克 (id-20578, 8 765 890 товаров)'];

$("#ot_brands_list").typeahead({source: typeahead_brands_list});
$("#ot_user_login_filter").typeahead({source: typeahead_list});
$("#ot_user_account_filter").typeahead({source: typeahead_list});
$("#ot_user_second_name_filter").typeahead({source: typeahead_list});
$("#ot_user_email_filter").typeahead({source: typeahead_list});
$("#ot_user_phone_filter").typeahead({source: typeahead_list});
$("#ot_user_city_filter").typeahead({source: typeahead_list});
$("#ot_user_country_filter").typeahead({source: typeahead_list});


/* enable datepicker */
var startDate = new Date(2012,1,20);
var endDate = new Date(2012,1,25);
$('#date-start')
    .datepicker()
    .on('changeDate', function(ev){
        if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('Дата начала должна быть раньше даты конца');
        } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#date-start-display').text($('#date-start').data('date'));
        }
        $('#date-start').datepicker('hide');
    });
$('#date-end')
    .datepicker()
    .on('changeDate', function(ev){
        if (ev.date.valueOf() < startDate.valueOf()){
            $('#alert').show().find('strong').text('Дата конца должна быть позже даты начала.');
        } else {
            $('#alert').hide();
            endDate = new Date(ev.date);
            $('#date-end-display').text($('#date-end').data('date'));
        }
        $('#date-end').datepicker('hide');
    });


$(document).ready(function() {
    $('.ot_product_img_carousel').carousel({
//      interval: 200
        interval: false
    })
});

/* improve loook of select elements */
$('.selectpicker').selectpicker();


/* ladda plugin  */
// Bind normal buttons
Ladda.bind( '.ladda-button', { timeout: 2000 } );
// Bind progress buttons and simulate loading progress
Ladda.bind( '.ladda-progress-button', {
    callback: function( instance ) {
        var progress = 0;
        var interval = setInterval( function() {
            progress = Math.min( progress + Math.random() * 0.1, 1 );
            instance.setProgress( progress );

            if( progress === 1 ) {
                instance.stop();
                clearInterval( interval );
            }
        }, 200 );
    }
} );


/* ini jstree */
//$.jstree._themes = "img/vendor/jstree/";
$(".ot_tree").jstree({
    "themes" : {
            "theme" : "classic"
        },
    "plugins" : [ "themes", "html_data", "ui", "hotkeys", "dnd"/*, "contextmenu"*/ ]
});


/*selects autoresize*/
$(document).ready(function() {
    $(".ot_autosized_textarea").autosize();
});