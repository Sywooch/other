/**
 * Общие функции для новой админки
 *
 * Перед изменением/удалением убедитесь, что после Ваших действий ничего не отвалится!
 * Файл заведён для того, чтобы не пересекаться с js скриптами верстальщика (plugins.js, ot-app.js)
**/

var showMessage = function (message, isError, dontHide) {
    var title = 'undefined' !== typeof isError ? trans.get('Error') : trans.get('InfoMessage');
    var type = 'undefined' !== typeof isError ? 'error' : 'success';    
    $.pnotify({
        title: title,
        text: message,
        history: false,
        hide: !! ('undefined' === typeof dontHide || !dontHide),
        sticker: false,
        delay: 5000,
        type: type
    });
}

var showError = function (data, dontHide) {
    var errorMessage = trans.get('Notify_error');
    if ('string' === typeof data) {
        errorMessage = data;
    } else if (data.message) {
        errorMessage = data.message;
    } else if (data.errors) {
        // Это массив ошибок, который нам отдаёт Validator.
        var _errorMessages = [];
        $.each(data.errors, function(i, error){
            if ('undefined' !== typeof error.key) {
                var selector = $('#' + error.key).length ? error.key : 'ot_' + error.key;
                $("#" + selector).addClass('validation-error');
            }
            _errorMessages.push(error.message);
        });
        errorMessage = _errorMessages.join('<br/>');
    }
    showMessage(errorMessage, true, dontHide);
}


var showStickyMessage = function (message) {
    var currentHeight = $(window).height();    
    var title = trans.get('InfoMessage');
    var type = 'error';
    var stack_var = {"dir1": "down", "dir2": "right", "push": "bottom", "firstpos1": currentHeight - 80, "firstpos2": 5};
    $.pnotify({
        title: title,
        text: message,
        history: false,
        hide: false,
        sticker: false,
        delay: 5000,
        type: type,
        stack: stack_var
    });
}

var getUrlHash = function (prefix) {
    var url = $.deparam.querystring();
    var action = (url.do || 'default').toLowerCase();
    var controller = (url.cmd || 'orders').toLowerCase();
    if (controller === 'orders') {
        action = action === 'default' ? 'list' : action;
    }
    var hash = controller + '_' + action;
    return ('undefined' !== typeof prefix ? prefix.toString() : '') + '__' + hash.toLowerCase();
}

//onShowCallback - функция вызываемая после открытия окна без подтвеождения пользователем
//level - уровень окна над другими подобными окнами
var modalDialog = function (title, content, onConfirmCallback, buttons, onShowCallback, level) {
    if ('undefined' == typeof level) {
        var level = 1;
    }
    var element = $(".confirmDialog-tpl").clone().removeClass("confirmDialog-tpl").addClass(level + '-confirmDialog').addClass('level-' + level);
    var dialog = element;
    dialog.find('.modal-header h3').html(title);
    dialog.find('.modal-body').html(content);
    if ('object' === typeof buttons) {
        if ('undefined' !== typeof buttons.confirm) {
            if (false !== buttons.confirm) {
                dialog.find('#confirm').html(buttons.confirm).show();
            } else {
                dialog.find('#confirm').hide();
            }
        }
        if ('undefined' !== typeof buttons.cancel) {
            dialog.find('#cancelBtn').html(buttons.cancel);
        }
    }
    dialog.find('#confirm').off().on('click', function () {
        if ('function' === typeof onConfirmCallback) {
            var callbackResult = onConfirmCallback(dialog.find('.modal-body'));
            // Если колбэк вернул false, то считаем,
            // что произошла ошибка, которая показана пользователю.
            // Поэтому окно не закрываем, чтобы дать пользователю возможность исправить ошибку
            if (false !== callbackResult) {
                dialog.find('.close').trigger('click');
            }
        } else {
            dialog.find('.close').trigger('click');
        }
    });

    // При скрытии диалогового окна восстановим его начальное состояние.
    dialog.off('hidden.restoreDefaults').on('hidden.restoreDefaults', function(){
        dialog.find('#confirm').html(trans.get('Yes')).show();
        dialog.find('#cancelBtn').html(trans.get('Cancel')).show();
        dialog.find('.modal-header h3, .modal-body').empty();
        element.remove();
    });

    if ('function' === typeof onShowCallback) {
        dialog.on('shown', onShowCallback(dialog.find('.modal-body')));
    }

    return dialog.modal();
}


