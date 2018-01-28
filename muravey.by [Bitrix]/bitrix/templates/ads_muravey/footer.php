<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
$curPage = $APPLICATION->GetCurPage(false);
?>
                </div>
                <!-- /content -->
                <?
                if (
                    $curPage != '/'
//                    $curPage != '/personal/carrier/' || 
//                    $curPage != '/personal/customers/'
                ):?>
            </div>
            <!-- /wrapper -->
            <?endif?>
        </div>
        <!-- /wrapper-main -->
        <footer class="footer">
            <div class="top-footer">
                <div class="wrapper">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/logo-footer.png" alt="muravey.by"/>
                </div>
            </div>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
                "ROOT_MENU_TYPE" => "bottom",    // Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                    0 => "",
                ),
                "MAX_LEVEL" => "1",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "",    // Тип меню для остальных уровней
                "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                ),
                false
            );?>
            <div class="wrapper">
                <div class="bottom-1">
                    <h2>Поиск заказа</h2>
                    <ul>
                        <li><a href="http://muravey.by/catalog/mebel-i-bytovaya-tekhnika/">Мебель и бытовая техника</a></li>
                        <li><a href="http://muravey.by/catalog/vyvoz-musora/">Вывоз мусора</a></li>
                        <li><a href="http://muravey.by/catalog/passazhirskie-perevozki/">Пассажирские перевозки</a></li>
                        <li><a href="http://muravey.by/catalog/konteyner/">Контейнеры</a></li>
                        <li><a href="http://muravey.by/catalog/pereezd/">Переезд</a></li>
                        <li><a href="http://muravey.by/catalog/avtomobili-i-mototsikly/">Автомобили и мотоциклы</a></li>
                        <li><a href="http://muravey.by/catalog/perevozka-zhivotnykh/">Перевозка животных</a></li>
                        <li><a href="http://muravey.by/catalog/negabarit/">Негабаритные грузы</a></li>
                        <li><a href="http://muravey.by/catalog/stroitelnye-materialy/">Строительные материалы</a></li>
                        <li><a href="http://muravey.by/catalog/dostavka/">Доставка</a></li>
                        <li><a href="http://muravey.by/catalog/produkty-pitaniya/">Продукты питания</a></li>
                        <li><a href="http://muravey.by/catalog/prochie-gruzy/">Прочие грузы</a></li>
                    </ul>
                    <div class="clear">
                    </div>
                </div>
                <div class="bottom-2">
                    <h2>Социальные сети</h2>
                    <ul>
                        <li><a href="https://vk.com/muravey_by" class="vk"></a></li>
                        <li><a href="#" class="facebook"></a></li>
                    </ul>
                    <p>Copyright <?=date('Y')?> muravey.by<br/>All rights reserved</p>
                </div>
                <div class="clear"></div>
            </div>
        </footer>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "popup",
            Array(
            )
        );?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter26373729 = new Ya.Metrika({id:26373729,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/26373729" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    </body>
</html>