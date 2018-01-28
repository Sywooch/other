<?php
error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('html_errors',true);
ini_set('error_reporting',E_ALL ^ E_NOTICE);
define('DIAFAN', 1);
define('ABSOLUTE_PATH', dirname(__FILE__).'/');
include_once(ABSOLUTE_PATH."config.php");
include_once ABSOLUTE_PATH.'includes/customization.php';
include_once(ABSOLUTE_PATH.'includes/developer.php');
include_once(ABSOLUTE_PATH.'includes/diafan.php');
include_once(ABSOLUTE_PATH.'includes/files.php');
$dev = new Dev();
$dev->set_error();
include_once ABSOLUTE_PATH.'includes/function.php';
include_once(ABSOLUTE_PATH.'includes/core.php');
include_once(ABSOLUTE_PATH.'includes/database.php');
DB::connect();
include_once ABSOLUTE_PATH.'includes/init.php';
$diafan = new Init();
//echo "hren".$_GET['id'];

//print_r($_POST);

if($_POST['seves']=="Сохранить"){
	//print_r($_POST);
	for($i=0;$i<count($_POST['ids']);$i++){
		DB::query("UPDATE diafan_shop SET sort = '".($i+1)."' WHERE id ='".$_POST['ids'][$i]."'");
		if($_POST['br'][$i]=="br"){
			DB::query("UPDATE diafan_shop SET view = 'br' WHERE id ='".$_POST['ids'][$i]."'");
		//	echo "UPDATE diafan_shop SET view = 'br' WHERE id ='".$_POST['ids'][$i]."'"."<br>";
		}else{
			DB::query("UPDATE diafan_shop SET view = '' WHERE id ='".$_POST['ids'][$i]."'");
		
		}
	}
}

	function get_paramssss($id, $site_id){
	
			$values = array();
		$result_el = DB::query("SELECT e.value1 as rvalue, e.value1, e.param_id, e.id FROM diafan_shop_param_element as e"
		. " LEFT JOIN diafan_shop_param_select as s ON e.param_id=s.param_id AND e.param_id=s.id"
		. " WHERE e.element_id=%d GROUP BY e.id ORDER BY s.sort ASC", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][] = $row_el;
		}
		return $values;
	}
	function images_get($id,$modele, $site_id){
		$result = DB::query("SELECT id, name, title1 FROM diafan_images WHERE module_name='".$modele."' AND element_id='".$id."' AND trash = '0'  LIMIT 1");
			//ho "SELECT id, name, alt1, title1 FROM diafan_images WHERE module_name='".$modele."' AND element_id='".$id."' AND trash='0'  LIMIT 1"."<br>";
			$img="";
			while($selm = DB::fetch_array($result)){
				//print_r($selm);
				if($selm['name']!=""){
					$img="/userfiles/shop/collection_element/".$selm['name'];
				}
			
			}
			return $img;
	}

