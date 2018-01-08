<?
####насторйки локальной базы данных######
include "db_conf.php";
#############################
define('DB_HOST', $config_locale['HOST']);
define('DB_NAME', $config_locale['DB']);
define('DB_USER', $config_locale['USER']);
define('DB_PASS', $config_locale['PASS']);
global $hide_file,$hide_base;
## соеденяемся с базой################
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
mysql_query("SET CHARACTER SET 'utf8'");
###функция для выполнения любого запроса##
function query($query){$result = mysql_query($query);}
function red($query){$result = mysql_query($query);	mysql_error();	$c=array();for($i=0;$i<mysql_num_fields($result);$i++) { $param=mysql_fetch_field($result);  $c['mas'][$i]= "$param->name";}$cats=array();$results = mysql_query($query);$cs=0;while ($row = mysql_fetch_assoc($results)) {	for($d=0;$d<count($c['mas']);$d++){	$cats[$cs][$c["mas"][$d]]= $row[$c['mas'][$d]];}$cs++;}return $cats;}
############################################
function get_naclad2($eeeeeee){
	$sekects=red("SELECT * FROM ad_requests WHERE id ='".$eeeeeee."' limit 1");
$sarray[0]='-';$sarray[1]='Брак';$sarray[2]='Возврат';$sarray[3]='Обмен';
	$crossp=red("SELECT * FROM as_bad_quest WHERE requet_id ='".$eeeeeee."'");
	$tupes=unserialize($crossp['0']['tupe']);
	//print_r($tupes);
	if(is_array($sekects) && count($sekects)>0){
	$sse=red("SELECT * FROM as_recuue WHERE PodrId='".$sekects['0']['dealer_id']."' AND	NaklID='".$sekects['0']['account_number']."'");
	 if(is_array($sse) && count($sse)>0){
		 $text='<table class="pruidn">';
		  $text.='<tr>
			
			<th>Код товара</th>
			<th>Наименование</th>
			<th>Количество</th>
			<th>Цена</th>
			<th>Обращение</th>
			<th>Количество</th>
		  </tr>';
		 foreach ($sse as $key => $sssxx) {
			 		  $text.='<tr '.(($tupes['tupe'][$sssxx['NakNom']]!=0)?'style="background:red;color:#fff"':"").'>
								<td>'.$sssxx['kod'].'</td>
								<td>'.$sssxx['Tovar'].'</td>
								<td align="center">'.$sssxx['kolvo'].'</td>
								<td align="center">'.$sssxx['cena'].'</td>
								<td align="center">'.$sarray[$tupes['tupe'][$sssxx['NakNom']]].'</td>
								<td align="center">'.$tupes['col'][$sssxx['NakNom']].'</td>
							  </tr>';
		 }
		  $text.='</table>';
		  return $text;
	 }
	}
	
}
?>
<html style="background:#fff">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Artisan.Dealers</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="Shortcut Icon" href="/public/site/img/favicon.ico">
	<!-- CSS -->
	<link href='/public/site/css/jquery-ui.css' rel='stylesheet' type='text/css'>
	<link href='/public/site/css/fonts.css' rel='stylesheet' type='text/css'>
	<link href='/public/site/css/main.css' rel='stylesheet' type='text/css'>
	<link href='/public/site/css/jquery.pnotify.css' rel='stylesheet' type='text/css'>
	<link href='/public/site/css/jquery.simplemodal.css' rel='stylesheet' type='text/css'>
	<link href='/public/zf/css/calendar-blue.css' rel='stylesheet' type='text/css'>

	<script src='/public/zf/js/jquery.js?23927' type='text/javascript'></script>
	<script src='/public/zf/js/form.js?23927' type='text/javascript'></script>
	
	<!--zf::debug:head-->
    <style>
	.users{background:#cecece;border-bottom:1px solid #000;padding:10px;}
	.agent{background:#fff;border-bottom:1px solid #000;padding:10px;padding-left:30px;}
	.users i,.agent i{font-size:10px;}
	.users p,.agent p{font-size:12px;}
	</style>

    
</head>    

<body style="background:#fff">	
<?$tupe_obrash="";

if(isset($_POST) && isset($_POST['comment_obrash']) && isset($_POST['numms'])){

	if(isset($_POST['comment_obrash']) && strip_tags($_POST['comment_obrash'])!=""){
		$comment_obrash=strip_tags($_POST['comment_obrash']);
	}else{
		$comment_obrash="error";
	}
	
	if($comment_obrash!="error"){
		$my_file=array();
		foreach ($_FILES["file_name"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["file_name"]["tmp_name"][$key];
				$cur_pas=explode('.',$_FILES["file_name"]["name"][$key]);
				
				$name = rand(500, 5000).mktime().".".$cur_pas[(count($cur_pas)-1)];
				move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT']."/public/userfiles/requests/".$name);
				$my_file[]=$_SERVER['DOCUMENT_ROOT']."/public/userfiles/requests/".$name;
			}
		}
		//print_r($my_file);
		$my_sar=array();
		$provs=red("SELECT *  FROM as_bad_quest WHERE id ='".$_POST['numms']."'");
		$asa=@unserialize($provs[0]['comment_tups']);
		if(is_array($asa)){
			$my_sar=$asa;
		}
		$my_sar[]=array(
		'ag'=>"OPER",
		'date'=>mktime(),
		'comment'=>$comment_obrash,
		'file'=>$my_file,
		);
		//print_r($my_sar);
		//echo "UPDATE as_bad_quest SET comment_tups='".mysql_real_escape_string(serialize($my_sar))."', status ='USER' WHERE id ='".$_POST['numms']."'";
		query("UPDATE as_bad_quest SET comment_tups='".serialize($my_sar)."',status ='USER' WHERE id ='".$_POST['numms']."'");
		//query("INSERT INTO as_bad_quest VALUES ('' ,'".mktime()."', '".$_POST['numms']."', '".$names_titl."', '".strip_tags($_POST['tupe_obrash'])."', '".$comment_obrash."', '".serialize($my_file)."', '".serialize($my_sar)."', 'USER')");
	//	$sss="COMPLATE";
	}
	
	
	
	
}


	
	$crop=red("SELECT *  FROM as_bad_quest WHERE id ='".$_GET['number']."'");
	
?>



	<h3>Претензия пользователя по заказу № <?=$_GET['number'];    //$crop[0]['requet_id']?></h3>
	<?=get_naclad2($crop[0]['requet_id']);?>
	<table class="sdkljhb" style="width:800px">
		<tr>
		<?
		$sss=unserialize($crop[0]['file']);
		if(is_array($sss) && count($sss)>0){
					foreach($sss as $els=>$sv){
					$filea.="<a target='_blank' href='".str_replace($_SERVER['DOCUMENT_ROOT'],"http://artisan-project.ru",$sv)."'>файл ".($els+1)."</a> ";
					
					}
				}
		?>
			<td colspan="2" class="users"><i><?=date('d-m-Y h:i:s',$crop[0]['data']);?></i><br><b><?=$crop[0]['title'];?></b><p><?=$crop[0]['coment'];?></p><div><?=$filea;?></div></td>
		</tr>
		<?
		
		$asdaf=unserialize($crop[0]['comment_tups']);
		if(is_array($asdaf) && count($asdaf)>0){
			foreach($asdaf as $element=>$val){
				$filea="";
				if(is_array($val['file']) && count($val['file'])>0){
					foreach($val['file'] as $el=>$v){
					$filea.="<a target='_blank' href='".str_replace($_SERVER['DOCUMENT_ROOT'],"http://artisan-project.ru",$v)."'>файл ".($el+1)."</a> ";
					
					}
				}
				
				
					echo '<tr>
							<td colspan="2" class="'.(($val['ag']=='OPER')?"agent":"users").'"><i>'.date('d-m-Y h:i:s',$val['date']).'</i><p>'.$val['comment'].'</p><div>'.$filea.'</div></td>
						</tr>';
				
			}
			
		}
		?>
		<form class="dss" method="post" action="" enctype="multipart/form-data"">
		<input type="hidden" name="numms" value="<?=$_GET['number']?>">
		<tr>
			<td colspan="2"><textarea placeholder="Написать коментарий пользователю"  style="width:748px;" class="comment_obrash" name="comment_obrash" style="<?=(($comment_obrash=="error")?"border:1px solid red":"")?>"></textarea></td>
		</tr>
		<tr>
			<td style="width:250px;"><b>Прикрепить файлы</b> <a href="javascript:void(0)" title="добавить файл" class="add_filess_tupe">+</a></td>
			<td class="propends"><input type="file" id="file_name" name="file_name[]" value=""></td>
		</tr>
		<tr>
			<td colspan="2"><br><br><center><div class="button_left" rel=""> <div class="button_right"><div class="button_middle" id="dfsgh">Ответить<input class="dont" type="submit" value=" Отправить претензию" style="position: absolute; top: -99999px; left: -99999px;"></input></div></div></div></center></td>
		</tr>
	</table>
	</form>

</body></html>
