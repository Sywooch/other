<?php 
$test = htmlspecialchars($_GET["search"]);
 
 
 if (substr_count('о нас', $test)){
 header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=2');
 } 
 
 elseif (substr_count('афиша', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=4');
 }
  elseif (substr_count('напишите нам', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=11');
 }
  elseif (substr_count('наш адрес', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=12');
 }
 
  elseif (substr_count('расписание занятий', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=10');
 }
  elseif (substr_count('цены', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=5');
 }
 
   elseif (substr_count('для родителей', $test) ){
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=14');
 }
 
    elseif (substr_count('акции Бонусы Скидки', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=6');
 }
 
 
     elseif (substr_count('фотогаллерея', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=7');
 }
      elseif (substr_count('детские праздники', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=8');
 }
 
       elseif (substr_count('отзывы', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=15');
 }
 
        elseif (substr_count('друзья и партнеры', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=16');
 }
 
         elseif (substr_count('наша команда', $test)) {
  header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=18');
 }
 
 else{ 
header('Location: http://prodlenka28.ru/index.php?option=com_content&view=article&id=17');
 }
 
 
 

?>