// вызов окна подтверждения действия
var confirmDialog = function (text, func) {
    $('.confirmDialog').modal();
    $('.confirmDialog .modal-body').html(text);

    $('.confirmDialog #confirm').off().on('click', function () {
        if ($.type(func) == 'function') {
            func();
        }
        $('.confirmDialog .close').trigger('click');
    });
}

// @DEPRECATED: use confirmDialog
var confirm_dialog = function (text, func) {
    showError('DEPRECATED. Use confirmDialog instead');
    return;
}

/**
 * escape через jquery
**/
var escapeData = function (text) {
    var decoded = jQuery('<div />').text(text).html();
    decoded = decoded.replace(/'/g, '&#039;').replace(/\"/g, '&quot;');
    return decoded;
}

var decodeData = function (text) {
    return jQuery('<div />').html(text).text();
}

$(function(){
    // control box
    // collapse a box    
    $('.header-control [data-box=collapse]').each(function(){
        var collapse = $(this),
            box = collapse.parents('.box:first'),
            index = $('.header-control [data-box=collapse]').index(this),
            cookieName = getUrlHash('collapseBoxIsOpened_' + index);

        collapse.on('click', function(){
            $(this).find('i').toggleClass('icon-caret-up icon-caret-down'); // change icon
            box.find('.box-body').slideToggle(function(){
                // запомнить открытые/закрыте раскладушки
                $.cookie(cookieName, box.find('.box-body').is(':visible'), { expires: 30, path: '/' });
            }); // toggle body box
        });

        if ($.cookie(cookieName) === 'false') {
            box.find('.box-body').hide();
        }
    });

    // collapse a blinked box
    $('.box-blinked .box-header [data-box=collapse]').each(function(){
        var collapse = $(this),
            box = collapse.parents('.box:first'),
            index = $('.box-blinked .box-header [data-box=collapse]').index(this),
            cookieName = getUrlHash('collapseBlinkedBoxIsOpened_' + index);

        collapse.on('click', function(){
            $(this).parent().find('i').toggleClass('icon-minus icon-plus'); // change icon
            box.find('.box-body').slideToggle(function(){
                // запомнить открытые/закрыте раскладушки
                $.cookie(cookieName, box.find('.box-body').is(':visible'), { expires: 30, path: '/' });
            }); // toggle body box
            return false;
        });

        if ($.cookie(cookieName) === 'false') {
            box.find('.box-body').hide();
        }
    });

    // запомнить открытые вкладки
    $('.tabbable ul.nav-tabs').each(function(i) {
        var storage = localStorage.getItem('tab'+i) || 0;
        $(this).find('li').eq(storage).addClass('active').siblings().removeClass('active')
            .parents('.tabbable').find('div.tab-pane').hide().eq(storage).show();
    });

    $('.tabbable ul.nav-tabs').delegate('li:not(.active)', 'click', function() {
        $(this).addClass('active').siblings().removeClass('active')
            .parents('.tabbable').find('div.tab-pane').eq($(this).index()).fadeIn(150).siblings('div.tab-pane').hide();
        var ulIndex = $('.tabbable ul.nav-tabs').index($(this).parents('.tabbable ul.nav-tabs'));
        localStorage.removeItem('tab'+ulIndex);
        localStorage.setItem('tab'+ulIndex, $(this).index());
    });

    $('.tabbable-ajax ul.nav-tabs').delegate('li:not(.active)', 'click', function() {
        $(this).addClass('active').siblings().removeClass('active')
            .parents('.tabbable-ajax').find('div.tab-pane').eq($(this).index()).fadeIn(150).siblings('div.tab-pane').hide();
        var cookieName = getUrlHash('active_ajax_tab');
        $.cookie(cookieName, $(this).data('type'), { expires: 30, path: '/' });
    });

    // выпадушка языковых версий сайта
    $('#activeLanguagesContainer').html($('#activeLanguages').html());

    // Количество элементов списка на страницу
    $('select#perpage, select.perpageSelect').on('change', function () {
        window.location.replace($.param.querystring(window.location.href, {perpage: $(this).val()}));
    });
});

$(document).ready(function(){
    $('body').livequery('.numeric', function (element) {
        $(element).numeric();
    });
    $('body').livequery('.price', function (element) {
        $(element).numeric({allow:"."});
    });
    $(document).on('click', '[data-toggle="collapse-custom"]', function (e) {
        var $this = $(this), href
          , target = $this.attr('data-target')
            || e.preventDefault()
            || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
          , option = $(target).data('collapse') ? 'toggle' : $this.data();
        if ($(target).hasClass('in')) {
            $this.addClass('collapsed');
            $(target).removeClass('in');
            $(target).hide();
        } else {
            $this.removeClass('collapsed');
            $(target).addClass('in');
            $(target).show();
        }
        return false;
    });

    // скрытие модальных окон по esc
    $(document).on('keyup', function(e){
        var code = e.keyCode || e.which;
        switch (code) {
            case 27: //esc
                $('.modal.hide.fade').each(function(){
                    if ($(this).is(':visible')) {
                        $(this).find('.close').trigger('click');
                    }
                });
            break;
            case 13: //enter
                e.preventDefault();
                $('.modal.hide.fade').each(function(){
                    if ($(this).is(':visible')) {
                        $(this).find('#confirm').trigger('click');
                    }
                });
            break;
        }
    });

    attachDatePicker('date-start', 'date-end', 'date-start-display', 'date-end-display');
    attachDatePicker('date-start-short', 'date-end-short', 'date-start-display-short', 'date-end-display-short');
});

/* enable datepicker */
var endDate = new Date();
var startDate = new Date(endDate.getFullYear(), endDate.getMonth(), endDate.getDate() - 1);
var dpOptions = {format: 'dd.mm.yyyy', weekStart: 1};
function attachDatePicker (startId, endId, startDisplayId, endDisplayId) {
    $('#' + startId)
        .datepicker(dpOptions)
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() > endDate.valueOf()){
                showError('Дата начала должна быть раньше даты конца');
            } else {
                startDate = new Date(ev.date);
                $('#' + startId).datepicker('setValue', startDate);
                $('#' + startDisplayId).val($('#' + startId).data('date'));
            }
            $('#' + startId).datepicker('hide');
        });
    $('#' + endId)
        .datepicker(dpOptions)
        .on('changeDate', function (ev) {
            if (ev.date.valueOf() < startDate.valueOf()){
                showError('Дата конца должна быть позже даты начала.');
            } else {
                endDate = new Date(ev.date);
                $('#' + endId).datepicker('setValue', endDate);
                $('#' + endDisplayId).val($('#' + endId).data('date'));
            }
            $('#' + endId).datepicker('hide');
        });
};

