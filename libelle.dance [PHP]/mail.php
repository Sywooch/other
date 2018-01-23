<?php

// && isset($_POST["code"])

if (isset($_POST["jform"]))
{



$data = array();
$data = $_POST["jform"];
$message="Р—Р°РїСЂРѕСЃ РѕС‚ ".$data["contact_name"]."

РўРµР»РµС„РѕРЅ:".$data["contact_phone"]."

".$_POST["jform_message"]."

";



 







if(mail("gsu1234@mail.ru", $data["contact_subject"], $message, "From:".$data["contact_email"])){
echo "OK";
}else{
echo "error";
};


mail("sales@amur-tg.ru", $data["contact_subject"], $message, "From:".$data["contact_email"]);



}

$go_to = $_POST["back_URL"]; 
//header("location:$go_to");
?>