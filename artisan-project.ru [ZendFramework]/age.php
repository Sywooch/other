<?
//print_r($_POST);
if($_POST['diller']!="" && $_POST['id']!="" && $_POST['shou']!="1"){
	//echo "hede";
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td")){
		$data=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td");
		$data_array=unserialize($data);
	}else{
		$data_array=array();
	}
	$data_array[]=$_POST['id'];
	file_put_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td",serialize($data_array));
	
}
if($_POST['diller']!="" && $_POST['id']!="" && $_POST['hede']!="1"){
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td")){
		$data=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td");
		$data_array=unserialize($data);
		$new_arr=array();
		for($i=0;$i<count($data_array);$i++){
			if($data_array[$i]!=$_POST['id']){
				$new_arr[]=$data_array[$i];
			}
		}
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_POST['diller'].".td",serialize($new_arr));
	}

}
?>