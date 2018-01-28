<?php 


ini_set('display_errors',1);
error_reporting(E_ALL);


header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=../login.php");
};


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//скрипт осуществляет удаление аудиофайла из папки mp3 в случае, если этот файл не 
//используется (т.е. если в базе не найдено ни одной ссылки на этот файл)
// запускаться может любым пользователем. 
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////




$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);
if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}
	mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	
					mysqli_select_db($dbh, DB_BASE);

$dir = opendir('../mp3');
$count = 0;
while($file = readdir($dir)){
$rash=substr(strrchr($file, '.'), 1);//получение расширения файла 
$log=0;
if(($rash=="mp3")||($rash=="MP3")){  $log=1; };
    if($file == '.' || $file == '..' || is_dir('../mp3/' . $file)||($log==0)){
        continue;
    }
	
	
	
	//echo"".$file."</br>";
	///просмотр всех таблиц в базе и проверка: существует ли строка с именем файла в таблице
	$log_file=0;//если = 0, то файл нигде не используется, и его можно удалить
	//если = 1, то файд используется.
	
	//получение списка всех таблиц в базе.
	$t_list=mysqli_query($dbh,'SHOW TABLES');

 
	while($row = mysqli_fetch_array($t_list)) {
		//echo"".$row[0]."</br></br>";//таблица
		
		if($row[0]=='news'){ //копилка
			$query2 = "SELECT * FROM news ORDER BY id ";
			$res2=mysqli_query($dbh, $query2);
			while($row2=mysqli_fetch_array($res2)){
			 
			// echo"".$row2['text']."-</br>";
			
			 //проверка, входит ли строка $file в строку $row2['text'];
			 $pos = strpos($row2['text'], $file);
			 
			 if ($pos === false) {
				
				} else {
				// echo"===============Найдено совпадение================</br>";
				 $log_file=1;
				}
			
			}
		};//копилка
		
		
		//разбиение строки на части , разделитель - _
		$mas_name_table=explode("_",$row[0]);
		if(($mas_name_table[0]=="buffer")){//буфер найден
		$query3 = "SELECT * FROM ".$row[0]." ORDER BY id ";
		$res3=mysqli_query($dbh, $query3);
			while($row3=mysqli_fetch_array($res3)){
			//echo"".$row3['text']."=</br>";
			 //проверка, входит ли строка $file в строку $row3['text'];
			 $pos = strpos($row3['text'], $file);
			 
			 if ($pos === false) {
				
				} else {
				// echo"===============Найдено совпадение================</br>";
				  $log_file=1;
				}
			}
		
		
		}//буфер найден
			
			
	}//конец цикла
	  

	
    
	if($log_file==0){//удаление файла. имя файла - $file
	
	
	if (unlink('../mp3/'.$file.'')) { } 
	else {  }
	
	}//удаление файла
	
	
	$count++;
}
//echo 'Количество файлов: ' . $count."</br>";







 
 ?>