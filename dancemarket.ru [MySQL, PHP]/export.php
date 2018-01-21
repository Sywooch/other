<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);
$start = microtime(true);


$dir=str_replace("/action","",dirname(__FILE__));
$dir=str_replace("\action","",dirname(__FILE__));
$dir=str_replace("/action","",$dir);
//echo "==".$dir."==";  

 
  
define('_JEXEC', 1);
define('JPATH_BASE', $dir);
define('DS', DIRECTORY_SEPARATOR);



ini_set('max_execution_time', 9600000);
ini_set('memory_limit', '2200M');
set_time_limit(9600000);
 
/* Required files */
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
require_once JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php';
//require_once JPATH_BASE.DS.'libraries'.DS.'import.php';
//require_once JPATH_BASE.DS.'administratior'.'/components/com_zoo/config.php';
require_once ( JPATH_LIBRARIES.DS.'import.php');
$app = JFactory::getApplication('site')->initialise();
require_once (JPATH_ADMINISTRATOR.'/components/com_zoo/config.php');


/* Create the Application */

$app2 = App::getInstance('zoo');
//$app2 = JFactory::getApplication('zoo');





$html="";
$html=$html.'<yml_catalog date="'.date("Y-m-d H:i:s").'">';
$html=$html.'<shop id="1">';
$html=$html.'<name>danceduet.ru</name>';
$html=$html.'<company>danceduet.ru</company>';
$html=$html.'<url>';
$html=$html.'<ref>';
$html=$html.'http://danceduet.ru';
$html=$html.'</ref>';
$html=$html.'<name>danceduet.ru</name>';
$html=$html.'</url>';
$html=$html.'<currencies>';
$html=$html.'<currency id="RUB" rate="CBRF"/>';
$html=$html.'</currencies>';

$html=$html.'<categories>';

//выборка корневых категорий
$database2 = JFactory::getDbo();
$database2->setQuery("SELECT * FROM #__zoo_application");
$list2 = $database2->loadObjectList();
foreach($list2 as $it2) {
	$html=$html.'<category id="1010'.$it2->id.'" parentId="0">'.$it2->name.'</category>';	
}

//выборка подкатегорий
$database2->setQuery("SELECT * FROM #__zoo_category WHERE published=1");
$list2 = $database2->loadObjectList();
foreach($list2 as $it2) {
	$html=$html.'<category id="'.$it2->id.'" parentId="1010'.$it2->application_id.'">'.$it2->name.'</category>';	
}



$html=$html.'</categories>';
$html=$html.'<offers>';










//выборка идентификаторов свойств без повторений
$database2 = JFactory::getDbo();
$database2->setQuery("SELECT DISTINCT element_id FROM #__zoo_search_index");
$list2 = $database2->loadObjectList();
foreach($list2 as $it2) {
$Data[]=$it2->element_id;

}





//проход по товарам


