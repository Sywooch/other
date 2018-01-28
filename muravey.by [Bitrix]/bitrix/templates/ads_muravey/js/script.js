//js для выбора формы критерия поиска
$(document).ready(function () 
{
//    $('#bclient').hide();
//    $('#btransfer').hide();

    $('#bclient-a').click(function (event) {
        event.preventDefault();
        $('#btransfer').hide();
        $('#bclient').show();
    });

    $('#btransfer-a').click(function (event) {
        event.preventDefault();
        $('#bclient').hide();
        $('#btransfer').show();
    });
    
    $('#example123').timepicker({
        timeOnlyTitle: 'Выберите время',
        timeText: 'Время',
        hourText: 'Часы',
        minuteText: 'Минуты',
        secondText: 'Секунды',
        currentText: 'Сейчас',
        closeText: 'Закрыть'
    });
    
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '<Пред',
        nextText: 'След>',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
        'Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);


    $.timepicker.regional['ru'] = {
        timeOnlyTitle: 'Выберите время',
        timeText: 'Время',
        hourText: 'Часы',
        minuteText: 'Минуты',
        secondText: 'Секунды',
        millisecText: 'Миллисекунды',
        timezoneText: 'Часовой пояс',
        currentText: 'Сейчас',
        closeText: 'Закрыть',
        timeFormat: 'HH:mm',
        amNames: ['', ''],
        pmNames: ['', ''],
        isRTL: false
    };
    
    $.timepicker.setDefaults($.timepicker.regional['ru']);
    
    $('.clickable_row tr td:not(.no_clickable_td)').click(function(e)
    {
        e.preventDefault();
        
        href = $(this).closest('tr').find('.title-category-s a').attr('href');
        if (href != null)
            location.assign(href);
        
        return false;
    });

    window.CheckInterval = setInterval('SendCheckQuery()', 30000);
});

var CheckFirstRun = true;
function SendCheckQuery()
{
    if (CheckFirstRun)
    {
        CheckFirstRun = false;
        clearInterval(window.CheckInterval);
    }
        
    $.ajax(
    {
        url: "/ajax/check_last_add_id.php",
        type: "POST",
        dataType: "json"
    })
    .done(function(json) 
    {
        if (!json.ACTUAL)
        {
            if (confirm('За время вашего пребывания на сайте появились новые объявления.\n\nПерейти в каталог заказов?'))
            {
                location.assign('/catalog/');
            }
        }
    });
}