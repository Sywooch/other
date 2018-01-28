<span style="font-size:8pt; font-weight:bold;">

	<a href="<? $CurrPage = $APPLICATION->GetCurPage(true);



$HomePage1 = '/en/mission/';
$HomePage2 = '/en/history/';
$HomePage3 = '/en/science/';

$pos1 = strpos($CurrPage, $HomePage1);
$pos2 = strpos($CurrPage, $HomePage2);
$pos3 = strpos($CurrPage, $HomePage3);

$tmp_2="";
if($pos1 === false){

}else{
$tmp_2='/ob_institute/nashi_cseli_i_zadachi/';
}

if($pos2 === false){

}else{
$tmp_2='/ob_institute/istorya_instituta/';
}

if($pos3 === false){

}else{
$tmp_2='/nauka/';
}

if(($pos1 === false)&&($pos2 === false)&&($pos3 === false)){
	$tmp_2='/';
}

echo $tmp_2;


 ?>" style="<? $CurrPage = $APPLICATION->GetCurPage(true);


$HomePage = '/en/';

$pos = strpos($CurrPage, $HomePage);

if ($pos === false) {
	echo' color:#6eaa39; ';//rus
} else {
	echo' color:#4c4c4c; ';//eng
}

 ?> text-decoration:none;">Рус</a><span style="color:#4c4c4c;"> /</span>
<a href="<? $CurrPage = $APPLICATION->GetCurPage(true);

$HomePage1 = '/ob_institute/nashi_cseli_i_zadachi/';
$HomePage2 = '/ob_institute/istorya_instituta/';
$HomePage3 = '/nauka/';

$pos1 = strpos($CurrPage, $HomePage1);
$pos2 = strpos($CurrPage, $HomePage2);
$pos3 = strpos($CurrPage, $HomePage3);

$tmp_2="";
if($pos1 === false){

}else{
$tmp_2='/en/mission/';
}

if($pos2 === false){

}else{
$tmp_2='/en/history/';
}

if($pos3 === false){

}else{
$tmp_2='/en/science/';
}

if(($pos1 === false)&&($pos2 === false)&&($pos3 === false)){
	$tmp_2='/en/';
}

echo $tmp_2;

 ?>" style=" <? $CurrPage = $APPLICATION->GetCurPage(true);


$HomePage = '/en/';

$pos = strpos($CurrPage, $HomePage);

if ($pos === false) {
   echo' color:#4c4c4c; ';
} else {
   echo' color:#6eaa39; ';
}
 
        ?>  text-decoration:none;">Eng</a>

</span>