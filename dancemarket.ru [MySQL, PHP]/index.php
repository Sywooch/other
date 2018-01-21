<? 
session_start();

include('../db.php'); 
include("pagination.php"); 
if( empty($_SESSION['admin_id']) or empty($_SESSION['admin_name'])) {
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);
echo'
<script language="JavaScript"> 
window.location.href = "login.php"
</script>';
exit;
};
$id = $_SESSION['admin_id'];
$gl_p  = $mysqli->query("SELECT `ip`,`session`,`email`,`shopId` FROM `administrators` where `id`='$id' limit 1");
$glo_p = $gl_p->fetch_row();
$ip_m = $glo_p[0];
$ses_m = $glo_p[1];
$em_reg=$glo_p[2];
$shopId=$glo_p[3];
$ses_id = session_id();
$a = (isset($_GET['a'])) ? htmlspecialchars($_GET['a']) : '';
if($a=='exit') {
unset($_SESSION['admin_id']);
unset($_SESSION['admin']);
unset($_SESSION['admin_name']);
echo'
<script language="JavaScript"> 
window.location.href = "login.php"
</script>';
exit;
}

include("tpl/head.php");

if($a=='myinfo') {
echo'<div id="zag">Настройки</div><div class="content">';
echo'
<div id="res17812"></div>
<form onsubmit="return false;">
<table cellpadding="0" cellspacing="0"><tr><td valign=top>
<table cellpadding="0" cellspacing="0">
<tr><td>E-mail:</td><td></td><td><input style="width:260px;" class="input_osn" type="text" id="email" value="'.$em_reg.'" /></td></tr>
<tr><td style="height:10px;"></td></tr>
<tr><td></td><td></td><td align=right><div id="sajax"><input class="button" onclick="myedit()" type="button" value="Сохранить"/></div></td></tr>
</table>
</td>
<td valign=top style="padding-left:100px;">
<table cellpadding="0" cellspacing="0">
<tr><td>Смена пароля:</td><td width="30px"></td><td><input style="width:260px;" class="input_osn" type="password" id="pass1" value="" /></td></tr>
<tr><td style="height:10px;"></td></tr>
<tr><td>Повторите новый пароль:</td><td></td><td><input style="width:260px;" class="input_osn" type="password" id="pass12" value="" /></td></tr>
<tr><td style="height:10px;"></td></tr>

</table>
</td>
</tr></table>
</form>';
}


///////////////////////////////////////////////////////////////////////

