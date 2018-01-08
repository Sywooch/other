<?php
//include('./connect.php');
//include('./func.php');

function vydiratel($text,$before,$after) 
{ 
         $text = @explode($before,$text); 
         $text = @explode($after,$text[1]); 
         $text = $text[0]; 
         return($text); 
} 

if( (!isset($_GET['id']))||(isset($_GET['id'])==NULL)||(isset($_GET['id'])=="") ){
$_GET['id']="1";
}

//$_GET['id']="1";
$cat = $_GET['id'];
//$img_g = $_GET['img'];


$data = @file_get_contents ('http://www.digitalplayground.com/movies/all-movies/all-pornstars/all-categories/alltime/bydate/'.$cat.'/') or die('Парсинг успешно завершен. <br />');

/*
$data = str_replace('<div id="hcontainer">','',$data);
$data = str_replace('<a href="http://www.gandex.ru"><img src="http://www.gandex.ru/images/logo.png" id="logo"></a>','',$data);
$data = str_replace('<div id="search">','',$data);
$data = str_replace('<div class="yaform-holster">','',$data);
$data = str_replace('<div id="social">','',$data);
$data = str_replace('class="yandexform yaform yaform_hint yaform_arr"','',$data);
$data = str_replace('<img src="/images/size-button.png" id="wpsize" style="cursor: pointer;">','',$data);
$data = str_replace('<span class="hlp">','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/reformal-button.png" alt="" style="border: 0;" class="tdsh">','',$data);
$data = str_replace('<span','',$data);
$data = str_replace('<div','',$data);
$data = str_replace('class','',$data);
$data = str_replace('<img src="/images/login.png','',$data);
$data = str_replace('<img src="/images/ico-close.png','',$data);
$data = str_replace('<img src="/images/rss-ico.png','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/facebook-ico.png','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/vkontakte-ico.png','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/twitter-ico.png','',$data);
$data = str_replace('<img src="/images/head-menu-enter.jpg','',$data);
$data = str_replace('<img src="//mc.yandex.ru/watch/30173?cnt-=1','',$data);
$data = str_replace('<img src="http://widget.reformal.ru/i/reformal_ru.png','',$data);
$data = str_replace('<img src="/images/path-arrow.png','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/next-button.png','',$data);
$data = str_replace('<img src="http://www.gandex.ru/images/prev-button.png','',$data);
*/

echo $data;

sleep (5);




//$img = vydiratel($data,'<img src="','"') ;
//echo $img;
//$img='<img src="'.$img.'" width="1000" style="float:left;"/>';
//echo $img;


/*
$url = vydiratel($data,'<br /><a href="','">Вчера&lt;&lt;') ;
if (trim($url) == '') $url = vydiratel($data,'<div class="voteresult"><a href="','">&lt;&lt; Назад') ;
if (trim($url) == '') $url = vydiratel($data,'</span><a href="','">') ;
if (trim($url) == '') $url = vydiratel($data,'<div class="voteresult"><a href="','">&lt;&lt;') ;
if (trim($url) == '') $url = vydiratel($data,'<div class="voteresult"><a href="','">&lt;&lt;') ;
if (trim($url) == '') $url = vydiratel($data,'<div class="voteresult"><a href="','">&lt;&lt;') ;
//echo $data ;

$data = str_replace ('<div class="topicbox"><div><div class="subdate">', '', $data) ;
$data = str_replace ('<div class="topicbox"><div class="subdate">', '', $data) ;
*/



//for ($i=1; $i <= 15; $i++)
//{
    /*$name = vydiratel($data,'<h3><a title="Читать - Анекдоты','</h3>') ;
    $data = str_replace ('<h3><a title="Читать - Анекдоты'.$name.'</h3>', '', $data) ;
    $name = vydiratel($name,'">','</a>') ;
    $name = iconv('windows-1251', 'UTF-8', $name);*/
    
	
	
  /*  $text = vydiratel($data,'<div class="topicbox">','</div>') ;
    $data = str_replace ('<div class="topicbox">'.$text.'</div>', '', $data) ;
    
    $name = vydiratel( $text,'<p class="title">','</p>') ;
    $text = str_replace ('<p class="title">'.$name.'</p>', '', $text) ;
    $name = strip_tags ($name) ;
    $name = iconv('windows-1251', 'UTF-8', $name);
    $name = trim ($name) ;
    
    $tags = vydiratel($text,'<div class="tags">','</div>') ;
    $text = str_replace ('<div class="tags">'.$tags.'</div>', '', $text) ;
    $tags = strip_tags ($tags) ;
    $tags = trim ($tags) ;
    $tags = iconv('windows-1251', 'UTF-8', $tags);
    
    $img_name = rand(1111,9999999999).'.jpg' ;
    $img = vydiratel($text,'src="','"') ;
    $img = file_get_contents($img);
    
    if (strlen($img) > 100)
       file_put_contents('./img/'.$img_name, $img) ;
    else
       $img_name = '' ;
    
    $text = str_replace ('<br />', "\n", $text) ;
    $text = strip_tags ($text) ;
    $text = iconv('windows-1251', 'UTF-8', $text);
    $text = trim($text) ;

    $text = str_replace ($name, '', $text) ;
    $text = str_replace ($tags, '', $text) ;*/
            
   // $res =  mysql_query ("Select * From `www.anekdot.ru` WHERE `data`='$text'") ;
   // $row = mysql_fetch_array ($res) ;
    
    //echo $name . '<br>' .$text. '<br>'; die();
   // if ($text != '' and $row['data'] == '' )
    //  if (( strlen($img) > 100 and $img_g == 'yes') or $img_g != 'yes')
     //   mysql_query ("INSERT INTO `www.anekdot.ru` (name,data,cat,tags, img) VALUES('$name','$text','$cat','$tags','$img_name');") ;
    
//}

$cat++;
if($cat==60){ exit; };
//echo '<meta http-equiv="refresh" content="0; url=./2.php?id='.$url.'" />' ;
echo '<meta http-equiv="refresh" content="0; url=./2.php?id='.$cat.'" />' ;

?>