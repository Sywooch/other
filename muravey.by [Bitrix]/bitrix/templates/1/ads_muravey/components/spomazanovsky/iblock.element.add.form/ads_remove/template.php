<?php
// sql select bd table
// так удаление не нужных тегов будет делать яваскрипт
// здесь будет идти выборка пользователя по тому, какой логин у самого юзера который лежит в куках
if(empty($row__01['TITLE']) === false)
{
	$sql__02 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__42
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__42 = 42;
	$sql__02->bindParam(':__42', $__42, PDO::PARAM_STR);
	$sql__02->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__02->execute();
	$sql__02->setFetchMode(PDO::FETCH_ASSOC);
	$row__02 = $sql__02->fetch();

	$sql__03 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__43
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__43 = 43;
	$sql__03->bindParam(':__43', $__43, PDO::PARAM_STR);
	$sql__03->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__03->execute();
	$sql__03->setFetchMode(PDO::FETCH_ASSOC);
	$row__03 = $sql__03->fetch();

	$sql__04 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__date
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__date = 45;
	$sql__04->bindParam(':__date', $__date, PDO::PARAM_STR);
	$sql__04->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__04->execute();
	$sql__04->setFetchMode(PDO::FETCH_ASSOC);
	$row__04 = $sql__04->fetch();

	$sql__05 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__time
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__time = 46;
	$sql__05->bindParam(':__time', $__time, PDO::PARAM_STR);
	$sql__05->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__05->execute();
	$sql__05->setFetchMode(PDO::FETCH_ASSOC);
	$row__05 = $sql__05->fetch();

	$sql__06 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__city_1
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__city_1 = 47;
	$sql__06->bindParam(':__city_1', $__city_1, PDO::PARAM_STR);
	$sql__06->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__06->execute();
	$sql__06->setFetchMode(PDO::FETCH_ASSOC);
	$row__06 = $sql__06->fetch();

	$sql__07 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__street_1
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__street_1 = 48;
	$sql__07->bindParam(':__street_1', $__street_1, PDO::PARAM_STR);
	$sql__07->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__07->execute();
	$sql__07->setFetchMode(PDO::FETCH_ASSOC);
	$row__07 = $sql__07->fetch();

	$sql__08 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__city_2
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__city_2 = 49;
	$sql__08->bindParam(':__city_2', $__city_2, PDO::PARAM_STR);
	$sql__08->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__08->execute();
	$sql__08->setFetchMode(PDO::FETCH_ASSOC);
	$row__08 = $sql__08->fetch();

	$sql__09 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__street_2
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__street_2 = 50;
	$sql__09->bindParam(':__street_2', $__street_2, PDO::PARAM_STR);
	$sql__09->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__09->execute();
	$sql__09->setFetchMode(PDO::FETCH_ASSOC);
	$row__09 = $sql__09->fetch();

	$sql__10 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element_property`
									WHERE
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__select_option
									AND
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = :__get;
							");
	$__select_option = 44;
	$sql__10->bindParam(':__select_option', $__select_option, PDO::PARAM_STR);
	$sql__10->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__10->execute();
	$sql__10->setFetchMode(PDO::FETCH_ASSOC);
	$row__10 = $sql__10->fetch();

	$sql__11 = $db->prepare("
									SELECT
											*
									FROM
											`b_iblock_element`
									WHERE
											`b_iblock_element`.`ID` = :__get;
							");
	$sql__11->bindParam(':__get', $__get, PDO::PARAM_STR);
	$sql__11->execute();
	$sql__11->setFetchMode(PDO::FETCH_ASSOC);
	$row__11 = $sql__11->fetch();

	$arSections = array(
		'16' => array('css' => 'container', 'name' => 'Контейнер'),
		'17' => array('css' => 'animals', 'name' => 'Перевозка животных'),
		'18' => array('css' => 'food', 'name' => 'Продукты питания'),
		'19' => array('css' => 'rubish', 'name' => 'Вывоз мусора'),
		'20' => array('css' => 'passajir', 'name' => 'Пассажирские перевозки'),
		'21' => array('css' => 'mebel', 'name' => 'Мебель и бытовая техника'),
		'22' => array('css' => 'pereezd', 'name' => 'Переезд'),
		'23' => array('css' => 'car', 'name' => 'Автомобили и мотоциклы'),
		'24' => array('css' => 'dostavka', 'name' => 'Доставка'),
		'25' => array('css' => 'stroit', 'name' => 'Строительные материалы'),
		'26' => array('css' => 'negabarit', 'name' => 'Негабарит'),
		'27' => array('css' => 'other', 'name' => 'Прочие грузы'),
	);

	if(isset($_POST['iblock_submit']) === true)
	{
		echo '<h1>Изменения сохранены</h1>';
		
		
		$sql__12 = $db->prepare("
									UPDATE
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
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									JOIN
											`b_search_content`
									ON
											`b_search_content`.`ITEM_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE,
											`b_iblock_element`.`IBLOCK_SECTION_ID` = :__IBLOCK_SECTION_ID,
											`b_iblock_element`.`NAME` = :__NAME_1,
											`b_iblock_element`.`DETAIL_TEXT` = :__DETAIL_TEXT,
											`b_search_content`.`TITLE` = :__TITLE,
											`b_search_content`.`BODY` = :__BODY,
											`b_sale_viewed_product`.`NAME` = :__NAME_2,
											`b_search_content`.`TITLE` = :__TITLE_2,
											`b_search_content`.`BODY` = :__BODY_2
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__42;
							");
		$__VALUE = $_POST['PROPERTY__42'];
		$__IBLOCK_SECTION_ID = $_POST['IBLOCK_SECTION'];
		$__NAME_1 = $_POST['TITLE'];
		$__DETAIL_TEXT = $_POST['DESCRIPTION'];
		$__TITLE = $_POST['TITLE'];
		$__BODY = $_POST['DESCRIPTION'];
		$__NAME_2 = $_POST['TITLE'];
		$__TITLE_2 = $_POST['TITLE'];
		$__BODY_2 = $_POST['DESCRIPTION'];
		$sql__12->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__12->bindParam(':__IBLOCK_SECTION_ID', $__IBLOCK_SECTION_ID, PDO::PARAM_STR);
		$sql__12->bindParam(':__NAME_1', $__NAME_1, PDO::PARAM_STR);
		$sql__12->bindParam(':__DETAIL_TEXT', $__DETAIL_TEXT, PDO::PARAM_STR);
		$sql__12->bindParam(':__TITLE', $__TITLE, PDO::PARAM_STR);
		$sql__12->bindParam(':__BODY', $__BODY, PDO::PARAM_STR);
		$sql__12->bindParam(':__NAME_2', $__NAME_2, PDO::PARAM_STR);
		$sql__12->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__12->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__12->bindParam(':__42', $__42, PDO::PARAM_STR);
		$sql__12->bindParam(':__TITLE_2', $__TITLE_2, PDO::PARAM_STR);
		$sql__12->bindParam(':__BODY_2', $__BODY_2, PDO::PARAM_STR);
		$sql__12->execute();
		
		$sql__13 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__42;
							");
		$__VALUE = $_POST['PROPERTY__42'];
		$sql__13->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__13->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__13->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__13->bindParam(':__42', $__42, PDO::PARAM_STR);
		$sql__13->execute();
		
		$sql__14 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__43;
							");
		$__VALUE = $_POST['PROPERTY__43'];
		$sql__14->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__14->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__14->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__14->bindParam(':__43', $__43, PDO::PARAM_STR);
		$sql__14->execute();
		
		$sql__15 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__43;
							");
		$__VALUE = $_POST['PROPERTY__43'];
		$sql__15->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__15->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__15->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__15->bindParam(':__43', $__43, PDO::PARAM_STR);
		$sql__15->execute();
		
		$sql__16 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__44;
							");
		$__44 = 44;
		$__VALUE = $_POST['PROPERTY__44'];
		$sql__16->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__16->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__16->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__16->bindParam(':__44', $__44, PDO::PARAM_STR);
		$sql__16->execute();
		
		$sql__22 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__45;
							");
		$__45 = 45;
		$__VALUE = $_POST['PROPERTY__45'];
		$sql__22->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__22->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__22->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__22->bindParam(':__45', $__45, PDO::PARAM_STR);
		$sql__22->execute();
		
		$sql__21 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__46;
							");
		$__46 = 46;
		$__VALUE = $_POST['PROPERTY__46'];
		$sql__21->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__21->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__21->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__21->bindParam(':__46', $__46, PDO::PARAM_STR);
		$sql__21->execute();
		
		$sql__17 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__47;
							");
		$__47 = 47;
		$__VALUE = $_POST['PROPERTY__47'];
		$sql__17->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__17->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__17->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__17->bindParam(':__47', $__47, PDO::PARAM_STR);
		$sql__17->execute();
		
		$sql__18 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__48;
							");
		$__48 = 48;
		$__VALUE = $_POST['PROPERTY__48'];
		$sql__18->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__18->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__18->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__18->bindParam(':__48', $__48, PDO::PARAM_STR);
		$sql__18->execute();
		
		$sql__19 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__49;
							");
		$__49 = 49;
		$__VALUE = $_POST['PROPERTY__49'];
		$sql__19->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__19->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__19->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__19->bindParam(':__49', $__49, PDO::PARAM_STR);
		$sql__19->execute();
		
		$sql__20 = $db->prepare("
									UPDATE
											`b_iblock_element`
									JOIN
											`b_user`
									ON
											`b_user`.`ID` = `b_iblock_element`.`CREATED_BY`
									JOIN
											`b_iblock_element_property`
									ON
											`b_iblock_element_property`.`IBLOCK_ELEMENT_ID` = `b_iblock_element`.`ID`
									SET
											`b_iblock_element_property`.`VALUE` = :__VALUE
									WHERE
											`b_iblock_element`.`XML_ID` = :__get
									AND
											`b_user`.`LOGIN` = :__cookies
									AND
											`b_iblock_element_property`.`IBLOCK_PROPERTY_ID` = :__50;
							");
		$__50 = 50;
		$__VALUE = $_POST['PROPERTY__50'];
		$sql__20->bindParam(':__VALUE', $__VALUE, PDO::PARAM_STR);
		$sql__20->bindParam(':__get', $__get, PDO::PARAM_STR);
		$sql__20->bindParam(':__cookies', $__cookies, PDO::PARAM_STR);
		$sql__20->bindParam(':__50', $__50, PDO::PARAM_STR);
		$sql__20->execute();
		
		?>
		<script>
		window.location.replace("index.php?edit_ads=" + <?=$_GET['edit_ads']?> + '&11');
		</script>
		<?php
	}
}
?>
<div class="all_categories" id="bx_incl_area_3">
	<ul class="order">
		<li><a href="#16" links="16" class="container">Контейнер</a></li>
		<li><a href="#17" links="17" class="animals">Перевозка животных</a></li>
		<li><a href="#18" links="18" class="food">Продукты питания</a></li>
		<li><a href="#19" links="19" class="rubish">Вывоз мусора</a></li>
		<li><a href="#20" links="20" class="passajir">Пассажирские перевозки</a></li>
		<li><a href="#21" links="21" class="mebel">Мебель и бытовая техника</a></li>
		<li><a href="#22" links="22" class="pereezd">Переезд</a></li>
		<li><a href="#23" links="23" class="car">Автомобили и мотоциклы</a></li>
		<li><a href="#24" links="24" class="dostavka">Доставка</a></li>
		<li><a href="#25" links="25" class="stroit">Строительные материалы</a></li>
		<li><a href="#26" links="26" class="negabarit">Негабарит</a></li>
		<li><a href="#27" links="27" class="other">Прочие грузы</a></li>
	</ul>