//управление цветом и размером
$rs_shop_color  = $mysqli->query('SELECT * FROM  `color`');
while ($row_shop_color = $rs_shop_color->fetch_assoc()){ 
	
	//echo $row_shop_color['name']." - ";
	
	$pos=strpos($row_shop_color['name'],"\n");
	if($pos===false){
		
	}else{
		//echo" 1 ";
		unset($mas_new_id);
		
		$id_old_color=$row_shop_color['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode("\n",$row_shop_color['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_color2  = $mysqli->query('SELECT * FROM  `color` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_color2)){
				while ($row_shop_color2 = $rs_shop_color2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_color2['id'];
				}
			}else{
				$rs_shop_color2  = $mysqli->query('INSERT INTO `color` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_color2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_color7  = $mysqli->query('DELETE FROM `color` WHERE id="'.$id_old_color.'"');
		if ($rs_shop_color7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_color4  = $mysqli->query('SELECT * FROM  `tovar_color` WHERE color="'.$id_old_color.'"');
		while ($row_shop_color4 = $rs_shop_color4->fetch_assoc()){ 
			$id_tovar=$row_shop_color4['tovar'];
			$rs_shop_color5  = $mysqli->query('DELETE FROM `tovar_color` WHERE color="'.$id_old_color.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_color5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_color6  = $mysqli->query('INSERT INTO `tovar_color` (tovar, color) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_color6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}
	
	
	
	
	
	$pos=strpos($row_shop_color['name'],",");
	if($pos===false){
		
	}else{
		//echo" 2 ";
		unset($mas_new_id);
		
		$id_old_color=$row_shop_color['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode(",",$row_shop_color['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_color2  = $mysqli->query('SELECT * FROM  `color` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_color2)){
				while ($row_shop_color2 = $rs_shop_color2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_color2['id'];
				}
			}else{
				$rs_shop_color2  = $mysqli->query('INSERT INTO `color` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_color2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_color7  = $mysqli->query('DELETE FROM `color` WHERE id="'.$id_old_color.'"');
		if ($rs_shop_color7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_color4  = $mysqli->query('SELECT * FROM  `tovar_color` WHERE color="'.$id_old_color.'"');
		while ($row_shop_color4 = $rs_shop_color4->fetch_assoc()){ 
			$id_tovar=$row_shop_color4['tovar'];
			$rs_shop_color5  = $mysqli->query('DELETE FROM `tovar_color` WHERE color="'.$id_old_color.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_color5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_color6  = $mysqli->query('INSERT INTO `tovar_color` (tovar, color) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_color6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}
	
	
	
	
	
	
	$pos=strpos($row_shop_color['name'],";");
	if($pos===false){
		
	}else{
		//echo" 3 ";
		unset($mas_new_id);
		
		$id_old_color=$row_shop_color['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode(";",$row_shop_color['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_color2  = $mysqli->query('SELECT * FROM  `color` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_color2)){
				while ($row_shop_color2 = $rs_shop_color2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_color2['id'];
				}
			}else{
				$rs_shop_color2  = $mysqli->query('INSERT INTO `color` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_color2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_color7  = $mysqli->query('DELETE FROM `color` WHERE id="'.$id_old_color.'"');
		if ($rs_shop_color7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_color4  = $mysqli->query('SELECT * FROM  `tovar_color` WHERE color="'.$id_old_color.'"');
		while ($row_shop_color4 = $rs_shop_color4->fetch_assoc()){ 
			$id_tovar=$row_shop_color4['tovar'];
			$rs_shop_color5  = $mysqli->query('DELETE FROM `tovar_color` WHERE color="'.$id_old_color.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_color5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_color6  = $mysqli->query('INSERT INTO `tovar_color` (tovar, color) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_color6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}	
	
	
	//echo"<br>";
	
	
	
	
}; 

///////////////////////////////////////////////////////////////////////





//управление цветом и размером
$rs_shop_size  = $mysqli->query('SELECT * FROM  `size`');
while ($row_shop_size = $rs_shop_size->fetch_assoc()){ 
	
	//echo $row_shop_color['name']." - ";
	/*
	$pos=strpos($row_shop_size['name'],"\n");
	if($pos===false){
		
	}else{
		//echo" 1 ";
		unset($mas_new_id);
		
		$id_old_size=$row_shop_size['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode("\n",$row_shop_size['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_size2  = $mysqli->query('SELECT * FROM  `size` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_size2)){
				while ($row_shop_size2 = $rs_shop_size2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_size2['id'];
				}
			}else{
				$rs_shop_size2  = $mysqli->query('INSERT INTO `size` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_size2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_size7  = $mysqli->query('DELETE FROM `size` WHERE id="'.$id_old_size.'"');
		if ($rs_shop_size7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_size4  = $mysqli->query('SELECT * FROM  `tovar_size` WHERE size="'.$id_old_size.'"');
		while ($row_shop_size4 = $rs_shop_size4->fetch_assoc()){ 
			$id_tovar=$row_shop_size4['tovar'];
			$rs_shop_size5  = $mysqli->query('DELETE FROM `tovar_size` WHERE size="'.$id_old_size.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_size5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_size6  = $mysqli->query('INSERT INTO `tovar_size` (tovar, size) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_size6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}
	*/
	
	
	
	/*
	$pos=strpos($row_shop_size['name'],",");
	if($pos===false){
		
	}else{
		//echo" 2 ";
		unset($mas_new_id);
		
		$id_old_size=$row_shop_size['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode(",",$row_shop_size['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_size2  = $mysqli->query('SELECT * FROM  `size` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_size2)){
				while ($row_shop_size2 = $rs_shop_size2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_size2['id'];
				}
			}else{
				$rs_shop_size2  = $mysqli->query('INSERT INTO `size` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_size2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_size7  = $mysqli->query('DELETE FROM `size` WHERE id="'.$id_old_size.'"');
		if ($rs_shop_size7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_size4  = $mysqli->query('SELECT * FROM  `tovar_size` WHERE size="'.$id_old_size.'"');
		while ($row_shop_size4 = $rs_shop_size4->fetch_assoc()){ 
			$id_tovar=$row_shop_size4['tovar'];
			$rs_shop_size5  = $mysqli->query('DELETE FROM `tovar_size` WHERE color="'.$id_old_size.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_size5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_size6  = $mysqli->query('INSERT INTO `tovar_size` (tovar, size) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_size6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}
	*/
	
	
	
	
	
	$pos=strpos($row_shop_size['name'],";");
	if($pos===false){
		
	}else{
		//echo" 3 ";
		unset($mas_new_id);
		
		$id_old_size=$row_shop_size['id'];//идентификатор связки
		//echo "<span style='color:white;'>".$row_shop_color['name']."</span><br><br>";
		$mas1=explode(";",$row_shop_size['name']);
		for($i=0;$i<count($mas1);$i++){
			//echo $mas1[$i]; echo " -- "; echo"<br>";
			$rs_shop_size2  = $mysqli->query('SELECT * FROM  `size` WHERE name="'.$mas1[$i].'"');
			if(mysqli_num_rows($rs_shop_size2)){
				while ($row_shop_size2 = $rs_shop_size2->fetch_assoc()){ 
					$mas_new_id[]=$row_shop_size2['id'];
				}
			}else{
				$rs_shop_size2  = $mysqli->query('INSERT INTO `size` (name) VALUES ("'.$mas1[$i].'")');
				if ($rs_shop_size2===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}	
				$mas_new_id[]=$mysqli->insert_id;
			}
			
				
		}
		
		
		$rs_shop_size7  = $mysqli->query('DELETE FROM `size` WHERE id="'.$id_old_size.'"');
		if ($rs_shop_size7===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$rs_shop_size4  = $mysqli->query('SELECT * FROM  `tovar_size` WHERE size="'.$id_old_size.'"');
		while ($row_shop_size4 = $rs_shop_size4->fetch_assoc()){ 
			$id_tovar=$row_shop_size4['tovar'];
			$rs_shop_size5  = $mysqli->query('DELETE FROM `tovar_size` WHERE size="'.$id_old_size.'" AND tovar="'.$id_tovar.'"');
			if ($rs_shop_size5===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}	
			
			for($i2=0;$i2<count($mas_new_id);$i2++){
				$rs_shop_size6  = $mysqli->query('INSERT INTO `tovar_size` (tovar, size) VALUES ("'.$id_tovar.'","'.$mas_new_id[$i2].'")');
				if ($rs_shop_size6===false) {
					printf("Ошибка #2: %s\n", $mysqli->error);
				}
			}
			
			
		}
		
		
		
		
	
	}	
	
	
	//echo"<br>";
	
	
	
	
}; 







///////////////////////////////////////////////////////////////////////


class TreeOX1 {
 
    private $_db = null;
    private $_category_arr = array();
 
    public function __construct() {
        //Подключаемся к базе данных, и записываем подключение в переменную _db
        $this->_db = new PDO("mysql:dbname=gb_shop_d;host=mysql89.1gb.ru", "gb_shop_d", "8cb25a97345");
        //В переменную $_category_arr записываем все категории (см. ниже)
        $this->_category_arr = $this->_getCategory();
    }
 
    /**
     * Метод читает из таблицы category все сточки, и 
     * возвращает двумерный массив, в котором первый ключ - id - родителя 
     * категории (parent_id)
     * @return Array 
     */
    private function _getCategory() {
        $query = $this->_db->prepare("SELECT * FROM `category`"); //Готовим запрос
        $query->execute(); //Выполняем запрос
        //Читаем все строчки и записываем в переменную $result
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором 
        //первый ключ - parent_id)
        $return = array();
        foreach ($result as $value) { //Обходим массив
            $return[$value->parent][] = $value;
        }
        return $return;
    }
 
    /**
     * Вывод дерева
     * @param Integer $parent - id-родителя
     * @param Integer $level - уровень вложености
     */
    public function outTree($parent, $level) {
        if (isset($this->_category_arr[$parent])) { //Если категория с таким parent_id существует
            foreach ($this->_category_arr[$parent] as $value) { //Обходим ее
                /**
                 * Выводим категорию 
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
                 */
                echo "<div class='cat_".$value->id."' onclick='select_category1(".$value->id.")' style='cursor:pointer; margin-left:" . ($level * 15) . "px;'>" . $value->name . "</div>";
                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                $this->outTree($value->id, $level);
                $level--; //Уменьшаем уровень вложености
            }
        }
    }
 
}
 
 
class TreeOX2 {
 
    private $_db = null;
    private $_category_arr = array();
 
    public function __construct() {
        //Подключаемся к базе данных, и записываем подключение в переменную _db
        $this->_db = new PDO("mysql:dbname=gb_shop_d;host=mysql89.1gb.ru", "gb_shop_d", "8cb25a97345");
        //В переменную $_category_arr записываем все категории (см. ниже)
        $this->_category_arr = $this->_getCategory();
    }
 
    /**
     * Метод читает из таблицы category все сточки, и 
     * возвращает двумерный массив, в котором первый ключ - id - родителя 
     * категории (parent_id)
     * @return Array 
     */
    private function _getCategory() {
        $query = $this->_db->prepare("SELECT * FROM `category`"); //Готовим запрос
        $query->execute(); //Выполняем запрос
        //Читаем все строчки и записываем в переменную $result
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        //Перелапачиваем массим (делаем из одномерного массива - двумерный, в котором 
        //первый ключ - parent_id)
        $return = array();
        foreach ($result as $value) { //Обходим массив
            $return[$value->parent][] = $value;
        }
        return $return;
    }
 
    /**
     * Вывод дерева
     * @param Integer $parent - id-родителя
     * @param Integer $level - уровень вложености
     */
    public function outTree($parent, $level) {
        if (isset($this->_category_arr[$parent])) { //Если категория с таким parent_id существует
            foreach ($this->_category_arr[$parent] as $value) { //Обходим ее
                /**
                 * Выводим категорию 
                 *  $level * 25 - отступ, $level - хранит текущий уровень вложености (0,1,2..)
                 */
                echo "<div class='cat_".$value->id."' onclick='select_category2(".$value->id.")' style='cursor:pointer; margin-left:" . ($level * 15) . "px;'>" . $value->name . "</div>";
                $level++; //Увеличиваем уровень вложености
                //Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
                $this->outTree($value->id, $level);
                $level--; //Уменьшаем уровень вложености
            }
        }
    }
 
}
 
 
 

 






if($a=='index') {
echo'<div id="zag">Главная</div><div class="content">';
echo'';
}



if($a=='admins') {
echo'<div id="zag">Администраторы</div><div class="content">';
echo'';
	$rs22  = $mysqli->query('SELECT id,login,email FROM  `administrators`' );
	while ($row22 = $rs22->fetch_assoc()){echo $row22['id'].' '.$row22['login'].' '.$row22['email'].'   <input type="password" value="" name="pass_'.$row22['id'].'" id="pass_'.$row22['id'].'"/> <span class="pass_button" style="cursor:pointer;" onclick="edit_pass('.$row22['id'].');">Сменить пароль</span><br><br><br>';
	};

}



if($a=='shops') {
	
	
if($_SESSION['admin_id']!='1'){

	$id_user=$_SESSION['admin_id'];
	$rs_user  = $mysqli->query('SELECT * FROM  `administrators` WHERE id="'.$id_user.'"');
	while ($row_user = $rs_user->fetch_assoc()){
		$id_shop_user=$row_user['shopId'];	
	}
	
	
	
	
}






echo'<div id="zag">Магазины</div><div class="content tmp3">';
echo"<b>Управление импортом</b><br><br>";




?>


<div class="block_import">
<span>Импортировать товары из xml-файла</span>
<form method="POST" id="formx2" action="javascript:void(null);">
<!--<span href="index.php?a=shop"><li><img src="tpl/img/raz1.png"/><div class="m" style="font-size:8px;">Импортировать<br />товары из xml-файла</div></li></span>-->
<br />
<input name="userfile" type="file" /><br />
<div id="addjax2"><input class="button" onclick="tovat_add2()" type="button" value="Добавить"/></div><br />
<div id="res12_2"></div>


<?php
if($_SESSION['admin_name']=='admin'){
//выборка магазина доступна для админа
?>
<br>
<br>
<select name="tovar_shop2" >
<option disabled selected value="0">Выберите магазин</option>


<?php
$rs_shop2  = $mysqli->query('SELECT * FROM  `shops`');
while ($row_shop2 = $rs_shop2->fetch_assoc()){ 
	echo'<option value="'.$row_shop2['id'].'" class="target">'.$row_shop2['name'].'</option>';
};
echo '</select>';
?>	


<?php	
}


?>

</form>

<form method="POST" id="formx3" action="javascript:void(null);">

<input name="url" type="text" placeholder="Введите ссылку на xml-файл"/><br />
<div id="addjax3"><input class="button" onclick="tovat_add3()" type="button" value="Загрузить"/></div>
<div id="addjax4"><input class="button" onclick="tovat_add4()" type="button" value="Включить автоимпорт"/></div>
<div id="res12_2"></div>
<?php
if($_SESSION['admin_name']=='admin'){
//выборка магазина доступна для админа
?>
<br>
<br>
<select name="tovar_shop3" >
<option disabled selected value="0">Выберите магазин</option>


<?php
$rs_shop2  = $mysqli->query('SELECT * FROM  `shops`');
while ($row_shop2 = $rs_shop2->fetch_assoc()){ 
	echo'<option value="'.$row_shop2['id'].'" class="target">'.$row_shop2['name'].'</option>';
};
echo '</select>';
?>	


<?php	
}


?>

</form>



</div>



<?php
echo'<hr style="margin-top:15px; margin-bottom:5px;">';



echo'';
	$rs22  = $mysqli->query('SELECT * FROM  `shops`' );
	while ($row22 = $rs22->fetch_assoc()){




if(($_SESSION['admin_id']=='1')||($id_shop_user==$row22['id'])){

		echo '<b style="margin-right:10px;">Наименование магазина:  </b> <input class="input_osn" type="text" name="name_shop" id="name_shop_'.$row22['id'].'" value="'.$row22['name'].'"/> '.'<br><br>';
		echo '<b style="margin-right:10px;">Телефон:  </b> <input class="input_osn" type="text" name="tel_shop" id="tel_shop_'.$row22['id'].'" value="'.$row22['tel'].'"/> '.'<br><br>';
		echo '<b style="margin-right:10px;">URL:  </b> <input class="input_osn" type="text" name="url_shop" id="url_shop_'.$row22['id'].'" value="'.$row22['url'].'"/> '.'<br><br>';
		echo '<b style="float:left; margin-right:10px;">Описание:  </b> <textarea  class="input_osn" name="comm_shop" id="comm_shop_'.$row22['id'].'" style=" height:50px;">'.$row22['comm'].'</textarea> '.'<br><br>';
	
		echo '<input type="button" class="button" value="Сохранить" onclick="edit_shop('.$row22['id'].');"/>';
	
		echo"<hr style='margin-top:5px; margin-bottom:5px;'>";
	

	
	
}else{

	

		
		echo '<b>Наименование магазина:</b> '.$row22['name'].' '.'<br>';
		echo '<b>Телефон:</b> '.$row22['tel'].' '.'<br>';
		echo '<b>URL:</b> <a href="'.$row22['url'].'" target="_blank">'.$row22['url'].'</a> '.'<br>';
		echo '<b>Описание:</b> '.$row22['comm'].' '.'<br>';
	
		echo"<hr style='margin-top:5px; margin-bottom:5px;'>";
	



}


};


?>
<?php
if($_SESSION['admin_name']=='admin'){
?>

<div class="insert_shop">
	<span style="display:block; margin-top:20px;">Добавить магазин</span>
	<span style="display:block; margin-top:20px;"><input type="text" value="" placeholder="Наименование" class="name" style="width:250px"/></span>
    <span style="display:block; margin-top:20px;"><input type="text" value="" placeholder="Телефон" class="phone" style="width:250px"/></span>
    <span style="display:block; margin-top:20px;"><input type="text" value="" placeholder="URL" class="url" style="width:250px"/></span>
    <span style="display:block; margin-top:20px;"><textarea class="description" placeholder="Описание" style="width:250px"></textarea></span>
    <input type="button" value="Добавить" onclick="insert_shop();" style="display:block; margin-top:20px; padding:10px; "/>
     


</div>


<script type="text/javascript">
function insert_shop(){

var name=$('.insert_shop .name').val();
var phone=$('.insert_shop .phone').val();
var url=$('.insert_shop .url').val();
var description=$('.insert_shop .description').val();






var msg={ name:name,phone:phone,url:url,description:description};

$.ajax({
type: "POST",
url: "ajax/insert_shop.php",
data: msg,
success: function(data){

alert(data);
window.location.reload();

}});


	
	
	
	
}

</script>

<?php
}
?>



<?php


}



//url,tel,mail,comm



if($a=='shop') {
echo'<div id="zag">Магазин</div><div class="content tmp1">';
echo'';
	$rs22  = $mysqli->query('SELECT * FROM  `shops` where id='.$shopId );
	if ($row22 = $rs22->fetch_assoc()){
	echo'
<div id="res17812"></div>
<form onsubmit="return false;">
<table cellpadding="0" cellspacing="0"><tr><td valign=top>
<table cellpadding="0" cellspacing="0">
<tr><td>Название:</td><td></td><td><input style="width:260px;" class="input_osn" type="text" id="name" value="'.$row22['name'].'" /></td></tr>
<tr><td style="height:10px;"></td></tr>

<tr><td>Телефон:</td><td></td><td><input style="width:260px;" class="input_osn" type="text" id="tel" value="'.$row22['tel'].'" /></td></tr>
<tr><td style="height:10px;"></td></tr>
<tr><td>url:</td><td></td><td><input style="width:260px;" class="input_osn" type="text" id="url" value="'.$row22['url'].'" /></td></tr>
<tr><td style="height:10px;"></td></tr>

<tr><td></td><td></td><td align=right><div id="sajax"><input class="button" onclick="myedit2('.$row22['id'].')" type="button" value="Сохранить"/></div></td></tr>
</table>
</td>
<td valign=top style="padding-left:100px;">
<table cellpadding="0" cellspacing="0">
<tr><td>Описание:</td><td width="30px"></td><td><input style="width:260px;" class="input_osn" type="text" id="comm" value="'.$row22['comm'].'" /></td></tr>
<tr><td style="height:10px;"></td></tr>


</table>
</td>
</tr></table>
</form>';	
		
		
		
	};

}

if($a=='mag') {
		function color_array($path) {
	global $color_name,$mysqli;
	if ($path!='') {
		$color_name[$path]='-';
	$rs22  = $mysqli->query("SELECT * FROM `color` where `id` =  '".$path."'  limit 1");
	if ($row22 = $rs22->fetch_assoc()){$color_name[$path]=$row22['name'];
	};};};

	function size_array($path) {
	global $size_name,$mysqli;
	if ($path!='') {
		$size_name[$path]='-';
	$rs22  = $mysqli->query("SELECT * FROM `size` where `id` =  '".$path."'  limit 1");
	if ($row22 = $rs22->fetch_assoc()){$size_name[$path]=$row22['name'];
	};};};
	
	function brand_array($path) {
	global $brand_name,$mysqli;
	if ($path!='') {
		$brand_name[$path]='-';
	$rs22  = $mysqli->query("SELECT * FROM `brand` where `id` =  '".$path."'  limit 1");
	if ($row22 = $rs22->fetch_assoc()){$brand_name[$path]=$row22['name'];
	};};};
echo'<div id="zag">Магазин</div><div class="content tmp2">';
	if(isset($_GET['id'])) {$id=$_GET['id'];} else {$id=0;};

	
if(isset($_GET['item'])) {
		if ($_SESSION['shopid']==0){$sql_t='';} else {$sql_t=' and shop='.$_SESSION['shopid']; }
	$rs1 = $mysqli->query("SELECT * FROM `tovar` where `id` =  ".$_GET['item'].$sql_t." limit 1;");
if ($row1 = $rs1->fetch_object()){	
$item=$row1 ->id;
$id=$row1 ->category;		
};
};


function head_menu($path) {
	global $menu,$mysqli;
	if ($path!='') {
	$rs22  = $mysqli->query("SELECT * FROM `category` where `id` =  '".$path."'  limit 1");
	if ($row22 = $rs22->fetch_assoc()){
		$menu='<a href="?a=mag&id='.$row22['id'].'" class="dr" >'.$row22['name'].'</a> >> '.$menu;
				if (0!==$row22['parent']){head_menu($row22['parent']);};
	};

			};
};



$menu='';
head_menu($id);
echo ($menu.'<br><br>');

if(isset($item)) {
	
	
	
	$rs23  = $mysqli->query("SELECT * FROM `tovar` where `id` =  '".$item."'  LIMIT 1");
while ($row23 = $rs23->fetch_assoc()){
	echo '<div class="block_afisha" style="color:#141414">';
	echo '<table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td width="10%" class="tmp121 detail_tovar_img">';


/*	
	$dh = opendir( '../img/shop/'.$item) or die ('../img/shop/'.$item );

while ( $f = readdir( $dh ) ) {
if (strripos($f,'.jpg')){
	if (!is_file('../img/shop/'.$item.'/small/'.$f))
	{
     $image = imagecreatefromjpeg('../img/shop/'.$item.'/'.$f);		
     $orig_width=imagesx($image);
     $orig_height=imagesy($image);
     $width = $orig_width;
     $height = $orig_height;
     $max_height=450;
     $max_width=240;
    if ($height > $max_height) {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }
    if ($width > $max_width) {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }
    $image_s = imagecreatetruecolor($width, $height);
    imagecopyresampled($image_s, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
	mkdir('../img/shop/'.$item.'/small', 0777, true);
    imagejpeg ($image_s,   '../img/shop/'.$item.'/small/'.$f,85);
		
	};



//echo '<a href="../img/shop/'.$item.'/'.$f.'"  class="fancybox" rel="group"><img class="img_block tmp2" src="../img/shop/'.$item.'/small/'.$f.'"></a><br>';
//echo '<a href="../img/shop/'.$item.'/'.$f.'"  >удалить</a><br>';

}};
*/

$rs_1 = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$row23['id']."'");	
		while ($row_1 = mysqli_fetch_assoc($rs_1)){	
			
			if($row_1['url']==""){ continue; };
			
			$image_1=$row_1['url'];
			
			echo '<a href="'.$image_1.'"  class="fancybox" rel="group"><img class="img_block tmp2" src="'.$image_1.'"></a><br>';
			echo '<a onclick=\'delete_foto("'.$row23['id'].'","'.$image_1.'");\' style="cursor:pointer;">удалить</a><br>';
			
			
		}

	//	echo'<img class="img_block tmp1" src="'.$image_1.'"></td><td valign=top style="padding-left:20px;">';





	
	
    echo '</td><td valign=top style="padding-left:20px;" class="tmp_3">';
	
	
	echo '<form method="POST" id="formr" action="javascript:void(null);">';
	
	echo 'Название: <input  type="text" class="target" name="tovar_name" id="tovar_name" placeholder="Название" value="'.$row23['name'].'">
	<span id="ovar_name"></span><input  type="hidden" id="tovar_id" name="tovar_id" value="'.$row23['id'].'">
	<br><br> id '.$row23['id'];
		 echo '<br><br>Торговая марка: <select name="tovar_brend" class="target  tmp1">
  <option disabled selected value="0">Выберите торговую марку</option>';
  $rs24  = $mysqli->query('SELECT * FROM  `brand`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<option value="'.$row24['id'].'"';
 echo ($row24['id']==$row23['brand'])? ' selected': '';
 echo'>'.$row24['name'].'</option>';
 };
echo '</select><span id="ovar_bren"></span>';
echo '<br><br>Артикул: <input  type="text" class="target" name="tovar_art" id="tovar_art" placeholder="артикул" value="'.$row23['artikul'].'"><span id="ovar_art"></span>';
	echo '<br><br>Цена: <input  type="text" class="target" name="tovar_price" id="tovar_price" placeholder="Цена" value="'.$row23['price'].'">'; 
		include('../currency.php'); 
		 echo '<select name="currency" class="target" >
  <option disabled selected value="">Выберите валюту</option>';
foreach ($currency as $key=>$val){
 echo'<option value="'.$key.'"';
  echo ($key==$row23['currency'])? ' selected': '';
  echo'>'.$key.'</option>';
 };
echo '</select><span id="urrency"></span><span id="ovar_pric"></span>';
	$tovar_color_arr= array();
	
 echo '<br><br>цвет(1):';





echo'<br><span style="cursor:pointer;" onclick="spoiler1();" class="spoiler_title1">Развернуть</span><br>';
echo'<div class="spoiler1" style="display:none;">'; 


		$rs2  = $mysqli->query('SELECT * FROM `tovar_color` where `tovar` =  '.$row23['id']);
while ($row2 = $rs2->fetch_assoc()){
$tovar_color_arr[$row2['color']]='';
};	

  $rs24  = $mysqli->query('SELECT * FROM  `color`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<br><label><input type="checkbox" class="target" name="tovarcolor'.$row24['id'].'"';
 echo (isset($tovar_color_arr[$row24['id']]))? ' checked':'';
 echo'/>'.$row24['name'].'</label> ';
 $color_name[$row24['id']]=$row24['name'];
 };
 
echo'</div>';
 
 
 
 
 
 
 
 

 echo '<span id="ovarcolor"></span><br><br>Размер:';
 
 
 echo'<br><span style="cursor:pointer;" onclick="spoiler2();" class="spoiler_title2">Развернуть</span><br>';
echo'<div class="spoiler2" style="display:none;">'; 

  	$tovar_size_arr= array();
 	$rs2  = $mysqli->query('SELECT * FROM `tovar_size` where `tovar` =  '.$row23['id']);
while ($row2 = $rs2->fetch_assoc()){
	$tovar_size_arr[$row2['size']]='';
};	
 
  $rs24  = $mysqli->query('SELECT * FROM  `size`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<br><label><input type="checkbox" class="target"  name="tovar_size'.$row24['id'].'"';
 echo (isset($tovar_size_arr[$row24['id']]))? ' checked':'';
 echo'/>'.$row24['name'].'</label> ';
 $size_name[$row24['id']]=$row24['name'];
 };
	
echo'</div>';




echo '<span id="ovar_size"></span><br><br><table><tr><td valign=top>В наличии:</td><td></td></tr><tr><td></td><td><span id="tovar_option">';



echo'</span></td></tr></tbody></table>';
		 echo '<br><br><select name="size_option" id="size_option_add">
  <option disabled selected value="">размер</option>';
foreach ($size_name as $key=>$val){
 echo'<option value="'.$key.'">'.$val.'</option>';
 };
echo '</select>';
		 echo '<br><br><select name="color_option" id="color_option_add">
  <option disabled selected value="">цвет</option>';
foreach ($color_name as $key=>$val){
 echo'<option value="'.$key.'">'.$val.'</option>';
 };
echo '</select>';
?>



<?php
	echo'<a href="javascript:void(0);" onclick="tovar_option_add(\''.$row23['id'].'\')">Добавить</a>';
echo '<br><br>Описание: <input  type="text" class="target" name="tovar_text" id="tovar_text" class="target" placeholder="Описание" value="'.$row23['text'].'"><span id="ovar_text"></span><br><br>'; 

?>

    
<div class="files2">
 <input name="userfile[]" type="file" /><br />
 <input name="userfile[]" type="file" /><br />
</div>
<br>
<input type="button" value="Добавить поле" onclick="insert_file_input2();"/>

<br>    
    
 <br> 
 <br>    
    
<div id="addjax_r"><input class="button" onclick="tovat_r()" type="button" value="Применить"></div>    
    
  


<?php
echo'</form>';
	echo '</td></tr></tbody></table></div>';
	
	?>
	<div class="container">
    <!-- The fileinput-button span is used to style the file input field as button -->
<!--
        <span>Select files...</span>
        <input id="fileupload" type="file" name="files[]" multiple>
    <br>
    <br>
    <div id="progress" class="progress">

    </div>
    <div id="files" class="files"></div>
    
    -->
  
    
    
    

</div>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="tpl/js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

<!-- The basic File Upload plugin -->
<script src="tpl/js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'ajax/uplood_foto.php?id=<? echo $item; ?>';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {//alert(data.result.files[0].name);
//alert(data.result);  
//alert('ee');
//$('<p/>').text(data.result.a).prependTo('#progress');
$( '#progress' ).text( "<b>Some</b> new text." );         
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
           
               
               $('<p/>').text(progress + '%').appendTo('#files');
        }
    });
});
</script>
	 <script type="text/javascript">
	 
	 
	 	 function    tovar_option_add(id){
var msg='tovar='+id+'&'+$("#size_option_add").serialize()+'&'+$("#color_option_add").serialize();
	 $.ajax({
type: "POST",
url: "ajax/tovar_option_add.php",
data: msg,
beforeSend: function(){
	 $("#tovar_option").empty(); 
$("#tovar_option").append("&nbsp;&nbsp;<img src='tpl/img/loader2.gif'/>&nbsp;&nbsp;");

},
success: function(data){
if (data!='') {alert(data);};
$("#tovar_option").empty(); 
tovar_option();

}});
	 };
	 
	 
	 
	 
	 function    tovar_option_del(tovar,color,size){

	 var msg={ tovar:tovar,color:color,size:size};
	 $.ajax({
type: "POST",
url: "ajax/tovar_option_del.php",
data: msg,
beforeSend: function(){
	 $("#tovar_option").empty(); 
$("#tovar_option").append("&nbsp;&nbsp;<img src='tpl/img/loader2.gif'/>&nbsp;&nbsp;");

},
success: function(data){
$("#tovar_option").empty(); 
tovar_option();
if (data!='') {alert(data);};
}});
	 };
	 
	 
	 
	$( ".target" ).change(function() {
	var msg   = $(this).serialize();
	if (this.nodeName=='INPUT') {
if ($(this).attr( "type")=='checkbox'){
if (!$(this).prop("checked"))
msg=this.name+'=off';

};};
var this_name=this.name.substring(1,10);

$.ajax({
type: "POST",
url: "ajax/tovar_save.php?id="+document.getElementById('tovar_id').value,
data: msg,
beforeSend: function(){

document.getElementById(this_name).innerHTML = "&nbsp;&nbsp;<img src='tpl/img/loader2.gif'/>&nbsp;&nbsp;";

},
success: function(data){
document.getElementById(this_name).innerHTML = "";
if (data!='') {alert(data);};
}});
});


   function    tovar_option(){
$("#tovar_option").empty(); 
$("#tovar_option").append("&nbsp;&nbsp;<img src='tpl/img/loader2.gif'/>&nbsp;&nbsp;");

$.ajax({ url: "ajax/tovar_option.php?id=<? echo $row23['id'];?>",
 timeout: 80000 }).done(
  function (result, status) {
   result = result.trim();
  
    if (result.length >0){
    
     result = jQuery.parseJSON(result);
     var inline1 = $("#tovar_option");
     inline1.empty(); 
     for (var index = 0; index < result.length; index++) {
      var operation = result[index];
      inline1.append((operation.size || "")+" "+(operation.color || "")+
      " <a href='javascript:void(0);'  onclick='tovar_option_del(<? echo $row23['id'];?>,"+(operation.colorid || "0")+','+(operation.sizeid || "0")+");'>Удалить</a><br>");
       };};});
        } 
$(function() {
  tovar_option();
});

	</script>	
	
	<?
};
	
		
} else {
	
	

?>




<?php	
	
	
	
	
$rs22  = $mysqli->query('SELECT * FROM `category` where `parent` =  '.$id.';');
$count_cat=0;
while ($row22 = $rs22->fetch_assoc()){
$url_cat_image="";	
	$rs22_image = $mysqli->query('SELECT * FROM `category_images` where `id_category` =  '.$row22['id'].';');
	while ($row22_image = $rs22_image->fetch_assoc()){
		$url_cat_image=$row22_image['url'];	
	}
echo '<div style="width:100%; display:inline-block; margin-bottom:10px;">';	
echo'<div style="width:calc(30% - 0px); float:left; ">';
echo'<img style="width:100%;" src="'.$url_cat_image.'" />';	
echo'</div>';

echo'<div style="width:calc(70% - 30px); float:right;padding-left:30px;">';
echo '<a class="ss_block ss_56" href="?a=mag&id='.$row22['id'].'">'.$row22['name'].'</a>';

if($_SESSION['admin_name']=='admin'){
	echo'<span style="cursor:pointer;" onclick="delete_cat('.$row22['id'].');">Удалить</span>  <form method="POST" id="formx_image_'.$row22['id'].'" action="javascript:void(null);" style="display:inline;"><input type="hidden" value="'.$row22['id'].'" name="id_cat" id="id_cat"/> <span onclick="image_category_'.$row22['id'].'('.$row22['id'].');" style="cursor:pointer; margin-left:15px;">Добавить/Обновить изображение:  </span><input type="file" name="cat_image"/></form>  <br><br>';
	
?>	
	
<script type="text/javascript">


function image_category_<?php echo $row22['id']; ?>(id){



var form = document.forms.formx_image_<?php  echo $row22['id']; ?>;



           var formData = new FormData(form); 
		//	alert(formData);
 
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/adm/ajax/image_category.php");
 
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        data = xhr.responseText;
                        if(data == "true") {
                        
						
						   alert(data);
						   location.reload();
                        
						
						} else {
							
							
                           alert(data);
						   location.reload();
						   
						   
						   
						}
                    }
                }
            };

            xhr.send(formData);

	
	
	
}



</script>    
    
    
<?php
	
	
	
	
	
	
	
}else{
echo"<br><br>";	
}
echo"</div>";
echo"</div>";

$count_cat++;
};

?>


<?php
if($_SESSION['admin_name']=='admin'){
?>

<input type="button" value="Добавить категорию" onclick="add_cat('<?php if(isset($_GET['id'])){ echo $_GET['id']; }else{ echo"0"; }   ?>');"/>

<?php
}
?>



<br>
<br> 


<?php
if ($count_cat==0) {
	echo 'Добавить товар в эту категорию<form method="POST" id="formx" action="javascript:void(null);">';
	echo '<INPUT TYPE=HIDDEN NAME=category VALUE="'.$id.'">'; 
	echo '<br><br><input  type="text" class="target" name="tovar_name" id="tovar_name" placeholder="Название">';
	 echo '<br><br><select name="tovar_brend" >
  <option disabled selected value="0">Выберите торговую марку</option>';
  $rs24  = $mysqli->query('SELECT * FROM  `brand`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<option value="'.$row24['id'].'" class="target">'.$row24['name'].'</option>';
 };
echo '</select>';
	 echo '<br><br><input  type="text" class="target" name="tovar_art" id="tovar_art" placeholder="артикул">';
	echo '<br><br><input  type="text" class="target" name="tovar_price" id="tovar_price" placeholder="Цена">'; 
	include('../currency.php'); 
		 echo '<select name="currency">
  <option disabled selected value="">Выберите валюту</option>';
foreach ($currency as $key=>$val){
 echo'<option value="'.$key.'">'.$key.'</option>';
 };
echo '</select>';
echo '<br><br>цвет(2):';


echo'<br><span style="cursor:pointer;" onclick="spoiler1();" class="spoiler_title1">Развернуть</span><br><br>';
echo'<div class="spoiler1" style="display:none;">'; 

  $rs24  = $mysqli->query('SELECT * FROM  `color`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<br><label><input type="checkbox" name="tovarcolor'.$row24['id'].'" />'.$row24['name'].'</label><br> ';
 };

echo'</div>';


 
 echo '<br><br>Размер:';


echo'<br><span style="cursor:pointer;" onclick="spoiler2();" class="spoiler_title2">Развернуть</span><br><br>';
echo'<div class="spoiler2" style="display:none;">'; 
 
 
  $rs24  = $mysqli->query('SELECT * FROM  `size`;');
 while ($row24 = $rs24->fetch_assoc()){ 
 echo'<br><label><input type="checkbox" name="tovar_size'.$row24['id'].'"/>'.$row24['name'].'</label><br> ';
 };


echo'</div>';





	echo '<br><input  type="text" class="target" name="tovar_text" id="tovar_text" placeholder="Описание"><br><br>'; 
	
?>	








<div class="files1">
 <input name="userfile[]" type="file" /><br />
 <input name="userfile[]" type="file" /><br />
</div>
<br>
<input type="button" value="Добавить поле" onclick="insert_file_input();"/>

<br>

<?php
if($_SESSION['admin_name']=='admin'){
//выборка магазина доступна для админа
?>
<br>
<br>
<select name="tovar_shop" >
<option disabled selected value="0">Выберите магазин, к которому будет принадлежать товар</option>


<?php
$rs_shop2  = $mysqli->query('SELECT * FROM  `shops`');
while ($row_shop2 = $rs_shop2->fetch_assoc()){ 
	echo'<option value="'.$row_shop2['id'].'" class="target">'.$row_shop2['name'].'</option>';
};
echo '</select>';
?>	


<?php	
}


?>

<br><br>	<br>
<?php	
		
	echo '<div id="addjax"><input class="button" onclick="tovat_add()" type="button" value="Добавить"/></div></form>';
	echo '<div id="res12"></div>';
	 	
};
	if (isset($_GET['page']))
   $page = ($_GET['page']); else $page = 1;
	
	$rows_per_page = 50;
	$from = ($page-1) * $rows_per_page;
	
	$q="SELECT count(*) FROM `tovar` where `category` =  '".$id."'";
$res=$mysqli->query($q);
$row11=$res->fetch_row();
$total_rows=$row11[0]; 	

$total_pages = ceil($total_rows / $rows_per_page);

if ($total_pages>1) {
 echo '<center><ul class="sdfqwe34" style="display:block-inline;"><li>Страницы: </li>';
for($i = 1; $i <= $total_pages; $i++) {
  if (($i) == $page) {
    echo "<li><span>" . $i . "</span></li>";
  } else {
    echo '<li><a href="?a=mag&id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
  }
};
 echo '</ul></center><br><br>';};
 $brand_name[0]='-';	
 $color_name[0]='-';
 $size_name[0]='-';
			if ($_SESSION['shopid']==0){$sql_t='';} else {$sql_t=' and shop='.$_SESSION['shopid']; }
	$rs23  = $mysqli->query("SELECT * FROM `tovar` where `category` =  ".$id.$sql_t." order by `name`  LIMIT $from, $rows_per_page");

$shop_user="";
if($_SESSION['admin_name']!="admin"){	
	$user_id=$_SESSION['admin_id'];
	$rs_user  = $mysqli->query("SELECT * FROM `administrators` where `id` =  ".$user_id."");
	while ($row_user = mysqli_fetch_assoc($rs_user)){	
		$shop_user=$row_user["shopId"];
		break;
	}
	
}
	
	
while ($row23 = $rs23->fetch_assoc()){
	

$image_1="";


	if(($_SESSION['admin_name']=="admin")){
		//администратор видит товары всех магазинов
		echo '<div class="block_afisha" style="color:#141414">';
		echo '<table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td width="10%" class="tmp2">';
	
		$rs_1 = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$row23['id']."'");	
		while ($row_1 = mysqli_fetch_assoc($rs_1)){	
			if($row_1['url']==""){ continue; }
			$image_1=$row_1['url'];
			break;
		}

		echo'<img class="img_block tmp1_1" src="'.$image_1.'"></td><td valign=top style="padding-left:20px;" class="tmp_1">';
	
		//<img class="img_block tmp1" src="../img/shop/'.$row23['id'].'.jpg"></td><td valign=top style="padding-left:20px;">
	
	
	
		echo '<a href="?a=mag&item='.$row23['id'].'">'.$row23['name'].'</a> <b><span style="cursor:pointer" onclick="delete_tovar('.$row23['id'].');">Удалить</span></b><br>id '.$row23['id'];

		if (!isset($brand_name[$row23['brand']])) brand_array($row23['brand']);
		echo '<br>Торговая марка: '.$brand_name[$row23['brand']];
		echo '<br>Артикул: '.$row23['artikul'];
		$row23['price']=str_replace(" ;"," ",$row23['price']);
		
		echo '<br>Цена: '.trim($row23['price']);
		echo '<br>Цвет:  ';
		$rs2  = $mysqli->query('SELECT DISTINCT * FROM `tovar_color` where `tovar` =  '.$row23['id']);
		
		
		$count1=0;
		$text_color="";
		while ($row2 = $rs2->fetch_assoc()){
			$count1++;	
			if (!isset($color_name[$row2['color']])) color_array($row2['color']);
			
			
			
			//echo $color_name[$row2['color']].' ';
			if(($color_name[$row2['color']]=="NULL")||(($color_name[$row2['color']]=="NULL,"))||(($color_name[$row2['color']]=="-"))||(($color_name[$row2['color']]=="")))
			{   }else{
		
	
		
	
				if(mysqli_num_rows($rs2)==$count1){
					//echo $color_name[$row2['color']].'';
					$text_color=$text_color.$color_name[$row2['color']].'';
				}else{
					//echo $color_name[$row2['color']].' , ';
					$text_color=$text_color.$color_name[$row2['color']].' , ';
				}
			}
	
	
	
		
		
		};	
		
		
		if($text_color[strlen($text_color)-2]==","){
			$text_color = substr($text_color,0,-2);
		}

		echo $text_color; 



		
		
		echo '<br>Размер:  ';
		$rs2  = $mysqli->query('SELECT DISTINCT * FROM `tovar_size` where `tovar` =  '.$row23['id']);
		
		
		$text_size="";
		while ($row2 = $rs2->fetch_assoc()){
		
		
		
			if (!isset($size_name[$row2['size']])) size_array($row2['size']);
			
			if(($size_name[$row2['size']]=="NULL")||($size_name[$row2['size']]=="NULL;")){ echo " ";}else{
				$size_name[$row2['size']]=str_replace(";;",";",$size_name[$row2['size']]);	
	
				if($size_name[$row2['size']]=="-"){
			
				}else{
					//echo $size_name[$row2['size']]." , ";
					$text_size=$text_size.$size_name[$row2['size']]." , ";
				}
	
	
			}
			
			
			
		
		
		};	
		
		if($text_size[strlen($text_size)-2]==","){
			$text_size = substr($text_size,0,-2);
		}
		echo $text_size;
		
		
		echo '<br>Описание: '.$row23['text'];
		
		$id_shop=$row23['shop'];
		$rs_shop  = $mysqli->query('SELECT * FROM `shops` where `id` =  '.$id_shop);
		while ($row_shop = mysqli_fetch_assoc($rs_shop)){
			$shop_url=$row_shop['url'];
		}
	
		echo '<br>Ссылка на магазин: '.$shop_url;
		echo '<br><a href="'.$row23['outer_url'].'" target="_blank">Ссылка на товар на сайте магазина</a><br>';
		?>
        <?php
		
		$rs2  = $mysqli->query('SELECT * FROM `special` where `id_tovar` =  '.$row23['id']);
        if(mysqli_num_rows($rs2)){
			
		?>
		<br><br>
        <input type="button" value="Удалить из спецразмещения" onclick="delete_special(<?php echo $row23['id']; ?>);"/>
        
		<?php	
		}else{
		?>
        <br><br>
        <input type="button" value="Добавить в спецразмещение" onclick="add_special(<?php echo $row23['id']; ?>);"/>	
		
        <?php	
		}
        
        ?>
        
        
        <?php
		
		
		echo '</td></tr></tbody></table></div>';
		
		
	}else{
		//пользователь видит товары только своего магазина
		
		if($row23["shop"]==$shop_user){
			
			echo '<div class="block_afisha" style="color:#141414">';
			echo '<table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td width="10%" class="tmp3">';
	
			$rs_1 = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$row23['id']."'");	
			while ($row_1 = mysqli_fetch_assoc($rs_1)){	
				$image_1=$row_1['url'];
				break;
			}

			echo'<img class="img_block tmp1_2" src="'.$image_1.'"></td><td valign=top style="padding-left:20px;" class="tmp_2">';
	
			//<img class="img_block tmp1" src="../img/shop/'.$row23['id'].'.jpg"></td><td valign=top style="padding-left:20px;">
	
	
	
			echo '<a href="?a=mag&item='.$row23['id'].'">'.$row23['name'].'</a><br>id '.$row23['id'];

			if (!isset($brand_name[$row23['brand']])) brand_array($row23['brand']);
			echo '<br>Торговая марка: '.$brand_name[$row23['brand']];
			echo '<br>Артикул: '.$row23['artikul'];
			$row23['price']=str_replace(" ;","",$row23['price']);
		
		echo '<br>Цена: '.trim($row23['price']);
			
			
			
			
			
			echo '<br>Цвет(4):  ';
			

			$rs2  = $mysqli->query('SELECT * FROM `tovar_color` where `tovar` =  '.$row23['id']);
			while ($row2 = $rs2->fetch_assoc()){
				if (!isset($color_name[$row2['color']])) color_array($row2['color']);
				
				if(($color_name[$row2['color']]=="NULL")||($color_name[$row2['color']]=="NULL;")){
					echo "";
				}else{
					echo $color_name[$row2['color']].'';
				}
			
			};	
			
			
			
			
			
			
			echo '<br>Размер:  ';
			
			$rs2  = $mysqli->query('SELECT * FROM `tovar_size` where `tovar` =  '.$row23['id']);
			while ($row2 = $rs2->fetch_assoc()){
				if (!isset($size_name[$row2['size']])) size_array($row2['size']);
				
				if(($size_name[$row2['size']]=="NULL")||($size_name[$row2['size']]=="NULL;")){
					echo "";
				}else{
					echo $size_name[$row2['size']].'';
				}
				
				
				
				
				
			};	
			
			
			
			
			echo '<br>Описание: '.$row23['text'];
			
			
			$id_shop=$row23['shop'];
			$rs_shop  = $mysqli->query('SELECT * FROM `shops` where `id` =  '.$id_shop);
			while ($row_shop = mysqli_fetch_assoc($rs_shop)){
				$shop_url=$row_shop['url'];
			}
			
			echo '<br>Ссылка на магазин: '.$shop_url;
			
			
			?>
        <?php
		
		$rs2  = $mysqli->query('SELECT * FROM `special` where `id_tovar` =  '.$row23['id']);
        if(mysqli_num_rows($rs2)){
			
		?>
		<br><br>
        <input type="button" value="Удалить из спецразмещения" onclick=""/>
        
		<?php	
		}else{
		?>
        <br><br>
        <input type="button" value="Добавить в спецразмещение" onclick=""/>	
		
        <?php	
		}
        
        ?>
        
        
        <?php
			
			echo '</td></tr></tbody></table></div>';
		
			
			
			
		}
	
	
		//&&($row23["shop"])){

	}
	
	
	
	/*
	echo '<div class="block_afisha" style="color:#141414">';
	echo '<table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td width="10%">';
	
	$rs_1 = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$row23['id']."'");	
	while ($row_1 = mysqli_fetch_assoc($rs_1)){	
		$image_1=$row_1['url'];
		break;
	}

	echo'<img class="img_block tmp1" src="'.$image_1.'"></td><td valign=top style="padding-left:20px;">';
	
	//<img class="img_block tmp1" src="../img/shop/'.$row23['id'].'.jpg"></td><td valign=top style="padding-left:20px;">
	
	
	
	echo '<a href="?a=mag&item='.$row23['id'].'">'.$row23['name'].'</a><br>id '.$row23['id'];

	if (!isset($brand_name[$row23['brand']])) brand_array($row23['brand']);
	echo '<br>Торговая марка: '.$brand_name[$row23['brand']];
	echo '<br>Артикул: '.$row23['artikul'];
	echo '<br>Цена: '.$row23['price'];
	echo '<br>Цвет:  ';
	$rs2  = $mysqli->query('SELECT * FROM `tovar_color` where `tovar` =  '.$row23['id']);
	while ($row2 = $rs2->fetch_assoc()){
		if (!isset($color_name[$row2['color']])) color_array($row2['color']);
		echo $color_name[$row2['color']].'; ';
	};	
	echo '<br>Размер:  ';
	$rs2  = $mysqli->query('SELECT * FROM `tovar_size` where `tovar` =  '.$row23['id']);
	while ($row2 = $rs2->fetch_assoc()){
		if (!isset($size_name[$row2['size']])) size_array($row2['size']);
		echo $size_name[$row2['size']].'; ';
	};	
	echo '<br>Описание: '.$row23['text'];
	echo '</td></tr></tbody></table></div>';
	*/

};



echo '<br>';	

if ($total_pages>1) {
 echo '<center><ul class="sdfqwe34" style="display:block-inline;"><li>Страницы: </li>';
for($i = 1; $i <= $total_pages; $i++) {
  if (($i) == $page) {
    echo "<li><span>" . $i . "</span></li>";
  } else {
    echo '<li><a href="?a=mag&&id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
  }
};
 echo '</ul></center>';};
 };

echo '</div>';
};



if(($a=="")||($a=="banner")){
	
if($_SESSION['admin_name']=='admin'){	
	

echo'<div id="zag">Управление категориями</div><div class="content">';
	
?>



<h3 class="head_unit">Объединение категорий</h3>
<div class="unit1">




<input type="hidden" name="cat1" id="cat1" value=""/>
<input type="hidden" name="cat2" id="cat2" value=""/>



<span class="head1">Категория 1</span>
<span class="head2">Категория 2</span>


<div class="category1">
<?php
$tree = new TreeOX1();
$tree->outTree(0, 0); //Выводим дерево	
	
	/*$rs_u  = $mysqli->query('SELECT * FROM `category` where `parent` =  0');
	while ($row_u = $rs_u->fetch_assoc()){
		echo "<span class='cat_".$row_u['id']."'>".$row_u['name']."</span><br>";
		
		
	}*/
?>
</div>


<div class="category2">
<?php
$tree = new TreeOX2();
$tree->outTree(0, 0); //Выводим дерево


/*
	$rs_u  = $mysqli->query('SELECT * FROM `category` where `parent` =  0');
	while ($row_u = $rs_u->fetch_assoc()){
		echo "<span class='cat_".$row_u['id']."'>".$row_u['name']."</span><br>";	
	}
	*/
?>
</div>


<span class="head3">Какую категорию сделать основной:</span>
<p class="radio1"><input name="main" id="main1" type="radio" value="category1">Категория 1</p>
<p class="radio2"><input name="main" id="main2" type="radio" value="category2">Категория 2</p>


<span class="head4">Окончательное наименование результирующей категории:</span>
<input type="text" value=""/>

<input type="button" value="Объединить категории" onclick="unite_cat();"/>



</div>




<br>
<br>	
<h3 class="head_unit">Управление цветами</h3><br><br>



<div class="unit1 unit_color" style="height:auto;">

<span onclick="add_color();">Добавить цвет</span><br><br>

<?php
$rs_color  = $mysqli->query('SELECT * FROM  `color`');
while ($row_color = $rs_color->fetch_assoc()){
?>

<input type="text" style="position:static;" value="<?php  echo $row_color['name']; ?>" id="color_<?php echo $row_color['id'];  ?>" name="color_<?php echo $row_color['id'];  ?>" />  <span onclick="save_color(<?php echo $row_color['id'];  ?>);">Сохранить</span>  <span onclick="delete_color(<?php echo $row_color['id'];  ?>);">Удалить</span><br><br>

<?php
}
?>


</div>	
	



<br>
<br>	
<h3 class="head_unit">Управление размерами</h3><br><br>



<div class="unit1 unit_color" style="height:auto;">

<span onclick="add_size();">Добавить размер</span><br><br>

<?php
$rs_color  = $mysqli->query('SELECT * FROM  `size`');
while ($row_color = $rs_color->fetch_assoc()){
?>

<input type="text" style="position:static;" value="<?php  echo $row_color['name']; ?>" id="size_<?php echo $row_color['id'];  ?>" name="size_<?php echo $row_color['id'];  ?>" />  <span onclick="save_size(<?php echo $row_color['id'];  ?>);">Сохранить</span>  <span onclick="delete_size(<?php echo $row_color['id'];  ?>);">Удалить</span><br><br>

<?php
}
?>


</div>	
	


<?php
	
echo'</div>';
	
	
?>	

	
	
<?php	
	
	
}

}







if($a=='foto') {
echo'<div id="zag">Жалобы</div><div class="content">';
echo'<form name="all2" onsubmit="return false;">
<table cellpadding="0" cellspacing="0" width="100%">
<tr class="news-table-zag">
<td width="30px" align=right>ID</td>
<td>Пользователь</td>
<td>Дата</td>
<td>Фотография</td>
<td>Текст</td>
<td class="last" width="70px"><center>Дейст.</center>
</td>
</tr>';

$el=10;$name='za';$osn='index.php?a=foto';$kol_page=pagination($name,$el);$p=addslashes(strip_tags(trim($_GET['page'])));if(!isset($p)){
$p = 1;}else{if(!preg_match("/^[0-9]+$/",$p) or $p<'1') {$p=1;} else {if ($p>$kol_page){$p=$kol_page;}}}$start = ($p-1)*$el;

if ($rs1  = $mysqli->query("SELECT * FROM `za` left join users on id_us=id order by `date_z` desc LIMIT ".$start.", ".$el)) {
$i=1;
while($row = $rs1->fetch_assoc()){
$fffergfft78=$row['name'];
echo'<tr class="news-table-content news-table href '.($i % 2 ? 'zebra' :'').'"    >
<td align=right>'.$row['id_z'].'</td>
<td>'.$row['login'].'<br/>'.$row['email'].'<br/>'.$row['number'].'</td>';

echo'
<td>'.date("d.m.Y",$row['date_z']).'</td><div id="res17812"></div>';

$val2=str_replace('img_m/', 'img_s/',$row['put']);
$a_o=explode("/",$row['put']);
$a_o=$a_o[1];
//$rs12  = $mysqli->query("SELECT parent,url,put FROM `url8` left join news on parent=news.id where url8.`id`='$a_o' limit 1");
//echo "SELECT parent,url,put FROM `url8` left join news on parent=news.id where url8.`id`='$a_o' limit 1";
//$vkit12 = $rs12->fetch_row();
//$parr=$vkit12[0];
//$urll=$vkit12[1];
//$put=$vkit12[2];
echo'<td><span style="float:left;"><a href="/'.$row['put'].'" target="_blank"><img src="/'.$val2.'" height="100px"/></a></span><span style="float:left;padding-left:10px;">
'.$val2.'<br/>';

echo'</span><div style="clear:both;"></div></td>';
echo'
<td>'.$row['text_z'].'</td>
<td class="last"><center>
<span id="loader'.$row['put'].'"><a href="javascript:void(0)" title="Удалить фото" style="font-size:10px;" onclick="delete_za(\''.$row['put'].'\')">Удалить жалобу и фото</a></span><br/><br/>
<span id="loader1'.$row['put'].'">
<a href="javascript:void(0)" style="font-size:10px;" onclick="delete_zab(\''.$row['put'].'\')">Удалить только жалобу</a>
</span>
<center></td>
</tr>';
$i++;
}}
echo'</table>
<div style="text-align:left;padding-top:50px;">
<table cellpadding="0" cellspacing="0" width="100%"><tr><td align=center>';

GetNav($p,$kol_page,$osn);

echo'<div id="res17812"></div></td></tr></table>
</div>
</form>';

}

include("tpl/footter.php");
?>


<?php
//убрать дублирующиеся категгории который вложены друг в друга


$rs1 = $mysqli->query("SELECT * FROM `categories_names`");
while ($row1 = mysqli_fetch_assoc($rs1)){
	if($row1['parent']==$row1['child']){
		$parent_id=$row1['parent_id'];
		$child_id=$row1['child_id'];
		?>
        
		
		
        <?php
		//поиск корневой категори с тем же именем  AND parent_id=0
		$rs2 = $mysqli->query("SELECT * FROM `categories_names` WHERE child='".$row1['parent']."' AND parent_id=0");
		while ($row2 = mysqli_fetch_assoc($rs2)){
			$child_root_id=$row2['child_id'];
			?>
			<?php		
        }
		?>
		
		
		
        <?php
		//$child_root_id - идентификатор корневой категории
		//$child_id - идентификатор дочерней категории
		//все товары, которые привязаны к дочерней категории, привязать к корневой
		//затем убрать дочернюю категорию
		
		$rs_upd = $mysqli->query("UPDATE `tovar` SET category='".$child_root_id."' WHERE category='".$child_id."' ");
		if ($rs_upd===false) {
			printf("Ошибка #25: %s\n", $mysqli->error);
		}
		
		
		$rs_del = $mysqli->query("DELETE FROM `category` WHERE id='".$child_id."' ");
		if ($rs_del===false) {
			printf("Ошибка #26: %s\n", $mysqli->error);
		}
		
		
		
		$rs_del = $mysqli->query("DELETE FROM `categories_names` WHERE parent='".$row1['parent']."' AND child='".$row1['child']."' ");
		if ($rs_del===false) {
			printf("Ошибка #27: %s\n", $mysqli->error);
		}
		
		
		
		
	}
	
	
}



?>