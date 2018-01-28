<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=login.php");
exit;
};



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Фабрика новостей - Создание новостного выпуска</title>
<script type="text/javascript" src="jquery/jquery.js"></script>
</head>



<frameset rows="50px,*"  cellpadding="0"  cellspacing="0">
<frame frameborder="0" src="frames_index_buffer/head.php" name="head" scrolling="no" noresize />
<frameset cols="33%,33%,*" cellpadding="0"  cellspacing="0">
 <frame frameborder="0" src="frames_index_buffer/frame1.php" name="frame1"  noresize style="border:2px black solid !important;"/>
 
<?php 

if(!isset($_GET['id_buffer'])){
echo'
 <frame frameborder="0" src="frames_index_buffer/frame2.php" name="frame2" 
 noresize  style="border:2px black solid !important;"/>
';

}else{
 $id_buffer=$_GET['id_buffer'];//идентификатор корзины, которую нужно создать.
// будет использоваться при создании новостного выпуска.

 echo'
 <frame frameborder="0" src="frames_index_buffer/frame2.php?id_buffer='.$id_buffer.'" name="frame2" 
 noresize  style="border:2px black solid !important;"/>
 
';

};
  ?>
 <frame frameborder="0" src="frames_index_buffer/frame3.php" name="frame3" noresize style="border:2px black solid !important;"/>
</frameset>
</frame>
<noframes>
        <body>
            <p>Для работы Портала нужен браузер с поддержкой <b>фреймов</b>.</p>
        </body>
    </noframes>
</frameset>



</html>
