$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {

        var language = $('#languages-filter').val();
        var translationTypeFilter = false;

        var translationType = $('#translations-type-filter').val();
        if(translationType){
            $(aData[2]).each(function(){
                if(language == $(this).attr('data-lang') && translationType == 'own' && $(this).hasClass('label-success')){
                    translationTypeFilter = true;
                    return false;
                }
                else if(language == $(this).attr('data-lang') && translationType == 'no' && $(this).hasClass('label-warning')){
                    translationTypeFilter = true;
                    return false;
                }
                else if(language == $(this).attr('data-lang') && translationType == 'box' &&
                    (!$(this).hasClass('label-warning') && !$(this).hasClass('label-success'))){
                    translationTypeFilter = true;
                    return false;
                }
            });
        }
        else{
            translationTypeFilter = true;
        }

        var textFilter = true;
        var text = $('#text-filter').val();
        if(text){
            if(aData && aData[0] && aData[1]){
                textFilter = (aData[0].indexOf(text) != -1) || (aData[1].indexOf(text) != -1);
            }
            else if(aData && aData[0]){
                textFilter = (aData[0].indexOf(text) != -1);
            }
            else{
                textFilter = false;
            }
        }

        return textFilter && translationTypeFilter;
    }
);

function InitDataTable(url){
    oTable = $('#translations_table').dataTable( {
        //"bFilter": false,
        "bDestroy": true,
        "bProcessing": true,
        "sAjaxSource": url,
        "oLanguage": { // localization
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Вывести _MENU_ записей на страницу",
            "sZeroRecords":  "Записи отсутствуют.",
            "sInfo":         "Показано с _START_ по _END_ из _TOTAL_ записей",
            "sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix":  "",
            "sSearch":       "Поиск по содержанию:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Первая",
                "sPrevious": "Предыдущая",
                "sNext": "Следующая",
                "sLast": "Последняя"
            }
        }
    } );
}

function InitDataTableWithActiveLang(){
    InitDataTable("index.php?cmd=Translations&do=getTranslationsJSON&lang=" + $('#languages-filter').val());
}

function TranslationsAreaView(view){
    var area = $('#translation_area');

    if (view == 'show') {
        area.show();
    }
    if (view == 'hide') {
        area.hide();
    }
}

$(function(){
    //TranslationsAreaView('hide');

    $(document).keydown(function(evt) {
        // press Enter
        if (evt.keyCode == 13) {
            evt.preventDefault();
            $('#filter-submit').click();
        }
    });

    $(document).on('click', 'a[data-action="delete"]',function(){
        var key = $(this).attr('data-key');
        var loader = $(this).find('i.icon-trash img');
        loader.show();

        $.get('index.php', {
            'cmd': 'Translations',
            'do': 'delete',
            'key': key
        }, function(data){
            if (! data.error) {
                $('.label-success[data-key="'+key+'"]').removeClass('label-success').addClass('label-warning');
                loader.hide();
				InitDataTableWithActiveLang();
            } else {
                loader.hide();
                showError(data);                
            }
        });
        return false;
    });

    InitDataTable("index.php?cmd=Translations&do=getTranslationsJSON");

    $('#text-filter').keyup(function(){
        TranslationsAreaView('show');
        oTable.fnDraw();
    });

    $('#filter-submit').click(function(){
        TranslationsAreaView('show');
        oTable.fnDraw();
    });

    $('#translations-type-filter').change(function(){
        TranslationsAreaView('show');
        oTable.fnDraw();
    });

    $('#languages-filter').change(function(){
        TranslationsAreaView('show');
        setTimeout(InitDataTableWithActiveLang, 10);
    });
});