function handleAjaxError(message, code) {
    if (code == 'SessionExpired') {
        window.location.href = 'index.php?cmd=Login&do=logout';
    } else if (message.length) {
        showError(message);
    }
}

var showDebugLog = function (debugLog) {
    var moreLink = $('<a href="javascript:void(0)">Показать лог запросов</a>');
    //var stack_var = {"dir1": "down", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
    $.pnotify({
        title: trans.get('Debug log'),
        text: $('<i></i>').append(debugLog.title).append(moreLink).html(),
        history: false,
        hide: true,
        sticker: false,
        delay: 10000,
        type: 'info',
        //stack: stack_var,
        after_open: function (pnotify) {
            pnotify.find('a').on('click', function () {
                modalDialog(
                    trans.get('Debug log'),
                    debugLog.body,
                    function(){},
                    { confirm: false, cancel: trans.get('Close') }
                );
            });
        }
    });
}

function modalLoginOpen(){
    var dialog = $('.loginDialog');

    dialog.find('#confirm').off().on('click', function () {
        var modalBody = $('.modal-body', dialog);
        var form = modalBody.find('.ot_auth_form');
        var button = modalBody.parent().find('#confirm');
        var buttonClose = modalBody.parent().find('#cancelBtn');
        button.addClass('disabled');
        $.post(
                form.attr('action'),
                form.serialize(),
                function (data) {
                    if (! data.error) {
                        showMessage(data.message ? data.message : trans.get('Notify_success'));
                        dialog.find('.close').trigger('click');
                    } else {
                        modalLoginOpen();
                        showError(data);
                    }
                    button.removeClass('disabled');
                }, 'json'
        );
        return true;
    });

/*    dialog.off('hidden.restoreDefaults').on('hidden.restoreDefaults', function(){
        dialog.find('#confirm').html(trans.get('Yes')).show();
        dialog.find('#cancelBtn').html(trans.get('Cancel')).show();
        dialog.find('.modal-header h3, .modal-body').empty();
    });*/


    dialog.modal();

    return false;
}

    jQuery.ajaxSetup({
        beforeSend : function (xhr, settings) {
            var url = $.deparam.querystring();
            if ('undefined' !== typeof url.debug && url.debug) {
                if ('undefined' !== typeof settings.data && settings.data.indexOf('&debug=') == -1) {
                    settings.data += '&debug=1';
                }
                if ('undefined' !== typeof settings.url && settings.url.indexOf('&debug=') == -1) {
                    settings.url += (settings.url.indexOf('?') !== -1) ? '&debug=1' : '?debug=1';
                }
            }
            $('.validation-error').removeClass('validation-error');
        }
    });
    $(document).ajaxComplete(function (event, xhr, settings) {
        try {
            var response = $.parseJSON(xhr.responseText);
            if ('object' === typeof response) {
                if ('undefined' !== typeof response.expired) {
                    if (response.expired === 1) {
                        modalLoginOpen();
                        return false;
                    }
                } else {
                    if ('undefined' !== typeof response.redirect) {
                        window.location.replace(response.redirect);
                    }
                }
                if ('undefined' !== typeof response.debugLog) {
                    showDebugLog(response.debugLog);
                }
            }
        } catch (error) {}
    });
    $(document).ajaxError(function (xhr, settings, errorThrown) {
        var errorMessage = '';
        if (settings.status == 403) {
            errorMessage = 'Доступ ограничен';
        } else {
            if ((settings.statusText !== 'error') && (settings.statusText !== 'abort')) {
                errorMessage = 'Произошла ошибка в AJAX-запросе: ';
                if (settings.statusText.indexOf('__FACEPALM__') !== -1) {
                    errorMessage += '<img src="/i/facepalm.gif" alt="">';
                    settings.statusText = settings.statusText.replace(/__FACEPALM__/g, '');
                }
                errorMessage += (settings.statusText + ': ' + settings.responseText);
                errorMessage = errorMessage.replace(/__newline__/g, "\n");
            }
        }
        if (errorMessage.length) {
            showError(errorMessage, true);
        }
    });