</div>
<div class="content category-shipping">
	<div class="container_center wrapper">
		<?php
		if(empty($row__01['TITLE']) === false)
		{
		?>
			<h1>Редактировать товар - <?=$row__01['TITLE']?></h1>
			<form name="category-shipping" method="post" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				
				<div class="dostavka-container">
					<div class="dostavka-block">
						<a class="<?=$arSections[$row__11['IBLOCK_SECTION_ID']]['css']?>" href="#">
							<?=$arSections[$row__11['IBLOCK_SECTION_ID']]['name']?>
						</a>
					</div>
				</div>
					
				<input class="section_id" type="hidden" name="IBLOCK_SECTION" value="<?=$row__11['IBLOCK_SECTION_ID']?>">
				<b class="change-category">Изменить категорию</b>
				
				<div class="padding_top">
					<h2>Что нужно перевезти:</h2>
					
					<input type="text" name="TITLE" value="<?=$row__01['TITLE']?>" class="title" placeholder="Что нужно перевезти"/>
					<br/>
					
					<textarea rows="6" cols="104" name="DESCRIPTION" class="description" placeholder="Этажи спуска/подъема, наличие лифтов и прочие детали перевозки"><?=$row__01['BODY']?></textarea>
					<br/>                                
					
					<input type="text" name="PROPERTY__42" value="<?=$row__02['VALUE']?>" class="volume" id="volume" placeholder="Объем груза"/>
					<label class="volume-label" for="volume">м3</label>
					
					<input type="text" name="PROPERTY__43" value="<?=$row__03['VALUE']?>" class="weight" id="weight" placeholder="Вес груза"/>
					<label class="weight-label" for="weight">кг</label>
					<br/><br/>
					
					<img src="<?=SITE_TEMPLATE_PATH?>/img/man.png" alt=""/>
					
					<?
					$arPorters = array(
						'1' => 'Погрузка/разгрузка не требуется',
						'2' => 'Достаточно помощи водителя',
						'3' => 'Необходим 1 грузчик',
						'4' => 'Необходимо 2 грузчика',
						'5' => 'Необходимо 3 грузчика'
					);
					?>
					<select name="PROPERTY__44" class="porter-count" id="porter-count">
						<?foreach ($arPorters as $porter => $porterText):?>
						<option value="<?=$porter?>" <?if ($arResult['ELEMENT_PROPERTIES']['44']['0']['VALUE'] == $porter || $row__10['VALUE'] == $porter):?>selected="selected"<?endif?>><?=$porterText?></option>
						<?PHP
						// ЗДЕСЬ АНАЛОГИЧНО НУЖНО ПОКАЗАТЬ ТОТ ПУНКТ, КОТОРЫЙ ПОЛЬЗОВАТЕЛЕМ БЫЛ ВЫБРАН В ПРОШОЛЫЙ РАЗ
						?>
						<?endforeach?>
					</select>
					<br/><br/>

					<h2>Откуда, куда, когда:</h2>
					<input type="text" class="from" name="PROPERTY__47" value="<?=$row__06['VALUE']?>" placeholder="Город (откуда) *"/>
					<input type="text" class="from-street" name="PROPERTY__48" value="<?=$row__07['VALUE']?>" placeholder="Улица, дом"/>
					<a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
					<br/>
					
					<input type="text" class="to" name="PROPERTY__49" value="<?=$row__08['VALUE']?>" placeholder="Город (куда) *"/>
					<input type="text" class="to-street" name="PROPERTY__50" value="<?=$row__09['VALUE']?>" placeholder="Улица, дом"/>
					<a href="#inline1" class="location fancybox"><img src="<?=SITE_TEMPLATE_PATH?>/img/location.png" alt=""/></a>
					<br/>
					
					<div id="inline1" style="display: none;"></div>
					<br/>
					
					<input type="text" id="date" name="PROPERTY__45" value="<?=$row__04['VALUE']?>" class="date" placeholder="Дата перевозки"/>
					<input type="text" id="time" name="PROPERTY__46" value="<?=$row__05['VALUE']?>" class="time" placeholder="Время"/>
					<br/>
					<input type="submit" name="iblock_submit" class="submit" value="Сохранить изменения"/>
				</div>
			</form>
			<div class="clear"></div>
		<?php
		}
		else
		{
			?>
			<h1>У вас нет прав для редактирования данной страницы</h1>
			<?php
		}
		?>
	</div>
