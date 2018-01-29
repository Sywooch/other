<? include('inc/sub_nav_config.php'); ?>

<h1><a href="config/build" class="muted">Конфигурация</a> / система</h1>

<!-- system update -->
<div class="box corner-all">
    <div class="box-header grd-orange color-white corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Общие</span>
    </div>

    <div class="box-body">
    </div>
</div>


<!-- caching configuration -->
<div class="box corner-all">
    <div class="box-header grd-orange color-white corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Кеширование</span>
    </div>

    <div class="box-body">

        <form class="form-horizontal inline_editable_form ot_form">

            <fieldset>

                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Внимание!</strong> Работает только на CRON'e! Звпуск вне CRON'а крайне нежелателен!
                    Перед первым запуском обязательно сохраните параметры для кэширования.
                </div>

        <div class="row-fluid">
            <div class="span6">

                <div class="control-group control-group-medium">
                    <label class="control-label">Ежедневное кэширование <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Установка времени суток по которому будет обновляться локальный кеш. Формат — часы:минуты"></i></label>
                    <div class="controls">
                        <a href="#" class="ot_inline_date_editable" data-pk="1" data-url="/post" data-viewformat="HH:mm" data-format="HH:mm" data-template="HH:mm" data-type="combodate"></a>
                        <!--
                         TODO:
                         — при редактировании выводить грамотное значение по умолчанию. Например 2:30 ночи. Я не допер как это сделать :(
                          -->
                    </div>
                </div>


                <div class="control-group control-group-medium">
                    <label class="control-label">Страницы на кэширование <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title="Локальная помощь"></i></label>
                    <div class="controls">
                        <a href="#" class="ot_inline_checklist_editable" data-type="checklist" data-pk="10" data-url="/post" data-original-title="Select options"></a>
                        <!--
                            Тут бы по-хорошему делать список в строчку, но это после того, как научимся кастомизировать вывод инлайновых элементов и появится лишнее время. Существующая реализация не слишком страшна чтобы критично было это сейчас допиливать
                         -->
                    </div>
                </div>


            </div>
            <div class="span6">


                <div class="control-group control-group-medium">
                    <label class="control-label">Сброс кеша <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></label>
                    <div class="controls">
                        <h5>Дефолтное состояние</h5>
                        <button type="button" class="btn btn_preloader btn-primary" data-loading-text="Выполняется очистка" autocomplete="off">Очистить</button>

                        <br><br>
                        <h5>При успешности действия</h5>
                        <button type="button" class="btn btn_preloader btn-primary" data-loading-text="Выполняется очистка" autocomplete="off">Очистить</button> →
                        <button type="button" class="btn btn_preloader btn-success" data-loading-text="Выполняется очистка" autocomplete="off">Очистить</button>
                        <p class="help-inline text-success">Кеш успешно очищен!</p>

                        <br><br>
                        <h5>При проблеме выполнения действия</h5>
                        <button type="button" class="btn btn_preloader btn-primary _btn-success" data-loading-text="Выполняется очистка" autocomplete="off">Очистить</button> →
                        <button type="button" class="btn btn_preloader btn-danger" data-loading-text="Выполняется очистка" autocomplete="off">Очистить</button>
                        <p class="help-inline text-error"><i class="icon-minus-sign"></i> Ошибка очистки кеша. <a
                                href="#" class="blink ot_show_modal_dialog">Напишите</a> о проблеме в службу поддержки.</p>

                    </div>
                </div>


            </div>
        </div>




            </fieldset>

        </form>

    </div>
</div>

<!-- system update -->
<div class="box corner-all">
    <div class="box-header grd-orange color-white corner-top">
        <div class="header-control">
            <a data-box="collapse"><i class="icon-caret-up"></i></a>
        </div>
        <span>Обновление</span>
    </div>

    <div class="box-body">
    </div>
</div>