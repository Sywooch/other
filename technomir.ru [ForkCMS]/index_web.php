<?php
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
session_start();

if((!isset($_SESSION["price_user"]))||($_SESSION["price_user"]=="")||($_SESSION["price_user"]==NULL))
{
echo'
<script type="text/javascript">
window.location.href="/admin/login.php";
</script>
';
exit;
}

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель администрирования</title>
<link rel="stylesheet" href="/css/style_price.css" />
</head>

<body style="margin:0; padding:0; border:0;">

<!--head-->
<div class="head_price" align="center">

<div id="logo" style="display: block;">
<a href="/" title="Мир технологий - мир ваших идей"><span><img src="/images/technomir.png"></span></a>
</div>

</div>
<!--head-->

<div class="block_price_admin" align="center">

<div align="left" id="price-list">
<!------------------------------------------------->
<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Невозможно соединиться с MySQL сервером!");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");  
mysql_select_db(DB_BASE)or die("Невозможно подключиться к базе!");
mysql_query("SET NAMES utf8");
$query="SELECT * FROM price_content ORDER BY number ASC";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

while($row=mysql_fetch_array($res)){

$pos = strpos($row["text"], "<input");
	if ($pos === false) {//заголовок
		echo '<div style="padding:3px; border:1px #269acd solid;">'. $row["text"] .'<input type="button" value="Изменить заголовок" 
		onclick=\'edit_h1("'.$row['number'].'");\'/>
		<input type="button" value="Выше" onclick=\'move_up("'.$row['number'].'");\'/>
		<input type="button" value="Ниже" onclick=\'move_down("'.$row['number'].'");\'/>
		<input type="button" value="Удалить" onclick=\'delete_1("'.$row['number'].'");\'/>
		</div>';
	}else{//поле с чебоксом
		echo '<div style="padding:3px; border:1px #269acd solid;">'. $row["text"] .'<input type="button" value="Изменить надпись" 
		onclick=\'edit_p("'.$row['number'].'");\'/>
		<input type="button" value="Изменить цену" onclick=\'edit_span("'.$row['number'].'");\' />
		<input type="button" value="Выше" onclick=\'move_up("'.$row['number'].'");\'/>
		<input type="button" value="Ниже" onclick=\'move_down("'.$row['number'].'");\'/>
		<input type="button" value="Удалить" onclick=\'delete_1("'.$row['number'].'");\'/>
		</div>';
	}



}

?>

</div>

<div class="insert_buttons">
<input type="button" style="width:200px; height:50px;" value="Добавить заголовок" onclick="insert_h1();"/>
<input type="button" style="width:200px; height:50px;" value="Добавить поле" onclick="insert_p_span();"/>

</div>



</div>
<script type="text/javascript">
function delete_1(n){


		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_delete.php",  
                    data: "number="+(n),

                    success: function(html){ 
						
						var price_list=$("#price-list").html();
						$("#price-list").html(html);
						
                    }  
         });


}

///////////////////////////////////////////////////
function move_down(n){

		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_move_down.php",  
                    data: "number="+(n),

                    success: function(html){ 
						
						var price_list=$("#price-list").html();
						$("#price-list").html(html);
                    }  
         });


}

/////////////////////////////////////////////////////
function move_up(n){

		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_move_up.php",  
                    data: "number="+(n),

                    success: function(html){ 
						
						var price_list=$("#price-list").html();
						$("#price-list").html(html);
                    }  
         });

}

