<?php
include('./connect.php');
include('./func.php');

$cat = $_GET['id'];

$data = @file_get_contents ('http://anekdotov.net'.$cat) or die('Парсинг успешно завершен. <br /> <a href="./view.php?site=anekdotov.net">Посмотреть последние спарсенные записи</a>');

$url_next = vydiratel($data,'<td width=10% align=right><a href=','><img') ; ;

$data = vydiratel($data,'<div class="pagenavimini">','<div id="yandex_ad6431"></div>') ;
$data = substr($data, 450);

for ($i=1; $i <= 15; $i++)
{    
    $text = vydiratel($data,'<a href=/pic/photo9/','.html><img') ;
    if (trim($text) != '') 
    {
        $url = 'http://anekdotov.net/pic/photo9/'.$text.'.html' ;
        $data = str_replace ('<a href=/pic/photo9/'.$text.'.html><img', '', $data) ;
    }
    else
    {
      $text = vydiratel($data,'<a href=/best/pic/','.html><img') ;
      if (trim($text) != '') 
      {
         $url = 'http://anekdotov.net/best/pic/'.$text.'.html' ;
         $data = str_replace ('<a href=/best/pic/'.$text.'.html><img', '', $data) ;
      }
    }
    $text = @file_get_contents ($url) ;
    $img = 'http://anekdotov.net' . vydiratel($text,'<input type=hidden name=pic value="','">') ;

    $img_name = rand(1111,9999999999).'.jpg' ;
    $img = file_get_contents($img);
    
    if (strlen($img) > 100)
       file_put_contents('./img/'.$img_name, $img) ;
    else
       $img_name = '' ;
    
    //echo $name . '<br>' .$text. '<br>'; die();
    if (strlen($img) > 100)
    mysql_query ("INSERT INTO `anekdotov.net` (img) VALUES('$img_name');") ;
}

echo '<meta http-equiv="refresh" content="0; url=./3.1.php?id='.$url_next.'" />' ;

?>