$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__zoo_item WHERE state=1");
$list = $database->loadObjectList();
foreach($list as $it) { 

$id=$it->id;
$application=$it->application_id;
//$name=iconv('UTF-8','CP1251',$it->name);
$name=$it->name;

$html=$html.'<offer id="'.$id.'" type="vendor.model">';

$html=$html.'<url>';



$database3 = JFactory::getDbo();
$database3->setQuery("SELECT * FROM #__zoo_application WHERE id='$application'");
$list3 = $database3->loadObjectList();
foreach($list3 as $it3) { 
$alias_1=$it3->alias;
}


$html=$html.'http://danceduet.ru/index.php/'.$alias_1.'/';


$database3->setQuery("SELECT * FROM #__zoo_category_item WHERE item_id='$id'");
$list3 = $database3->loadObjectList();
foreach($list3 as $it3) { 
$category_id=$it3->category_id;
}

$database3->setQuery("SELECT * FROM #__zoo_category WHERE id='$category_id'");
$list3 = $database3->loadObjectList();
foreach($list3 as $it3) { 
$alias_2=$it3->alias;
}
$html=$html.$alias_2."/item/".$it->alias;

$html=$html.'</url>';



$html=$html.'<currencyId>RUB</currencyId>';
$html=$html.'<categoryId>'.$category_id.'</categoryId>';
echo "Category: ".$category_id." <br>"; 
echo "Category: ".$name." <br>"; 
//echo $name." === ";
$html=$html.'<name>'.$name.'</name>';


$html=$html.'<vendor>-</vendor>';



$html=$html.'<images>';



$item = $app2->table->item->get($id);

//print_r($item);



//$it->elements - json


//"6be00b4e-791d-478d-b14b-077061e1b9ec":{"file":
//echo $it->elements;

$el=str_replace(" ","",$it->elements);
$el=str_replace("\n","",$el);
$el=str_replace("\t","",$el);
$el=str_replace("\r\n","",$el);
$el=str_replace("/n","",$el);
$el=str_replace("/r/n","",$el);
$el=str_replace("<br>","",$el);
$el=str_replace("<br/>","",$el);
$el=str_replace("<br />","",$el);

$el=str_replace('":{"file":"images','==file2==',$el);
$el=str_replace(',"','==file1==',$el);

//echo $el;


//echo $el." == ";
//echo"<br><br>";

$pattern = "|==file1==(.+)==file2==|isU"; 
$num_match = preg_match_all($pattern, $el, $out); 
  
//echo $out[0][0];//." ".$out[0][1];//." ".$out[0][2];
//  echo "<br />";
//echo $out[1][0];//." ".$out[1][1];//." ".$out[1][2];
 // echo count($out[1]);

//очистить массив
unset($element_photo_m);



foreach($out[1] as $value){
//echo $value." -------- <br>";

$val_m=explode("==file1==",$value);

//echo $val_m[count($val_m)-1];
$element_photo_m[] = $val_m[count($val_m)-1];

}



//echo "<br><br><br><br><br>";




$element_photo_m[] = '96f3818e-fefa-4272-9636-0b61d2a690c5';
$element_photo_m[] = 'dc36ed81-2caf-4b2b-a939-9339c271d18a';
$element_photo_m[] = 'eeae639c-f4ec-4ec4-8286-f4a94a85a4ff';
$element_photo_m[] = 'a00a1b81-24c6-4d7d-8488-d75cb194f532';
$element_photo_m[] = 'cda65603-b616-43f1-a4a7-99764a5c6be0';
$element_photo_m[] = '10b326a5-0319-44af-acfb-1a5d71e31642';
$element_photo_m[] = '94562a5d-9f08-4c88-ac02-66fcd7d736c0';
$element_photo_m[] = '748899b9-b0b5-4f0b-8f02-c31d80f123d4';
$element_photo_m[] = 'b64e18b2-7502-4d1d-baf4-7080b9a179b0';
$element_photo_m[] = '671303a2-3eb0-45b1-af04-5c25552ebc22';
$element_photo_m[] = '44294231-b962-484a-818e-429633e59dad';
$element_photo_m[] = '72ebda65-43f8-4b19-8470-45062d895fbb';
$element_photo_m[] = 'aaf7af4c-37d4-4bf7-b298-86d50738778f';
$element_photo_m[] = 'c23d135a-5d95-4b81-a0ea-53419be2faaa';
$element_photo_m[] = '78b2269c-f41f-42e5-a333-fd96393f3d50';
$element_photo_m[] = '0ac90341-2f8a-47f4-ab6d-133a78219cf7';
$element_photo_m[] = '6be00b4e-791d-478d-b14b-077061e1b9ec';
$element_photo_m[] = '5cb7c631-8a14-4f1d-990e-fe8a621a4464';
$element_photo_m[] = '6c637ecc-6ce7-4043-a3d0-8843572859d3';
$element_photo_m[] = '7de2014f-3789-4f0d-be89-29f3328dbe74';
$element_photo_m[] = '20eab2ea-2362-446f-afe9-873ace8ddc36';
$element_photo_m[] = 'f5f30cde-8d0e-4228-868a-3b0b0cf7f03b';


//echo count($element_photo_m)."==<br><br>";

foreach ( $element_photo_m as $value ) {
//echo $value."<br>";

	$pos = strpos($it->elements, $value);
  	//echo $pos."<br>";
  	//if(($pos=="")||($pos==NULL)){ echo "123<br>"; }else{ echo "222<br>"; }

  	if(($pos=="")||($pos==NULL)){

  	}else{
		
		
  		$photo = $item->getElement($value)->getElementData()->get('file');
  		
		if($photo==""){continue;}
  		
		$image_file = 'http://danceduet.ru'.'/'.$photo;
  		//echo $image_file."<br>";
		
		//отбросить картинки, ширина который меньше 300
		$size_1 = @getimagesize ($image_file);
		if($size_1[0]<=300){ continue; };
  		
		$html=$html.'<image>'.$image_file.'</image>';
		
		
  	}
	
	
	
}



//$photo = $item->getElement($element_photo)->getElementData()->get('file');

//$image_file = 'http://danceduet.ru'.'/'.$photo;
//echo $image_file."<br>";


//$html=$html.'<image>'.$image_file.'</image>';




$html=$html.'</images>';








$html=$html.'<description>';



	$html2="";
	foreach($Data as $value){
		
		
		//echo $value." = ";
	
		//получение свойств товара
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__zoo_search_index WHERE item_id='$id' AND element_id='$value'" );
		$count1=$database2->getAffectedRows();
		if($count1==0){ $html2=$html2."NULL-!-"; /*echo "NULL -!- ";*/  };

		$list2 = $database2->loadObjectList();
		


		foreach($list2 as $it2) {
		
			$html2=$html2.nl2br($it2->value)."-!-";	
			//echo"<br>";
			
			?>
           
           
            <?
			//echo iconv('UTF-8','CP1251',($it2->value)." -!- ");
			
			
		}
		//echo "<br><br>";
		//echo iconv('UTF-8','CP1251',$html2);


		
		
		
	//$html2="";
	}


	$html2_m=explode("-!-",$html2);
echo $html2."++<br>";

	//	echo count($html2_m)."<br>";
	
	if($html2_m[0]=="NULL"){
			if($html2_m[11]!="NULL"){ $html2_m[0]=$html2_m[11]; }else
			if($html2_m[15]!="NULL"){ $html2_m[0]=$html2_m[15]; }else
			if($html2_m[12]!="NULL"){ $html2_m[0]=$html2_m[12]; }

		}

		if($html2_m[3]=="NULL"){
			if($html2_m[6]!="NULL"){ $html2_m[3]=$html2_m[6]; }else
			//if($html2_m[12]!="NULL"){ $html2_m[3]=$html2_m[12]; }
			if($html2_m[9]!="NULL"){ $html2_m[3]=$html2_m[9]; }else
			if($html2_m[13]!="NULL"){ $html2_m[3]=$html2_m[13]; }
				

		}

		if($html2_m[2]=="NULL"){
			if($html2_m[8]!="NULL"){ $html2_m[2]=$html2_m[8]; }
			
		}

		$html2=$html2_m[0]."-!-".$html2_m[1]."-!-".$html2_m[2]."-!-".$html2_m[3]."-!-".$html2_m[4]."-!-".$html2_m[5]."-!-".$html2_m[6]."-!-".$html2_m[7]."-!-".$html2_m[8]."-!-".$html2_m[9]."-!-".$html2_m[10]."-!-".$html2_m[11]."-!-".$html2_m[12]."-!-".$html2_m[13]."-!-".$html2_m[14]."-!-".$html2_m[15];

		//echo iconv('UTF-8','CP1251',$html2);

$html=$html.$html2;


	
	//echo"<br><br>";

	
	
	
	
$html=$html.'</description>';

//echo "=".$html2_m[3]."=<br>";

if($category_id==25){
	$html2_m[3]=$html2_m[10];
}

if($category_id==25){
	$html2_m[0]=$html2_m[12];
}

if($category_id==25){
	$html2_m[2]="NULL";
}


if(($category_id==21)||($category_id==33)||($category_id==19)||(($category_id==39)&&($html2_m[7]!="NULL"))||($category_id==32)||($category_id==34)||($category_id==23)){
	$html2_m[3]=$html2_m[7];
	$html2_m[0]=$html2_m[8];
	$html2_m[2]=$html2_m[9];
}


if($category_id==26){
	$html2_m[3]=$html2_m[14];
	$html2_m[0]=$html2_m[17];
	$html2_m[2]='NULL';
}

if($category_id==20){
	$html2_m[3]=$html2_m[7];
	$html2_m[0]=$html2_m[13];
	$html2_m[2]='NULL';
}

if(($category_id==33)&&($html2_m[14]!="NULL")){
	$html2_m[3]=$html2_m[14];
	$html2_m[0]='NULL';
	$html2_m[2]='NULL';	
}

if($category_id==44){
	$html2_m[3]=$html2_m[7];
	$html2_m[0]=$html2_m[13];
	$html2_m[2]=$html2_m[9];
}


if(($category_id==23)&&($html2_m[13]!="NULL")&&($html2_m[7]!="NULL")){
	$html2_m[3]=$html2_m[7];
	$html2_m[0]=$html2_m[13];
	$html2_m[2]='NULL';
}

if($category_id==38){
	$html2_m[3]=$html2_m[7];
	$html2_m[0]=$html2_m[13];
	$html2_m[2]=$html2_m[9];
}


/*
if(($category_id==21)||($category_id==33)||($category_id==19)||(($category_id==39)&&($html2_m[8]!="NULL"))||($category_id==32)||($category_id==34)||($category_id==23)){
	$html2_m[0]=$html2_m[8];
}

if(($category_id==21)||($category_id==33)||($category_id==19)||(($category_id==39)&&($html2_m[9]!="NULL"))||($category_id==32)||($category_id==34)||($category_id==23)){
	$html2_m[2]=$html2_m[9];
}
*/

$tmp_m=explode("<br />",$html2_m[3]);


$html=$html.'<prices>';

echo "<b>Price:</b> ";

$count_tmp = count($tmp_m);
for ($i=0; $i<$count_tmp; $i++)
{	

$html=$html.'<price text="">';
$html=$html.$tmp_m[$i];
$html=$html.'</price>';
echo "".$tmp_m[$i]." | ";
}

$html=$html.'</prices>';









$tmp_m=explode("<br />",$html2_m[0]);

$html=$html.'<colors>';

echo "<b>Color:</b> ";

$count_tmp = count($tmp_m);
for ($i=0; $i<$count_tmp; $i++)
{	
$html=$html.'<color>';
$html=$html.$tmp_m[$i];
$html=$html.'</color>';
echo "".$tmp_m[$i]." | ";
}

$html=$html.'</colors>';







$tmp_m=explode("<br />",$html2_m[2]);
$html=$html.'<sizes>';

echo "<b>Sizes:</b> ";

$count_tmp = count($tmp_m);
for ($i=0; $i<$count_tmp; $i++)
{	
$html=$html.'<size>';
$html=$html.$tmp_m[$i];
$html=$html.'</size>';
echo "".$tmp_m[$i]." | ";
}
$html=$html.'</sizes>';

echo"<br><br>";

$html=$html.'</offer>';




	


}



$html=$html."</offers>";
$html=$html."</shop>";
$html=$html."</yml_catalog>";

$fp = fopen ('export.xml', "w");
fwrite($fp, $html);
fclose($fp);
//echo iconv('UTF-8','CP1251',$html);

echo "Экспорт успешно завершён. Время выполнения: ";

echo microtime(true) - $start;

?>
