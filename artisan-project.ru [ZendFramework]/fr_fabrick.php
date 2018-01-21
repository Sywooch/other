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
## соеден€емс€ с базой################
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
//mysql_query("SET CHARACTER SET 'utf8'");
###функци€ дл€ выполнени€ любого запроса##
function query($query){$result = mysql_query($query);}
function red($query){$result = mysql_query($query);	mysql_error();	$c=array();for($i=0;$i<mysql_num_fields($result);$i++) { $param=mysql_fetch_field($result);  $c['mas'][$i]= "$param->name";}$cats=array();$results = mysql_query($query);$cs=0;while ($row = mysql_fetch_assoc($results)) {	for($d=0;$d<count($c['mas']);$d++){	$cats[$cs][$c["mas"][$d]]= $row[$c['mas'][$d]];}$cs++;}return $cats;}
############################################

function gel_elements($id){
	$res=red("SELECT * FROM ad_svyaz WHERE id_element='".$id."'");
	if(count($res)) {
	$end_result = '';
        foreach($res as $r) {
			$rss=red("SELECT * FROM ad_goods WHERE id = '".$r['data']."' LIMIT 1");
			$end_result.='<div ids="'.$r['data'].'" class="clasd">'.$rss[0]['title'].' ('.$rss[0]['art'].')<a class="del" href="javascript:void(0);"></a></div>';
		}
	}
	return $end_result;
}

if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['ellem']) && $_POST['ellem']!="" && isset($_POST['add']) && $_POST['add']=="add"){
	query("INSERT INTO ad_svyaz VALUES ('' , '".$_POST['id']."', '".$_POST['ellem']."')");
}	
if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['ellem']) && $_POST['ellem']!="" && isset($_POST['delet']) && $_POST['delet']=="delet"){
	query("DELETE FROM ad_svyaz WHERE id_element = '".$_POST['id']."' AND data='".$_POST['ellem']."'");
}




if(isset($_POST['search']) && $_POST['search']!=""){
header("Content-type: text/html; charset=windows-1251");
$row=red("SELECT * FROM ad_goods WHERE ftitle LIKE '%".trim(iconv("UTF-8", "windows-1251",$_POST['search']))."%' LIMIT 10");
//echo "SELECT * FROM ad_goods WHERE ftitle LIKE '%".trim($_POST['search'])."%'";
//print_r($row);
if(count($row)) {
        $end_result = '';
        foreach($row as $r) {
            $result         = $r['title'];
            $bold           = '<span class="found">' . $word . '</span>';
            $end_result     .= '<li class="userts" ids="'.$r['id'].'">' . $result . ' ('.$r['art'].')</li>';
        }
        echo $end_result;
    } else {
        echo '<li>ѕо вашему запросу ничего не найдено</li>';
    }

}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>fancyBox - iframe demo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style>
	body{font-size:12px;}
	#container { margin: 0 auto; width: 800px; height:500px;}
	a { color:#DF3D82; text-decoration:none }
	a:hover { color:#DF3D82; text-decoration:underline; }
	ul.update { list-style:none;font-size:1.1em; margin-top:10px;width: 600px; padding-left: 0px;}
	ul.update li{padding: 5px;text-align:left;cursor:pointer;}
	ul.update li:nth-child(2n+1){text-align:left; background: #333;color: #fff;}
	#flash { margin-top:20px; text-align:left; }
	#searchresults { text-align:left; margin-top:20px; display:none; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; }
	.word { font-weight:bold; color:#000000; }
	#search_box { padding:4px; border:solid 1px #666666; width:300px; height:30px; font-size:18px;-moz-border-radius: 6px;-webkit-border-radius: 6px; }
	.search_button { border:#000000 solid 1px; padding: 6px; color:#000; font-weight:bold; font-size:16px;-moz-border-radius: 6px;-webkit-border-radius: 6px; }
	.found { font-weight: bold; font-style: italic; color: #ff0000; }
	.del{width:16px;height:16px;background:url('/fancybox/dels_fr.png') top left no-repeat;display:block;float:right;}
	.clasd{padding:3px;margin:3px;border:1px solid #ccc;display:inline-block;border-radius:5px;background:#ccc;}
	</style>
	<script type="text/javascript" src="/public/cms/lib/jquery-1.10.1.min.js"></script>
	<script>
		$(document).ready(function(){
		 $(document).on('click',".userts",function() {
			$(this).css("background","red");
			$(this).css("color","#fff");
			$.post("/fr_fabrick.php",{id: "<?=$_GET['id']?>",ellem:$(this).attr('ids'),add:"add"}, function(data) {});
			$('.proper').append('<div ids="'+$(this).attr('ids')+'" class="clasd">'+$(this).text()+'<a class="del" href="javascript:void(0);"></a></div>');
		});
		$(document).on('click',".del",function(event) {
		
			var idss=$(this).parent().attr('ids');
			$(this).parent().hide();
			$.post("/fr_fabrick.php",{id: "<?=$_GET['id']?>",ellem:idss,delet:"delet"}, function(data) {});
		});
		
		
		  $(".search_button").click(function() {
			// получаем то, что написал пользователь
			var searchString    = $("#search_box").val();
			// формируем строку запроса
			var data  = 'search='+ searchString;

			// если searchString не пуста€
			if(searchString) {
				// делаем ajax запрос
				$.ajax({
					type: "POST",
					url: "/fr_fabrick.php",
					data: data,
					beforeSend: function(html) { // запуститс€ до вызова запроса
						$("#results").html('');
				   },
				   success: function(html){ // запуститс€ после получени€ результатов
						$("#results").show();
						$("#results").append(html);
				  }
				});
			}
			return false;
		});
			
			
		});
	</script>
</head>
<body>
	<div id="container">
		<div style="margin:20px auto; ">
			<form method="post" action="fr_fabrick.php">
				<input type="text" name="search" id="search_box" class='search_box'/>
				<input type="submit" value="ѕоиск" class="search_button" /><br />
			</form>
		</div>
		<div>
				<ul id="results" class="update">
				</ul>

		</div>
		<div class="proper">
			<?=gel_elements($_GET['id']);?>
		</div>
	</div>
</body>
</html>
<?}?>