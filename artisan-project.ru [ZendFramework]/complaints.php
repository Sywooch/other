<?
####насторйки локальной базы данных######
$config_locale['HOST']="u305676.mysql.masterhost.ru";
$config_locale['DB']="u305676_apt";
$config_locale['USER']="u305676_aptest";
$config_locale['PASS']="6in_A5eddEn-";
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
function get_reson($id){
$asd=array(
'1'=>"Возврат товара",
'2'=>"Обмен товара",
'9'=>"Жалоба на работу склада",
'6'=>"Жалоба на транспортное обслуживание",
'5'=>"Жалоба на работу менеджера",
'3'=>"Жалоба на работу администратора",
'4'=>"Жалоба на работу бухгалтерии",
'7'=>"Другое",
);
return $asd[$id];
}

function get_status($id){
$asd=array("new"=> 'непрочтённая',"not_answered"=>'прочтённая, но не отвеченная',"answered"=>'отвеченная',);
return $asd[$id];
}
if(isset($_GET['act']) && isset($_GET['id']) && $_GET['act']=="true" && $_GET['id']!=""){
	$arr=red("SELECT * FROM ad_communication2 WHERE complaint_id ='".$_GET['id']."' ORDER BY id ASC");
	if(count($arr)>0){
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]['is_answer']=="no"){
			//print_r($arr[$i]);
			$ar_file=red("SELECT * FROM ad_files2 WHERE pid ='".$arr[$i]['id']."'");
			//print_r($ar_file);
			$file='';
			
			for($s=0;$s<count($ar_file);$s++){
				$file_name=explode('/',$ar_file[$s]['file']);
				$file.='<a href="/admin/complaints/download?file_name='.$ar_file[$s]['file'].'">'.$file_name[(count($file_name)-1)].'</a>';
				
			}
			
			///admin/complaints/download?file_name=
			
			echo '<div style="background:#333;color:#fff;padding:10px;"><b>'.$arr[$i]['commdate'].'<b/><p>'.$arr[$i]['text'].'</p>'.$file.'</div>';
		}else{
			$ar_file=red("SELECT * FROM ad_files2 WHERE pid ='".$arr[$i]['id']."'");
			
			//print_r($ar_file);
			echo '<div style="padding:10px;padding-left:40px;border-bottom:1px solid #ccc;font-size:12px;"><b>'.$arr[$i]['commdate'].'<b/><p>'.$arr[$i]['text'].'</p></div>';
		}
	}}else{
		echo "Нет притензий";
	}
	//echo "ddd";
	
}else{
$arr=red("SELECT * FROM ad_complaints2");
?>
<html>
	<head>
		<style>
			body{margin:0px;padding:0px;font:normal normal 12px;font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;}
			table tr th{background:#333;color:#fff;}
			table tr td{padding:5px;text-align:center;border-left:1px solid #ccc;border-bottom:1px solid #ccc;font-size:12px;}
		</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
				$(".various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
			});
	</script>
	</head>
<body>


<?

echo '
<table>
	<tr>
		<th>ID</th>
		<th>Дата поступления претензии </th>
		<th>Клиент (дилер)</th>
		<th>Причина обращения</th>
		<th>Заголовок</th>
		<th>Дата поступления последнего сообщения дилера по претензии </th>
		<th>Дата последнего ответа </th>
		<th>Статус ответа </th>
		<th>Ответивший </th>
	</tr>
';
for($i=0;$i<count($arr);$i++){
	echo '	<tr>
		<td>'.$arr[$i]['id'].'</td>
		<td>'.$arr[$i]['compldate'].'</td>
		<td>'.$arr[$i]['company'].'</td>
		<td>'.get_reson($arr[$i]['reason_id']).'</td>
		<td><a class="various3" href="/complaints.php?act=true&id='.$arr[$i]['id'].'">'.$arr[$i]['title'].'</a></td>
		<td>'.$arr[$i]['last_req_date'].'</td>
		<td>'.$arr[$i]['last_answ_date'].'</td>
		<td>'.get_status($arr[$i]['status']).'</td>
		<td>Максим Слива </td>
	</tr>';
}
echo '</table>';
?>
</body>
</html>
<?}?>