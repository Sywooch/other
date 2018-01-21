<?php



####��������� ��������� ���� ������######
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
## ����������� � �����################
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
//mysql_query("SET CHARACTER SET 'utf8'");
###������� ��� ���������� ������ �������##
function query($query){$result = mysql_query($query);}
function red($query){$result = mysql_query($query);	mysql_error();	$c=array();for($i=0;$i<mysql_num_fields($result);$i++) { $param=mysql_fetch_field($result);  $c['mas'][$i]= "$param->name";}$cats=array();$results = mysql_query($query);$cs=0;while ($row = mysql_fetch_assoc($results)) {	for($d=0;$d<count($c['mas']);$d++){	$cats[$cs][$c["mas"][$d]]= $row[$c['mas'][$d]];}$cs++;}return $cats;}
############################################



function generate_password($number)  
  {  
    $arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 'A','B','C','D','E','F',  
                 'G','H','I','J','K','L',  
                 'M','N','O','P','R','S',  
                 'T','U','V','X','Y','Z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0','.',',',  
                 '(',')','[',']','!','?',  
                 '&','^','%','@','*','$',  
                 '<','>','/','|','+','-',  
                 '{','}','`','~');  
    // Генерируем пароль  
    $pass = "";  
    for($i = 0; $i < $number; $i++)  
    {  
      // Вычисляем случайный индекс массива  
      $index = rand(0, count($arr) - 1);  
      $pass .= $arr[$index];  
    }  
    return $pass;  
  }  



function generate_code($number)  
  {  
    $arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 'A','B','C','D','E','F',  
                 'G','H','I','J','K','L',  
                 'M','N','O','P','R','S',  
                 'T','U','V','X','Y','Z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0');  
    // Генерируем код  
    $pass = "";  
    for($i = 0; $i < $number; $i++)  
    {  
      // Вычисляем случайный индекс массива  
      $index = rand(0, count($arr) - 1);  
      $pass .= $arr[$index];  
    }  
    return $pass;  
  }  



		
$email=$_POST['email'];




//генерация нового пароля
$new_pass=generate_password(6);

//получить идентфикатор дилера по его mail
$res=red("SELECT * FROM ad_dealers WHERE mail='".$email."'");
$dealer_id=$res[0]['id'];
$login=$res[0]['login'];
$code=generate_code(10);
$res=query("INSERT INTO ad_dealers_restore_access (code, dealer_id) VALUES ('".$code."','".$dealer_id."')");



$link=$_SERVER['SERVER_NAME']."/?restore_access=1&dealer_id=".$dealer_id."&new_pass=".$new_pass."&code=".$code."";


$text="Для восстановления доступа перейдите по <a href='http://".$link."' target='_blank'>ссылке</a>. Вашим новым паролем будет: ".$new_pass."";

mail($email, "Восстановление доступа в личный кабинет", $text, 
    'Content-type: text/html;' . "\r\n"."From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	

mail('gsu1234@mail.ru', "Дилер ".$login." восстановил доступ в личный кабинет", "Дилер c логином ".$login." восстановил доступ в личный кабинет", 
    'Content-type: text/html;' . "\r\n"."From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
mail('dealers@artisan-project.ru', "Дилер ".$login." восстановил доступ в личный кабинет", "Дилер c логином ".$login." восстановил доступ в личный кабинет", 
    'Content-type: text/html;' . "\r\n"."From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
	
		

?>