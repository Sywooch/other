<?php
require '/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/components/spomazanovsky/catalog.element/.default/template.php';

// подключаем константы
require '/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/core/define.php';

// соединение с базой данных, будем проверять есть ли такой файл
if(file_exists('/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/core/db.php'))
{
	// соединились с базой
	require '/home/user1167996/www/muravey.by/bitrix/templates/ads_muravey/core/db.php';
}
/*
if(isset($_GET['true']) === true)
{
	$sql_00com = $db->prepare("
								ALTER TABLE `b_comments` ADD `DATE` CHAR(20);
							");
	$sql_00com->setFetchMode(PDO::FETCH_ASSOC);
	$sql_00com->execute();
}
*/
if(isset($_POST['iblock_submit']) == true)
{
	$__42 = 42;
	$__43 = 43;
	$__44 = 44;
	$__45 = 45;
	$__46 = 46;
	$__47 = 47;
	$__48 = 48;
	$__49 = 49;
	$__50 = 50;
	$__cookies = $_COOKIE['BITRIX_SM_LOGIN'];
	$__get = $_GET['edit_ads'];
	$__VALUE_1 = $_POST['PROPERTY__42'];
	$__VALUE_2 = $_POST['PROPERTY__43'];
	$__VALUE_3 = $_POST['PROPERTY__44'];
	$__VALUE_4 = $_POST['PROPERTY__45'];
	$__VALUE_5 = $_POST['PROPERTY__46'];
	$__VALUE_6 = $_POST['PROPERTY__47'];
	$__VALUE_7 = $_POST['PROPERTY__48'];
	$__VALUE_8 = $_POST['PROPERTY__49'];
	$__VALUE_9 = $_POST['PROPERTY__50'];
	$__IBLOCK_SECTION_ID = $_POST['IBLOCK_SECTION'];
	$__NAME_1 = $_POST['TITLE'];
	$__DETAIL_TEXT = $_POST['DESCRIPTION'];
	$__TITLE = $_POST['TITLE'];
	$__BODY = $_POST['DESCRIPTION'];
	$__NAME_2 = $_POST['TITLE'];
	$__TITLE_2 = $_POST['TITLE'];
	$__BODY_2 = $_POST['DESCRIPTION'];

	$sql_00a = $db->prepare("
								UPDATE
										`b_iblock_element`
								SET
										`b_iblock_element`.`NAME` = :__NAME_1
								WHERE
										`b_iblock_element`.`XML_ID` = :__get
							");
	$sql_00a->bindParam(':__NAME_1', $__NAME_1,PDO::PARAM_STR);
	$sql_00a->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00a->execute();
	
	$sql_00b = $db->prepare("
								UPDATE
										`b_sale_viewed_product`
								SET
										`b_sale_viewed_product`.`NAME` = :__NAME_1
								WHERE
										`b_sale_viewed_product`.`PRODUCT_ID` = :__get
							");
	$sql_00b->bindParam(':__NAME_1', $__NAME_1,PDO::PARAM_STR);
	$sql_00b->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00b->execute();
	
	$sql_00c = $db->prepare("
								UPDATE
										`b_search_content`
								SET
										`b_search_content`.`TITLE` = :__TITLE,
										`b_search_content`.`BODY` = :__BODY
								WHERE
										`b_search_content`.`ITEM_ID` = :__get
							");
	$sql_00c->bindParam(':__TITLE', $__TITLE,PDO::PARAM_STR);
	$sql_00c->bindParam(':__BODY', $__BODY,PDO::PARAM_STR);
	$sql_00c->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00c->execute();
	
	$sql_00d = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_1
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__42
							");
	$sql_00d->bindParam(':__VALUE_1', $__VALUE_1,PDO::PARAM_STR);
	$sql_00d->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00d->bindParam(':__42', $__42,PDO::PARAM_STR);
	$sql_00d->execute();
	
	$sql_00e = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_2
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__43
							");
	$sql_00e->bindParam(':__VALUE_2', $__VALUE_2,PDO::PARAM_STR);
	$sql_00e->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00e->bindParam(':__43', $__43,PDO::PARAM_STR);
	$sql_00e->execute();
	
	$sql_00f = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_3
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__44
							");
	$sql_00f->bindParam(':__VALUE_3', $__VALUE_3,PDO::PARAM_STR);
	$sql_00f->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00f->bindParam(':__44', $__44,PDO::PARAM_STR);
	$sql_00f->execute();
	
	$sql_00g = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_4
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__45
							");
	$sql_00g->bindParam(':__VALUE_4', $__VALUE_4,PDO::PARAM_STR);
	$sql_00g->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00g->bindParam(':__45', $__45,PDO::PARAM_STR);
	$sql_00g->execute();
	
	$sql_00h = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_5
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__46
							");
	$sql_00h->bindParam(':__VALUE_5', $__VALUE_5,PDO::PARAM_STR);
	$sql_00h->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00h->bindParam(':__46', $__46,PDO::PARAM_STR);
	$sql_00h->execute();
	
	$sql_00i = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_6
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__47
							");
	$sql_00i->bindParam(':__VALUE_6', $__VALUE_6, PDO::PARAM_STR);
	$sql_00i->bindParam(':__get', $__get,PDO::PARAM_STR);
	$sql_00i->bindParam(':__47', $__47,PDO::PARAM_STR);
	$sql_00i->execute();
	
	$sql_00e = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_7
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__48
							");
	$sql_00e->bindParam(':__VALUE_7', $__VALUE_7, PDO::PARAM_STR);
	$sql_00e->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql_00e->bindParam(':__48', $__48,PDO::PARAM_STR);
	$sql_00e->execute();
	
	$sql_00l = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_8
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__49
							");
	$sql_00l->bindParam(':__VALUE_8', $__VALUE_8, PDO::PARAM_STR);
	$sql_00l->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql_00l->bindParam(':__49', $__49,PDO::PARAM_STR);
	$sql_00l->execute();
	
	$sql_00m = $db->prepare("
								UPDATE
										`b_iblock_element_property`
								SET
										`b_iblock_element_property`.`VALUE` = :__VALUE_9
								WHERE
										`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get
								AND
										`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__50
							");
	$sql_00m->bindParam(':__VALUE_9', $__VALUE_9, PDO::PARAM_STR);
	$sql_00m->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql_00m->bindParam(':__50', $__50,PDO::PARAM_STR);
	$sql_00m->execute();
	
	$sql_00n = $db->prepare("
								UPDATE
										`b_iblock_section_element`
								SET
										`b_iblock_section_element`.`IBLOCK_SECTION_ID` = :__IBLOCK_SECTION_ID
								WHERE
										`b_iblock_section_element`.`IBLOCK_ELEMENT_ID` = :__get
							");
	$sql_00n->bindParam(':__IBLOCK_SECTION_ID', $__IBLOCK_SECTION_ID, PDO::PARAM_STR);
	$sql_00n->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql_00n->execute();
	
	//header('Location: index.php?edit_ads=' . $_GET['edit_ads'] . '&submit_myform');
	?>
	<script>
	window.location.href = "<?php echo 'index.php?edit_ads=' . $_GET['edit_ads'] . '&submit_myform' ?>";
	</script>
	<?php
}
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

$sql__00 = $db->prepare("
								SELECT
										*
								FROM
										`b_iblock_element`
								JOIN
										`b_sale_viewed_product`
								ON
										`b_sale_viewed_product`.`PRODUCT_ID` = `b_iblock_element`.`XML_ID`
								JOIN
										`b_search_content`
								ON
										`b_search_content`.`ITEM_ID` = `b_iblock_element`.`XML_ID`
								JOIN
										`b_user`
								ON
										`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
								WHERE
										`b_user`.`ID` = :__login_user
						");
$__login_user = $USER->GetID();
$sql__00->bindParam(':__login_user', $__login_user, PDO::PARAM_STR);
$sql__00->execute();
$sql__00->setFetchMode(PDO::FETCH_ASSOC);
$row__00 = $sql__00->fetch();
/*
echo $__login_user;
echo '<pre>';
print_r($row__00 = $sql__00->fetch());
echo '</pre>';*/
$sql__01 = $db->prepare("
								SELECT
										*
								FROM
										`b_iblock_element`
								JOIN
										`b_iblock_section_element`
								ON
										`b_iblock_element`.`ID` = `b_iblock_section_element`.`IBLOCK_ELEMENT_ID`
								WHERE
										`b_iblock_element`.`ID` = :__get;
						");
$__get = $_GET['edit_ads'];
$sql__01->bindParam(':__get', $__get, PDO::PARAM_STR);
$sql__01->execute();
$sql__01->setFetchMode(PDO::FETCH_ASSOC);
$row__01 = $sql__01->fetch();
	
$sql__00as1 = $db->prepare("
								SELECT
										*
								FROM
										`b_user`
								JOIN
										`b_iblock_element`
								ON
										`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
								WHERE
										`b_user`.`ID` = :__login_user
								AND
										`b_iblock_element`.`XML_ID` = :__get;
						");
$__login_user = $USER->GetID();
$sql__00as1->bindParam(':__login_user', $__login_user, PDO::PARAM_STR);
$sql__00as1->bindParam(':__get', $__get, PDO::PARAM_STR);
$sql__00as1->execute();
$sql__00as1->setFetchMode(PDO::FETCH_ASSOC);
$row__00as1 = $sql__00as1->fetch();
/*
echo '<pre>';
print_r($row__00as1 = $sql__00as1->fetch());
echo '</pre>';
/*
$sql__00as2 = $db->prepare("
								SELECT
										*
								FROM
										`b_iblock_element`
								WHERE
										`b_iblock_element`.`CREATED_BY` = :__login_user;
						");
$__login_user = $USER->GetID();
$sql__00as2->bindParam(':__login_user', $__login_user, PDO::PARAM_STR);
$sql__00as2->execute();
$sql__00as2->setFetchMode(PDO::FETCH_ASSOC);
$row__00as2 = $sql__00as2->fetch();
/*
echo '<br/><pre>';
?>
<table>
<?php
while($row__01 = $sql__01->fetch())
{
	?>
	<tr>
		<td><?=$row__01['ID']?></td>
	</tr>
	<tr>
		<td><?=$row__01['MODIFIED_BY']?></td>
	</tr>
	<tr>
		<td><?=$row__01['CREATED_BY']?></td>
	</tr>
	<tr>
		<td><?=$row__01['NAME']?></td>
	</tr>
	<?php
}
?>
</table>
<?php
echo '</pre>';
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <!-- Content-Type, robots, keywords, description -->
    <?$APPLICATION->ShowHead()?>
    
    <!-- JavaScript -->
    <?
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
    
    <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/modal.js"></script>
    
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    
	<script>
		jQuery(function()
		{
			$('b.change-category').click(function()
			{
				$('#bx_incl_area_3').animate(
				{
					height: '390px',
					opacity: '1'
				},
				{
					duration: 600
				});
				$('.padding_top').animate(
				{
					top: '400px'
				},
				{
					duration: 500
				});
				$('.content.category-shipping').animate(
				{
					'padding-bottom': '900px'
				},
				{
					duration: 500
				});
			});
			
			$('ul.order a').click(function()
			{
				$('#bx_incl_area_3').animate(
				{
					height: '0',
					opacity: '0'
				},
				{
					duration: 500
				});
				$('.padding_top').animate(
				{
					top: '0px'
				},
				{
					duration: 600
				});
				$('.content.category-shipping').animate(
				{
					'padding-bottom': '525px'
				},
				{
					duration: 600
				});
				var attr_categories = $(this).attr('links');
				$('.section_id').attr('value',attr_categories);
				
				$(this).clone().prependTo('.dostavka-block').siblings().remove();
			});
		});
		
		// при выборе категории, или изменения категории, будет заносится в атрибут name="" в скрытом поле, которое будет заносится в базу
	</script>
	
    <?if (!$isLastAddIdEqualsCurrent):?>
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
    <?endif;?>
    <script>
	<?php
	if(isset($_GET['edit_ads']) === true)
	{
		?>
		jQuery(function($)
		{
			$('#slider-wrap').remove();
			$('.search-link').remove();
			$('.search-order').remove();
			$('.how-worked').remove();
			$('.content.profitabel').remove();
		});
		<?php
	}
	?>
	</script>
    <title>
		<?php
		if($USER->IsAuthorized())
		{
			if(isset($_GET['edit_ads']) === true && $row__00as1['CREATED_BY'] === $USER->GetID() && $row__00as1['EMAIL'] === $USER->GetLogin())
			{
				?>Редактировать товар | <?php echo $row__01['NAME'];
			}
			else if(empty($_GET['edit_ads']) === true)
			{
				$APPLICATION->ShowTitle();
			}
			else
			{
				?>
				У вас нет прав для редактирования данной страницы
				<?php
			}
		}
		else if(!$USER->IsAuthorized())
		{
			if(empty($_GET['edit_ads']) === true)
			{
				$APPLICATION->ShowTitle();
			}
			else
			{
				?>
				У вас нет прав для редактирования данной страницы
				<?php
			}
		}
		?>
	</title>
</head>
<link rel="icon" type="image/x-icon" href="/favicon.ico" />
<body <?if ($curDir == '/personal/carrier/account/'):?>class="account-page"<?endif?>>
    <div id="panel"><?$APPLICATION->ShowPanel()?></div>
    <div class="wrapper-main">
        <header class="header">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "header", Array(
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
                <?
                if (!$USER->IsAuthorized())
                {
                    ?>
                    <p><a id="modal_authorize" href="#" data-toggle="modal" data-target="#login">Вход</a> | <a href="/auth/?register=yes">Регистрация</a></p>
                    <?/*<p><a href="/auth/">Вход</a> | <a href="/auth/?register=yes">Регистрация</a></p>*/?>
                    <?
                }
                else
                {
                    ?>
                    <div class="personal-info">
                        <div class="avatar">
                            <?
                            $arPicture = GetUserFirstAutoPicture();
                            if (!empty($arPicture['src']))
                            {
                                ?>
                                <a href="/personal/"><img src="<?=$arPicture['src']?>" alt=""></a>
                                <?
                            }
                            else
                            {
                                ?>
                                <a href="/personal/"><img src="<?=SITE_TEMPLATE_PATH?>/img/avatar.png" alt=""></a>
                                <?
                            }    
                            ?>
                        </div>
                        <div class="identity">ID <?=$USER->GetID()?></div>
                        <div class="login-user">
                            <a href="/personal/"><?=$USER->GetLogin()?></a>
                        </div>
                        <?
                        if (CheckUserParticipationInGroup('TYPE_TRANSPORTERS'))
                        {
                            ?>
                            <div class="rate-star">
                                <?
                                $rating = GetCarrierRatingByID();
                                echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star-a.png" />', (intval($rating)));
                                if ($rating < 5)
                                    echo str_repeat('<img src="'.SITE_TEMPLATE_PATH.'/img/star.png" />', (round(5 - intval($rating))));
                                ?>
                            </div>
                            <?
                        }    
                        ?>
                        <div><a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array(), false);?>">Выйти</a></div>
                    </div>
                    <?
                }
                ?>
            </div>
            <div class="logo">
                <div class="wrapper">
                    <a href="<?=SITE_DIR?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="muravey.by"/></a>
                </div>
            </div>
        </header>
		<?php
		if(isset($_GET['edit_ads']) === true)
		{
			require suffix . components_templates . 'spomazanovsky/iblock.element.add.form/ads_remove/template.php';
		}
		?>
		<?if ($curPage == '/'):?>
		<div id="slider-wrap">
			<div id="slider">
				<div class="slide"><img src="<?=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
				<div class="slide"><img src="<?=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
				<div class="slide"><img src="<?=SITE_TEMPLATE_PATH?>/img/1.png" alt="" /></div>
			</div>
		</div>
		<?endif?>
		<?if (
			$curPage == '/' || 
			$curPage == '/customers/' || 
			$curPage == '/customers/internet-shopping/' || 
			$curPage == '/carrier/' || 
			$curPage == '/carrier/tarifs/'
		):?>
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
		<?endif?>
		<?if ($curPage == '/'):?>
		<div class="search-order">
			<?if (CheckUserParticipationInGroup('TYPE_CUSTOMERS') || !$USER->IsAuthorized()):?>
			<h1><a name="change">Разместить заказ</a></h1>
			<?else:?>
			<h1><a name="change">Поиск заказа</a></h1>
			<?endif?>
			
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "homepage", array(
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
			<?/*
			<ul class="order">
				<li><a href="/ads_add/avtomobili-i-mototsikly/" class="car">Автомобили и мотоциклы</a></li>
				<li><a href="/ads_add/vyvoz-musora/" class="rubish">Вывоз мусора</a></li>
				<li><a href="/ads_add/dostavka/" class="dostavka">Доставка</a></li>
				<li><a href="/ads_add/konteyner/" class="container">Контейнер</a></li>
				<li><a href="/ads_add/mebel-i-bytovaya-tekhnika/" class="mebel">Мебель и бытовая техника</a></li>
				<li><a href="/ads_add/negabarit/" class="negabarit">Негабаритные грузы</a></li>
				<li><a href="/ads_add/passazhirskie-perevozki/" class="passajir">Пассажирские перевозки</a></li>
				<li><a href="/ads_add/perevozka-zhivotnykh/" class="animals">Перевозка животных</a></li>
				<li><a href="/ads_add/pereezd/" class="pereezd">Переезд</a></li>
				<li><a href="/ads_add/prochie-gruzy/" class="other">Прочие грузы</a></li>
			</ul>
			*/?>
		</div>
		
		<div class="how-worked">
			<div class="wrapper">
				<h1>Как это работает</h1>
				<ul class="icon-how-worked">
					<li>
					<a href="#">
						<p><img src="<?=SITE_TEMPLATE_PATH?>/img/icon1.png" alt=""/></p>
						<h2>Разместите заказ</h2>
						<p>Подробно опишите груз и маршрут.</p>
					</a>
					</li>
					<li>
					<a href="#">
					<p>
						<img src="<?=SITE_TEMPLATE_PATH?>/img/icon2.png" alt=""/>
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
						<img src="<?=SITE_TEMPLATE_PATH?>/img/icon3.png" alt=""/>
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
		<?endif?>
		<?
		$contentClass = "content";
		if (preg_match("~/catalog/~", $curDir))
		{
			if (!preg_match("~.html~", $curPage))
				$contentClass .= " search-customer";
			else
				$contentClass .= " product-carrier";
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
		<div class="<?=$contentClass?>">
			<?php
			if(isset($_GET['edit_ads']) === false)
			{
			?>
				<?
				if (preg_match("~/personal/~", $curPage) && $USER->IsAuthorized()):?>
					<div class="wrapper">
						<h1><?=$APPLICATION->ShowTitle(false)?></h1>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "personal", Array(
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
				<?//elseif ($USER->IsAuthorized() || preg_match("~/auth/~", $curPage)):?>
				<?
				elseif (!preg_match("~/carrier/carrier-info/~", $curDir)):?>
				<div class="wrapper">
				<?endif?>
			<?php
			}
			?>