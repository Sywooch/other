<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

IncludeTemplateLangFile(__FILE__);

CUtil::InitJSCore();       

CJSCore::Init(array("jquery"));
CJSCore::Init(array("fx"));
CJSCore::Init(array("popup"));

global $USER;
if (!is_object($USER))
    $USER = new CUser();

$arUserGroups = $USER->GetUserGroupArray();
$arUserTypeGroups = array();
$dbGroups = CGroup::GetList($by, $order, array('DESCRIPTION' => 'TYPE_%'), "N");
while ($arGroup = $dbGroups->GetNext())
{
    $arUserTypeGroups[$arGroup['DESCRIPTION']] = $arGroup['ID'];
}
    
$curPage = $APPLICATION->GetCurPage(false);
$curDir  = $APPLICATION->GetCurDir();

$arContentDivClasses = array(
    '/' => 'profitabel',
    '/terms.php' => 'about',
    '/about/' => 'about',
    '/customers/' => 'search-order search-customer-order',
    '/customers/internet-shopping/' => 'tarify shopi',
    '/customers/tips/' => 'tarify tips',
    '/customers/question-answer/' => 'profitabel',
    '/carrier/' => 'search-order search-carrier-order',
    '/carrier/tarifs/' => 'tarify',
    '/carrier/rating/' => 'tarify',
    '/carrier/tips/' => 'tarify tips',
    '/carrier/tools/' => 'tarify tools',
    '/personal/carrier/' => 'profile-carrier',
    '/carrier/carrier-info/' => 'profile-carrier',
    '/personal/carrier/profile/' => 'profile-carrier',
    '/personal/carrier/bets/' => 'profile-carrier',
    '/personal/carrier/account/' => 'profile-carrier',
    '/personal/carrier/notifications/' => 'profile-carrier',
    '/personal/customers/' => 'profile-customer',
    '/personal/customers/profile/' => 'profile-customer',
    '/personal/customers/notifications/' => 'profile-carrier'
);

//  Проверка на случайное попадание пользователей не в свой ЛК
if (preg_match("~/personal/~", $curPage))
{
    if (preg_match("~/personal/carrier/~", $curPage) && CheckUserParticipationInGroup('TYPE_CUSTOMERS'))
        LocalRedirect(SITE_DIR."personal/customers/");
    elseif (preg_match("~/personal/customers/~", $curPage) && CheckUserParticipationInGroup('TYPE_TRANSPORTERS'))
        LocalRedirect(SITE_DIR."personal/carrier/");
}

// Совпадает ли последний ID объявления, зафиксированное пользователем, с имеющимся на данный момент?
$isLastAddIdEqualsCurrent = IsLastAddIdEquealsCurrent();

// подключаем константы
require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/ads_muravey/core/define.php';

