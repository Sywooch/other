<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
?><div class="left_categories">

<div>
<div class="head">
<span class="select_all">Выделить все</span>
<span class="line">  |  </span>
<span class="select_cancel">Снять выделение</span>

</div>


<ul>
<?
CModule::IncludeModule("iblock");
$wanted_sect=CIBlockSection::GetList(Array("ID"=>"ASC"), Array("IBLOCK_ID"=>6), false, Array());
while($one_sect=$wanted_sect->GetNext()) // 
{

	//	echo "<pre>";
	//	print_r($one_sect);
	//	echo "</pre>";
?>
<li data-id="<?=$one_sect['ID'];?>"><span><img src="<?=CFile::GetPath($one_sect["PICTURE"]);?>" alt="<?=$one_sect["NAME"];?>" title="<?=$one_sect["NAME"];?>" /><span><?=$one_sect["NAME"];?></span></span></li>

<?
}
?>

</ul>



</div>

</div>


<div class="map" id="map"></div>

<script type="text/javascript">
var full_names = [];
var full_images = [];
var full_images2 = [];
var full_name = [];
var full_date = [];
var full_f = [];
var full_s = [];
var full_r = [];
var full_id = [];
</script>

<?
//достать все адреса учебных заведений
CModule::IncludeModule("iblock");
$my_elements = CIBlockElement::GetList (
	  Array("ID" => "ASC"),
	  Array("IBLOCK_ID" => 6),
	  false,
	  false,
	  Array()
	);
$count=0;
 while($ar_fields = $my_elements->GetNext()){

	 //echo "<pre>";
	 //print_r($ar_fields);
	 //echo "</pre>";

$db_props = CIBlockElement::GetProperty(6, $ar_fields["ID"], "sort", "asc", array());
	$PROPS = array();
	while($ar_props = $db_props->Fetch()){
		$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
	}
//echo $PROPS['ADDRES']."<br>";

//echo $PROPS['CITY']."<br>"; - идентификатор города
//$ar_fields['ID'];
$obElement = CIBlockElement::GetByID($PROPS['CITY']);
if($arEl = $obElement->GetNext()){
   //echo $arEl["NAME"]."<br>";

$full_name=$arEl["NAME"].", ".$PROPS['ADDRES'];

}

//echo $full_name."<br>";
//https://geocode-maps.yandex.ru/1.x/?geocode=Тверская+6.
?>
<script type="text/javascript">

full_names[full_names.length]='<?=$full_name;?>';
	<?
	if($ar_fields['IBLOCK_SECTION_ID']==5){
echo "full_images[full_images.length]='/bitrix/images/label_1.png';";
	}else if($ar_fields['IBLOCK_SECTION_ID']==6){
echo "full_images[full_images.length]='/bitrix/images/label_2.png';";
	}else if($ar_fields['IBLOCK_SECTION_ID']==7){
echo "full_images[full_images.length]='/bitrix/images/label_3.png';";
	}else if($ar_fields['IBLOCK_SECTION_ID']==8){
echo "full_images[full_images.length]='/bitrix/images/label_4.png';";
	}else if($ar_fields['IBLOCK_SECTION_ID']==9){
echo "full_images[full_images.length]='/bitrix/images/label_5.png';";
	}else if($ar_fields['IBLOCK_SECTION_ID']==10){
echo "full_images[full_images.length]='/bitrix/images/label_6.png';";
	}
?>






	full_images2[full_images2.length]='<?=CFile::GetPath($ar_fields["PREVIEW_PICTURE"]); if($ar_fields["PREVIEW_PICTURE"]==""){ echo "/bitrix/images/no_photo.png";  }?>';





full_name[full_name.length]='<?=$ar_fields["NAME"];?>';

full_date[full_date.length]='<?=$PROPS["DATE"];?>';
full_f[full_f.length]='<?=$PROPS["FACULTIES"];?>';
full_s[full_s.length]='<?=$PROPS["STUDENTS"];?>';
full_r[full_r.length]='<?=$PROPS["RATING"];?>';
full_id[full_id.length]='<?=$ar_fields["IBLOCK_SECTION_ID"];?>';

	//alert(full_images['<?=$count;?>']+" -- "+full_name['<?=$count;?>']+" -- "+full_id['<?=$count;?>']);
<? $count++; ?>


	//for(var i2=0;i2<full_images.length;i2++){
	//alert(full_images[i2]+" = "+full_id[i2]);
	//}
	//full_images[]=/bitrix/images/label_1.png
</script>


<?

}


?>