</div>

<script type="text/javascript">
var myPlacemarkFrom, myPlacemarkTo;
var coordsFrom, coordsTo;
var distance;
var country, region, city, address;
var route;

$(document).ready(function()
{
$('.change-category').click(function($)
{
	
});

$('#date').datepicker();
$('#time').timepicker({timeFormat: "hh:mm", altFieldTimeOnly: true, amPmText: ['', '']});

$('.load-photo').click(function(e)
{
	e.preventDefault();
	
	$('#load-photo').click();

	return false; 
});

$('#load-photo').change(function()
{
	text = $.trim($('#load-photo').val());
	slashIndex = text.lastIndexOf('\\') + 1;
	text = text.substr(slashIndex);
	
	$('.load-photo').val('Выбранное фото: ' + text);
});

$('.from, .from-street').click(function() { if (!myPlacemarkFrom) { $('.fancybox').click(); } });
$('.to, .to-street').click(function() { if (!myPlacemarkTo) { $('.fancybox').click(); } });

ymaps.ready(function () 
{         
	// Устанавливаем ширину/высоту контейнера карты
	$('#inline1').css({width: $(window).width() - 400, height: $(window).height() - 200});
	$('.fancybox').fancybox(
	{
		afterShow: function ()
		{
			// Если карту не создали ранее
			if (!window.myMap)
			{
				// Создаём её
				window.myMap = new ymaps.Map("inline1", 
				{
					center: [ymaps.geolocation.latitude, ymaps.geolocation.longitude],
					zoom: 10,
					behaviors: ["scrollZoom", "drag"]
				});
				
				// Добавляем на карту контролы
				window.myMap.controls.add('zoomControl').add('miniMap').add('typeSelector').add('mapTools').add('searchControl');
				
				// Добавляем слушателя кликов по карте
				window.myMap.events.add('click', function (e) 
				{
					// Если метка «От» ещё не создана – создаём
					if (!myPlacemarkFrom) 
					{
						coordsFrom = e.get('coords');
						myPlacemarkFrom = createPlacemark(coordsFrom, "A");
						window.myMap.geoObjects.add(myPlacemarkFrom);
						
						// Добавляем слушателя передвижения метки «От»
						myPlacemarkFrom.events.add('dragend', function () 
						{    
							coordsFrom = myPlacemarkFrom.geometry.getCoordinates();
							
							// Если обе метки установлены - считаем и актуализируем расстояние
							if (myPlacemarkTo)       
							{
								ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
								{
									route = router;
									distance = route.getLength() * 0.001;
									$('#distance').val(Math.floor(distance));    
								});
							}
							
							// Устанавливаем на форме адрес метки «От»
							getAddress('from', coordsFrom);
						});
						
						getAddress('from', coordsFrom);
					}
					// Если метка «До» ещё не создана – создаём
					else if (!myPlacemarkTo)
					{
						coordsTo = e.get('coords');
						myPlacemarkTo = createPlacemark(coordsTo, "B");
						window.myMap.geoObjects.add(myPlacemarkTo);
						
						// Добавляем слушателя передвижения метки «До»
						myPlacemarkTo.events.add('dragend', function () 
						{
							coordsTo = myPlacemarkTo.geometry.getCoordinates();
							
							// Если обе метки установлены - считаем и актуализируем расстояние
							if (myPlacemarkFrom)
							{
								ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
								{
									route = router;
									distance = route.getLength() * 0.001;
									$('#distance').val(Math.floor(distance));    
								});
							}
							
							// Устанавливаем на форме адрес метки «До»
							getAddress('to', coordsTo);
						});
						
						// Устанавливаем на форме адрес метки «От»
						getAddress('to', coordsTo);
					}
					
					// Если установлены обе метки -вычисляем и записываем расстояние
					if (coordsFrom && coordsTo)
					{
						ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
						{
							route = router;
							distance = route.getLength() * 0.001;
							$('#distance').val(Math.floor(distance));    
						});
					}
				});

				// Функция создания метки
				function createPlacemark(coords, icon_content) 
				{
					return new ymaps.Placemark(coords, 
					{
						iconContent: icon_content
					}, 
					{
						draggable: true
					});
				}

				// Фукнкция определения адреса по координатам (обратное геокодирование)
				function getAddress(placemark, coords) 
				{     
					ymaps.geocode(coords).then(function (res) 
					{
						arr = [];
						
						id = 0;
						res.geoObjects.each(function (obj) 
						{
							value = obj.properties.get('name');
							
							if (id == 0)
							{
								$('#country_' + placemark).val(value);
							}
							
							if (value.toLowerCase().indexOf("область") >= 0 || value.toLowerCase().indexOf("москва") >= 0)
							{
								$('#region_' + placemark).val(value);
							}
							
							arr.push(value);
						});
					});
					  
					ymaps.geocode(coords, {json: false, kind: "locality", results: 1}).then(function (res) 
					{
						res.geoObjects.each(function (obj) 
						{                                           
							city = obj.properties.get('name');
						});
						
						ymaps.geocode(coords, {json: false, kind: "house", results: 1}).then(function (res) 
						{
							res.geoObjects.each(function (obj) 
							{
								address = obj.properties.get('name');
							});
							
							if (placemark == 'from')
							{
								$('input.from').val(city);
								$('input.from-street').val(address);
							}
							else if (placemark == 'to')
							{
								$('input.to').val(city);
								$('input.to-street').val(address);
							}
						});
					});
					
					$('#coords_' + placemark).val(coords);
				}
			}
		},
		afterClose: function () 
		{
//                window.myMap.destroy();
//                window.myMap = null;
//                myPlacemarkFrom = null;
//                myPlacemarkTo = null;
		}
	});
});
});
</script>