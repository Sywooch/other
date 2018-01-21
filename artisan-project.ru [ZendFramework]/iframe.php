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
function get_all_sity(){$arr=red("SELECT * FROM ad_countries");$new_ar=array();for($i=0;$i<count($arr);$i++){$new_ar[$arr[$i]['id']]=$arr[$i]['title'];}return $new_ar;}
function preg_file_diller($code){
	global $hide_file;
	if(isset($_GET["id"]) && $_GET["id"]!=""){
		
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_GET["id"].".td")){
		
			$data=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_GET["id"].".td");
			$data_array=unserialize($data);
			$hide_file=count($data_array);
			$ss="";
		//print_r($data_array);
			for($i=0;$i<count($data_array);$i++){if($data_array[$i]==$code){$ss="1";}}
			if($ss=="1"){
				
				return 'hide" sa="1';
			}else{
				return "";
			}
			
		}else{
			return "";
		}
	}
}

function get_all_fabric(){
	//echo $_GET["id"];
	global $hide_base;
	$arr=red("SELECT * FROM ad_factories ORDER BY country_id ASC");
	$arr_count=get_all_sity();
	$text='<div class="clame">';
	$ss="we";
	$mm="wr";
	$hide_base=count($arr);
		for($i=0;$i<count($arr);$i++){
			//if($mm!=$arr[$i]['country_id']){if($mm!=""){$text.="</div>";}$mm=$arr[$i]['country_id'];}
			if($mm!=$arr[$i]['country_id']){if($mm!="wr"){$text.="</div>";}$mm=$arr[$i]['country_id'];}
			
			if($arr[$i]['country_id']=="" && $ss!=$arr[$i]['country_id']){$ss=$arr[$i]['country_id'];$text.="<div id='cslal' class='country0'><h3>Без страны<a href='javascript:void(0);' class='hide_count' cl='0'>(Скрыть)</a></h3>";}
			if($ss!=$arr[$i]['country_id']){$ss=$arr[$i]['country_id'];$text.="<div id='cslal' class='country".$arr[$i]['country_id']."'><h3>".$arr_count[$arr[$i]['country_id']]."<a href='javascript:void(0);' class='hide_count' cl='".$arr[$i]['country_id']."'>(Скрыть)</a></h3>";}
			$text.='<a class="blosa '.preg_file_diller($arr[$i]['id']).'" href="javascript:void(0);" ittr="'.$arr[$i]['id'].'">'.$arr[$i]['title'].'</a>';
			
		}
	return $text."</div><br><br>";
}
//print_r(get_all_sity());

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>fancyBox - iframe demo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style>
		body{font-size:12px;}
		.blosa{display:inline-block;padding:10px;text-decoration:none;color:#333;}
		.hide{text-decoration:line-through;color:#999;}
		.hide_count{font-size:10px;margin-left:10px;color:#333;}
		.hide_all{display:block;padding:10px;text-decoration:none;color:#222;font-size:14px;}
		.hides{color:#DB000D;}
		.hse{display:none;padding:20px;text-align:center;position:absolute;top:100px;left:50%;margin-left:-100px;background:#000;color:#fff;width:200px;font-weight:bold;font-size:14px;}
		.hse img{margin-right:10px;float: left;}
	</style>
	<script type="text/javascript" src="/public/cms/lib/jquery-1.10.1.min.js"></script>
	<script>
	

		$(document).ready(function(){
			$('.blosa').click(function(){
				if($(this).attr("sa")=="1"){
					$(this).removeClass("hide");
					$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),shou:"1" }, function(data) {});
					$(this).attr("sa","");

				}else{
					$(this).addClass("hide");
					$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),hede:"1" }, function(data) {	});
					$(this).attr("sa","1");
				}
			});
			$('.hide_all').click(function(){
				if($(this).text()=="Скрыть все"){
					$(this).text("Открыть все");
					$(this).addClass("hides");
					$(".hse").show();
					$(".clame a").each(function paintPackageTable(indexTr) {
						if (!$(this).hasClass("hide_count") ) {
						$(this).addClass("hide");
							$.ajax({url: "/age.php", type: 'POST',async: false,data: {diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),hede:"1" }});
							//$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),hede:"1" }, function(data) {});
							$(this).attr("sa","1");
						}
						});
						$(".hse").hide();
				}else{
					$(this).removeClass("hides");
					$(this).text("Скрыть все");
					$(".hse").show();
						$(".clame a").each(function paintPackageTable(indexTr) {
						if (!$(this).hasClass("hide_count") ) {
							$(this).removeClass("hide");
							//$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),shou:"1" }, function(data) {});
							$.ajax({url: "/age.php", type: 'POST',async: false,data: {diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),shou:"1" }});
							$(this).attr("sa","");
							}
						});
						$(".hse").hide();
				}
			
			});
			$('.hide_count').click(function(){
				if($(this).text()=="(Скрыть)"){
					$(this).text("(Открыть)");
					$(this).addClass("hides");
					$(".hse").show();
						$(".country"+$(this).attr("cl")+" a").each(function paintPackageTable(indexTr) {
						if (!$(this).hasClass("hide_count") ) {
							$(this).addClass("hide");
							$.ajax({url: "/age.php", type: 'POST',async: false,data: {diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),hede:"1" }});
							//$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),hede:"1" }, function(data) {});
							$(this).attr("sa","1");
						}
						});
						$(".hse").hide();
				
				}else{
					$(this).removeClass("hides");
					$(this).text("(Скрыть)");
					$(".hse").show();
						$(".country"+$(this).attr("cl")+" a").each(function paintPackageTable(indexTr) {
						if (!$(this).hasClass("hide_count") ) {
							$(this).removeClass("hide");
							//$.post("/age.php",{diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),shou:"1" }, function(data) {});
							$.ajax({url: "/age.php", type: 'POST',async: false,data: {diller: <?=$_GET['id'];?>, id: $(this).attr("ittr"),shou:"1" }});
							$(this).attr("sa","");
							}
						});
						$(".hse").hide();
				}
			
			
			
			});
			$(".clame #cslal").each(function zzzz(indexTr) {
			var all=0;
			var hiddens=0;
				$("a",this).each(function(){
					if (!$(this).hasClass("hide_count")) {
						all++;
						if ($(this).hasClass("hide")) {
							hiddens++;
						}
					}
			   });
			   if(all==hiddens){
				$(this).find(".hide_count").text("(Открыть)");
				$(this).find(".hide_count").addClass("hides");
			   }
			
			})
			
			
		});
	</script>
</head>
<body>
<div class="hse"><img src="http://www.loadinfo.net/images/preview/12_cyrle_two_24.gif">Пожалуйста подождите</div>
<?$text=get_all_fabric();?>
<?
//echo $hide_base."!=".$hide_file;
?>
<div><?if($hide_base!=$hide_file){?><a href="javascript:void(0);" class="hide_all">Скрыть все</a><?}else{?><a href="javascript:void(0);" class="hide_all hides">Открыть все</a><?}?></div>
<?=$text;?>
</body>
</html>