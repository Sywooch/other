<?php 
$otz =  "\n".strip_tags($_POST['f1']).'/#/'.  strip_tags($_POST['f2']);
file_put_contents('otzivi.txt', $otz, FILE_APPEND | LOCK_EX);
header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=15');
?>