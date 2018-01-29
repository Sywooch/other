<script type="text/javascript">

    /* enable portlets */

    // Init vars
    var closedBoxesCookiePrefix = "SimplensoClosedBoxes_";
    var boxPositionCookiePrefix = "SimplensoColumnBoxes_";
    var deletedBoxesCookiePrefix = "SimplensoDeletedBoxes_";
    var cookieExpiration = 365;


    $(document).ready(function(){


        // Control funtion for portlet (box) buttons clicks
        function setControls(ui) {
            //$('[class="box-btn"][title="toggle"]').click(function() {
            $('.box-btn').click(function() {
                var e = $(this);
                //var p = b.next('a');
                // Control functionality
                switch(e.attr('title').toLowerCase()) {
                    case 'config':
                        widgetConfig(b, p);
                        break;

                    case 'toggle':
                        widgetToggle(e);
                        break;

                    case 'close':
                        widgetClose(e);
                        break;
                }
            });
        }

        // Toggle button widget
        function widgetToggle(e) {
            // Make sure the bottom of the box has rounded corners
            e.parent().toggleClass("round-all");
            e.parent().toggleClass("round-top");

            // replace plus for minus icon or the other way around
            if(e.html() == "<i class=\"icon-plus\"></i>") {
                e.html("<i class=\"icon-minus\"></i>");
            } else {
                e.html("<i class=\"icon-plus\"></i>");
            }

            // close or open box
            e.parent().next(".box-container-toggle").toggleClass("box-container-closed");

            // store closed boxes in cookie
            var closedBoxes = [];
            var i = 0;
            $(".box-container-closed").each(function()
            {
                closedBoxes[i] = $(this).parent(".box").attr("id");
                i++;
            });
            $.cookie(closedBoxesCookiePrefix + $("body").attr("id"), closedBoxes, { expires: cookieExpiration });

            //Prevent the browser jump to the link anchor
            return false;

        }

        // Close button widget with dialog
        function widgetClose(e) {
            // get box element
            var box = e.parent().parent();

            // prompt user to confirm
            bootbox.confirm("Are you sure?", function(confirmed) {
                // remove box
                box.remove();

                // store removal in cookie
                $.cookie(deletedBoxesCookiePrefix + $("body").attr("id") + "_" + box.attr('id'), "yes", { expires: cookieExpiration });
            });
        }

        $('#box-close-modal .btn-success').click(function(e) {
            // e is the element that triggered the event
            console.log(e.target); // outputs an Object that you can then explore with Firebug/developer tool.
            // for example e.target.firstChild.wholeText returns the text of the button
        });

        // Modify button widget
        function widgetConfig(w, p) {
            $("#dialog-config-widget").dialog({
                resizable: false,
                modal: true,
                width: 500,
                buttons: {
                    "Save changes": function(e, ui) {
                        /* code the functionality here, could store in a cookie */
                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });
        }$('#tab').tab('show');

        // set portlet comtrols
        setControls();

        // Portlets (boxes)
        $(".column").sortable({
            connectWith: '.column',
            iframeFix: false,
            items:'div.box',
            opacity:0.8,
            helper:'original',
            revert:true,
            forceHelperSize:true,
            placeholder: 'box-placeholder round-all',
            forcePlaceholderSize:true,
            tolerance:'pointer'
        });

        // Store portlet update (move) in cookie
        $(".column").bind('sortupdate', function() {
            $('.column').each(function() {
                $.cookie(boxPositionCookiePrefix + $("body").attr("id") + ($(this).attr('id')), $(this).sortable('toArray'), { expires: cookieExpiration });
            });
        });

        // Portlets | INIT | check for closed portlet cookie
        var ckie = $.cookie(closedBoxesCookiePrefix+$("body").attr("id"));
        if (ckie && ckie != '')	{
            // get cookie and split in array
            var list = ckie.split(',');

            // loop over boxes in cookie and do actions
            for (var x = 0; x < list.length; x++) {
                var box = $("#"+list[x]);
                // close box
                box.find(".box-container-toggle").toggleClass("box-container-closed");
                // make closed box round
                box.find(".box-header").toggleClass("round-top").toggleClass("round-all");
                // find toggle button and change icon
                box.find('a[title="toggle"]').html("<i class=\"icon-plus\"></i>");
            }
        }

        // Delete Cookies
        $(".cookie-delete").click(function() {
            deleteCookies();
        });

        // funtion to get all cookies
        function getCookiesArray() {
            var cookies = { };

            if (document.cookie && document.cookie != '') {
                var split = document.cookie.split(';');
                for (var i = 0; i < split.length; i++) {
                    var name_value = split[i].split("=");
                    name_value[0] = name_value[0].replace(/^ /, '');
                    cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
                }
            }

            return cookies;
        }

        // function to delete all cookies
        function deleteCookies() {
            var cookies = getCookiesArray();
            for(var name in cookies) {
                $.cookie(name, null);
            }
        }
    });

</script>


<style type="text/css">
        /* Portlets */
    .box {
        margin-bottom:10px;
        }
    .box h4.box-header {
        size:10px;
        padding: 7px 7px;
        margin: 0;
        list-style: none;
        cursor:move;
        }


    .box-content {
        padding:10px;
        }

    .box-btn {
        float:right;
        margin-left:2px;
        margin-right:2px;
        height: 14px;
        width: 14px;
        text-decoration:none;
        display: block;
        float: right;
        overflow: hidden;
        background-position:center;
        cursor:pointer;
        }

    .box-btn [class^="icon-"], .box-btn [class*=" icon-"] {
        vertical-align:top;
        margin-top:0px;
        }

    .box-container-closed {
        display:none;
        }

        /* Portlets */
    .box-placeholder {
        background-color: #f5f5f5;
        border: 1px dashed #DDDDDD;
        display: block;
        /* float: left;*/
        margin-bottom: 13px !important;
        margin-left: 1%;
        margin-right: 0.6%;
        }
    .box-placeholder * {
        visibility:hidden;
        }
    .column {
        min-height:20px;
        }
</style>


<!-- ot-sub-nav -->
<div class="ot_sub_nav">

    <ul class="nav nav-tabs">
        <li class="active"><a href="/config/build">Конструкция сайта</a></li>
        <li><a href="/config/orders">Заказы</a></li>
        <li><a href="/config/cat">Каталог</a></li>
        <li><a href="/config/lang">Языки</a></li>
        <li><a href="/config/system">Система</a></li>
    </ul>

</div>


<h1>ТЗ на доработку портлетов</h1>

<div class="alert alert-success" style="color: #000; background: #F5F5F5">
    <button type="button" class="close" data-dismiss="alert">&times;</button>

    <h3>Исходник</h3>
    <p>Реализация была позаимствована отсюда — http://wbpreview.com/previews/WB00958H8/portlets.html</p>
    <p>Это некие шаблоны написанные под продажу, поэтому одним из принципов нашего заиствования является рерайтинг всего что может указывать на кражу :) Я сохранял страницу локально и оттуда выдерал исходники.</p>
    <h3>Что здесь есть нужного</h3>
    <p>Здесь полезным для нас является возможность запоминания состояния элементов в куках и возможность сортировки портлетов, то бишь расскарывающихся-скрывающихся блоков.</p>
    <h3>Что здесь нам не нужно</h3>
    <ul>
        <li>Удаление блоков нам не нужно (то что по крестику), поэтому выбрасываем.</li>
        <li>Настройки блока пока тоже не нужны — тоже выбрасываем.</li>
        <li>Элемент для таскания блоков мы переносим со всей плашки блока, на соответствующу пиктограмму.</li>
    </ul>

    <h3>Как оно работает</h3>
    <p>Судя по моим наблюдениям, используются jquery UI и jquery.cookie. Все эти скрипты я подключил внизу index.php. Кастомный код из темы-исходника (simplenso.js) вынесен в js/plugins.js, в секцию portlets</p>

    <h3>Почему требуется доработка</h3>
    <p>У меня не получилось нормально прикрутить реализацию к прототипу, потому что:</p>
    <ul>
        <li>оно отказывалось работать из-за ошибок жабоскрипта, вызванные плагином <a href="/test/fixed-header">FixedHeader</a>.</li>
        <li>не понятно как работает запоминание позиций в куках</li>
    </ul>

    <h3>Библиотеки плагинов</h3>
    <pre>&lt;!-- jQuery UI Sortable --&gt;
        &lt;script src="/js/vendor/jquery.ui/jquery.ui.core.min.js"&gt;&lt;/script&gt;
        &lt;script src="/js/vendor/jquery.ui/jquery.ui.widget.min.js"&gt;&lt;/script&gt;
        &lt;script src="/js/vendor/jquery.ui/jquery.ui.mouse.min.js"&gt;&lt;/script&gt;
        &lt;script src="/js/vendor/jquery.ui/jquery.ui.sortable.min.js"&gt;&lt;/script&gt;

&lt;!-- jQuery Cookie --&gt;
        &lt;script src="/js/vendor/jquery.cookie.js"&gt;&lt;/script&gt;</pre>

</div>
<!-- Конец вступительного блока с инструкциями -->

<h2>Исходники портлетов</h2>
<!-- default portlet -->
<div class="row-fluid">

    <div class="column ui-sortable">

        <div class="box" id="box-1">
            <h4 class="box-header round-top">Исходный портлет 1
                <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                <a class="box-btn" title="toggle"><i class="icon-plus"></i></a>
                <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>
            </h4>
            <div class="box-container-toggle box-container-closed">
                <div class="box-content">

                    <form>
                        <fieldset>
                            <label>Описание поля</label>
                            <input type="text" placeholder="Введите текст…">
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox"> Отображать товары каруселью</label>
                                    <i class="icon-question-sign ot_inline_help"></i>
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>

        <div class="box" id="box-2">
            <h4 class="box-header round-top">Исходный портлет 2
                <a class="box-btn" title="close"><i class="icon-remove"></i></a>
                <a class="box-btn" title="toggle"><i class="icon-plus"></i></a>
                <a class="box-btn" title="config" data-toggle="modal" href="#box-config-modal"><i class="icon-cog"></i></a>
            </h4>
            <div class="box-container-toggle box-container-closed">
                <div class="box-content">
                    Содержание портлета
                </div>
            </div>
        </div>


    </div>
</div>


<div id="box-config-modal" class="modal hide fade in" style="display: none;">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Adjust widget</h3>
    </div>
    <div class="modal-body">
        <p>This part can be customized to set box content specifix settings!</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Save Changes</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
    </div>
</div>


<!--
================================================
-->

<h2>Переботанные для админки варианты</h2>

<!-- customised OT portlets -->
<div class="row-fluid">

    <div class="column ui-sortable">

        <div class="box" id="box-3">
            <h4 class="box-header">Главная страница
                <a class="box-btn" title="close"><i class="icon-move"></i></a>
                <a class="box-btn" title="toggle"><i class="icon-plus"></i></a>
            </h4>
            <div class="box-container-toggle box-container-closed">
                <div class="box-content">

                    <form>
                        <fieldset>
                            <label>Описание поля</label>
                            <input type="text" placeholder="Введите текст…">
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox"> Отображать товары каруселью</label>
                                <i class="icon-question-sign ot_inline_help"></i>
                            </div>
                            <button type="submit" class="btn">Отправить</button>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>

        <div class="box" id="box-4">
            <h4 class="box-header">Страница товара
                <a class="box-btn" title="close"><i class="icon-move"></i></a>
                <a class="box-btn" title="toggle"><i class="icon-plus"></i></a>
            </h4>
            <div class="box-container-toggle box-container-closed">
                <div class="box-content">
                    Содержание портлета
                </div>
            </div>
        </div>


    </div>
</div>



<!-- Модальное окно при активации настроек -->
<div id="box-config-modal" class="modal hide fade in" style="display: none;">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Adjust widget</h3>
    </div>
    <div class="modal-body">
        <p>This part can be customized to set box content specifix settings!</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Save Changes</a>
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
    </div>
</div>


<style type="text/css">
    i.icon-move {cursor: move}
</style>