$query = DB::query('SELECT s.id, s.name1,s.view, s.sort, r.rewrite FROM diafan_shop_rel sr
									LEFT JOIN diafan_shop s ON s.id = sr.rel_element_id
									LEFT JOIN diafan_rewrite r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.act1 = "1" AND s.trash = "0" AND sr.element_id = "'.$_GET['id'].'" AND sr.trash = "0" AND s.cat_id = "8" ORDER BY s.sort ASC');
	
$count = DB::num_rows($query);
			$elements = array();
			if($count > 0)
			{
				while($selm = DB::fetch_array($query))
				{
				//print_r($selm);
			$params =get_paramssss($selm['id'], 29);
			//	echo $selm['id']."--".$selm['name1'];
			//print_r($params);
			$material		= '';
					$size			= '';
					$size_type		= '';
					$plitka_type	= '';
					$ptype			= '';

					if(!empty($params))
					{
					//print_R($params);
						foreach($params as $param)
						{
							if($param[0]['id'] == 3) $material		= $param[0]['rvalue'];
							if($param[0]['id'] == 4) $size			= $param[0]['rvalue'];
							if($param[0]['id'] == 5) $size_type	= $param[0]['rvalue'];
							if($param[0]['id'] == 7) $plitka_type	= $param[0]['rvalue'];
							if($param[0]['id'] == 6) $ptype		= $param[0]['rvalue'];
						//	print_r( $param);
						}
					}
					
					$plitka_type=$params[7][0]['rvalue'];
					//echo $params[7][0]['rvalue']."<br>";
					$dsssss="0";
					//echo $plitka_type."<br>";
					if($plitka_type=="настенная плитка"){$plitka_type="Настенная плитка";$dsssss="1";}
					if($plitka_type=="напольная плитка"){$plitka_type="Напольная плитка";$dsssss="1";}
					if($plitka_type=="базовая плитка"){$plitka_type="Напольная плитка";$dsssss="1";}
					
					if($dsssss=="0"){$plitka_type = 'Декоративные элементы';}
					
					//if(empty($size_type)) $size_type = 'м2';

				$elements[$plitka_type][] = array(
									'id'			=> $selm['id'],
									'name'			=> $selm['name1'],
									'img'			=> images_get($selm['id'], "shop", 29),
									'sort'			=> $selm['sort'],
									'view'			=> $selm['view'],
									'url'			=> BASE_PATH_HREF.$selm['rewrite'].'/',
									);
				}
					
				
			}	
			$d=0;

			
echo "<form method='POST'>";
if(isset($elements['Настенная плитка']) && count($elements['Настенная плитка']) > 0){
	echo '<table class="dialer"><tr><th colspan="3">Настенная плитка</th></tr>';

		foreach($elements['Настенная плитка'] as $key =>$element){
			if($element['sort']==0){$element['sort']=$d+1;}
			echo '<tr><td>
				<input type="hidden" name="ids[]" class="idss" value="'.$element['id'].'">
				<input type="hidden" name="br[]" class="brsss" value="'.(($element['view']=="br")?"br":"no").'">
				<img width="60px" src="'.$element['img'].'"></td><td>'.$element['name'].'</td><td>
				<a href="javascript:void(0);" ids="'.$element['id'].'" brd="'.(($element['view']=="br")?"blobe":"no").'" class="so_up '.(($element['view']=="br")?"br":"no").'"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="top_up"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="down_up"></a>
			
			</td></tr>';
			$d++;
		}
	echo "</table>";
}
if(isset($elements['Напольная плитка']) && count($elements['Напольная плитка']) > 0){
	echo '<table class="dialer"><tr><th colspan="3">Напольная плитка</th></tr>';

		foreach($elements['Напольная плитка'] as $key => $element){
			if($element['sort']==0){$element['sort']=$d+1;}
			echo '<tr><td>
						  <input type="hidden" name="ids[]" class="idss" value="'.$element['id'].'">
						  <input type="hidden" name="br[]" class="brsss" value="'.(($element['view']=="br")?"br":"no").'">
						  <img width="60px" src="'.$element['img'].'"></td><td>'.$element['name'].'</td><td>
				<a href="javascript:void(0);" ids="'.$element['id'].'" brd="'.(($element['view']=="br")?"br":"no").'" class="so_up '.(($element['view']=="br")?"br":"no").'"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="top_up"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="down_up"></a>
			
			</td></tr>';
			$d++;
		}
	echo "</table>";
}

if(isset($elements['Декоративные элементы']) && count($elements['Декоративные элементы']) > 0){
	echo '<table class="dialer"><tr><th colspan="3">Декоративные элементы</th></tr>';

		foreach($elements['Декоративные элементы'] as $key => $element){
		if($element['sort']==0){$element['sort']=$d+1;}
			echo '<tr><td>
			<input type="hidden" name="ids[]" class="idss" value="'.$element['id'].'">
			<input type="hidden" name="br[]" class="brsss" value="'.(($element['view']=="br")?"br":"no").'">
			<img width="60px" src="'.$element['img'].'"></td><td>'.$element['name'].'</td><td>
				<a href="javascript:void(0);" ids="'.$element['id'].'" brd="'.(($element['view']=="br")?"br":"no").'" class="so_up '.(($element['view']=="br")?"br":"no").'"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="top_up"></a>
				<a href="javascript:void(0);" ids="'.$element['id'].'" sorts="'.$element['sort'].'" class="down_up"></a>
			
			</td></tr>';
			$d++;
		}
	echo "</table>";
}
echo "<input type='submit' name='seves' value='Сохранить'></form>";




	
?>
<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
<style>
.so_up{background:url('/img/top_ed.png') center no-repeat;display:block;width:20px;height:20px;float:left}
.top_up{background:url('/img/up_arr.png') center no-repeat;display:block;width:20px;height:20px;float:left}
.down_up{background:url('/img/down_arr.png') center no-repeat;display:block;width:20px;height:20px;float:left}
.act{border:1px solid #ccc;}
.br{border:2px solid red;}


</style>
<script>
	$(document).ready(function(){
		$(".top_up").live("click",function () {
			//alert($(this).attr("ids"));
			//alert($(this).parent().parent().prev().html());
			if($(this).attr("sorts")!=1){
				var sd=($(this).attr("sorts")*1)-1;
				$(this).parent().parent().prev().find("a").attr("sorts",$(this).attr("sorts"));
				//$(this).parent().parent().find(".sortis").val(sd);
				$(this).parent().find("a").attr("sorts",sd);
				
				
				$(this).parent().parent().after("<tr>"+$(this).parent().parent().prev().html()+"</tr>");
				$(this).parent().parent().prev().remove();
			}
			
		});
		$(".down_up").live("click",function () {
			//alert($(this).attr("ids"));
			//alert($(this).parent().parent().prev().html());
			//if($(this).attr("sorts")!=1){
				var sd=($(this).attr("sorts")*1)+1;
				$(this).parent().parent().next().find("a").attr("sorts",$(this).attr("sorts"));
				//$(this).parent().parent().find(".sortis").val(sd);
				$(this).parent().find("a").attr("sorts",sd);
				$(this).parent().parent().before("<tr>"+$(this).parent().parent().next().html()+"</tr>");
				$(this).parent().parent().next().remove();
			//}
			
		});
		$(".so_up").live("click",function () {
		//alert('vbc');
				if($(this).attr("brd")!="br"){
					$(this).addClass("br");
					$(this).attr("brd","br");
					$(this).parent().parent().find(".brsss").val("br");
				}else{
					$(this).removeClass("br");
					$(this).attr("brd","no");
					$(this).parent().parent().find(".brsss").val("no");
				}
		});
	
	});
</script>