////////////////////////////////////////////////////
function insert_p_span(){
var new_text_head=prompt('Введите наименование поля:', "");
if(new_text_head==''){ alert("Ошибка! Вы ввели пустое наименование поля."); };


while(true){
	var new_text_price=prompt('Введите цену:', "");
	var pattern=/^0*[1-9]\d*$/;
	if (pattern.test(new_text_price)){
	break;
	}
	else{
	alert('Ошибка! В качестве цены нужно ввести число.');
	}
	
}

if(new_text_price==''){ alert("Ошибка! Вы ввели пустое значение цены."); };

if((new_text_head!='')&&(new_text_head!=null)&&(new_text_price!='')&&(new_text_price!=null)){


		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_insert_p_span.php",  
                    data: "new_text_head="+(new_text_head)+"&new_text_price="+(new_text_price),

                    success: function(html){ 
						
						arr = html.split('{total}');
						//arr[0] - созданное поле
						//arr[1] - номер созданного поля
						
						arr[1]=arr[1].replace(/^\s+|\s+$/g, ''); 
										
						var price_list=$("#price-list").html();
						var edit_button="<input type=\"button\" value=\"Изменить надпись\" onclick='edit_p(\""+arr[1]+"\");'>";
						var edit_button2="<input type=\"button\" value=\"Изменить цену\" onclick='edit_span(\""+arr[1]+"\");'>";
						var button_up="<input type=\"button\" value=\"Выше\" onclick='move_up(\""+arr[1]+"\");'>";
						var button_down="<input type=\"button\" value=\"Ниже\" onclick='move_down(\""+arr[1]+"\");'>";
						var button_delete="<input type=\"button\" value=\"Удалить\" onclick='delete_1(\""+arr[1]+"\");'>";
						
						
	price_list=price_list+"<div style=\"padding:3px; border:1px #269acd solid;\">"+arr[0]+edit_button+edit_button2+button_up+button_down+button_delete+"</div>";
						
						$("#price-list").html(price_list);
						
						//alert(html);
                    }  
         });

}

}

/////////////////////////////////////////////////////////////////////
function insert_h1(){
var new_text=prompt('Введите заголовок:', "");
if(new_text==''){ alert("Ошибка! Вы ввели пустой заголовок."); };

if((new_text!='')&&(new_text!=null)){


		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_insert_h1.php",  
                    data: "new_text="+(new_text),
	  	 		
                    success: function(html){ 
						
						arr = html.split('{total}');
						
						arr[1]=arr[1].replace(/^\s+|\s+$/g, ''); 
				
						
						var price_list=$("#price-list").html();
						var edit_button="<input type=\"button\" value=\"Изменить заголовок\" onclick='edit_h1(\""+arr[1]+"\");'>";
						var button_up="<input type=\"button\" value=\"Выше\" onclick='move_up(\""+arr[1]+"\");'>";
						var button_down="<input type=\"button\" value=\"Ниже\" onclick='move_down(\""+arr[1]+"\");'>";
						var button_delete="<input type=\"button\" value=\"Удалить\" onclick='delete_1(\""+arr[1]+"\");'>";
						
	price_list=price_list+"<div style=\"padding:3px; border:1px #269acd solid;\">"+arr[0]+edit_button+button_up+button_down+button_delete+"</div>";
						
						$("#price-list").html(price_list);
						//alert(html);
                    }  
         });


}


}
////////////////////////////////////////////////////////////////////
function edit_h1(n){

var new_text=prompt('Введите новый заголовок:', "");
if(new_text==''){ alert("Ошибка! Вы ввели пустой заголовок."); };

if((new_text!='')&&(new_text!=null)){


		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_edit_h1.php",  
                    data: "n="+(n)+"&new_text="+(new_text),
	  	 		
                    success: function(html){ 

						$("#h1_"+n).html(html);
                       
                    }  
         });


}

}


function edit_p(n){

var new_text=prompt('Введите новую надпись:', "");
if(new_text==''){ alert("Ошибка! Вы ввели пустую надпись."); };

if((new_text!='')&&(new_text!=null)){

		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_edit_p.php",  
					data: "n="+(n)+"&new_text="+(new_text),
	  	 		
                    success: function(html){  
                        $("#p_"+n).html(html+":");
                    }  
         });

}

}



function edit_span(n){

var new_text=prompt('Введите новую сумму:', "");
if(new_text==''){ alert("Ошибка! Вы ввели пустой заголовок."); };

while(true){
	var new_text=prompt('Введите цену:', "");
	var pattern=/^0*[1-9]\d*$/;
	if (pattern.test(new_text)){
	break;
	}
	else{
	alert('Ошибка! В качестве цены нужно ввести число.');
	}
	
}


if((new_text!='')&&(new_text!=null)){

		$.ajax({  
                    type: "POST",  
                    url: "action/ajax_edit_span.php",  
					data: "n="+(n)+"&new_text="+(new_text),
	  	 		
                    success: function(html){  
                       $("#span_"+n).html(html);
					   
                    }  
         });

}

}

</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>
</html>