//// Преобразует число в строку формата 1_separator000_separator000._decimal
// _number - число любое, целое или дробное не важно
// _decimal - число знаков после запятой
// _separator - разделитель разрядов
function sdf_FTS(_number, _decimal, _separator) {
    // определяем, количество знаков после точки, по умолчанию выставляется 2 знака
    var decimal=(typeof(_decimal)!='undefined')?_decimal:2;

    // определяем, какой будет сепаратор [он же разделитель] между разрядами
    var separator=(typeof(_separator)!='undefined')?_separator:'';

    // преобразовываем входящий параметр к дробному числу, на всяк случай, если вдруг
    // входящий параметр будет не корректным
    var r=parseFloat(_number)

    // так как в javascript нет функции для фиксации дробной части после точки
    // то выполняем своеобразный fix
    var exp10=Math.pow(10,decimal);// приводим к правильному множителю
    r=Math.round(r*exp10)/exp10;// округляем до необходимого числа знаков после запятой

    // преобразуем к строгому, фиксированному формату, так как в случае вывода целого числа
    // нули отбрасываются не корректно, то есть целое число должно
    // отображаться 1.00, а не 1
    rr=Number(r).toFixed(decimal).toString().split('.');

    // разделяем разряды в больших числах, если это необходимо
    // то есть, 1000 превращаем 1 000
    b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
    if (_decimal != 0) {
        r = b + '.' + rr[1];
    } else {
        r = b;
    }
    return r;// возвращаем результат
}