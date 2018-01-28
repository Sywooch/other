<?
session_start();

	$_SESSION['paramspage']=array('param'=>$_POST['param'],'di_param'=>$_POST['di_param'],'sort_type'=>$_POST['sort_type'],'page'=>$_POST['page']);
	
	if($_POST['cat_ids']!=""){
		$_SESSION['cat_id']=$_POST['cat_ids'];
	}
	echo "ok";
?>