<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="http://maps.api.2gis.ru/1.0"></script>
<?php
$Pos1=$_GET['Pos1'];
$Pos2=$_GET['Pos2'];
$A=$_GET['A'];
$F=$_GET['F'];
$City=$_GET['City'];
$C=$_GET['C'];


echo'
<script type="text/javascript">
    // Создаем обработчик загрузки страницы:
    DG.autoload(function() {
        // Создаем объект карты, связанный с контейнером:
        var myMap = new DG.Map(\'myMapId\');
        // Устанавливаем центр карты и коэффициент масштабирования:
        myMap.setCenter(new DG.GeoPoint('.$Pos1.','.$Pos2.'),17);
        // Добавляем элемент управления коэффициентом масштабирования:
        myMap.controls.add(new DG.Controls.Zoom());
        
        // Создаем балун:
var myBalloon = new DG.Balloons.Common({
    // Местоположение на которое указывает балун: 
    geoPoint: new DG.GeoPoint('.$Pos1.','.$Pos2.'),
    // Устанавливаем текст, который будет отображатся при открытии балуна:
    contentHtml: \'<div style="height:140px">'.$A.',<br>'.$City.', '.$F.'<br>'.$C.'<br></div> \'
});
// Создаем маркер:
var myMarker = new DG.Markers.Common({
    // Местоположение на которое указывает маркер:
    geoPoint: new DG.GeoPoint('.$Pos1.','.$Pos2.'),
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
</script>';
?>


<script type="text/javascript">
function f_show(){
$("#f").show(2000);
}

function action(t){
var t2=("actions2.php?id_action="+t);

window.location.href=t2;

}
</script>


</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Карта</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<div id="myMapId" style=" margin-top:20px;width:800px; height:400px;  margin-left:0px;margin-bottom:20px; background-color: #333333"> 
</div> 

</div>


<a href="organisations.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>

</div>


</div>
</body>

</html>