// соединение с базой данных, будем проверять есть ли такой файл
if(file_exists($_SERVER["DOCUMENT_ROOT"] . core_templates . 'db.php'))
{
	// соединились с базой
	require $_SERVER["DOCUMENT_ROOT"] . core_templates . 'db.php';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php=LANGUAGE_ID?>" lang="<?php=LANGUAGE_ID?>">
<head>
    <!-- Content-Type, robots, keywords, description -->
    <?php$APPLICATION->ShowHead()?>
    
    <!-- JavaScript -->
    <?php
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/script.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slider.js");
    $APPLICATION->AddHeadScript("//maps.googleapis.com/maps/api/js?sensor=false&language=ru");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/v3_epoly.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/libs/fancybox/jquery.fancybox.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.selectbox-0.2.js");
    
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.ui.1.10.4.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.ui.timepicker.js");
    
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery.ui.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery-ui-1.10.4.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/libs/fancybox/jquery.fancybox.css");
    ?>
    
    <script type="text/javascript" src="<?php=SITE_TEMPLATE_PATH?>/js/modal.js"></script>
    
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    
    <?phpif (!$isLastAddIdEqualsCurrent):?>
    <script type="text/javascript">
    $(document).ready(function()
    {
        setTimeout(function()
        {
            if (confirm('За время вашего отсутствия появились новые объявления.\n\nПерейти в каталог заказов?'))
            {
                location.assign('/catalog/');
            }
        }, 2000);
    });
    </script>
    <?phpendif;?>
    
    <title><?php$APPLICATION->ShowTitle()?></title>
</head>
<link rel="icon" type="image/x-icon" href="/favicon.ico" />
<body <?phpif ($curDir == '/personal/carrier/account/'):?>class="account-page"<?phpendif?>>
	<?phpphp
	if(isset($_GET['edit_shop']) === true)
	{
		echo '<b style="border:20px solid #f00;padding:100px;"></b>';
	}
	?>
    <div id="panel"><?php$APPLICATION->ShowPanel()?></div>
    <div class="wrapper-main">
        <header class="header">
            <?php$APPLICATION->IncludeComponent("bitrix:menu", "header", Array(
                "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
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
            <div class="enter-form">
                <?php
                if (!$USER->IsAuthorized())
                {
                    ?>
                    <p>
						<a id="modal_authorize" href="#" data-toggle="modal" data-target="#login">Вход</a>
						|
						<a href="/auth/?register=yes">Регистрация</a>
					</p>
                    <?php
                }
                else
                {
                    ?>
                    <div class="personal-info">
                        <div class="avatar">
                            <?php
                            $arPicture = GetUserFirstAutoPicture();
                            if (!empty($arPicture['src']))
                            {
                                ?>
                                <a href="/personal/"><img src="<?php=$arPicture['src']?>" alt=""></a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="/personal/"><img src="<?php=SITE_TEMPLATE_PATH?>/img/avatar.png" alt=""></a>
                                <?php
                            }    
                            ?>
                        </div>
                        <div class="identity">ID <?php=$USER->GetID()?></div>
                        <div class="login-user">
                            <a href="/personal/"><?php=$USER->GetLogin()?></a>
                        </div>
                        <?php
                        if (CheckUserParticipationInGroup('TYPE_TRANSPORTERS'))
                        {
                            ?>
                            <div class="rate-star">
                                <?php
                                $rating = GetCarrierRatingByID();
                                echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star-a.png" />', (intval($rating)));
                                if ($rating < 5)
                                    echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star.png" />', (round(5 - intval($rating))));
                                ?>
                            </div>
                            <?php
                        }    
                        ?>
                        <div>
							<a href="<?php=$APPLICATION->GetCurPageParam("logout=yes", array(), false);?>">Выйти</a>
						</div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="logo">
                <div class="wrapper">
                    <a href="<?php=SITE_DIR?>"><img src="<?php=SITE_TEMPLATE_PATH?>/img/logo.png" alt="muravey.by"/></a>
                </div>
            </div>
        </header>
		<?php
		if ($curPage == '/')
		{
		?>
		<div id="slider-wrap">
			<div id="slider">
				<div class="slide"><img src="<?php=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
				<div class="slide"><img src="<?php=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
				<div class="slide"><img src="<?php=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
			</div>
		</div>
		<?php
		}
		
		if(
			$curPage == '/' || 
			$curPage == '/customers/' || 
			$curPage == '/customers/internet-shopping/' || 
			$curPage == '/carrier/' || 
			$curPage == '/carrier/tarifs/'
		)
		{
		?>
		<div class="search-link">
			<div class="wrapper">
				<ul class="main-registration">
					<li>
						<a href="/ads_add/?id=21" class="bclient">Разместить заказ</a>
						<a href="/customers/" class="green greenc">Заказчикам</a>
					</li>
					<li class="graph"></li>
					<li>
						<a href="/catalog/" class="btransfer">Поиск заказов</a>
						<a href="/carrier/" class="green greent">Перевозчикам</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		}
		?>
		
		<?php
		if ($curPage == '/')
		{
		?>
		<div class="search-order">
			<?phpif (CheckUserParticipationInGroup('TYPE_CUSTOMERS') || !$USER->IsAuthorized()):?>
			<h1><a name="change">Разместить заказ | изменить товар</a></h1>
			<?phpelse:?>
			<h1><a name="change">Поиск заказа</a></h1>
			<?phpendif?>
			
			<?php$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "homepage", array(
				"IBLOCK_TYPE" => "catalog",
				"IBLOCK_ID" => "4",
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_CODE" => "",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => "2",
				"SECTION_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SECTION_USER_FIELDS" => array(
					0 => "UF_LI_CLASS",
					1 => "",
				),
				"SECTION_URL" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"ADD_SECTIONS_CHAIN" => "Y",
				"VIEW_MODE" => "LINE",
				"SHOW_PARENT_NAME" => "Y",
				"USER_TYPE_TRANSPORTER" => CheckUserParticipationInGroup('TYPE_TRANSPORTERS')
				),
				false
			);?>
		</div>
		<div class="how-worked">
			<div class="wrapper">
				<h1>Как это работает | изменить товар</h1>
				<ul class="icon-how-worked">
					<li>
					<a href="#">
						<p><img src="<?php=SITE_TEMPLATE_PATH?>/img/icon1.png" alt=""/></p>
						<h2>Разместите заказ</h2>
						<p>Подробно опишите груз и маршрут.</p>
					</a>
					</li>
					<li>
					<a href="#">
					<p>
						<img src="<?php=SITE_TEMPLATE_PATH?>/img/icon2.png" alt=""/>
					</p>
					<h2>Получайте предложения</h2>
					<p>
						Перевозчики торгуются за Ваш заказ. Предложения приходят на SMS и e-mail. Обращайте внимание на рейтинг и отзывы перевозчика.
					</p>
					</a>
					</li>
					<li>
					<a href="#">
					<p>
						<img src="<?php=SITE_TEMPLATE_PATH?>/img/icon3.png" alt=""/>
					</p>
					<h2>Выбирайте перевозчика</h2>
					<p>
						Выберите лучшее предложение. Перевозчик сам свяжется с вами.
					</p>
					</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		}
		$contentClass = "content";
		if(preg_match("~/catalog/~", $curDir))
		{
			if (!preg_match("~.html~", $curPage))
			{
				$contentClass .= " search-customer";
			}
			else
			{
				$contentClass .= " product-carrier";
			}
		}
		elseif (preg_match("~ads_add~", $curDir))
		{
			$contentClass .= " category-shipping";
		}
		else
		{
			$contentClass .= " ".$arContentDivClasses[$curDir];
		}
		?>
		<div class="<?php=$contentClass?>">
			<?php
			if (preg_match("~/personal/~", $curPage) && $USER->IsAuthorized())
			{
			?>
			<div class="wrapper">
				<h1><?php=$APPLICATION->ShowTitle(false)?></h1>
				<?php$APPLICATION->IncludeComponent("bitrix:menu", "personal", Array(
					"ROOT_MENU_TYPE" => "personal",    // Тип меню для первого уровня
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
			</div>
			<?php//elseif ($USER->IsAuthorized() || preg_match("~/auth/~", $curPage)):?>
			<?php
			}
			(!preg_match("~/carrier/carrier-info/~", $curDir))
			{
				?>
				<div class="wrapper">
				<?php
			}
			if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
			IncludeTemplateLangFile(__FILE__);
			$curPage = $APPLICATION->GetCurPage(false);
			?>
			</div>
                <!-- /content -->
                <?php
                if (
                    $curPage != '/'
//                    $curPage != '/personal/carrier/' || 
//                    $curPage != '/personal/customers/'
                ):?>
        </div>
            <!-- /wrapper -->
            <?phpendif?>
    </div>
	<!-- /wrapper-main -->
	<footer class="footer">
		<div class="top-footer">
			<div class="wrapper">
				<img src="<?php=SITE_TEMPLATE_PATH?>/img/logo-footer.png" alt="muravey.by" />
			</div>
		</div>
		<?php$APPLICATION->IncludeComponent("bitrix:menu", "footer", Array(
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
				<div class="clear"></div>
			</div>
			<div class="bottom-2">
				<h2>Социальные сети</h2>
				<ul>
					<li><a href="https://vk.com/muravey_by" class="vk"></a></li>
					<li><a href="#" class="facebook"></a></li>
				</ul>
				<p>Copyright <?php=date('Y')?> muravey.by<br/>All rights reserved</p>
			</div>
			<div class="clear"></div>
		</div>
	</footer>
	<?php$APPLICATION->IncludeComponent(
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