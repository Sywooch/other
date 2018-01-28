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
<meta name="generator" content="notepad++ :)  fuck you">
<meta name="author" content="retina-studio">
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда исползовать стандартный режим отображения-->
<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Контакты</title>

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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/jquery.highlight.js"></script>

</head>
<body   style="background-color:#483930">
<?php include_once("analyticstracking.php") ?>
<?php
if(($_GET['foto']=="")||($_GET['foto']==NULL)||(!isset($_GET['foto']))){
$foto='0920_big';
}else{
$foto=$_GET['foto'];}
echo'<img src="content/images/contacts_content/'.$foto.'_big.jpg" alt="мебель" style="max-width:100%"/> ';

?>

</body>

</html>
