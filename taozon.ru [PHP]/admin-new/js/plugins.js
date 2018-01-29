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

    /*$('#data_table').dataTable( {
        //"bInfo": false, //disable table info
        //"bPaginate": false, //disable pagination
        //"bLengthChange": false, //disable electing items per page
        "oLanguage": { // localization
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Вывести _MENU_ записей на страницу",
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

    /* tables only with sorting
    $('.data_table_sorting').dataTable( {
        "bInfo": false, //disable table info
        "bPaginate": false, //disable pagination
        "bLengthChange": false, //disable electing items per page
        "bFilter": false, //disable filtering
//        "bSort": false, //disable sorting
        "oLanguage": { // localization
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Вывести _MENU_ записей на страницу",
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
    } );*/

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
        offset: 75 // Apply "stuck" when element 75px from top
    });*/

    /* tabdrop */
    $('.ot_sub_nav .nav-tabs').tabdrop()

    /* fix tables header to the top  */
    var tableElement = $('#data_table, #data_table_sorting');
    if(tableElement.length){
        //var oTable = tableElement.dataTable();
    }

    if(typeof oTable !== 'undefined'){
        new FixedHeader( oTable, {
            "offsetTop": 120
        } );
    }

} );


// control box
// collapse a box
/* НЕ ВОССТАНАВЛИВАТЬ. Переопределено в ot-common.js !
$('.header-control [data-box=collapse]').click(function(){
    var collapse = $(this),
        box = collapse.parent().parent().parent();

    collapse.find('i').toggleClass('icon-caret-up icon-caret-down'); // change icon
    box.find('.box-body').slideToggle(); // toggle body box
});

НЕ ВОССТАНАВЛИВАТЬ. Переопределено в ot-common.js !
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
*/

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
            {value: 3, text: 'Третьего не дано'}
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
        /*$.fn.editableform.buttons =
            '<button class="btn btn-mini btn-primary editable-submit" type="submit"><i class="icon-ok icon-white"></i></button>'+
            '<button class="btn btn-mini editable-cancel" type="button"><i class="icon-remove"></i></button>';
*/
        $('.ot-typehead-users').editable({
            mode: 'popup',
            title: 'Начните печатать логин...',
            placeholder: 'Start typing an user login',
//            clear: true,
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
        });

    //sortable elements
    $(".ot_sortable").sortable({
            handle: 'i.icon-move'
        });


    var adjustment
    $(".ot_sort_n_drop").sortable({
        handle: 'i.icon-move',
        group: 'simple_with_animation',
        pullPlaceholder: false,
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
    { id: 'cn', text: '中国的 (Chinese)'},
    { id: 'es', text: 'Español (Spanish)'},
    { id: 'de', text: 'Deutsch (German)' },
    { id: 'pt', text: 'Português (Portuguese)' },
    { id: 'bg', text: 'Български (Bulgarian)' },
    { id: 'il', text: 'עברית (Hebrew)'},
    { id: 'am', text: 'հայերէն (Armenian)' },
    { id: 'saha', text: 'Саха тыла (Yakut)' },
    { id: 'pl', text: 'Jezyk polski, polszczyzna (Polish)' },
    { id: 'ge', text: 'ქართული ენა (Georgian)' },
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
