
<ul class="breadcrumb">
    <li><a href="."><i class="icon-home"></i></a> <span class="divider">›</span></li>
    <li><a href="config/build">Конфигурация</a> <span class="divider">›</span></li>
    <li><a href="config/system/general">Cистема</a> <span class="divider">›</span></li>
    <li class="active">Обновление</li>
</ul>
<!--/.breadcrumb-->

<? include('inc/sub_nav_config.php'); ?>

<!-- ot-sub-sub-nav -->
<div class="tabbable ot_sub_sub_nav">
    <ul class="nav nav-pills">
        <li><a href="config/system/general">Общие</a></li>
        <li><a href="config/system/cache">Кеширование</a></li>
        <li class="active"><a href="config/system/update">Обновление</a></li>
    </ul>
</div><!-- /ot-sub-sub-nav -->


<h1>Обновление</h1>

<div class="well">

    <!-- В ситуации, когда текущая версия устарела и есть версия для обновления -->
    <h3>Автоматическое обновление системы</h3>
    <p><strong class="label label-info">0.8</strong> — текущая установленная версия</p>
    <p><strong class="label label-success" title="Версия совместима с вашей системой">1.1</strong> — последняя доступная версия для обновления (<span data-target=".collapse-chengelog-111" data-toggle="collapse" class="blink">история изменений</span>)</p>
    <div class="collapse collapse-chengelog-111">
        <h4>Описание изменений</h4>
        <ul>
            <li>Исправлено включение верстки справа налево для определенных языков</li>
            <li>Исправлено формирование robots.txt, пример нового файла для индексации сайта будет расположен в <code>robots_example.txt</code></li>
            <li>Исправлена выгрузка заказов для сайтов, у который выставлены свои префиксы для заказов</li>
            <li>Исправлена ошибка с загрузкой изображений в текстовые страницы</li>
            <li>Исправлена выгрузка в эксель у тех, у кого выгружались пустые файлы</li>
            <li>Изменен порядок полей ФИО в ЛК пользователей — <a href="http://forum.opentao.net/forums/showthread.php?t=46195">http://forum.opentao.net/forums/showthread.php?t=46195</a></li>
            <li>Добавлена Капча при входе в админ-панель. Задается в настройках в админ</li>
            <li>Исправлено ценообразование NEW — в Опере были неактивны кнопки редактирования и удаления последней ценовой группы</li>
            <li>Исправлен ряд ошибок с уведомлениями в админке</li>
        </ul>
    </div>
    <p class="offset-top2">
        <button type="button" class="btn btn_preloader btn-primary" data-loading-text="Выполняется обновление" autocomplete="off">Обновить</button>
    </p>

    <hr><!-- the divider in prototype to separate different conditions of the page-->

    <!-- В ситуации, когда текущая версия является обновленной и последней -->
    <h3>Автоматическое обновление системы</h3>
    <p><strong class="label label-success" title="Версия совместима с вашей системой">1.1</strong> — установлена самая свежая версия. Обновление не требуется.</p>

    <hr><!-- the divider in prototype to separate different conditions of the page-->
    <!-- В ситуации, когда текущая версия устарела, а последняя версия не рекомендуется для обновления -->
    <h3>Автоматическое обновление системы</h3>
    <p><strong class="label label-info">0.8</strong> — текущая установленная версия</p>
    <p><strong class="label label-important" title="Версия несовместима с вашей системой и не рекомендуется к обновлению">1.1</strong> — последняя доступная версия для обновления (<span data-target=".collapse-chengelog-111-alt" data-toggle="collapse" class="blink">история изменений</span>)</p>
    <div class="collapse collapse-chengelog-111-alt">
        <h4>Описание изменений</h4>
        <ul>
            <li>Исправлено включение верстки справа налево для определенных языков</li>
            <li>Исправлено формирование robots.txt, пример нового файла для индексации сайта будет расположен в <code>robots_example.txt</code></li>
            <li>Исправлена выгрузка заказов для сайтов, у который выставлены свои префиксы для заказов</li>
            <li>Исправлена ошибка с загрузкой изображений в текстовые страницы</li>
            <li>Исправлена выгрузка в эксель у тех, у кого выгружались пустые файлы</li>
            <li>Изменен порядок полей ФИО в ЛК пользователей — <a href="http://forum.opentao.net/forums/showthread.php?t=46195">http://forum.opentao.net/forums/showthread.php?t=46195</a></li>
            <li>Добавлена Капча при входе в админ-панель. Задается в настройках в админ</li>
            <li>Исправлено ценообразование NEW — в Опере были неактивны кнопки редактирования и удаления последней ценовой группы</li>
            <li>Исправлен ряд ошибок с уведомлениями в админке</li>
        </ul>
    </div>
    <div class="text-error">
        <p> <i class="icon-warning-sign"></i> При автоматическом обновлении работоспособность системы не гарантируется. Возможны дисфункции в следующих концептах:</p>
        <ul>
            <li>Верстка сайта</li>
            <li>Заказы</li>
            <li>Отображение цен на товары</li>
            <li>Отображение списка товаров</li>
        </ul>
        <p>Советуем вам <span class="blink ot_show_modal_dialog">обратиться</span> в службу поддержки по решению данного вопроса средствами специалистов. <i class="icon-question-sign ot_inline_help" data-toggle="popover" data-placement="top" data-content="Это локальная подсказка, призванная пояснять пользователям назначение элементов." title="" data-original-title=""></i></p>
    </div>
    <p class="offset-top2">
        <button type="button" class="btn btn_preloader btn-danger" data-loading-text="Выполняется опасное обновление" autocomplete="off">Все равно обновить!</button>
    </p>

    <hr><!-- the divider in prototype to separate different conditions of the page-->
    <!-- В ситуации, когда пользователь все-таки обновил движок до нерекомендуемой версии -->
    <h3>Автоматическое обновление системы</h3>
    <p><strong class="label label-important" title="Версия несовместима с вашей системой и не рекомендуется к обновлению">1.1</strong> — установлена самая свежая версия, однако система может работать нестабильно.</p>


    <div class="box box-blinked box-closed offset-top2">
        <div class="box-header corner-top">
            <i class="icon-caret-right color-blue font-14"></i>
            <a href="#" data-box="collapse" class="_font-14">
                Доступные предыдущие версии для обновления
            </a>
        </div>

        <div class="box-body">

            <ul class="unstyled">
                <li>
                    <h4>Версия <span class="label label-success" title="Версия совместима с вашей системой">1.0.4</span> <span class="muted">(31.12.2012)</span></h4>
                    <ul>
                        <li>Исправлено включение верстки справа налево для определенных языков</li>
                        <li>Исправлено формирование robots.txt, пример нового файла для индексации сайта будет расположен в <code>robots_example.txt</code></li>
                        <li>Исправлена выгрузка заказов для сайтов, у который выставлены свои префиксы для заказов</li>
                        <li>Исправлена ошибка с загрузкой изображений в текстовые страницы</li>
                        <li>Исправлена выгрузка в эксель у тех, у кого выгружались пустые файлы</li>
                        <li>Изменен порядок полей ФИО в ЛК пользователей — <a href="http://forum.opentao.net/forums/showthread.php?t=46195">http://forum.opentao.net/forums/showthread.php?t=46195</a></li>
                        <li>Добавлена Капча при входе в админ-панель. Задается в настройках в админ</li>
                        <li>Исправлено ценообразование NEW — в Опере были неактивны кнопки редактирования и удаления последней ценовой группы</li>
                        <li>Исправлен ряд ошибок с уведомлениями в админке</li>
                    </ul>
                </li>
                <li>
                    <h4>Версия <span class="label label-success" title="Версия совместима с вашей системой">1.0.3</span> <span class="muted">(31.11.2012)</span></h4>
                    <ul>
                        <li>Исправлено включение верстки справа налево для определенных языков</li>
                        <li>Исправлено формирование robots.txt, пример нового файла для индексации сайта будет расположен в <code>robots_example.txt</code></li>
                        <li>Исправлена выгрузка заказов для сайтов, у который выставлены свои префиксы для заказов</li>
                        <li>Исправлена ошибка с загрузкой изображений в текстовые страницы</li>
                        <li>Исправлена выгрузка в эксель у тех, у кого выгружались пустые файлы</li>
                        <li>Изменен порядок полей ФИО в ЛК пользователей — <a href="http://forum.opentao.net/forums/showthread.php?t=46195">http://forum.opentao.net/forums/showthread.php?t=46195</a></li>
                        <li>Добавлена Капча при входе в админ-панель. Задается в настройках в админ</li>
                        <li>Исправлено ценообразование NEW — в Опере были неактивны кнопки редактирования и удаления последней ценовой группы</li>
                        <li>Исправлен ряд ошибок с уведомлениями в админке</li>
                    </ul>
                </li>
                <li>
                    <h4>Версия <span class="label label-important" title="Версия несовместима с вашей системой и не рекомендуется к обновлению">1.0.2</span> <span class="muted">(31.10.2012)</span></h4>
                    <ul>
                        <li>Исправлено включение верстки справа налево для определенных языков</li>
                        <li>Исправлено формирование robots.txt, пример нового файла для индексации сайта будет расположен в <code>robots_example.txt</code></li>
                        <li>Исправлена выгрузка заказов для сайтов, у который выставлены свои префиксы для заказов</li>
                        <li>Исправлена ошибка с загрузкой изображений в текстовые страницы</li>
                        <li>Исправлена выгрузка в эксель у тех, у кого выгружались пустые файлы</li>
                        <li>Изменен порядок полей ФИО в ЛК пользователей — <a href="http://forum.opentao.net/forums/showthread.php?t=46195">http://forum.opentao.net/forums/showthread.php?t=46195</a></li>
                        <li>Добавлена Капча при входе в админ-панель. Задается в настройках в админ</li>
                        <li>Исправлено ценообразование NEW — в Опере были неактивны кнопки редактирования и удаления последней ценовой группы</li>
                        <li>Исправлен ряд ошибок с уведомлениями в админке</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</div>


<!-- Системные уведомления на все случаи жизни -->

<!-- Все получилось! -->
<div class="alert alert-success">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Система успешно обновлена!
</div>

<!-- Обновиться получилось, но хрен его знает где что могло сломаться -->
<div class="alert">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Система успешно обновлена, однако могут возникнуть проблемы с её корректной работой.
</div>

<!-- Ничего не получилось :( -->
<div class="alert alert-danger">
    <button data-dismiss="alert" class="close" type="button">×</button>
    Обновление системы завершилось неудачей.
</div>