<script type="text/javascript">
 var myMap;
    ymaps.ready(function () {

myMap = new ymaps.Map("map", {
    center: [59.93772, 30.313622],
    zoom: 10,
controls: []
});


myMap.behaviors.enable('scrollZoom');


		//myCollection = new ymaps.GeoObjectCollection();



var Collection1 = new ymaps.GeoObjectCollection(null, {
            preset: 'islands#yellowIcon'
        });




for(var i2=0;i2<full_images.length;i2++){

	//alert(i2);
  ymaps.option.presetStorage.add('custom#active'+i2, {
    iconLayout: 'default#image',
	  iconImageHref: full_images[i2],
    iconImageSize: [30, 40],
    iconImageOffset: [-15, -40],
								 /* iconImageClipRect: [
      [0, 30],
      [30, 70]
],*/
    hideIconOnBalloonOpen: false
  });


}

		//var myCollection = new ymaps.GeoObjectCollection();

for(var i=0;i<full_names.length;i++){


	//alert(i);
var i3=0;
	//alert(i3);
//alert(full_names[i]);
ymaps.geocode(full_names[i], {
        /**
         * Опции запроса
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        // Сортировка результатов от центра окна карты.
        // boundedBy: myMap.getBounds(),
        // strictBounds: true,
        // Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
        // Если нужен только один результат, экономим трафик пользователей.
        results: 1
    }).then(function (res) {
            // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                // Координаты геообъекта.
                coords = firstGeoObject.geometry.getCoordinates(),
                // Область видимости геообъекта.
                bounds = firstGeoObject.properties.get('boundedBy');

	//alert(i3);
var tmp='custom#active'+i3;
	//	alert(tmp+"=");
firstGeoObject.options.set('preset', {
    preset: tmp
  });



	var baloon_content="<div class='container'><div class='left'><img src='"+full_images2[i3]+"' alt='' title=''/></div><div class='right'><p class='head'>"+full_name[i3]+"</p><p>Дата основания: "+full_date[i3]+" год.</p><p>Факультеты: "+full_f[i3]+" шт.</p><p>Учащихся: "+full_s[i3]+" чел.</p><p>Место в рейтинге: "+full_r[i3]+"</p></div></div><div class='point'></div>";

	//	alert(baloon_content);

i3++;


firstGeoObject.properties.set('balloonContentBody', baloon_content);
firstGeoObject.properties.set('balloonShadow', false);
	//myCollection.add(firstGeoObject);
Collection1.add(firstGeoObject);

            // Добавляем первый найденный геообъект на карту.
            myMap.geoObjects.add(firstGeoObject);



	//firstGeoObject.properties.set('balloonContent', "----");



            // Масштабируем карту на область видимости геообъекта.
	myMap.setBounds(bounds, {
                // Проверяем наличие тайлов на данном масштабе.
	     checkZoomRange: true
	 });










            /**
             * Все данные в виде javascript-объекта.
             */
            console.log('Все данные геообъекта: ', firstGeoObject.properties.getAll());
            /**
             * Метаданные запроса и ответа геокодера.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderResponseMetaData.xml
             */
            console.log('Метаданные ответа геокодера: ', res.metaData);
            /**
             * Метаданные геокодера, возвращаемые для найденного объекта.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderMetaData.xml
             */
            console.log('Метаданные геокодера: ', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData'));
            /**
             * Точность ответа (precision) возвращается только для домов.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/precision.xml
             */
            console.log('precision', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.precision'));
            /**
             * Тип найденного объекта (kind).
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/kind.xml
             */
            console.log('Тип геообъекта: %s', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.kind'));
            console.log('Название объекта: %s', firstGeoObject.properties.get('name'));
            console.log('Описание объекта: %s', firstGeoObject.properties.get('description'));
            console.log('Полное описание объекта: %s', firstGeoObject.properties.get('text'));

            /**
             * Если нужно добавить по найденным геокодером координатам метку со своими стилями и контентом балуна, 
//создаем новую метку по координатам найденной и добавляем ее на карту вместо найденной.
             */

	//  var myPlacemark = new ymaps.Placemark(coords, {
				 //iconContent: 'моя метка',
	//  balloonContent: 'Содержимое балуна <strong>моей метки</strong>'
	//   }, {
	//		 //preset: 'islands#violetStretchyIcon'
	//      });

	//   myMap.geoObjects.add(myPlacemark);




        });








}


		//myMap.geoObjects.add(Collection1)

		function all_map(){


myMap.destroy();




myMap = new ymaps.Map("map", {
    center: [59.93772, 30.313622],
    zoom: 10,
controls: []
});


myMap.behaviors.enable('scrollZoom');


		//myCollection = new ymaps.GeoObjectCollection();



var Collection1 = new ymaps.GeoObjectCollection(null, {
            preset: 'islands#yellowIcon'
        });




for(var i2=0;i2<full_images.length;i2++){

	//if(full_id[i2]!=id){ continue; };

	//alert(full_images[i2]);

  ymaps.option.presetStorage.add('custom#active'+i2, {
    iconLayout: 'default#image',
	  iconImageHref: full_images[i2],
    iconImageSize: [30, 40],
    iconImageOffset: [-15, -40],
								 /* iconImageClipRect: [
      [0, 30],
      [30, 70]
],*/
    hideIconOnBalloonOpen: false
  });


}

		//var myCollection = new ymaps.GeoObjectCollection();

for(var i=0;i<full_images.length;i++){

	//alert(full_id[i]+" = "+full_name[i]);
	//alert(i);
var i3=0;
	//alert(i3);
//alert(full_names[i]);
ymaps.geocode(full_names[i], {
        /**
         * Опции запроса
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        // Сортировка результатов от центра окна карты.
        // boundedBy: myMap.getBounds(),
        // strictBounds: true,
        // Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
        // Если нужен только один результат, экономим трафик пользователей.
        results: 1
    }).then(function (res) {
            // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                // Координаты геообъекта.
                coords = firstGeoObject.geometry.getCoordinates(),
                // Область видимости геообъекта.
                bounds = firstGeoObject.properties.get('boundedBy');

	//alert(i3);
var tmp='custom#active'+i3;
	//	alert(tmp+"=");
firstGeoObject.options.set('preset', {
    preset: tmp
  });



	var baloon_content="<div class='container'><div class='left'><img src='"+full_images2[i3]+"' alt='' title=''/></div><div class='right'><p class='head'>"+full_name[i3]+"</p><p>Дата основания: "+full_date[i3]+" год.</p><p>Факультеты: "+full_f[i3]+" шт.</p><p>Учащихся: "+full_s[i3]+" чел.</p><p>Место в рейтинге: "+full_r[i3]+"</p></div></div><div class='point'></div>";

	//	alert(baloon_content);

i3++;


firstGeoObject.properties.set('balloonContentBody', baloon_content);
firstGeoObject.properties.set('balloonShadow', false);
	//myCollection.add(firstGeoObject);
Collection1.add(firstGeoObject);

            // Добавляем первый найденный геообъект на карту.
	//	if(full_id[i3]==id){ 
            myMap.geoObjects.add(firstGeoObject);
	//};


	//firstGeoObject.properties.set('balloonContent', "----");



            // Масштабируем карту на область видимости геообъекта.
	myMap.setBounds(bounds, {
                // Проверяем наличие тайлов на данном масштабе.
	     checkZoomRange: true
	 });










            /**
             * Все данные в виде javascript-объекта.
             */
            console.log('Все данные геообъекта: ', firstGeoObject.properties.getAll());
            /**
             * Метаданные запроса и ответа геокодера.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderResponseMetaData.xml
             */
            console.log('Метаданные ответа геокодера: ', res.metaData);
            /**
             * Метаданные геокодера, возвращаемые для найденного объекта.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderMetaData.xml
             */
            console.log('Метаданные геокодера: ', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData'));
            /**
             * Точность ответа (precision) возвращается только для домов.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/precision.xml
             */
            console.log('precision', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.precision'));
            /**
             * Тип найденного объекта (kind).
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/kind.xml
             */
            console.log('Тип геообъекта: %s', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.kind'));
            console.log('Название объекта: %s', firstGeoObject.properties.get('name'));
            console.log('Описание объекта: %s', firstGeoObject.properties.get('description'));
            console.log('Полное описание объекта: %s', firstGeoObject.properties.get('text'));

            /**
             * Если нужно добавить по найденным геокодером координатам метку со своими стилями и контентом балуна, 
//создаем новую метку по координатам найденной и добавляем ее на карту вместо найденной.
             */

	//  var myPlacemark = new ymaps.Placemark(coords, {
				 //iconContent: 'моя метка',
	//  balloonContent: 'Содержимое балуна <strong>моей метки</strong>'
	//   }, {
	//		 //preset: 'islands#violetStretchyIcon'
	//      });

	//   myMap.geoObjects.add(myPlacemark);




        });








}





		}




		$("#content .left_categories .head .select_all").click(function(){
$("#content .left_categories li").addClass('active');
all_map();
		});

		$("#content .left_categories .head .select_cancel").click(function(){
$("#content .left_categories li").removeClass('active');
all_map();
		});


		$("#content .left_categories li").click(function(){
var id=$(this).attr("data-id");

			//myCollection.removeAll();

myMap.destroy();




myMap = new ymaps.Map("map", {
    center: [59.93772, 30.313622],
    zoom: 10,
controls: []
});


myMap.behaviors.enable('scrollZoom');


		//myCollection = new ymaps.GeoObjectCollection();



var Collection1 = new ymaps.GeoObjectCollection(null, {
            preset: 'islands#yellowIcon'
        });




for(var i2=0;i2<full_images.length;i2++){

	//if(full_id[i2]!=id){ continue; };

	//alert(full_images[i2]);

  ymaps.option.presetStorage.add('custom#active'+i2, {
    iconLayout: 'default#image',
	  iconImageHref: full_images[i2],
    iconImageSize: [30, 40],
    iconImageOffset: [-15, -40],
								 /* iconImageClipRect: [
      [0, 30],
      [30, 70]
],*/
    hideIconOnBalloonOpen: false
  });


}

		//var myCollection = new ymaps.GeoObjectCollection();

for(var i=0;i<full_images.length;i++){

	//alert(full_id[i]+" = "+full_name[i]);
	//alert(i);
var i3=0;
	//alert(i3);
//alert(full_names[i]);
ymaps.geocode(full_names[i], {
        /**
         * Опции запроса
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
         */
        // Сортировка результатов от центра окна карты.
        // boundedBy: myMap.getBounds(),
        // strictBounds: true,
        // Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
        // Если нужен только один результат, экономим трафик пользователей.
        results: 1
    }).then(function (res) {
            // Выбираем первый результат геокодирования.
            var firstGeoObject = res.geoObjects.get(0),
                // Координаты геообъекта.
                coords = firstGeoObject.geometry.getCoordinates(),
                // Область видимости геообъекта.
                bounds = firstGeoObject.properties.get('boundedBy');

	//alert(i3);
var tmp='custom#active'+i3;
	//	alert(tmp+"=");
firstGeoObject.options.set('preset', {
    preset: tmp
  });



	var baloon_content="<div class='container'><div class='left'><img src='"+full_images2[i3]+"' alt='' title=''/></div><div class='right'><p class='head'>"+full_name[i3]+"</p><p>Дата основания: "+full_date[i3]+" год.</p><p>Факультеты: "+full_f[i3]+" шт.</p><p>Учащихся: "+full_s[i3]+" чел.</p><p>Место в рейтинге: "+full_r[i3]+"</p></div></div><div class='point'></div>";

	//	alert(baloon_content);

i3++;


firstGeoObject.properties.set('balloonContentBody', baloon_content);
firstGeoObject.properties.set('balloonShadow', false);
	//myCollection.add(firstGeoObject);
Collection1.add(firstGeoObject);

            // Добавляем первый найденный геообъект на карту.
	if(full_id[i3]==id){ 
            myMap.geoObjects.add(firstGeoObject);
 };


	//firstGeoObject.properties.set('balloonContent', "----");



            // Масштабируем карту на область видимости геообъекта.
	myMap.setBounds(bounds, {
                // Проверяем наличие тайлов на данном масштабе.
	     checkZoomRange: true
	 });










            /**
             * Все данные в виде javascript-объекта.
             */
            console.log('Все данные геообъекта: ', firstGeoObject.properties.getAll());
            /**
             * Метаданные запроса и ответа геокодера.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderResponseMetaData.xml
             */
            console.log('Метаданные ответа геокодера: ', res.metaData);
            /**
             * Метаданные геокодера, возвращаемые для найденного объекта.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderMetaData.xml
             */
            console.log('Метаданные геокодера: ', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData'));
            /**
             * Точность ответа (precision) возвращается только для домов.
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/precision.xml
             */
            console.log('precision', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.precision'));
            /**
             * Тип найденного объекта (kind).
             * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/kind.xml
             */
            console.log('Тип геообъекта: %s', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.kind'));
            console.log('Название объекта: %s', firstGeoObject.properties.get('name'));
            console.log('Описание объекта: %s', firstGeoObject.properties.get('description'));
            console.log('Полное описание объекта: %s', firstGeoObject.properties.get('text'));

            /**
             * Если нужно добавить по найденным геокодером координатам метку со своими стилями и контентом балуна, 
//создаем новую метку по координатам найденной и добавляем ее на карту вместо найденной.
             */

	//  var myPlacemark = new ymaps.Placemark(coords, {
				 //iconContent: 'моя метка',
	//  balloonContent: 'Содержимое балуна <strong>моей метки</strong>'
	//   }, {
	//		 //preset: 'islands#violetStretchyIcon'
	//      });

	//   myMap.geoObjects.add(myPlacemark);




        });








}






		});//click


   });
</script>




<p>Ищете где получить качественное образование в Москве, России или за рубежом? На Учёбе.ру мы собрали для вас всю нужную информацию о среднем, профессиональном, высшем и бизнес-образовании. В нашем каталоге представлены все школы, колледжи, вузы и другие учебные заведения, образовательные программы и инструменты для их поиска и сравнения. Вы можете выбрать интересующую вас специальность, сравнить программы государственного и частного образования, узнать стоимость обучения и условия поступления, ознакомиться с вариантами дистанционного или заочного обучения, выбрать куда можно пойти учиться после 9 или 11 классов и многое другое.</p>


<script type="text/javascript">



</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>