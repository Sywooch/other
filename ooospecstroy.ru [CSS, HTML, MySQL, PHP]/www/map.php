<?php
session_start();
header('Content-type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Компания предлагает полный цикл услуг в области строительства, реставрации, реконструкции, ремонта и отделочных работ, а также изготовление корпусной мебели по индивидуальным заказам физических и юридических лиц"/>
<meta name="keywords" content="компания спецстрой благовещенск" />
<meta name="robots" content="all"/>
<meta name="revisit-after" content="1 days"/>
<meta name="document-state" content="Dynamic"/>
<meta name="generator" content="notepad++">
<meta name="author" content="retina-studio">
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда исползовать стандартный режим отображения-->
<script type="text/javascript" src="http://maps.api.2gis.ru/1.0"></script>

<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Карта</title>

<link rel="stylesheet" href="css/global.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/style_header.css"/>
<link rel="stylesheet" href="css/style_content.css"/>
<link rel="stylesheet" href="css/style_footer.css"/>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38692430-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="http://maps.api.2gis.ru/1.0"></script> 
    <script type="text/javascript"> 
        // Создаем обработчик загрузки страницы: 
        DG.autoload(function() { 
            // Создаем объект карты, связанный с контейнером: 
            var myMap = new DG.Map('myMapId'); 
            // Устанавливаем центр карты, и коэффициент масштабирования: 
            myMap.setCenter(new DG.GeoPoint(127.504399,50.264827), 15); 
            // Добавляем элемент управления коэффициентом масштабирования: 
            myMap.controls.add(new DG.Controls.Zoom()); 
 
                        // Создаем балун:
            var myBalloon = new DG.Balloons.Common({
                // Местоположение на которое указывает балун: 
                 geoPoint: new DG.GeoPoint(127.504399,50.264827),
                 // Устанавливаем текст, который будет отображатся при открытии балуна:
                 contentHtml: '<div style="height:100px; width:280px">Спецстрой, ООО,<br>ремонтно-производственная компания<br>ул.Артиллерийская 31,<br>+7 (4162) 53-72-72,<br>+79145570072<br></div><div align="center" style="height:150px; width:280px"><img src="images/logo_map.jpg"/></div>'
            });
            // Создаем маркер:
            var myMarker = new DG.Markers.Common({
                 // Местоположение на которое указывает маркер:
                 geoPoint: new DG.GeoPoint(127.504399,50.264827),
                 // Функция, вызываемая при клике по маркеру
                 clickCallback: function() {
                    if (! myMap.balloons.getDefaultGroup().contains(myBalloon)) {
                        // Если балун еще не был добавлен на карту, добавляем его:
                         myMap.balloons.add(myBalloon);
                     } else {
                         // Показываем уже ранее добавленный на карту балун
                         myBalloon.show();
                     }
                }
            });
            // Добавить маркер на карту:
            myMap.markers.add(myMarker);
        }); 
    </script> 


</head>

<body style="background-color:#483930;" >
<?php include_once("analyticstracking.php") ?>

<!--всплывающий блок с картой-->


<div id="myMapId" style="width:800px; height:600px; position:absolute; top:50%; left:50%; background-color:blue; margin:-300px 0 0 -400px"></div>





</body>

</html>
