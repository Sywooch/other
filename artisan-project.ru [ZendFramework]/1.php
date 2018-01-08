<?
####насторйки локальной базы данных######
$config_locale['HOST']="u261784.mysql.masterhost.ru";
$config_locale['DB']="u261784";
$config_locale['USER']="u261784";
$config_locale['PASS']="3averoffi7";
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
// Проверяем как обратились к этому обработчику если методом POST, то всё нормально, а если нет, то обработчик выполняться не будет!
 if($_SERVER["REQUEST_METHOD"] == "POST"){
	 $Q = mysql_real_escape_string($_POST['q']);
	$arrsa=red("SELECT * FROM ad_goods_to_order WHERE (art LIKE '".$Q."%' OR art LIKE '%".$Q."%' OR art LIKE '%".$Q."' ) OR (title LIKE '".$Q."%' OR title LIKE '%".$Q."%' OR title LIKE '%".$Q."') LIMIT 0 , 5");
	 if(count($arrsa)>=1){
		for($i=0;$i<count($arrsa);$i++){
			echo '<li><a href="javascript:void(0);" class="propen" art="'.$arrsa[$i]['art'].'" idds="'.$arrsa[$i]['id'].'">'.$arrsa[$i]['art'].' '.$arrsa[$i]['title'].' '.$arrsa[$i]['packCntByUnit'].'шт/кор</a></li>';
			
		}
	 }else{
		echo '<center><a id="search-noresult">Ничего не найдено! :\''.$Q.'(</a></center>';   
	 }
 }?>