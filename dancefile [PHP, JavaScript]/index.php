<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
    <link rel="stylesheet" type="text/css" href="/style/style.css">
	
    
    
    <script src="/js/jquery-1.8.2.js"></script>
    <script src="/js/jquery-ui-1.9.1.custom.js"></script>
    <script src="/js/jquery.json-2.3.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/date_extension.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.9.1.custom.css">
        
    <script src="/js/registration.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/registration.css">
    
 
 
 	<script type="text/javascript">
    
    /* 
        Функция DateDiff рассчитывает разницу между датами.
    Принимает даты или в виде строк (в формате гггг / мм / дд,
    допускается указание времени в стандартном формате) или
    в виде объекта Date. Если одна из дат (или обе) будут пропущены,
    то их значением будет new Date() (текущая дата).
        Возвращает строку, с подробным расчётом разницы, включая
    года, месяцы, дни, часы, минуты и секунды. Расчёт с погрешностью.
    Исходим из того, что в каждом месяце в среднем 30.5 дня.
        Если передать функции третьим аргументом true, то функция
    вернёт объект, содержащий числовые значения разницы. Формат
    объекта: {
        years: 0,
        months: 0,
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    }
*/
 
function dateDiff (dateFrom, dateTo, inObjectPlease) {
    // Нормализуем данные
    dateFrom = dateFrom || new Date(); dateTo = dateTo || new Date ();
    dateFrom = Date.parse(new Date(dateFrom)); dateTo = Date.parse (new Date(dateTo));
    // Объявим всё, что нужно для работы.
    var secDiff = (dateTo - dateFrom) / 1000, x;
    var subZero = false, dividers = [60, 60, 24, 30.5, 12];
    var result = {
        years: 0,
        months: 0,
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    }
    /*
            Если разница отрицательна, запомним это и сделаем её положительной,
        для упрощения расчётов.
    */
    if (secDiff < 0) {
        subZero = true;
        secDiff *= -1;
    }
    /*
            Функция arrayMultiply возвращает произведение элементов 
            переданного ей массива.
    */
    function arrayMultiply (arr) {
        var result = 1, x;
        for (x = 0; x < arr.length; x++) {
            result *= arr[x];
        }
        return result;
    }
    /*
            Функция pickWord возвращает слово в форме, подходящей для
        переданной функции цифре. Принимает цифру и три формы слова —
        для значения 1, для значения 2 и для значения 5.
    */
    function pickWord(num, txt1, txt2_4, txt5) {
        var symb;
        num = parseInt(num);
        if (isNaN(num)) {
            return txt1;
        }
        num = String(num);
        if (num.length > 1) {
            symb = num.substr(-2);
            symb = +symb;
            if (symb >= 10 && symb <= 20) {
                return txt5;
            }
        }
        symb = num.substr(-1);
        symb = +symb;
        if (symb === 1) {
            return txt1;
        }
        if (symb >= 2 && symb <= 4) {
            return txt2_4;
        }
        return txt5;
    }
    /*
            Вспомогательная функция next уменьшает количество делителей
        и разницу в секундах на необходимые значения.
    */
    function next(success, subtrahend) {
        if (success) {
            secDiff -=  subtrahend;
        }
        if (dividers.length > 0) {
            dividers.length -= 1;
        }
    }
    // Присваиваем каждому полю объекта result соответствующее значение.
    for (x in result) {
        result[x] = (secDiff - secDiff % arrayMultiply(dividers)) / arrayMultiply(dividers);
        next(result[x], (secDiff - secDiff % arrayMultiply(dividers)));
        if (subZero) {
            result[x] *= -1;
        }
    }
    if (inObjectPlease) {
        return result
    }
    // формируем строку.
    //result.result = result.years ? result.years + pickWord(result.years, " год ", " года ", " лет "): "";
   	result.result = result.years ? result.years + pickWord(result.years, "", "", ""): "";
   

 	//result.result += result.months ? result.months + pickWord(result.months, " месяц ", " месяца ", " месяцев "): "";
    //result.result += result.days ? result.days + pickWord(result.days, " день ", " дня ", " дней "): "";
    //result.result += result.hours ? result.hours + pickWord(result.hours, " час ", " часа ", " часов "): "";
    //result.result += result.minutes ? result.minutes + pickWord(result.minutes, " минута ", " минуты ", " минут "): "";
    //result.result += result.seconds ? result.seconds + pickWord(result.seconds, " секунда ", " секунды ", " секунд "): "";
    return result.result;
}
    
    
    </script>
 
 
    
    
    </head>
    <body>


<?php
include('db.php'); 

?>





<?php
if( (!isset($_GET['page'])) || ($_GET['page']=='reg') ){

?>


<!--<a class="link1" href="/index.php?page=turnir">Управление группами, участвующими в турнирах</a>-->
<a class="link1" href="/index.php?page=reg-group">Управление разрешением регистрации в группе</a>

<a class="link3" href="/index.php?page=classes" style="display:none;">Управление классами участников</a>
<a class="link4" href="/index.php?page=categorii">Управление категориями</a>

<a class="link5" href="/index.php?page=categorii-dancer" style="display:none;">Управление принадлежностью участников к категории</a>
<a class="link6" href="/index.php?page=dynamic-turnir">Управление турнирами</a>

<a class="link7" href="/index.php?page=participants">Управление зарегистрированными участниками</a>
<a class="link8" href="/index.php?page=test1">Список существующих пар [для тестирования]</a>

	<h2 class="head1">Регистрация на турнир</h2>
    <div class="reg_ok"></div>



	
    
    <div id="form">
            <div>
            	<h6>Отделение</h6>
                <select id="curgroup_otd" class="tmp_2" name="curgroup_otd">
					<?php
					$rs=$mysqli->query('SELECT * FROM `active_turnir` ORDER BY date');
					while ($row = $rs->fetch_assoc()){
					?>
						<option value="<?php echo $row['id']; ?>"><?php 
						
						//echo $row['name'];  
						//$id_turnir1=$row['id_turnir'];
						//$rs2=$mysqli->query("SELECT * FROM `info_turnir` WHERE id='".$id_turnir1."'");
						//while ($row2 = $rs2->fetch_assoc()){
							echo $row['name_turnir']."  ::  ".$row['date']."  ::  Отделение ".$row['id_otd'];
						//	break;
						//}
						
						?></option>                    
                    <?php
					}
					?>                    
                        
                </select>
            
            	<div style="width:100%; height:6px; "></div>
                <h6>Текущая группа</h6>
                <select id="curgroup" name="curgroup">
					<?php
					$rs=$mysqli->query('SELECT * FROM `active_categorii`');
					while ($row = $rs->fetch_assoc()){
					?>
                    
                    <?php
					//проверка, разрешена ли группа для выбранного отделения
					
					//
					$rs_otd=$mysqli->query('SELECT * FROM `active_turnir` ORDER BY date LIMIT 1');
					while ($row_otd = $rs_otd->fetch_assoc()){
						$otd1_groups=$row_otd['groups'];//список групп для выбранного отделения
							
					}
					
					$mas_otd1=explode(";",$otd1_groups);
					
					$log1=0;
					
					foreach($mas_otd1 as $value){
						if($value==$row['id']){ $log1=1; break; }
					}
					
					
					?>
                    
                    
                    <?php
					if($log1==1){
					?>
                    
                    <?php
					//проверка, не закрыта ли регистрация в группу $row['id']
					
					$rs_access = $mysqli->query("SELECT * FROM `active_reg_access_closed` WHERE id_group='".$row['id']."'");
					if(mysqli_num_rows($rs_access)){
					//регистрация для группы закрыта	
					
					}else{
					//регистрация для группы открыта
					
					?>
                    
						<option value="<?php echo $row['id']; ?>"><?php echo $row['name'];  ?></option>                    
                    
					
                    <?php
					
					}
					
					?>
					
					<?php
					}
					?>
					
					
					
					<?php
					}
					?>                    
                        
                </select>
                
                <span class="groups_2">Зарегистрироваться так-же в: 
                
                	<div class="dynamic">
                
                	<?php
					$rs=$mysqli->query('SELECT * FROM `active_categorii`');
					while ($row = $rs->fetch_assoc()){
					?>
                    
                    <?php
					//проверка, разрешена ли группа для выбранного отделения
					
					//
					$rs_otd=$mysqli->query('SELECT * FROM `active_turnir` ORDER BY date LIMIT 1');
					while ($row_otd = $rs_otd->fetch_assoc()){
						$otd1_groups=$row_otd['groups'];//список групп для выбранного отделения
							
					}
					
					$mas_otd1=explode(";",$otd1_groups);
					
					$log1=0;
					
					foreach($mas_otd1 as $value){
						if($value==$row['id']){ $log1=1; break; }
					}
					
					
					?>
                    
                    
                    <?php
					if($log1==1){
					?>
                    
                    <?php
					//проверка, не закрыта ли регистрация в группу $row['id']
					
					$rs_access = $mysqli->query("SELECT * FROM `active_reg_access_closed` WHERE id_group='".$row['id']."'");
					if(mysqli_num_rows($rs_access)){
					//регистрация для группы закрыта	
					
					}else{
					//регистрация для группы открыта
					
					?>
                    
					                 
                    	<span class="ch_<?php echo $row['id']; ?>"><input type="checkbox" name="groups_2[]"  value="<?php echo $row['id']; ?>"/> <?php echo $row['name'];  ?></span>
					
                    <?php
					
					}
					
					?>
					
					<?php
					}
					?>
					
					
					
					<?php
					}
					?>   
                    
                                     
                    </div> 
                
                </span>
                
                
                
                
                <div style="width:100%; height:6px; "></div>
                
                <div class="type_par">
                <h6>Тип участия</h6>
                
                
                <select id="curgroup_type" name="curgroup_type">
                	
                    <option value="para">пара</option>
                    <option value="solo">соло</option>
                </select>
                
                <select id="curgroup_gender" name="curgroup_gender" style="display:none;">
                	
                    <option value="m">муж.</option>
                    <option value="w">жен.</option>
                </select>
                
                </div>
                
            </div>
            
                <input type="hidden" id="grprog587" name="grprog587" value="110">
            
                <input type="hidden" id="grprog588" name="grprog588" value="110">
            
                <input type="hidden" id="grprog589" name="grprog589" value="110">
            
                <input type="hidden" id="grprog590" name="grprog590" value="110">
            
                <input type="hidden" id="grprog591" name="grprog591" value="110">
            
                <input type="hidden" id="grprog592" name="grprog592" value="110">
            
                <input type="hidden" id="grprog597" name="grprog597" value="110">
            
                <input type="hidden" id="grprog596" name="grprog596" value="110">
            
                <input type="hidden" id="grprog595" name="grprog595" value="110">
            
                <input type="hidden" id="grprog594" name="grprog594" value="110">
            
                <input type="hidden" id="grprog593" name="grprog593" value="110">
            
                <input type="hidden" id="grprog598" name="grprog598" value="110">
            
            <h6>Регистрационная форма</h6>
            <button id="newcuple">Новая пара</button>
            <form action="" method="POST" id="regform"><div style="display:none"><input type="hidden" name="csrfmiddlewaretoken" value="cfdhzi1jrRYz3rKcdZ7EmLNcvibfnFT6"></div>
                <table>
                    <tbody><tr class="row1">
                        <td rowspan="3">
                            <table>
                                <tbody><tr class="row2">
                                    <th>№№</th>
                                </tr>
                                <tr class="row1">
                                    <td><input type="text" name="number" id="number" class="error"><span id="enumber" class="errortext">Неправильный номер</span></td>
                                </tr>
                            </tbody></table>
                            <table id="editinfo">
                                <tbody><tr>
                                    <th>Редактирование</th>
                                </tr>
                                <tr>
                                    <td><input id="cupleid" type="text" value="0" disabled="disabled" style="width:50px;"> <a class="clear" title="Выйти из режима редактирования"></a></td>
                                </tr>
                            </tbody></table>
                        </td>
                        <td>
                            <table>
                                <tbody><tr class="row2">
                                    <th>&nbsp;</th>
                                    <th>Фамилия</th>
                                    <th>Имя</th>
                                    <th>Д.Р.</th>
                                    <th>K<sup>St</sup></th>
                                    <th><!--Р<sup>St</sup>--></th>
                                    <th>K<sup>La</sup></th>
                                    <th><!--Р<sup>La</sup>--></th>
                                    <th>K<sup>Mn</sup></th>
                                    <th><!--Р<sup>Mn</sup>--></th>
                                </tr>
                                <tr class="row1 solo_hidden2">
                                    <td><a id="dancer1" title="0">Партнер</a></td>
                                    <td style="position:relative;"><input type="hidden" value="" name="mfam_id" id="mfam_id" /><input type="text" name="mfam" id="mfam" class="ui-autocomplete-input error" autocomplete="off">
                                    	<select class="list_mfam" size="10" style="position:absolute;left: 33px;top: 24px; width:auto; display:none; z-index:99999999;">
                                        	<option value=""></option>
                                            
                                        </select>
                                    
                                    
                                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="emfam" class="errortext">Заполнить!</span></td>
                                    <td><input type="text" name="mnam" id="mnam" class="ui-autocomplete-input error" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="emnam" class="errortext">Заполнить!</span></td>
                                    <td><input type="date" name="mbir" id="mbir" class="calendar hasDatepicker"><span id="embir"></span></td>
                                    <td><select id="mkst" name="mkst">﻿
<option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="emkst"></span></td>
                                    <td><!--<select id="mrst" name="mrst">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="emrst">--></td>
                                    <td><select id="mkla" name="mkla">﻿
 <option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="emkla"></span></td>
                                    <td><!--<select id="mrla" name="mrla">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="emrla">--></td>
                                    <td><select id="mkmn" name="mkmn">﻿
<option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="emkmn"></span></td>
                                    <td><!--<select id="mrmn" name="mrmn">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="emrmn">--></td>
                                </tr>
                                <tr class="row2 solo_hidden">
                                    <td><a id="dancer2" title="">Партнерша</a></td>
                                    <td style="position:relative;"><input type="hidden" value="" name="ffam_id" id="ffam_id" /><input type="text" name="ffam" id="ffam" class="ui-autocomplete-input error" autocomplete="off">
                                    <select class="list_ffam" size="10" style="position:absolute;left: 33px;top: 24px; width:auto; display:none; z-index:99999999;">
                                        	<option value=""></option>
                                            
                                        </select>
                                    
                                    
                                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="effam" class="errortext">Заполнить!</span></td>
                                    <td><input type="text" name="fnam" id="fnam" class="ui-autocomplete-input error" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="efnam" class="errortext">Заполнить!</span></td>
                                    <td><input type="date" name="fbir" id="fbir" class="calendar hasDatepicker"><span id="efbir"></span></td>
                                    <td><select id="fkst" name="fkst">﻿
<option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="efkst"></span></td>
                                    <td><!--<select id="frst" name="frst">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="efrst">--></td>
                                    <td><select id="fkla" name="fkla">﻿
 <option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="efkla"></span></td>
                                    <td><!--<select id="frla" name="frla">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="efrla">--></td>
                                    <td><select id="fkmn" name="fkmn">﻿
<option value="-">-</option>

	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>    
</select><span id="efkmn"></span></td>
                                    <td><!--<select id="frmn" name="frmn">﻿
    <option value="9">-</option>

    <option value="1">3ю</option>

    <option value="2">2ю</option>

    <option value="3">3</option>

    <option value="4">1ю</option>

    <option value="5">2</option>

    <option value="6">1</option>

    <option value="7">КМ</option>

    <option value="8">МС</option>
</select><span id="efrmn">--></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr class="row2">
                        <td>
                            <table>
                                <tbody><tr class="row1">
                                    <th>&nbsp;</th>
                                    <th>Название</th>
                                    <th>Город</th>
                                    <th>Страна</th>
                                </tr>
                                <tr class="row2 solo_hidden2">
                                    <td>СТК1</td>
                                    <td style="position:relative;"><a id="idstk1" title=""></a><input type="text" name="stk1" id="stk1" class="ui-autocomplete-input error" autocomplete="off">
                     <select class="list_stk1" size="10" style="position:absolute;left: 121px;top: 24px; width:200px; display:none; z-index:99999999;">
                                        	<option value=""></option>
                                            
                                        </select>               
                                    
                                    
                                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible">No search results.</span><span id="estk1" class="errortext">Заполнить!</span></td>
                                    <td><a id="idcity1" title=""></a><input type="text" name="city1" id="city1" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecity1"></span></td>
                                    <td><a id="idcountry1" title=""></a><input type="text" name="country1" id="country1" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecountry1"></span></td>
                                </tr>
                                <tr class="row1 solo_hidden">
                                    <td>СТК2</td>
                                    <td style="position:relative;"><a id="idstk2" title=""></a><input type="text" name="stk2" id="stk2" class="ui-autocomplete-input" autocomplete="off">
                                   <select class="list_stk2" size="10" style="position:absolute;left: 121px;top: 24px; width:200px; display:none; z-index:99999999;">
                                        	<option value=""></option>
                                            
                                        </select>
                                    
                                    
                                    
                                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="estk2"></span></td>
                                    <td><a id="idcity2" title=""></a><input type="text" name="city2" id="city2" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecity2"></span></td>
                                    <td><a id="idcountry2" title=""></a><input type="text" name="country2" id="country2" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecountry2"></span></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr class="row1">
                        <td>
                            <table>
                                <tbody><tr class="row2">
                                    <th>&nbsp;</th>
                                    <th colspan="3">Тренеры</th>
                                </tr>
                                <tr class="row1">
                                    <td>St:</td>
                                    <td>1.<a id="idcoach1" title=""></a><input type="text" name="coach1" id="coach1" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach1"></span></td>
                                    <td>2.<a id="idcoach2" title=""></a><input type="text" name="coach2" id="coach2" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach2"></span></td>
                                    <td>3.<a id="idcoach3" title=""></a><input type="text" name="coach3" id="coach3" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach3"></span></td>
                                </tr>
                                <tr class="row2">
                                    <td>La:</td>
                                    <td>4.<a id="idcoach4" title=""></a><input type="text" name="coach4" id="coach4" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach4"></span></td>
                                    <td>5.<a id="idcoach5" title=""></a><input type="text" name="coach5" id="coach5" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach5"></span></td>
                                    <td>6.<a id="idcoach6" title=""></a><input type="text" name="coach6" id="coach6" class="ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span id="ecoach6"></span></td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    <tr class="row1">
                        <td colspan="2">
                            <span id="confirmb" style="display: none;"><input type="checkbox" value="1" id="confirm" name="confirm">Все равно регистрировать пару</span> <span id="etotal"></span>
                        </td>
                    </tr>
                   <!-- <tr class="row2">
                        <td colspan="2" style="text-align:right;">
                            <span id="predvb" class=""><input type="checkbox" value="1" id="predv" name="predv">Предварительная регистрация</span>
                        </td>
                    </tr>-->
                   <!-- <tr class="row1">
                        <td colspan="2">
                            <button name="st" id="st" style="display: inline-block;">St</button>
                            <button name="la" id="la" style="display: inline-block;">La</button>
                            <button name="stla" id="stla" style="display: inline-block;">St + La</button>
                            <button name="mn" id="mn" style="display: none;">Mn</button>
                        </td>
                    </tr>-->
                </tbody></table>

            </form>
            <button id="insert">Зарегистрироваться</button>
            
            <div class="warning_registration"></div>
            <button id="warning_button">Всё равно зарегистрироваться</button>
        </div>
    

<h2 class="head1">Список зарегистрированных участников</h2>
<div class="list_participants" style="text-align:left;">






</div>



<script type="text/javascript">

jQuery(window).on('ready',  function() {
var group=$("#curgroup").val();

//удалить лишний чебокс
//$('.groups_2 > div > span').fadeIn(1);

$('.groups_2 .ch_'+group).css('display','none');
$('.groups_2 .ch_'+group).fadeOut(1);
	

});
</script>


<!----- list_participants --->
<script type="text/javascript">

jQuery(window).on('load',  function() {
	
	
	
	
	var otdel=$("#curgroup_otd :selected").val();//идентификатор отделения
	var group=$("#curgroup").val();//
group=String(group);


//получить список зарегистрированых участников


params = { otdel:otdel,group:group }
	$.ajax({
		type: "POST",
		url: "ajax/registration_list.php",
		data: params,
		async: false,
		success: function(data){
			//alert(data+"#2");
			
			if(data=="-"){
				$('.list_participants').html("");
			}else{
			
			var data1 = JSON.parse ( data );
			
			var html2="";
		
			for (var i in data1) {
				
			
   				
				var html=data1[i];
				
				var html_m=html.split(":");
				
				html2=html2+'<div class="item"><div class="contaner"><span class="nimber">Номер: '+html_m[0]+'</span></div><div class="contaner"><span class="surname_m">'+html_m[1]+'</span> <span class="name_m">'+html_m[2]+'</span> <span class="date_m">'+html_m[3]+'</span> <span class="kst_m">Kst: '+html_m[4]+'</span> <span class="kla_m">Kla: '+html_m[5]+'</span> <span class="kmn_m">Kmn: '+html_m[6]+'</span> <span class="ctk1_name">'+html_m[13]+'</span> <span class="ctk1_city">'+html_m[14]+'</span> <span class="ctk1_country">'+html_m[15]+'</span></div><div class="contaner"><span class="surname_j">'+html_m[7]+'</span> <span class="name_j">'+html_m[8]+'</span> <span class="date_j">'+html_m[9]+'</span> <span class="kst_j">Kst: '+html_m[10]+'</span> <span class="kla_j">Kla: '+html_m[11]+'</span> <span class="kmn_j">Kmn: '+html_m[12]+'</span> <span class="ctk2_name">'+html_m[16]+'</span> <span class="ctk2_city">'+html_m[17]+'</span> <span class="ctk2_country">'+html_m[18]+'</span></div><div class="contaner"><span class="st1">'+html_m[19]+'</span></div><div class="contaner"><span class="st2">'+html_m[20]+'</span></div><div class="contaner"><span class="st3">'+html_m[21]+'</span></div><div class="contaner"><span class="la1">'+html_m[22]+'</span></div><div class="contaner"><span class="la2">'+html_m[23]+'</span></div><div class="contaner"><span class="la3">'+html_m[24]+'</span></div></div>';
				
				
			}
			
			
			$('.list_participants').html(html2);
			
			}
			
			
			
			
			
		}})




	
});


///////////////////////////////////////

jQuery('.groups_2').on('click', 'input', function() {





	var otdel=$("#curgroup_otd :selected").val();//идентификатор отделения
	var group=$("#curgroup").val();//идентификатор отделения
group=String(group);


var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   group=group+','+num[j];
	   
       j++;
   });
}





params = { otdel:otdel,group:group }
	$.ajax({
		type: "POST",
		url: "ajax/registration_list.php",
		data: params,
		async: false,
		success: function(data){
			//alert(data+"#3")
			
			if(data=="-"){
				$('.list_participants').html("");
			}else{
			
			var data1 = JSON.parse ( data );
			
			var html2="";
			for (var i in data1) {
				
				
   				
				var html=data1[i];
				
				var html_m=html.split(":");
				
				var html2=html2+'<div class="item"><div class="contaner"><span class="nimber">Номер: '+html_m[0]+'</span></div><div class="contaner"><span class="surname_m">'+html_m[1]+'</span> <span class="name_m">'+html_m[2]+'</span> <span class="date_m">'+html_m[3]+'</span> <span class="kst_m">Kst: '+html_m[4]+'</span> <span class="kla_m">Kla: '+html_m[5]+'</span> <span class="kmn_m">Kmn: '+html_m[6]+'</span> <span class="ctk1_name">'+html_m[13]+'</span> <span class="ctk1_city">'+html_m[14]+'</span> <span class="ctk1_country">'+html_m[15]+'</span></div><div class="contaner"><span class="surname_j">'+html_m[7]+'</span> <span class="name_j">'+html_m[8]+'</span> <span class="date_j">'+html_m[9]+'</span> <span class="kst_j">Kst: '+html_m[10]+'</span> <span class="kla_j">Kla: '+html_m[11]+'</span> <span class="kmn_j">Kmn: '+html_m[12]+'</span> <span class="ctk2_name">'+html_m[16]+'</span> <span class="ctk2_city">'+html_m[17]+'</span> <span class="ctk2_country">'+html_m[18]+'</span></div><div class="contaner"><span class="st1">'+html_m[19]+'</span></div><div class="contaner"><span class="st2">'+html_m[20]+'</span></div><div class="contaner"><span class="st3">'+html_m[21]+'</span></div><div class="contaner"><span class="la1">'+html_m[22]+'</span></div><div class="contaner"><span class="la2">'+html_m[23]+'</span></div><div class="contaner"><span class="la3">'+html_m[24]+'</span></div></div>';
				
				
			}
			
			
			$('.list_participants').html(html2);
			
			}
			
			
			
			
			
		}
		
	
		
		
		})


	




});

/*

$('.groups_2 :checkbox').change(function(){ 


	var otdel=$("#curgroup_otd :selected").val();//идентификатор отделения
	var group=$("#curgroup").val();//идентификатор отделения
group=String(group);


var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   group=group+','+num[j];
	   
       j++;
   });
}





params = { otdel:otdel,group:group }
	$.ajax({
		type: "POST",
		url: "ajax/registration_list.php",
		data: params,
		async: false,
		success: function(data){
			alert(data+"#3")
			
			if(data=="-"){
				$('.list_participants').html("");
			}else{
			
			var data1 = JSON.parse ( data );
			
			var html2="";
			for (var i in data1) {
				
				
   				
				var html=data1[i];
				
				var html_m=html.split(":");
				
				var html2=html2+'<div class="item"><div class="contaner"><span class="nimber">Номер: '+html_m[0]+'</span></div><div class="contaner"><span class="surname_m">'+html_m[1]+'</span> <span class="name_m">'+html_m[2]+'</span> <span class="date_m">'+html_m[3]+'</span> <span class="kst_m">Kst: '+html_m[4]+'</span> <span class="kla_m">Kla: '+html_m[5]+'</span> <span class="kmn_m">Kmn: '+html_m[6]+'</span> <span class="ctk1_name">'+html_m[13]+'</span> <span class="ctk1_city">'+html_m[14]+'</span> <span class="ctk1_country">'+html_m[15]+'</span></div><div class="contaner"><span class="surname_j">'+html_m[7]+'</span> <span class="name_j">'+html_m[8]+'</span> <span class="date_j">'+html_m[9]+'</span> <span class="kst_j">Kst: '+html_m[10]+'</span> <span class="kla_j">Kla: '+html_m[11]+'</span> <span class="kmn_j">Kmn: '+html_m[12]+'</span> <span class="ctk2_name">'+html_m[16]+'</span> <span class="ctk2_city">'+html_m[17]+'</span> <span class="ctk2_country">'+html_m[18]+'</span></div><div class="contaner"><span class="st1">'+html_m[19]+'</span></div><div class="contaner"><span class="st2">'+html_m[20]+'</span></div><div class="contaner"><span class="st3">'+html_m[21]+'</span></div><div class="contaner"><span class="la1">'+html_m[22]+'</span></div><div class="contaner"><span class="la2">'+html_m[23]+'</span></div><div class="contaner"><span class="la3">'+html_m[24]+'</span></div></div>';
				
				
			}
			
			
			$('.list_participants').html(html2);
			
			}
			
			
			
			
			
		}
		
	
		
		
		})


	



})

*/


///////////////////////////////////////


$("#curgroup").change(function(){



	var otdel=$("#curgroup_otd :selected").val();//идентификатор отделения
	var group=$("#curgroup").val();//идентификатор отделения
group=String(group);


var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   group=group+','+num[j];
	   
       j++;
   });
}




//получить список зарегистрированых участников
// alert(group);
$('.groups_2 > div > span').fadeIn(1);
$('.groups_2 .ch_'+group).fadeOut(1);


params = { otdel:otdel,group:group }
	$.ajax({
		type: "POST",
		url: "ajax/registration_list.php",
		data: params,
		async: false,
		success: function(data){
			//alert(data+"#4")
			
			
			
			if(data=="-"){
				$('.list_participants').html("");
			}else{
			
			var data1 = JSON.parse ( data );
			
			var html2="";
			for (var i in data1) {
				
				
   				
				var html=data1[i];
				
				var html_m=html.split(":");
				
				var html2=html2+'<div class="item"><div class="contaner"><span class="nimber">Номер: '+html_m[0]+'</span></div><div class="contaner"><span class="surname_m">'+html_m[1]+'</span> <span class="name_m">'+html_m[2]+'</span> <span class="date_m">'+html_m[3]+'</span> <span class="kst_m">Kst: '+html_m[4]+'</span> <span class="kla_m">Kla: '+html_m[5]+'</span> <span class="kmn_m">Kmn: '+html_m[6]+'</span> <span class="ctk1_name">'+html_m[13]+'</span> <span class="ctk1_city">'+html_m[14]+'</span> <span class="ctk1_country">'+html_m[15]+'</span></div><div class="contaner"><span class="surname_j">'+html_m[7]+'</span> <span class="name_j">'+html_m[8]+'</span> <span class="date_j">'+html_m[9]+'</span> <span class="kst_j">Kst: '+html_m[10]+'</span> <span class="kla_j">Kla: '+html_m[11]+'</span> <span class="kmn_j">Kmn: '+html_m[12]+'</span> <span class="ctk2_name">'+html_m[16]+'</span> <span class="ctk2_city">'+html_m[17]+'</span> <span class="ctk2_country">'+html_m[18]+'</span></div><div class="contaner"><span class="st1">'+html_m[19]+'</span></div><div class="contaner"><span class="st2">'+html_m[20]+'</span></div><div class="contaner"><span class="st3">'+html_m[21]+'</span></div><div class="contaner"><span class="la1">'+html_m[22]+'</span></div><div class="contaner"><span class="la2">'+html_m[23]+'</span></div><div class="contaner"><span class="la3">'+html_m[24]+'</span></div></div>';
				
				
			}
			
			
			$('.list_participants').html(html2);
			
			}
			
			
			
			
			
		}
		
	
		
		
		})


		
	








	
});

</script>
<!----- list_participants --->





<script type="text/javascript">



$( "#mfam" ).autocomplete({
      source: function(request, response){
        // организуем кроссдоменный запрос
		
		var term=$("#mfam").val();
		//alert(term);
		var mfam_id="";
		var ffam_id="";
		
        $.ajax({
          url: "ajax/search.php",
		  type: "POST",
		  data: {term : term},
          // обработка успешного выполнения запроса
          success: function(data){
			  var html1="";
			  var data1 = JSON.parse ( data );
			  for (i = 0; i < data1.length; i++) { 
			  
			  	///alert(data1[i]); 
				mas=data1[i].split('-!-');
			  	var id=mas[0];
				var mfam_id=id;
				var name=mas[1];
				var name2=mas[2];
				var id_w=mas[3];
				var club_1=mas[4];
				
				//alert(name);
			   html1=html1+'<option id="'+id+'" value="'+id_w+'">'+name+' | '+name2+' ('+club_1+')</option>';
			  
			  }
			  
			  //alert(html1);
			  $('.list_mfam').html(html1);
              var length1=data1.length;
			  if(length1<10){ $(".list_mfam").attr("size", length1);  }
			  if(length1==1){ $(".list_mfam").attr("size", "2"); }
			  $(".list_mfam").css("display","block");
				
				
				
				
				
				
				var id=$(".list_mfam").children(":selected").attr("id");
  				var id2=$(".list_mfam").val();
				if(id!=undefined){
	/*
   					$.ajax({
          				url: "ajax/search_auto.php",
		  				type: "POST",
		  				data: {id : id,id2 : id2},
          				// обработка успешного выполнения запроса
          				success: function(data){
			   				var data1 = JSON.parse ( data );
			   				var name=data1[0];
			   				var sname=data1[1];
			   				var date=data1[2];
			   				var club=data1[3];
			   				var city=data1[4];
							var trener=data1[5];
							var hidden=data1[24];
							
							var k1=data1[12];
							var k2=data1[13];
							var k3=data1[14];
							//alert(k1+" "+k2+" "+k3);
			   				
							var name_k1=data1[18];
			   				var name_k2=data1[19];
			   				var name_k3=data1[20];
			   				//alert(name_k1+" "+name_k2+" "+name_k3);
							if(name_k1==null){ name_k1="-"; k1="-"; }
			   				if(name_k2==null){ name_k2="-"; k2="-"; }
			   				if(name_k3==null){ name_k3="-"; k3="-"; }
			   
						
						
							//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
							$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
							//$('#mkst').html(html_k);
							
							//$('select option[value="Mazda"]').prop('selected', true);
							//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
							$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
							//$('#mkla').html(html_k);
						
							//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
							$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
							//$('#mkmn').html(html_k);
						
							var m_t=trener.split('-!-');
				
							var length1=m_t.length;
							if(length1==1){
								$('#coach1').val(m_t[0]);
						
							}
							if(length1==2){
								$('#coach1').val(m_t[0]);
								$('#coach2').val(m_t[1]);
					
							}
							if(length1==3){
								$('#coach1').val(m_t[0]);
								$('#coach2').val(m_t[1]);
								$('#coach3').val(m_t[2]);
							}
						
						
						
						
						
			   				//alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
							$('#ffam_id').val(hidden);
		  					$('#mfam').val(sname);
							$('#mnam').val(name);
							$('#mbir').val(date);
						
						
							if(club.indexOf(' | ') + 1) {
								var club_m=club.split(" | ");
								var club_id_m=data1[26].split(" | ");
								var html_club="";
								for (var i = 0; i < club_m.length; i++) {
    								html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
								}	
					
								$('.list_stk1').html(html_club);
								var length1=club_m.length;
			 					if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  					if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  					$(".list_stk1").css("display","block");
					
					
								//alert(club_m);
							}else{
						
								$('#stk1').val(club);
								$('#city1').val(city);
						
							}
						
						
							//$('#mkst').val(date);
							//$('#mkla').val(date);
							//$('#mkmn').val(date);
					
							$(".list_mfam").css('display','none');
						
						
							//автозаполнение для партнёрши
				
							if(name==null){ }else{
				
								var name=data1[6];
			   					var sname=data1[7];
			   					var date=data1[8];
			   					var club=data1[9];
			   					var city=data1[10];
			   					var trener=data1[11];
			   
			   
			  	 				var k4=data1[15];
			   					var k5=data1[16];
			   					var k6=data1[17];
			   					//alert(k4+" "+k5+" "+k6);
			   
			   					var name_k4=data1[21];
			   					var name_k5=data1[22];
			   					var name_k6=data1[23];
			   					//alert(name_k4+" "+name_k5+" "+name_k6);
			  					if(name_k4==null){ name_k4="-"; k4="-"; }
			   					if(name_k5==null){ name_k5="-"; k5="-"; }
			  					if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			   					// var html_k='<option value="'+k4+'">'+name_k4+'</option>';
								$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
								//$('#fkst').html(html_k);
								//alert(data1[25]);
								//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
								$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
								//$('#fkla').html(html_k);
								//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
								$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
								//$('#fkmn').html(html_k);
			   
			   
			   
			   
			   					//alert(trener);
			   					var m_t=trener.split('-!-');
				
								var length1=m_t.length;
								if(length1==1){
									$('#coach4').val(m_t[0]);
					
								}
								if(length1==2){
									$('#coach4').val(m_t[0]);
									$('#coach5').val(m_t[1]);
					
								}
								if(length1==3){
									$('#coach4').val(m_t[0]);
									$('#coach5').val(m_t[1]);
									$('#coach6').val(m_t[2]);
								}
				
								$('#mfam_id').val(id);
								$('#ffam').val(sname);
								$('#fnam').val(name);
								$('#fbir').val(date);
				
				
								if(club.indexOf(' | ') + 1) {
									var club_m=club.split(" | ");
									var club_id_m=data1[26].split(" | ");
									var html_club="";
									for (var i = 0; i < club_m.length; i++) {
    									html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
									}	
					
									$('.list_stk2').html(html_club);
									var length1=club_m.length;
			 						if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  						if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  						$(".list_stk2").css("display","block");
					
					
									//alert(club_m);
								}else{
				
									$('#stk2').val(club);
									$('#city2').val(city);
				
				
								}
				
				


							}
						
						
						
						
						
						
						
						
						
		  				}
		  
   					})
					
					
					*/
		
				}
				
				
				
				
				
				
				
				
				
				
			
          }
        });
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
      },
      minLength: 1
	  
    });


</script> 


<script type="text/javascript">

$( "#ffam" ).autocomplete({
      source: function(request, response){
        // организуем кроссдоменный запрос
		
		var term=$("#ffam").val();
		//alert(term);
		var mfam_id="";
		var ffam_id=""; 
		 
        $.ajax({
          url: "ajax/search2.php",
		  type: "POST",
		  data: {term : term},
          // обработка успешного выполнения запроса
          success: function(data){
			  var html1="";
			  var data1 = JSON.parse ( data );
			  for (i = 0; i < data1.length; i++) { 
			  
			  	///alert(data1[i]); 
				mas=data1[i].split('-!-');
			  	var id=mas[0];
				var ffam_id=id;
				var name=mas[1];
				var name2=mas[2];
				var id_m=mas[3];
				var club_1=mas[4];
				//alert(name);
			   html1=html1+'<option id="'+id+'" value="'+id_m+'">'+name+' | '+name2+' ('+club_1+')</option>';
			  
			  }
			  
			  //alert(html1);
			  $('.list_ffam').html(html1);
              var length1=data1.length;
			  if(length1<10){ $(".list_ffam").attr("size", length1);  }
			  if(length1==1){ $(".list_ffam").attr("size", "2"); }
			  $(".list_ffam").css("display","block");
				
				
				var id=$(".list_ffam").children(":selected").attr("id");
  				
				if(id!=undefined){
					
					/*
					var id=$(".list_ffam").children(":selected").attr("id");
  					var id2=$(".list_ffam").val();
   					$.ajax({
          				url: "ajax/search_auto2.php",
		  				type: "POST",
		  				data: {id : id,id2 : id2},
          				// обработка успешного выполнения запроса
          				success: function(data){
			  	 			var data1 = JSON.parse ( data );
			   				var name=data1[0];
			   				var sname=data1[1];
			   				var date=data1[2];
			   				var club=data1[3];
			   				var city=data1[4];
			   				var trener=data1[5];
							var hidden=data1[24];
							
							var k1=data1[12];
							var k2=data1[13];
							var k3=data1[14];
							//alert(k1+" "+k2+" "+k3);
			   			
							var name_k1=data1[18];
			   				var name_k2=data1[19];
			   				var name_k3=data1[20];
			   				//alert(name_k1+" "+name_k2+" "+name_k3);
							if(name_k1==null){ name_k1="-"; k1="-"; }
			   if(name_k2==null){ name_k2="-"; k2="-"; }
			   if(name_k3==null){ name_k3="-"; k3="-"; }
			   				//alert("2");
							
							
							//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
							$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
						//	$('#fkst').html(html_k);
						//alert(data1[25]);
							//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
							$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
						//	$('#fkla').html(html_k);
							//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
							$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
						//	$('#fkmn').html(html_k);
							
							
							var m_t=trener.split('-!-');
				
							var length1=m_t.length;
							if(length1==1){
								$('#coach1').val(m_t[0]);
					
							}
							if(length1==2){
								$('#coach1').val(m_t[0]);
								$('#coach2').val(m_t[1]);
					
							}
							if(length1==3){
								$('#coach1').val(m_t[0]);
								$('#coach2').val(m_t[1]);
								$('#coach3').val(m_t[2]);
							}
							
			   				//alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
							$('#mfam_id').val(hidden);
		  					$('#ffam').val(sname);
							$('#fnam').val(name);
							$('#fbir').val(date);
							
							
							
							if(club.indexOf(' | ') + 1) {
								var club_m=club.split(" | ");
								var club_id_m=data1[26].split(" | ");
								var html_club="";
								for (var i = 0; i < club_m.length; i++) {
    								html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
								}	
					
								$('.list_stk2').html(html_club);
								var length1=club_m.length;
			 					if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  					if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  					$(".list_stk2").css("display","block");
					
					
								//alert(club_m);
								}else{
									$('#stk2').val(club);
									$('#city2').val(city);
				
							}
				
							$(".list_ffam").css('display','none');
							
							
							


				//автозаполнение для партнёра
				
				
				var name=data1[6];
			   var sname=data1[7];
			   var date=data1[8];
			   var club=data1[9];
			   var city=data1[10];
			   var trener=data1[11];
			   
			   var k4=data1[15];
			   var k5=data1[16];
			   var k6=data1[17];
			   //alert(k4+" "+k5+" "+k6);
			   
			   
			   var name_k4=data1[21];
			   var name_k5=data1[22];
			   var name_k6=data1[23];
			   //alert(name_k4+" "+name_k5+" "+name_k6);
			   if(name_k4==null){ name_k4="-"; k4="-"; }
			   if(name_k5==null){ name_k5="-"; k5="-"; }
			   if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			  
			   if(name==null){ }else{
			
				  	//var html_k='<option value="'+k4+'">'+name_k4+'</option>';
				  	$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
					//$('#mkst').html(html_k);
					//alert(data1[25]);
					//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
					$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
					//$('#mkla').html(html_k);
					
					//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
					$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
					//$('#mkmn').html(html_k);
			   
			   
			   	   
				   
			   //alert(trener);
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
				
				$('#ffam_id').val(id);
				$('#mfam').val(sname);
				$('#mnam').val(name);
				$('#mbir').val(date);
				
				if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[27].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk1').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  			$(".list_stk1").css("display","block");
					
					
					//alert(club_m);
					}else{
				
				
				$('#stk1').val(club);
				$('#city1').val(city);
				
				}
				
				
				//$('#mkst').val(date);
				//$('#mkla').val(date);
				//$('#mkmn').val(date);
				
			   }
							
							
							
							
							
							
		  				}
		  
  					 })
					
					
				*/	
				}
				
				
				
				
				
				
			
          }
        });
      },
      minLength: 1
	  
    });


</script> 

<script type="text/javascript">

$(".list_mfam").click(function(){
 
  var id=$(this).children(":selected").attr("id");
  var id2=$(this).val();
   $.ajax({
          url: "ajax/search_auto.php",
		  type: "POST",
		  data: {id : id,id2 : id2},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var sname=data1[1];
			   var date=data1[2];
			   var club=data1[3];
			   
			   
			   
			   var city=data1[4];
			   var trener=data1[5];
			   var hidden=data1[24];
			   
				var k1=data1[12];
				var k2=data1[13];
				var k3=data1[14];
			   //alert(k1+" "+k2+" "+k3);
			   	
				var name_k1=data1[18];
			   	var name_k2=data1[19];
			   	var name_k3=data1[20];
			   //	alert(name_k1+" "+name_k2+" "+name_k3);		
			   if(name_k1==null){ name_k1="-"; k1="-"; }
			   if(name_k2==null){ name_k2="-"; k2="-"; }
			   if(name_k3==null){ name_k3="-"; k3="-"; }
			   
			   
			   
			   	//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
				$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
				$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkla').html(html_k);
				
				//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
				$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkmn').html(html_k);
			   
			   
			   //alert(trener);
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
				
				//alert(trener);
				
			   //alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
			   	$('#ffam_id').val(hidden);
		  		$('#mfam').val(sname);
				$('#mnam').val(name);
				$('#mbir').val(date);
				
				
				if(club.indexOf(' | ') + 1) {
					var club_m=club.split(" | ");
					var club_id_m=data1[26].split(" | ");
					var html_club="";
					for (var i = 0; i < club_m.length; i++) {
    					 html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
					}
					
					$('.list_stk1').html(html_club);
					var length1=club_m.length;
			 		if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  		if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  		$(".list_stk1").css("display","block");
					
					
					//alert(club_m);
				}else{
					$('#stk1').val(club);
					$('#city1').val(city);
				}
				
				
				
				//$('#mkst').val(date);
				//$('#mkla').val(date);
				//$('#mkmn').val(date);
				
				
				
				$(".list_mfam").css('display','none');
				
				
				
				//автозаполнение для партнёрши
				
				
				var name=data1[6];
			   var sname=data1[7];
			   var date=data1[8];
			   var club=data1[9];
			   var city=data1[10];
			   var trener=data1[11];
			   
			   
			   var k4=data1[15];
			   var k5=data1[16];
			   var k6=data1[17];
			   //alert(k4+" "+k5+" "+k6);
			   
			   var name_k4=data1[21];
			   var name_k5=data1[22];
			   var name_k6=data1[23];
			   //alert(name_k4+" "+name_k5+" "+name_k6);
			   if(name_k4==null){ name_k4="-"; k4="-"; }
			   if(name_k5==null){ name_k5="-"; k5="-"; }
			   if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			  
			   
			   if(name==null){ }else{
			   
			    //var html_k='<option value="'+k4+'">'+name_k4+'</option>';
				$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
				$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkla').html(html_k);
				//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
				$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkmn').html(html_k);
			   
			   
			   
			   
			   		var m_t=trener.split('-!-');
					
					var length1=m_t.length;
					if(length1==1){
						$('#coach4').val(m_t[0]);
					
					}
					if(length1==2){
						$('#coach4').val(m_t[0]);
						$('#coach5').val(m_t[1]);
					
					}
					if(length1==3){
						$('#coach4').val(m_t[0]);
						$('#coach5').val(m_t[1]);
						$('#coach6').val(m_t[2]);
					}
				
					$('#mfam_id').val(id);
					$('#ffam').val(sname);
					$('#fnam').val(name);
					$('#fbir').val(date);
					
					if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[27].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk2').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  			$(".list_stk2").css("display","block");
					
					
					//alert(club_m);
					}else{
					
						$('#stk2').val(club+'');
						$('#city2').val(city);
				
					}
					
					
				
				}
				
				
				
				
		  }
		  
   })
 
 
 	
	
});

</script>


<script type="text/javascript">

$(".list_mfam").change(function(){
 
  var id=$(this).children(":selected").attr("id");
  var id2=$(this).val();
   $.ajax({
          url: "ajax/search_auto.php",
		  type: "POST",
		  data: {id : id,id2 : id2},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var sname=data1[1];
			   var date=data1[2];
			   var club=data1[3];
			   
			   
			   
			   var city=data1[4];
			   var trener=data1[5];
			   var hidden=data1[24];
			   
				var k1=data1[12];
				var k2=data1[13];
				var k3=data1[14];
			   //alert(k1+" "+k2+" "+k3);
			   	
				var name_k1=data1[18];
			   	var name_k2=data1[19];
			   	var name_k3=data1[20];
			   //	alert(name_k1+" "+name_k2+" "+name_k3);		
			   if(name_k1==null){ name_k1="-"; k1="-"; }
			   if(name_k2==null){ name_k2="-"; k2="-"; }
			   if(name_k3==null){ name_k3="-"; k3="-"; }
			   
			   
			   
			   	//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
				$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
				$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkla').html(html_k);
				
				//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
				$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkmn').html(html_k);
			   
			   
			   //alert(trener);
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
				
				//alert(trener);
				
			   //alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
			   	$('#ffam_id').val(hidden);
		  		$('#mfam').val(sname);
				$('#mnam').val(name);
				$('#mbir').val(date);
				
				
				if(club.indexOf(' | ') + 1) {
					var club_m=club.split(" | ");
					var club_id_m=data1[26].split(" | ");
					var html_club="";
					for (var i = 0; i < club_m.length; i++) {
    					 html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
					}
					
					$('.list_stk1').html(html_club);
					var length1=club_m.length;
			 		if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  		if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  		$(".list_stk1").css("display","block");
					
					
					//alert(club_m);
				}else{
					$('#stk1').val(club);
					$('#city1').val(city);
				}
				
				
				
				//$('#mkst').val(date);
				//$('#mkla').val(date);
				//$('#mkmn').val(date);
				
				
				
				$(".list_mfam").css('display','none');
				
				
				
				//автозаполнение для партнёрши
				
				
				var name=data1[6];
			   var sname=data1[7];
			   var date=data1[8];
			   var club=data1[9];
			   var city=data1[10];
			   var trener=data1[11];
			   
			   
			   var k4=data1[15];
			   var k5=data1[16];
			   var k6=data1[17];
			   //alert(k4+" "+k5+" "+k6);
			   
			   var name_k4=data1[21];
			   var name_k5=data1[22];
			   var name_k6=data1[23];
			   //alert(name_k4+" "+name_k5+" "+name_k6);
			   if(name_k4==null){ name_k4="-"; k4="-"; }
			   if(name_k5==null){ name_k5="-"; k5="-"; }
			   if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			  
			   
			   if(name==null){ }else{
			   
			    //var html_k='<option value="'+k4+'">'+name_k4+'</option>';
				$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
				$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkla').html(html_k);
				//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
				$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#fkmn').html(html_k);
			   
			   
			   
			   
			   		var m_t=trener.split('-!-');
					
					var length1=m_t.length;
					if(length1==1){
						$('#coach4').val(m_t[0]);
					
					}
					if(length1==2){
						$('#coach4').val(m_t[0]);
						$('#coach5').val(m_t[1]);
					
					}
					if(length1==3){
						$('#coach4').val(m_t[0]);
						$('#coach5').val(m_t[1]);
						$('#coach6').val(m_t[2]);
					}
				
					$('#mfam_id').val(id);
					$('#ffam').val(sname);
					$('#fnam').val(name);
					$('#fbir').val(date);
					
					if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[27].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk2').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  			$(".list_stk2").css("display","block");
					
					
					//alert(club_m);
					}else{
					
						$('#stk2').val(club+'');
						$('#city2').val(city);
				
					}
					
					
				
				}
				
				
				
				
		  }
		  
   })
  
  
});



</script>
   
   
   
<script type="text/javascript">


$(".list_ffam").click(function(){


 
  var id=$(this).children(":selected").attr("id");
  var id2=$(this).val();
   $.ajax({
          url: "ajax/search_auto2.php",
		  type: "POST",
		  data: {id : id,id2 : id2},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var sname=data1[1];
			   var date=data1[2];
			   var club=data1[3];
			   var city=data1[4];
			   var trener=data1[5];
			   var hidden=data1[24];
			   
				var k1=data1[12];
				var k2=data1[13];
				var k3=data1[14];
			   //	alert(k1+" "+k2+" "+k3);
			   
			   
				var name_k1=data1[18];
			   	var name_k2=data1[19];
			   	var name_k3=data1[20];
			   	//alert(name_k1+" "+name_k2+" "+name_k3);
			   	if(name_k1==null){ name_k1="-"; k1="-"; }
			   if(name_k2==null){ name_k2="-"; k2="-"; }
			   if(name_k3==null){ name_k3="-"; k3="-"; }
			   
				
				//alert("1");
				//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
				$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkst').html(html_k);
						//alert(data1[25]);
						//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
						$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkla').html(html_k);
						//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
						$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkmn').html(html_k);
				
				
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
			   
			   
			   //alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
			   	$('#mfam_id').val(hidden);
		  		$('#ffam').val(sname);
				$('#fnam').val(name);
				$('#fbir').val(date);
				
				if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[26].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk2').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  			$(".list_stk2").css("display","block");
					
					
					//alert(club_m);
					}else{
				
					$('#stk2').val(club);
					$('#city2').val(city);
				
				}
				
				
				
				$(".list_ffam").css('display','none');
				
				
				//автозаполнение для партнёра
				
				
				var name=data1[6];
			   var sname=data1[7];
			   var date=data1[8];
			   var club=data1[9];
			   var city=data1[10];
			   var trener=data1[11];
			   
			   
			   var k4=data1[15];
			   var k5=data1[16];
			   var k6=data1[17];
			   //alert(k4+" "+k5+" "+k6);
			   
			   var name_k4=data1[21];
			   var name_k5=data1[22];
			   var name_k6=data1[23];
			   //alert(name_k4+" "+name_k5+" "+name_k6);
			   if(name_k4==null){ name_k4="-"; k4="-"; }
			   if(name_k5==null){ name_k5="-"; k5="-"; }
			   if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			   
			   
			   if(name==null){ }else{
				   
				//var html_k='<option value="'+k4+'">'+name_k4+'</option>';
				$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
				$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkla').html(html_k);
				
				//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
				$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkmn').html(html_k);
			   
			      
				   
			   //alert(trener);
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
				
				$('#ffam_id').val(id);
				$('#mfam').val(sname);
				$('#mnam').val(name);
				$('#mbir').val(date);
				
				if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[27].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk1').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  			$(".list_stk1").css("display","block");
					
					
					//alert(club_m);
					}else{
				
					$('#stk1').val(club);
					$('#city1').val(city);
				
				
				}
					
					
				//$('#mkst').val(date);
				//$('#mkla').val(date);
				//$('#mkmn').val(date);
				
				
				
				
				
			   }
				
				
				
				
				
				
				
		  }
		  
   })


   
});



</script>

   
   
<script type="text/javascript">

$(".list_ffam").change(function(){
 
  var id=$(this).children(":selected").attr("id");
  var id2=$(this).val();
   $.ajax({
          url: "ajax/search_auto2.php",
		  type: "POST",
		  data: {id : id,id2 : id2},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var sname=data1[1];
			   var date=data1[2];
			   var club=data1[3];
			   var city=data1[4];
			   var trener=data1[5];
			   var hidden=data1[24];
			   
				var k1=data1[12];
				var k2=data1[13];
				var k3=data1[14];
			   //	alert(k1+" "+k2+" "+k3);
			   
			   
				var name_k1=data1[18];
			   	var name_k2=data1[19];
			   	var name_k3=data1[20];
			   	//alert(name_k1+" "+name_k2+" "+name_k3);
			   	if(name_k1==null){ name_k1="-"; k1="-"; }
			   if(name_k2==null){ name_k2="-"; k2="-"; }
			   if(name_k3==null){ name_k3="-"; k3="-"; }
			   
				
				//alert("1");
				//var html_k='<option value="'+k1+'">'+name_k1+'</option>';
				$('#fkst option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkst').html(html_k);
						//alert(data1[25]);
						//var html_k='<option value="'+k2+'">'+name_k2+'</option>';
						$('#fkla option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkla').html(html_k);
						//var html_k='<option value="'+k3+'">'+name_k3+'</option>';
						$('#fkmn option[value="'+data1[25]+'"]').prop('selected', true);
						//$('#fkmn').html(html_k);
				
				
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
			   
			   
			   //alert(name+" = "+sname+" = "+date+" = "+club+" = "+city);
			   	$('#mfam_id').val(hidden);
		  		$('#ffam').val(sname);
				$('#fnam').val(name);
				$('#fbir').val(date);
				
				if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[26].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk2').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  			$(".list_stk2").css("display","block");
					
					
					//alert(club_m);
					}else{
				
					$('#stk2').val(club);
					$('#city2').val(city);
				
				}
				
				
				
				$(".list_ffam").css('display','none');
				
				
				//автозаполнение для партнёра
				
				
				var name=data1[6];
			   var sname=data1[7];
			   var date=data1[8];
			   var club=data1[9];
			   var city=data1[10];
			   var trener=data1[11];
			   
			   
			   var k4=data1[15];
			   var k5=data1[16];
			   var k6=data1[17];
			   //alert(k4+" "+k5+" "+k6);
			   
			   var name_k4=data1[21];
			   var name_k5=data1[22];
			   var name_k6=data1[23];
			   //alert(name_k4+" "+name_k5+" "+name_k6);
			   if(name_k4==null){ name_k4="-"; k4="-"; }
			   if(name_k5==null){ name_k5="-"; k5="-"; }
			   if(name_k6==null){ name_k6="-"; k6="-"; }
			   
			   
			   
			   if(name==null){ }else{
				   
				//var html_k='<option value="'+k4+'">'+name_k4+'</option>';
				$('#mkst option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkst').html(html_k);
				//alert(data1[25]);
				//var html_k='<option value="'+k5+'">'+name_k5+'</option>';
				$('#mkla option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkla').html(html_k);
				
				//var html_k='<option value="'+k6+'">'+name_k6+'</option>';
				$('#mkmn option[value="'+data1[25]+'"]').prop('selected', true);
				//$('#mkmn').html(html_k);
			   
			      
				   
			   //alert(trener);
			   var m_t=trener.split('-!-');
				
				var length1=m_t.length;
				if(length1==1){
					$('#coach1').val(m_t[0]);
					
				}
				if(length1==2){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					
				}
				if(length1==3){
					$('#coach1').val(m_t[0]);
					$('#coach2').val(m_t[1]);
					$('#coach3').val(m_t[2]);
				}
				
				$('#ffam_id').val(id);
				$('#mfam').val(sname);
				$('#mnam').val(name);
				$('#mbir').val(date);
				
				if(club.indexOf(' | ') + 1) {
						var club_m=club.split(" | ");
						var club_id_m=data1[27].split(" | ");
						var html_club="";
						for (var i = 0; i < club_m.length; i++) {
    						html_club=html_club+'<option id="'+club_id_m[i]+'">'+club_m[i]+'</option>';
						}	
					
						$('.list_stk1').html(html_club);
						var length1=club_m.length;
			 			if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  			if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  			$(".list_stk1").css("display","block");
					
					
					//alert(club_m);
					}else{
				
					$('#stk1').val(club);
					$('#city1').val(city);
				
				
				}
					
					
				//$('#mkst').val(date);
				//$('#mkla').val(date);
				//$('#mkmn').val(date);
				
				
				
				
				
			   }
				
				
				
				
				
				
				
		  }
		  
   })
  
  
});



</script>    


<script type="text/javascript">
//кнопка регистрации
$("#insert").click(function(){
var log_warning=0;
var number=$("#number").val();

var mfam=$("#mfam").val();
var mnam=$("#mnam").val();
var mbir=$("#mbir").val();
var mkst=$("#mkst").val();
var mkla=$("#mkla").val();
var mkmn=$("#mkmn").val();

var ffam=$("#ffam").val();
var fnam=$("#fnam").val();
var fbir=$("#fbir").val();
var fkst=$("#fkst").val();
var fkla=$("#fkla").val();
var fkmn=$("#fkmn").val();

var stk1=$("#stk1").val();
var city1=$("#city1").val();
var country1=$("#country1").val();

var stk2=$("#stk2").val();
var city2=$("#city2").val();
var country2=$("#country2").val();

var coach1=$("#coach1").val();
var coach2=$("#coach2").val();
var coach3=$("#coach3").val();
var coach4=$("#coach4").val();
var coach5=$("#coach5").val();
var coach6=$("#coach6").val();

var curgroup=$("#curgroup").val();









var turnir_otd=$("#curgroup_otd").val();
var curgroup_type=$("#curgroup_type").val();

curgroup=String(curgroup);

var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   curgroup=curgroup+','+num[j];
	   
       j++;
   });
}


//alert(curgroup);

//return false;


var curgroup_m = curgroup.split(',');





for (var i = 0; i < curgroup_m.length; i++) {


/////////////////////////////////////////////

//проверка по возрасту и классу
//определить положение переключателя соло/пара
var type1=$("#curgroup_type").val();
//alert(type1);
if(type1=="para"){
//пара

//вычислить старшего по возрасту участника
//	alert(mbir)

	


	if(mbir>fbir){
		var st_bir=fbir;
	}else{
		var st_bir=mbir;
	}

	//получить дату проведения турнина, на который регитрируется участник

	var turnir_otd_text=$("#curgroup_otd :selected").text();
	var mas_1=turnir_otd_text.split("::");


	var date_otd_turnir=$.trim(mas_1[1]);

	//alert("=="+date_otd_turnir+"==");
	//сколько лет будет старшему участинку на дату проведения турнира?
	
	
	years=dateDiff(st_bir, date_otd_turnir);
	//alert(years);
	
	//получить минимальный и максимальный возрастные пределы для группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	
	//alert(id_class);
	var years_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_years.php",
		data: params,
		async: false,
		success: function(data){
			years_tmp=data;
		}})
	
	//alert("="+years_tmp+"=");
	var mas_2=years_tmp.split(":");
	
	var min_years=mas_2[0];
	var max_years=mas_2[1];
	
	//alert(years+" = "+min_years+" = "+max_years);
	
	if((years>=min_years)&&(years<=max_years)){
			
		
	}else if(years<min_years){
		
		
		/*
		if (confirm("Предупреждение: возраст старшего участника слишком мал для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
		var warning=$('.warning_registration').html();
		warning=warning+"(Группа "+txt_1+") "+"Предупреждение: возраст старшего участника слишком мал для участия в выбранной группе.<br>";
		$('.warning_registration').html(warning);
		$('#warning_button').css('display','block');
		//return false;
		log_warning=1;

		
	}else if(years>max_years){
		
		
		/*
		if (confirm("Предупреждение: возраст старшего участника слишком велик для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		
		var warning=$('.warning_registration').html();
		var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
		warning=warning+"(Группа "+txt_1+") "+"Предупреждение: возраст старшего участника слишком велик для участия в выбранной группе.<br>";
		$('.warning_registration').html(warning);
		$('#warning_button').css('display','block');
		//return false;
		log_warning=1;
	}
	




	//проверка по классу
	//получить минимальный и максимальный классы выбранной группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	
	var classes_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_classes.php",
		data: params,
		async: false,
		success: function(data){
			classes_tmp=data;
		}})
	var mas_2=classes_tmp.split(":");
	
	var min_class=mas_2[0];//идентификатор минимального класса выбранной группы
	var max_class=mas_2[1];//идентификатор максимального класса выбранной группы
	//alert(min_class);
	//alert(max_class);
	//получить идентификатор класса старшего по классу участника
	//получить идентификаторы классов обоих партнёров
	var info_class_dancer_m="";
	var info_class_dancer_w="";
	
	var id_m=$("#mfam_id").val();
	var id_f=$("#ffam_id").val();
	
	
	params = { id_m:id_m }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_m.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_m=data;
		}})
	
	params = { id_f:id_f }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_w.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_w=data;
		}})
	
	
	
	//получить класс старшего по классу партнёра
	var info_class_dancer_r="";
	if(info_class_dancer_w>info_class_dancer_m){
		info_class_dancer_r=info_class_dancer_w;
	}else{
		info_class_dancer_r=info_class_dancer_m;	
	}
	
	
	//alert(info_class_dancer_r);
	
	if((min_class=='-')&&(max_class=='-')){
	
	}else{
	
		if((info_class_dancer_r>=min_class)&&(info_class_dancer_r<=max_class)){
	
		}else if(info_class_dancer_r>max_class){
			
			/*
			if (confirm("Предупреждение: класс старшего участника выше, чем максимально допустимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			var warning=$('.warning_registration').html();
			var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
			warning=warning+"(Группа "+txt_1+") "+"Предупреждение: класс старшего участника выше, чем максимально допустимый для участия в выбранной группе.<br>";
			$('.warning_registration').html(warning);
			$('#warning_button').css('display','block');
			//return false;
			log_warning=1;
		
		}else if(info_class_dancer_r<min_class){
			
			/*
			if (confirm("Предупреждение: класс старшего участника ниже, чем минимально допусимый для участия в выбранной группе. Продолжить?")) {
				
			} else {
  			
				return false;	
			}
			*/
			var warning=$('.warning_registration').html();
			var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
			warning=warning+"(Группа "+txt_1+") "+"Предупреждение: класс старшего участника ниже, чем минимально допусимый для участия в выбранной группе.<br>";
			$('.warning_registration').html(warning);
			$('#warning_button').css('display','block');
			//return false;
			log_warning=1;
		
		}
	
	
	
	}
	
	
	
	
	
	//проверка истории выступлений: если ранее участник был замечен в более старшей по классу группе, то вывести предупреждение
	//передача в скрипт:
	//id_m - идентификатор партнёра (любой из пары), по нему будет вычислен идентификатор пары
	//info_class_dancer_r - класс старшего по классу партнёра
	
	
	params = { id_m:id_m,info_class_dancer_r:info_class_dancer_r }
	$.ajax({
		type: "POST",
		url: "ajax/history_turnir.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="warning"){  
				
				/*
				if (confirm("Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом. Продолжить?")) {
			
				} else {
  			
					return false;	
				}
				*/
				var warning=$('.warning_registration').html();
				var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
				warning=warning+"(Группа "+txt_1+") "+"Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом.<br>";
				$('.warning_registration').html(warning);
				$('#warning_button').css('display','block');
				//return false;
				log_warning=1;
				
				
			}
			
			//info_class_dancer_w=data;
		}})
	
	
	
	//проверка: если участник имеет класс N, получить дату его последего выступления
	if(info_class_dancer_r=="1"){
		//id_m
		params = { id_m:id_m }
		$.ajax({
		type: "POST",
		url: "ajax/history_turnir_last_date.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="ok"){
				
				
				
			}else{
				var date1=data;
				
				var years_2=dateDiff(date1, date_otd_turnir);
				if(years_2<1){  }else{
				
					/*
					if (confirm("Предупреждение: с момента последнего выступления участника прошло более года. Продолжить?")) {
			
					} else {
  			
						return false;	
					}
					*/
					var warning=$('.warning_registration').html();
					var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
					warning=warning+"(Группа "+txt_1+") "+"Предупреждение: с момента последнего выступления участника прошло более года.<br>";
					$('.warning_registration').html(warning);
					$('#warning_button').css('display','block');
					//return false;
					log_warning=1;
					
				}
				
				
				
				
			}
			
			//info_class_dancer_w=data;
		}})
		
	}
	
	

	
	
	
	
	
	
	

	
}else{
//соло
	
	
	var st_bir=mbir;

	//получить дату проведения турнина, на который регитрируется участник

	var turnir_otd_text=$("#curgroup_otd :selected").text();
	var mas_1=turnir_otd_text.split("::");


	var date_otd_turnir=$.trim(mas_1[1]);

	//alert("=="+date_otd_turnir+"==");
	//сколько лет будет старшему участинку на дату проведения турнира?
	
	
	years=dateDiff(st_bir, date_otd_turnir);
	//alert(years);
	
	//получить минимальный и максимальный возрастные пределы для группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	//alert(id_class);
	var years_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_years.php",
		data: params,
		async: false,
		success: function(data){
			years_tmp=data;
		}})
	
	//alert("="+years_tmp+"=");
	var mas_2=years_tmp.split(":");
	
	var min_years=mas_2[0];
	var max_years=mas_2[1];
	
	if((years>=min_years)&&(years<=max_years)){
			
		
	}else if(years<min_years){
		/*
		if (confirm("Предупреждение: возраст участника слишком мал для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		var warning=$('.warning_registration').html();
		var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
		
				warning=warning+"(Группа "+txt_1+") "+"Предупреждение: возраст участника слишком мал для участия в выбранной группе.<br>";
		$('.warning_registration').html(warning);
		$('#warning_button').css('display','block');
		//return false;
		log_warning=1;
		
	}else if(years>max_years){
		
		/*
		if (confirm("Предупреждение: возраст участника слишком велик для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		var warning=$('.warning_registration').html();
		var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
				warning=warning+"(Группа "+txt_1+") "+"Предупреждение: возраст участника слишком велик для участия в выбранной группе.<br>";
		$('.warning_registration').html(warning);
		$('#warning_button').css('display','block');
		//return false;
		log_warning=1;
		
	}
	




	//проверка по классу
	//получить минимальный и максимальный классы выбранной группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	//alert("1111");
	//alert(id_class);
	var classes_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_classes.php",
		data: params,
		async: false,
		success: function(data){
			classes_tmp=data;
		}})
	var mas_2=classes_tmp.split(":");
	
	var min_class=mas_2[0];//идентификатор минимального класса выбранной группы
	var max_class=mas_2[1];//идентификатор максимального класса выбранной группы
	//alert(min_class);
	//alert(min_class);
	//получить идентификатор класса старшего по классу участника
	//получить идентификаторы классов обоих партнёров
	var info_class_dancer_m="";
	//var info_class_dancer_w="";
	
	var id_m=$("#mfam_id").val();
	//var id_f=$("#ffam_id").val();
	
	
	params = { id_m:id_m }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_m.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_m=data;
		}})
	
	//params = { id_f:id_f }
	//$.ajax({
	//	type: "POST",
	//	url: "ajax/info_class_dancer_w.php",
	//	data: params,
	//	async: false,
	//	success: function(data){
	//		info_class_dancer_w=data;
	//	}})
	
	
	
	//получить класс старшего по классу партнёра
	var info_class_dancer_r="";
	//if(info_class_dancer_w>info_class_dancer_m){
	//	info_class_dancer_r=info_class_dancer_w;
	//}else{
		info_class_dancer_r=info_class_dancer_m;	
	//}
	
	if((min_class=='-')&&(max_class=='-')){
	
	}else{
	
	
	
		if((info_class_dancer_r>=min_class)&&(info_class_dancer_r<=max_class)){
	
		}else if(info_class_dancer_r>max_class){
			
			/*
			if (confirm("Предупреждение: класс участника выше, чем максимально допустимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			var warning=$('.warning_registration').html();
			var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
				warning=warning+"(Группа "+txt_1+") "+"Предупреждение: класс участника выше, чем максимально допустимый для участия в выбранной группе.<br>";
			$('.warning_registration').html(warning);
			$('#warning_button').css('display','block');
			//return false;
			log_warning=1;
		
		}else if(info_class_dancer_r<min_class){
			/*
			if (confirm("Предупреждение: класс участника ниже, чем минимально допусимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			var warning=$('.warning_registration').html();
			var txt_1=$("#curgroup option[value='"+curgroup_m[i]+"']").text();
				warning=warning+"(Группа "+txt_1+") "+"Предупреждение: класс участника ниже, чем минимально допусимый для участия в выбранной группе.<br>";
			$('.warning_registration').html(warning);
			$('#warning_button').css('display','block');
			//return false;
			log_warning=1;
		}
	
	
	}
	
	
	
	
	//проверка истории выступлений: если ранее участник был замечен в более старшей по классу группе, то вывести предупреждение
	//передача в скрипт:
	//id_m - идентификатор партнёра (любой из пары), по нему будет вычислен идентификатор пары
	//info_class_dancer_r - класс старшего по классу партнёра
	/*
	params = { id_m:id_m,info_class_dancer_r:info_class_dancer_r }
	$.ajax({
		type: "POST",
		url: "ajax/history_turnir.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="warning"){  
				if (confirm("Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом. Продолжить?")) {
			
				} else {
  			
					return false;	
				}
				
			}
			
			//info_class_dancer_w=data;
		}})
	
	
	
	//проверка: если участник имеет класс N, получить дату его последего выступления
	if(info_class_dancer_r=="1"){
		//id_m
		params = { id_m:id_m }
		$.ajax({
		type: "POST",
		url: "ajax/history_turnir_last_date.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="ok"){
				
				
				
			}else{
				var date1=data;
				
				var years_2=dateDiff(date1, date_otd_turnir);
				if(years_2<1){  }else{
				
				
					if (confirm("Предупреждение: с момента последнего выступления участника прошло более года. Продолжить?")) {
			
					} else {
  			
						return false;	
					}
					
					
				}
				
				
				
				
			}
			
			//info_class_dancer_w=data;
		}})
		
	}
	*/
	
	
	
	
	

	
}


//return false;

///////////////////////////////////////////	

}








if(log_warning==1){
	
return false;
	
}







if((number=="")||(mfam=="")||(mnam=="")||(mbir=="")||(ffam=="")||(fnam=="")||(fbir=="")||(stk1=="")||(city1=="")||(stk2=="")||(city2=="")){

alert("Ошибка! Заполнены не все поля.");
if(number==""){ $("#number").css('background-color','red'); }
if(mfam==""){ $("#mfam").css('background-color','red'); }
if(mnam==""){ $("#mnam").css('background-color','red'); }
if(mbir==""){ $("#mbir").css('background-color','red'); }
if(ffam==""){ $("#ffam").css('background-color','red'); }
if(fnam==""){ $("#fnam").css('background-color','red'); }
if(fbir==""){ $("#fbir").css('background-color','red'); }
if(stk1==""){ $("#stk1").css('background-color','red'); }
if(city1==""){ $("#city1").css('background-color','red'); }
if(stk2==""){ $("#stk2").css('background-color','red'); }
if(city2==""){ $("#city2").css('background-color','red'); }



}else{





for (var i = 0; i < curgroup_m.length; i++) {
//////////////////
//params = { number:number,mfam:mfam,mnam:mnam,mbir:mbir,mkst:mkst,mkla:mkla,mkmn:mkmn,ffam:ffam,fnam:fnam,fbir:fbir,fkst:fkst,fkla:fkla,fkmn:fkmn,stk1:stk1,city1:city1,country1:country1,stk2:stk2,city2:city2,country2:country2,coach1:coach1,coach2:coach2,coach3:coach3,coach4:coach4,coach5:coach5,coach6:coach6,curgroup:curgroup,turnir_otd:turnir_otd,curgroup_type:curgroup_type};

params = { number:number,mfam:mfam,mnam:mnam,mbir:mbir,mkst:mkst,mkla:mkla,mkmn:mkmn,ffam:ffam,fnam:fnam,fbir:fbir,fkst:fkst,fkla:fkla,fkmn:fkmn,stk1:stk1,city1:city1,country1:country1,stk2:stk2,city2:city2,country2:country2,coach1:coach1,coach2:coach2,coach3:coach3,coach4:coach4,coach5:coach5,coach6:coach6,curgroup:curgroup_m[i],turnir_otd:turnir_otd,curgroup_type:curgroup_type};




$.ajax({
type: "POST",
url: "ajax/reg_turnir.php",
data: params,
success: function(data){

$('.reg_ok').html("Регистрация успешно завершена.");
document.location.reload();

//	alert(data);
//document.location.href="/index.php?page=participants";
}})

///////////////////
}




}











});


</script>  












<script type="text/javascript">
//кнопка регистрации
$("#warning_button").click(function(){

var number=$("#number").val();

var mfam=$("#mfam").val();
var mnam=$("#mnam").val();
var mbir=$("#mbir").val();
var mkst=$("#mkst").val();
var mkla=$("#mkla").val();
var mkmn=$("#mkmn").val();

var ffam=$("#ffam").val();
var fnam=$("#fnam").val();
var fbir=$("#fbir").val();
var fkst=$("#fkst").val();
var fkla=$("#fkla").val();
var fkmn=$("#fkmn").val();

var stk1=$("#stk1").val();
var city1=$("#city1").val();
var country1=$("#country1").val();

var stk2=$("#stk2").val();
var city2=$("#city2").val();
var country2=$("#country2").val();

var coach1=$("#coach1").val();
var coach2=$("#coach2").val();
var coach3=$("#coach3").val();
var coach4=$("#coach4").val();
var coach5=$("#coach5").val();
var coach6=$("#coach6").val();

var curgroup=$("#curgroup").val();
var turnir_otd=$("#curgroup_otd").val();
var curgroup_type=$("#curgroup_type").val();


curgroup=String(curgroup);

var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   curgroup=curgroup+','+num[j];
	   
       j++;
   });
}




var curgroup_m = curgroup.split(',');





/////////////////////////////////////////////


//проверка по возрасту и классу
//определить положение переключателя соло/пара
var type1=$("#curgroup_type").val();
//alert(type1);
if(type1=="para"){
//пара

//вычислить старшего по возрасту участника
//	alert(mbir)

	if(mbir>fbir){
		var st_bir=fbir;
	}else{
		var st_bir=mbir;
	}

	//получить дату проведения турнина, на который регитрируется участник

	var turnir_otd_text=$("#curgroup_otd :selected").text();
	var mas_1=turnir_otd_text.split("::");


	var date_otd_turnir=$.trim(mas_1[1]);

	//alert("=="+date_otd_turnir+"==");
	//сколько лет будет старшему участинку на дату проведения турнира?
	
	
	years=dateDiff(st_bir, date_otd_turnir);
	//alert(years);
	
	//получить минимальный и максимальный возрастные пределы для группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	
	
	//alert(id_class);
	var years_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_years.php",
		data: params,
		async: false,
		success: function(data){
			years_tmp=data;
		}})
	
	//alert("="+years_tmp+"=");
	var mas_2=years_tmp.split(":");
	
	var min_years=mas_2[0];
	var max_years=mas_2[1];
	
	//alert(years+" = "+min_years+" = "+max_years);
	
	if((years>=min_years)&&(years<=max_years)){
			
		
	}else if(years<min_years){
		
		
		
		/*if (confirm("Предупреждение: возраст старшего участника слишком мал для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		//$('.warning_registration').html("Предупреждение: возраст старшего участника слишком мал для участия в выбранной группе.<br>");
		
		
		//return false;
		

		
	}else if(years>max_years){
		
		
		/*
		if (confirm("Предупреждение: возраст старшего участника слишком велик для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		
		//$('.warning_registration').html("Предупреждение: возраст старшего участника слишком велик для участия в выбранной группе.<br>");
		
	
	}
	




	//проверка по классу
	//получить минимальный и максимальный классы выбранной группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	
	var classes_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_classes.php",
		data: params,
		async: false,
		success: function(data){
			classes_tmp=data;
		}})
	var mas_2=classes_tmp.split(":");
	
	var min_class=mas_2[0];//идентификатор минимального класса выбранной группы
	var max_class=mas_2[1];//идентификатор максимального класса выбранной группы
	//alert(min_class);
	//alert(max_class);
	//получить идентификатор класса старшего по классу участника
	//получить идентификаторы классов обоих партнёров
	var info_class_dancer_m="";
	var info_class_dancer_w="";
	
	var id_m=$("#mfam_id").val();
	var id_f=$("#ffam_id").val();
	
	
	params = { id_m:id_m }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_m.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_m=data;
		}})
	
	params = { id_f:id_f }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_w.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_w=data;
		}})
	
	
	
	//получить класс старшего по классу партнёра
	var info_class_dancer_r="";
	if(info_class_dancer_w>info_class_dancer_m){
		info_class_dancer_r=info_class_dancer_w;
	}else{
		info_class_dancer_r=info_class_dancer_m;	
	}
	
	
	//alert(info_class_dancer_r);
	
	if((min_class=='-')&&(max_class=='-')){
	
	}else{
	
		if((info_class_dancer_r>=min_class)&&(info_class_dancer_r<=max_class)){
	
		}else if(info_class_dancer_r>max_class){
			
			/*
			if (confirm("Предупреждение: класс старшего участника выше, чем максимально допустимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			
			//$('.warning_registration').html("Предупреждение: класс старшего участника выше, чем максимально допустимый для участия в выбранной группе.<br>");
		
		
		
		}else if(info_class_dancer_r<min_class){
			
			/*
			if (confirm("Предупреждение: класс старшего участника ниже, чем минимально допусимый для участия в выбранной группе. Продолжить?")) {
				
			} else {
  			
				return false;	
			}
			*/
			
			//$('.warning_registration').html("Предупреждение: класс старшего участника ниже, чем минимально допусимый для участия в выбранной группе.<br>");
			
		
		
		}
	
	
	
	}
	
	
	
	
	
	//проверка истории выступлений: если ранее участник был замечен в более старшей по классу группе, то вывести предупреждение
	//передача в скрипт:
	//id_m - идентификатор партнёра (любой из пары), по нему будет вычислен идентификатор пары
	//info_class_dancer_r - класс старшего по классу партнёра
	
	
	params = { id_m:id_m,info_class_dancer_r:info_class_dancer_r }
	$.ajax({
		type: "POST",
		url: "ajax/history_turnir.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="warning"){  
				
				/*
				if (confirm("Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом. Продолжить?")) {
			
				} else {
  			
					return false;	
				}
				*/
				//$('.warning_registration').html("Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом.<br>");
				
			}
			
			//info_class_dancer_w=data;
		}})
	
	
	
	//проверка: если участник имеет класс N, получить дату его последего выступления
	if(info_class_dancer_r=="1"){
		//id_m
		params = { id_m:id_m }
		$.ajax({
		type: "POST",
		url: "ajax/history_turnir_last_date.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="ok"){
				
				
				
			}else{
				var date1=data;
				
				var years_2=dateDiff(date1, date_otd_turnir);
				if(years_2<1){  }else{
				
					/*
					if (confirm("Предупреждение: с момента последнего выступления участника прошло более года. Продолжить?")) {
			
					} else {
  			
						return false;	
					}
					*/
					
					//$('.warning_registration').html("Предупреждение: с момента последнего выступления участника прошло более года.<br>");
					
					
				}
				
				
				
				
			}
			
			//info_class_dancer_w=data;
		}})
		
	}
	
	
	
	

	
}else{
//соло
	
	
	var st_bir=mbir;

	//получить дату проведения турнина, на который регитрируется участник

	var turnir_otd_text=$("#curgroup_otd :selected").text();
	var mas_1=turnir_otd_text.split("::");


	var date_otd_turnir=$.trim(mas_1[1]);

	//alert("=="+date_otd_turnir+"==");
	//сколько лет будет старшему участинку на дату проведения турнира?
	
	
	years=dateDiff(st_bir, date_otd_turnir);
	//alert(years);
	
	//получить минимальный и максимальный возрастные пределы для группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	
	//alert(id_class);
	var years_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_years.php",
		data: params,
		async: false,
		success: function(data){
			years_tmp=data;
		}})
	
	//alert("="+years_tmp+"=");
	var mas_2=years_tmp.split(":");
	
	var min_years=mas_2[0];
	var max_years=mas_2[1];
	
	if((years>=min_years)&&(years<=max_years)){
			
		
	}else if(years<min_years){
		/*
		if (confirm("Предупреждение: возраст участника слишком мал для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		
		//$('.warning_registration').html("Предупреждение: возраст участника слишком мал для участия в выбранной группе.<br>");


		
	}else if(years>max_years){
		
		/*
		if (confirm("Предупреждение: возраст участника слишком велик для участия в выбранной группе. Продолжить?")) {
			
		} else {
  			
			return false;	
		}
		*/
		//$('.warning_registration').html("Предупреждение: возраст участника слишком велик для участия в выбранной группе.<br>");
	
	
	}
	




	//проверка по классу
	//получить минимальный и максимальный классы выбранной группы
	//var id_class=$("#curgroup :selected").val();
	var id_class=curgroup_m[i];
	//alert("1111");
	//alert(id_class);
	var classes_tmp="";
	params = { id_class:id_class }
	$.ajax({
		type: "POST",
		url: "ajax/reg_turnir_classes.php",
		data: params,
		async: false,
		success: function(data){
			classes_tmp=data;
		}})
	var mas_2=classes_tmp.split(":");
	
	var min_class=mas_2[0];//идентификатор минимального класса выбранной группы
	var max_class=mas_2[1];//идентификатор максимального класса выбранной группы
	//alert(min_class);
	//alert(min_class);
	//получить идентификатор класса старшего по классу участника
	//получить идентификаторы классов обоих партнёров
	var info_class_dancer_m="";
	//var info_class_dancer_w="";
	
	var id_m=$("#mfam_id").val();
	//var id_f=$("#ffam_id").val();
	
	
	params = { id_m:id_m }
	$.ajax({
		type: "POST",
		url: "ajax/info_class_dancer_m.php",
		data: params,
		async: false,
		success: function(data){
			info_class_dancer_m=data;
		}})
	
	//params = { id_f:id_f }
	//$.ajax({
	//	type: "POST",
	//	url: "ajax/info_class_dancer_w.php",
	//	data: params,
	//	async: false,
	//	success: function(data){
	//		info_class_dancer_w=data;
	//	}})
	
	
	
	//получить класс старшего по классу партнёра
	var info_class_dancer_r="";
	//if(info_class_dancer_w>info_class_dancer_m){
	//	info_class_dancer_r=info_class_dancer_w;
	//}else{
		info_class_dancer_r=info_class_dancer_m;	
	//}
	
	if((min_class=='-')&&(max_class=='-')){
	
	}else{
	
	
	
		if((info_class_dancer_r>=min_class)&&(info_class_dancer_r<=max_class)){
	
		}else if(info_class_dancer_r>max_class){
			
			/*
			if (confirm("Предупреждение: класс участника выше, чем максимально допустимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			//$('.warning_registration').html("Предупреждение: класс участника выше, чем максимально допустимый для участия в выбранной группе.<br>");
			
		
		
		}else if(info_class_dancer_r<min_class){
			/*
			if (confirm("Предупреждение: класс участника ниже, чем минимально допусимый для участия в выбранной группе. Продолжить?")) {
			
			} else {
  			
				return false;	
			}
			*/
			
			//$('.warning_registration').html("Предупреждение: класс участника ниже, чем минимально допусимый для участия в выбранной группе.<br>");
		
		
		}
	
	
	}
	
	
	
	
	//проверка истории выступлений: если ранее участник был замечен в более старшей по классу группе, то вывести предупреждение
	//передача в скрипт:
	//id_m - идентификатор партнёра (любой из пары), по нему будет вычислен идентификатор пары
	//info_class_dancer_r - класс старшего по классу партнёра
	/*
	params = { id_m:id_m,info_class_dancer_r:info_class_dancer_r }
	$.ajax({
		type: "POST",
		url: "ajax/history_turnir.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="warning"){  
				if (confirm("Предупреждение: регистрируемый участник участвовал ранее в соревнованиях под более высшим классом. Продолжить?")) {
			
				} else {
  			
					return false;	
				}
				
			}
			
			//info_class_dancer_w=data;
		}})
	
	
	
	//проверка: если участник имеет класс N, получить дату его последего выступления
	if(info_class_dancer_r=="1"){
		//id_m
		params = { id_m:id_m }
		$.ajax({
		type: "POST",
		url: "ajax/history_turnir_last_date.php",
		data: params,
		async: false,
		success: function(data){
			if(data=="ok"){
				
				
				
			}else{
				var date1=data;
				
				var years_2=dateDiff(date1, date_otd_turnir);
				if(years_2<1){  }else{
				
				
					if (confirm("Предупреждение: с момента последнего выступления участника прошло более года. Продолжить?")) {
			
					} else {
  			
						return false;	
					}
					
					
				}
				
				
				
				
			}
			
			//info_class_dancer_w=data;
		}})
		
	}
	*/
	
	
	
	
	

	
}


//return false;















if((number=="")||(mfam=="")||(mnam=="")||(mbir=="")||(ffam=="")||(fnam=="")||(fbir=="")||(stk1=="")||(city1=="")||(stk2=="")||(city2=="")){

alert("Ошибка! Заполнены не все поля.");
if(number==""){ $("#number").css('background-color','red'); }
if(mfam==""){ $("#mfam").css('background-color','red'); }
if(mnam==""){ $("#mnam").css('background-color','red'); }
if(mbir==""){ $("#mbir").css('background-color','red'); }
if(ffam==""){ $("#ffam").css('background-color','red'); }
if(fnam==""){ $("#fnam").css('background-color','red'); }
if(fbir==""){ $("#fbir").css('background-color','red'); }
if(stk1==""){ $("#stk1").css('background-color','red'); }
if(city1==""){ $("#city1").css('background-color','red'); }
if(stk2==""){ $("#stk2").css('background-color','red'); }
if(city2==""){ $("#city2").css('background-color','red'); }



}else{
	
	
	
	
	


for (var i = 0; i < curgroup_m.length; i++) {

params = { number:number,mfam:mfam,mnam:mnam,mbir:mbir,mkst:mkst,mkla:mkla,mkmn:mkmn,ffam:ffam,fnam:fnam,fbir:fbir,fkst:fkst,fkla:fkla,fkmn:fkmn,stk1:stk1,city1:city1,country1:country1,stk2:stk2,city2:city2,country2:country2,coach1:coach1,coach2:coach2,coach3:coach3,coach4:coach4,coach5:coach5,coach6:coach6,curgroup:curgroup_m[i],turnir_otd:turnir_otd,curgroup_type:curgroup_type};


$.ajax({
type: "POST",
url: "ajax/reg_turnir.php",
data: params,
async: false,
success: function(data){



//	alert(data);
//document.location.href="/index.php?page=participants";
}})

}

$('.reg_ok').html("Регистрация успешно завершена.");
document.location.reload();





}







});


</script>  
















<!--автозаполнение при вводе наименования клуба -->


<script type="text/javascript">

$( "#stk1" ).autocomplete({
      source: function(request, response){
        // организуем кроссдоменный запрос
		
		var term=$("#stk1").val();
		//alert(term);
		 
        $.ajax({
          url: "ajax/search_club.php",
		  type: "POST",
		  data: {term : term},
          // обработка успешного выполнения запроса
          success: function(data){
			  var html1="";
			  var data1 = JSON.parse ( data );
			  for (i = 0; i < data1.length; i++) { 
			  
			  	///alert(data1[i]); 
				mas=data1[i].split('-!-');
			  	var id=mas[0];
				var name=mas[1];
				//alert(name);
			   html1=html1+'<option id="'+id+'">'+name+'</option>';
			  
			  }
			  
			  //alert(html1);
			  $('.list_stk1').html(html1);
              var length1=data1.length;
			  if(length1<10){ $(".list_stk1").attr("size", length1);  }
			  if(length1==1){ $(".list_stk1").attr("size", "2"); }
			  $(".list_stk1").css("display","block");
				
				
				var id=$(".list_stk1").children(":selected").attr("id");
  				
				if(id!=undefined){
					
					
					var id=$(".list_stk1").children(":selected").attr("id");
  
   					$.ajax({
          				url: "ajax/search_club_auto.php",
		  				type: "POST",
		  				data: {id : id},
          				// обработка успешного выполнения запроса
          				success: function(data){
			   				var data1 = JSON.parse ( data );
			   				var name=data1[0];
			   				var city=data1[1];
			   
			    			$('#stk1').val(name);
							$('#city1').val(city);
				
							$(".list_stk1").css('display','none');
		  				}
		  
   					})
					
					
					
				}
				
				
				
				
				
				
			
          }
        });
      },
      minLength: 1
	  
    });


</script> 

<script type="text/javascript">

$( "#stk2" ).autocomplete({
      source: function(request, response){
        // организуем кроссдоменный запрос
		
		var term=$("#stk2").val();
		//alert(term);
		 
        $.ajax({
          url: "ajax/search_club.php",
		  type: "POST",
		  data: {term : term},
          // обработка успешного выполнения запроса
          success: function(data){
			  var html1="";
			  var data1 = JSON.parse ( data );
			  for (i = 0; i < data1.length; i++) { 
			  
			  	///alert(data1[i]); 
				mas=data1[i].split('-!-');
			  	var id=mas[0];
				var name=mas[1];
				//alert(name);
			   html1=html1+'<option id="'+id+'">'+name+'</option>';
			  
			  }
			  
			  //alert(html1);
			  $('.list_stk2').html(html1);
              var length1=data1.length;
			  if(length1<10){ $(".list_stk2").attr("size", length1);  }
			  if(length1==1){ $(".list_stk2").attr("size", "2"); }
			  $(".list_stk2").css("display","block");
				
				
				var id=$(".list_stk2").children(":selected").attr("id");
  				
				if(id!=undefined){
					
					
					var id=$(".list_stk2").children(":selected").attr("id");
  
   					$.ajax({
          				url: "ajax/search_club_auto.php",
		  				type: "POST",
		  				data: {id : id},
          				// обработка успешного выполнения запроса
          				success: function(data){
			   				var data1 = JSON.parse ( data );
			   				var name=data1[0];
			   				var city=data1[1];
			   
			    			$('#stk2').val(name);
							$('#city2').val(city);
				
							$(".list_stk2").css('display','none');
		  				}
		  
   					})
					
					
					
				}
				
				
				
				
				
				
			
          }
        });
      },
      minLength: 1
	  
    });


</script> 




<script type="text/javascript">

$(".list_stk1").change(function(){
 
  var id=$(this).children(":selected").attr("id");
  
   $.ajax({
          url: "ajax/search_club_auto.php",
		  type: "POST",
		  data: {id : id},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var city=data1[1];
			   
			    $('#stk1').val(name);
				$('#city1').val(city);
				
				$(".list_stk1").css('display','none');
		  }
		  
   })
  
  
});



</script>



<script type="text/javascript">

$(".list_stk2").change(function(){
 
  var id=$(this).children(":selected").attr("id");
  
   $.ajax({
          url: "ajax/search_club_auto.php",
		  type: "POST",
		  data: {id : id},
          // обработка успешного выполнения запроса
          success: function(data){
			   var data1 = JSON.parse ( data );
			   var name=data1[0];
			   var city=data1[1];
			   
			    $('#stk2').val(name);
				$('#city2').val(city);
				
				$(".list_stk2").css('display','none');
		  }
		  
   })
  
  
});



</script>



<script type="text/javascript">
//смена списка доступных групп после смены отделения турнира
$("#curgroup_otd").change(function(){
	
	var id=$("#curgroup_otd :selected").val();//идентификатор выбранного отделения турнира

	//сделать запрос и вытащить список допуcтимых групп (имена и идентификаторы)
	
	$.ajax({
          url: "ajax/groups_otd.php",
		  type: "POST",
		  data: {id : id},
		  async: false,
          // обработка успешного выполнения запроса
          success: function(data){
			  
			  var data_m=data.split("-!-");
			  $('#curgroup').html(data_m[0]);
			  //alert(data);
			  $('.dynamic').html(data_m[1]);
			  
			  
			  
			  var group=$("#curgroup").val();
			  $('.groups_2 > div > span').fadeIn(1);
			  $('.groups_2 .ch_'+group).fadeOut(1);
			  
			  
			  
		  }
		  
   })
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
	var otdel=$("#curgroup_otd :selected").val();//идентификатор отделения
	var group=$("#curgroup").val();//
	
	
	
	
	
group=String(group);



var check_ch = $('.groups_2 :checkbox:checked').size();

if (check_ch > 0)
{
   var num = new Array(check_ch);
 
   var j = 0;
   $('.groups_2 :checkbox:checked').each(function() {
       num[j] = $(this).attr('value');
	   group=group+','+num[j];
	   
       j++;
   });
}



//получить список зарегистрированых участников
//alert(otdel);
//alert(group);

params = { otdel:otdel,group:group }
	$.ajax({
		type: "POST",
		url: "ajax/registration_list.php",
		data: params,
		async: false,
		success: function(data){
			//alert(data+"#1")
			
			if(data=="-"){
				$('.list_participants').html("");
			}else{
			
			var data1 = JSON.parse ( data );
			
			var html2="";
			for (var i in data1) {
				
				
   				
				var html=data1[i];
				
				var html_m=html.split(":");
				
				var html2=html2+'<div class="item"><div class="contaner"><span class="nimber">Номер: '+html_m[0]+'</span></div><div class="contaner"><span class="surname_m">'+html_m[1]+'</span> <span class="name_m">'+html_m[2]+'</span> <span class="date_m">'+html_m[3]+'</span> <span class="kst_m">Kst: '+html_m[4]+'</span> <span class="kla_m">Kla: '+html_m[5]+'</span> <span class="kmn_m">Kmn: '+html_m[6]+'</span> <span class="ctk1_name">'+html_m[13]+'</span> <span class="ctk1_city">'+html_m[14]+'</span> <span class="ctk1_country">'+html_m[15]+'</span></div><div class="contaner"><span class="surname_j">'+html_m[7]+'</span> <span class="name_j">'+html_m[8]+'</span> <span class="date_j">'+html_m[9]+'</span> <span class="kst_j">Kst: '+html_m[10]+'</span> <span class="kla_j">Kla: '+html_m[11]+'</span> <span class="kmn_j">Kmn: '+html_m[12]+'</span> <span class="ctk2_name">'+html_m[16]+'</span> <span class="ctk2_city">'+html_m[17]+'</span> <span class="ctk2_country">'+html_m[18]+'</span></div><div class="contaner"><span class="st1">'+html_m[19]+'</span></div><div class="contaner"><span class="st2">'+html_m[20]+'</span></div><div class="contaner"><span class="st3">'+html_m[21]+'</span></div><div class="contaner"><span class="la1">'+html_m[22]+'</span></div><div class="contaner"><span class="la2">'+html_m[23]+'</span></div><div class="contaner"><span class="la3">'+html_m[24]+'</span></div></div>';
				
				
			}
			
			
			$('.list_participants').html(html2);
			
			}
			
			
			
			
			
		}})







   
   
   
   
	

});
</script>

<script type="text/javascript">
$("#curgroup_type").change(function(){

var type=$("#curgroup_type :selected").val();

if(type=="solo"){
//соло-участие
	$('.solo_hidden').css('display','none');
	$('a#dancer1').css('display','none');
	$('#curgroup_gender').css('display','inline');
	
}else{
//парное участие
	$('.solo_hidden').css('display','table-row');
	$('a#dancer1').css('display','inline');
	$('a#dancer2').css('display','inline');
	$('#curgroup_gender').css('display','none');
}


});
</script>


<script type="text/javascript">
$("#curgroup_gender").change(function(){
var type=$("#curgroup_gender :selected").val();

if(type=="m"){	
//мужчина

	$('.solo_hidden').css('display','none');
	$('a#dancer1').css('display','none');
	$('.solo_hidden2').css('display','table-row');
	
}else{
//женщина
	$('.solo_hidden').css('display','table-row');
	$('a#dancer1').css('display','none');
	$('.solo_hidden2').css('display','none');
	$('a#dancer2').css('display','none');
}
	
	
});
</script>


<!--

<script type="text/javascript">
$("#mkst").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});

$("#mkla").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});


$("#mkmn").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});

$("#fkst").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});

$("#fkla").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});

$("#fkmn").change(function(){
	
if (confirm("Вы хотите сменить класс участнику на тот, который ему не принадлежит. Вы действительно хотите выполнить данную операцию?")) {

} else {
return false;
}

	
	
});
</script>
-->



<?php
}else if($_GET['page']=='turnir'){

?>

	<h2 class="head1">Управление группами, участвующими в турнирах</h2>
<a href="/index.php" class="link1">Перейти на страницу регистрации</a>

<?php


/*
//формирование таблицы со списком отделений
$rs=$mysqli->query('SELECT * FROM `info_turnir` ');
while ($row = $rs->fetch_assoc()){

$id_turnir=$row['id'];
$name_turnir=$row['name'];
$start=$row['start'];
$end=$row['end'];


if($start==$end){
	
//турнир проходит всего один день


	$rs1=$mysqli->query("SELECT * FROM `active_turnir` WHERE id_turnir='".$id_turnir."' AND id_otd='1' AND date='".$start."' ");
	if(mysqli_num_rows($rs1)){	
		//обновление имени турнира
		$rs_insert = $mysqli->query("UPDATE `active_turnir` SET name_turnir='".$name_turnir."' WHERE id_turnir='".$id_turnir."'  ");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
	}else{

	
		$rs_insert = $mysqli->query("INSERT INTO `active_turnir` (id_turnir,id_otd,date,groups,name_turnir) VALUES ('".$id_turnir."','1','".$start."','','".$name_turnir."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}


	}
	

	
}else{
//турнир занимает несколько дней

$count=1;
	
	
	while(true){
		
		
		$rs1=$mysqli->query("SELECT * FROM `active_turnir` WHERE id_turnir='".$id_turnir."' AND id_otd='".$count."' AND date='".$start."' ");
		if(mysqli_num_rows($rs1)){	
			//обновление имени турнира
			$rs_insert = $mysqli->query("UPDATE `active_turnir` SET name_turnir='".$name_turnir."' WHERE id_turnir='".$id_turnir."' ");
			if ($rs_insert===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}
			
		}else{

	
			$rs_insert = $mysqli->query("INSERT INTO `active_turnir` (id_turnir,id_otd,date,groups,name_turnir) VALUES ('".$id_turnir."','".$count."','".$start."','','".$name_turnir."')");
			if ($rs_insert===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}
			$count++;


		}

	//echo $start."<br>";
	
	if($start==$end){break;};
	
	
	//увеличить дату на один день
	$start=date('Y-m-d', strtotime($start) + 60 * 60 * 24);
	
	
	
	}


	
	
}



*/

?>


<!--вывод турниров-->

<?php
$rs=$mysqli->query("SELECT * FROM `active_turnir` ORDER BY date");
while ($row = $rs->fetch_assoc()){

?>

<div class="block1_turnir"  style="position:relative;">
	<div class="col1 col"> 
    	<b>Идентификатор турнира: </b><br><?php  echo $row['id_turnir']; ?>
    </div>


	<div class="col2 col"> 
    	<b>Наименование турнира: </b><br><?php  echo $row['name_turnir']; ?>
    	<?php  
		//получить наименование турнира по идентификатору
		//$rs2=$mysqli->query("SELECT * FROM `info_turnir` WHERE id='".$row['id_turnir']."'");
		//while ($row2 = $rs2->fetch_assoc()){
		//	echo $row2['name'];
		//	break;
		//}
		
		?>
    </div>


    <div class="col3 col">
    	<b>Отделение: </b><br> 
    	<?php  echo $row['id_otd'];  ?>
    </div>


	<div class="col4 col">
    	<b>Дата: </b><br>
    	<?php  echo $row['date'];  ?>
    </div>


	<div class="col5 col">
    	<b>Группы, которые могут принимать участие в отделении турнира: </b><br>
    	<?php
		
		$groups=$row['groups'];
		
		$mas_groups=explode(";",$groups);
		
		
		
		?>
		
		<select id="group_<?php  echo $row['id']; ?>" name="group_<?php  echo $row['id']; ?>" size="10" multiple>
		                
                
		<?php
		$rs3=$mysqli->query("SELECT * FROM `active_categorii`");
		while ($row3 = $rs3->fetch_assoc()){
		?>
			<option <?php    
				
				foreach($mas_groups as $value){
					if($value==$row3['id']){  echo " selected "; break; }
					
				}
		
			
			  ?> value="<?php echo $row3['id']; ?>"><?php echo $row3['name']; ?></option>                    
        <?php
		}
        ?>
        </select>
		<input type="button" value="Сохранить выбор групп" onclick="group_turnir(<?php  echo $row['id']; ?>);" 
        style="position:absolute; top:50px; right:5px;"/>
    </div>






</div>






<?php
}
?>

<!--вывод турниров-->


<script type="text/javascript">

function group_turnir(id){
	

	//var someArray = $('select#group_'+id+'').attr('value') || [];

	//for (i = 0; i < someArray.length; i++) { alert(someArray[i]); }
	var len=document.getElementById('group_'+id+'').length;
    var text="";
	for (i = 0; i < len; i++) {
		if(document.getElementById('group_'+id+'').options[i].selected==true){
			var val = document.getElementById('group_'+id+'').options[i].value;
			text=text+val+";";
		}
	}
	
	
	
	
	
	$.ajax({
          url: "ajax/group_turnur.php",
		  type: "POST",
		  data: {id : id,text : text},
          // обработка успешного выполнения запроса
          success: function(data){
			 alert(data);
		//	 location.reload();
		  }
		  
	})
	
	
	
	
}

</script>


<?php

}else if($_GET['page']=='participants'){

?>

<h2 class="head1">Управление участниками</h2>
<a href="/index.php" class="link1">Перейти на страницу регистрации</a>



<div style="width:100%; margin-bottom:20px;">

Сортировать по: <select id="order_by" name="order_by" style="margin-right:30px;">

<option value="-">-</option>
<option value="surname_m" <?php if($_GET['order_by']=='surname_m'){ echo "selected"; } ?>>Фамилия партнёра</option>
<option value="surname_w" <?php if($_GET['order_by']=='surname_w'){ echo "selected"; } ?>>Фамилия партнёрши</option>
<option value="date_m" <?php if($_GET['order_by']=='date_m'){ echo "selected"; } ?>>Дата рождения партнёра</option>
<option value="date_w" <?php if($_GET['order_by']=='date_w'){ echo "selected"; } ?>>Дата рождения партнёрши</option>
<option value="kst_m" <?php if($_GET['order_by']=='kst_m'){ echo "selected"; } ?>>kst партнёра</option>
<option value="kla_m" <?php if($_GET['order_by']=='kla_m'){ echo "selected"; } ?>>kla партнёра</option>
<option value="kmn_m" <?php if($_GET['order_by']=='kmn_m'){ echo "selected"; } ?>>kmn партнёра</option>
<option value="kst_j" <?php if($_GET['order_by']=='kst_j'){ echo "selected"; } ?>>kst партнёрши</option>
<option value="kla_j" <?php if($_GET['order_by']=='kla_j'){ echo "selected"; } ?>>kla партнёрши</option>
<option value="kmn_j" <?php if($_GET['order_by']=='kmn_j'){ echo "selected"; } ?>>kmn партнёрши</option>
<option value="group" <?php if($_GET['order_by']=='group'){ echo "selected"; } ?>>Группа</option>


</select>  

Направление сортировки:
<select id="direction" name="direction">

<option value="-">-</option>
<option value="asc" <?php if($_GET['direction']=='asc'){ echo "selected"; } ?>>По возрастанию</option>
<option value="desc" <?php if($_GET['direction']=='desc'){ echo "selected"; } ?>>По убыванию</option>

</select>

<input type="button" value="Выполнить" onclick="order();"/>


﻿</div>


<?php

if(isset($_GET['order_by'])){
	
	if($_GET['order_by']=='surname_m'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY surname_m ".$_GET['direction']."");
	}
	if($_GET['order_by']=='surname_w'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY surname_j ".$_GET['direction']."");
	}
	if($_GET['order_by']=='date_m'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY date_m ".$_GET['direction']."");
	}
	if($_GET['order_by']=='date_w'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY date_j ".$_GET['direction']."");
	}
	
	if($_GET['order_by']=='kst_m'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kst_m ".$_GET['direction']."");
	}
	if($_GET['order_by']=='kla_m'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kla_m ".$_GET['direction']."");
	}
	if($_GET['order_by']=='kmn_m'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kmn_m ".$_GET['direction']."");
	}
	
	
	if($_GET['order_by']=='kst_j'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kst_j ".$_GET['direction']."");
	}
	if($_GET['order_by']=='kla_j'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kla_j ".$_GET['direction']."");
	}
	if($_GET['order_by']=='kmn_j'){  
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY kmn_j ".$_GET['direction']."");
	}
	
	
	if($_GET['order_by']=='group'){ 
		
		$rs4=$mysqli->query("SELECT * FROM `active_categorii`");
		while ($row4 = $rs4->fetch_assoc()){
			$id_4=$row4['id'];
			$class_min=$row4['class_min'];
			$rs5=$mysqli->query("UPDATE `active_participants` SET class_min='".$class_min."' WHERE id_group='".$id_4."' ");
			
		}
		
		
		$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY class_min ".$_GET['direction']."");
		
		
	}
	
	
	
	
	
}else{

$rs3=$mysqli->query("SELECT * FROM `active_participants` ORDER BY id DESC");

}



while ($row3 = $rs3->fetch_assoc()){
?>

<div class="container_partner" id="container_partner_<?php echo $row3['id']; ?>" style="position:relative; height: 0px;
    overflow: hidden;
    padding-bottom: 0px;
    padding-top: 32px;">



<input type="button" value="Сохранить" class="button_save" onclick="save_participant(<?php echo $row3['id']; ?>)" style="position:absolute; right:10px; top:30px; display:none;"/>
<input type="button" value="Удалить" onclick="delete_participant(<?php echo $row3['id']; ?>)" style="position:absolute; right:10px; top:65px;"/>

<input type="text" style="width:300px;" id="number_<?php echo $row3['id']; ?>" name="number_<?php echo $row3['id']; ?>" value="<?php echo $row3['number']; ?>"/><br><br>
<b><?php  if($row3['type']=="solo"){  echo"Участник:"; }else{ echo"Партнёр:";} ?></b><br><br>
<input type="text" id="surname_m_<?php echo $row3['id']; ?>" name="surname_m_<?php echo $row3['id']; ?>" value="<?php echo $row3['surname_m']; ?>" style="width:200px;"/>
<input type="text" id="name_m_<?php echo $row3['id']; ?>" name="name_m_<?php echo $row3['id']; ?>" value="<?php echo $row3['name_m']; ?>" style="width:200px;"/><br><br>
<input type="date" id="date_m_<?php echo $row3['id']; ?>" name="date_m_<?php echo $row3['id']; ?>" value="<?php echo $row3['date_m']; ?>"/><br><br>
<?php
$id_kst_m=$row3['kst_m'];
$id_kla_m=$row3['kla_m'];
$id_kmn_m=$row3['kmn_m'];

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kst_m."'");
while ($row_k = $rs_k->fetch_assoc()){
$kst_m=$row_k['name'];
echo"K<sup>st</sup>";
?>

<select id="kst_m_<?php echo $row3['id']; ?>" name="kst_m_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kst_m==$row['id']){ echo "selected";  $kst_m=$row['name'];  } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
<?php
}
?>

</select><br>


<?php
break;
}

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kla_m."'");
while ($row_k = $rs_k->fetch_assoc()){
$kla_m=$row_k['name'];
echo "K<sup>la</sup>";
?>

<select id="kla_m_<?php echo $row3['id']; ?>" name="kla_m_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kla_m==$row['id']){ echo "selected"; $kla_m=$row['name']; } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name'];   ?></option>
    
    
<?php
}
?>

</select><br>


<?php
break;
}

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kmn_m."'");
while ($row_k = $rs_k->fetch_assoc()){
$kmn_m=$row_k['name'];
echo "K<sup>mn</sup>";
?>

<select id="kmn_m_<?php echo $row3['id']; ?>" name="kmn_m_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kmn_m==$row['id']){ echo "selected"; $kmn_m=$row['name']; } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name'];  ?></option>
    
    
<?php
}
?>

</select><br><br>



<?php
break;
}

?>



<input type="text" name="ctk1_name_<?php echo $row3['id']; ?>" id="ctk1_name_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk1_name']; ?>" style="width:200px;"/><br><br>
<input type="text" name="ctk1_city_<?php echo $row3['id']; ?>" id="ctk1_city_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk1_city']; ?>" style="width:200px;"/><br><br>
<input type="text" name="ctk1_country_<?php echo $row3['id']; ?>" id="ctk1_country_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk1_country']; ?>" style="width:200px;"/><br><br>


<?php
if($row3['type']=="solo"){
}else{
?>

<b>Партнёрша:</b><br><br>
<input type="text" name="surname_j_<?php echo $row3['id']; ?>" id="surname_j_<?php echo $row3['id']; ?>" value="<?php echo $row3['surname_j']; ?>" style="width:200px;"/>  
<input type="text" name="name_j_<?php echo $row3['id']; ?>" id="name_j_<?php echo $row3['id']; ?>" value="<?php echo $row3['name_j']; ?>" style="width:200px;"/><br><br>
<input type="date" name="date_j_<?php echo $row3['id']; ?>" id="date_j_<?php echo $row3['id']; ?>" value="<?php echo $row3['date_j']; ?>" style="width:200px;"/><br><br>
<?php
$id_kst_j=$row3['kst_j'];
$id_kla_j=$row3['kla_j'];
$id_kmn_j=$row3['kmn_j'];

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kst_j."'");
while ($row_k = $rs_k->fetch_assoc()){
$kst_j=$row_k['name'];
echo"K<sup>st</sup>";


?>

<select id="kst_j_<?php echo $row3['id']; ?>" name="kst_j_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kst_j==$row['id']){ echo "selected"; $kst_j=$row['name']; } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name'];   ?></option>
    
    
<?php
}
?>

</select><br>



<?php


break;
}

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kla_j."'");
while ($row_k = $rs_k->fetch_assoc()){
$kla_j=$row_k['name'];
echo "K<sup>la</sup>";


?>

<select id="kla_j_<?php echo $row3['id']; ?>" name="kla_j_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kla_j==$row['id']){ echo "selected"; $kla_j=$row['name']; } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name'];  ?></option>
    
    
<?php
}
?>

</select><br>



<?php


break;
}

$rs_k=$mysqli->query("SELECT * FROM `info_k` WHERE id='".$id_kmn_j."'");
while ($row_k = $rs_k->fetch_assoc()){
$kmn_j=$row_k['name'];
echo "K<sup>mn</sup>";


?>

<select id="kmn_j_<?php echo $row3['id']; ?>" name="kmn_j_<?php echo $row3['id']; ?>">﻿
<option value="-">-</option>
<?php
	$rs=$mysqli->query('SELECT * FROM `info_k`');
	while ($row = $rs->fetch_assoc()){
?>                                
    
	<option <?php if($id_kmn_j==$row['id']){ echo "selected"; $kmn_j=$row['name']; } ?> value="<?php echo $row['id'];  ?>"><?php echo $row['name']; ?></option>
    
    
<?php
}
?>

</select><br><br>



<?php



break;
}

?>
<input type="text" name="ctk2_name_<?php echo $row3['id']; ?>" id="ctk2_name_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk2_name']; ?>" style="width:200px;"/><br><br>
<input type="text" name="ctk2_city_<?php echo $row3['id']; ?>" id="ctk2_city_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk2_city']; ?>" style="width:200px;"/><br><br>
<input type="text" name="ctk2_country_<?php echo $row3['id']; ?>" id="ctk2_country_<?php echo $row3['id']; ?>" value="<?php echo $row3['ctk2_country']; ?>" style="width:200px;"/><br><br>

<?php
}
?>

<b>Тренеры:</b><br><br>
<input type="text" name="st1_<?php echo $row3['id']; ?>" id="st1_<?php echo $row3['id']; ?>" value="<?php echo $row3['st1']; ?>" style="width:200px;"/><br><br>
<input type="text" name="st2_<?php echo $row3['id']; ?>" id="st2_<?php echo $row3['id']; ?>" value="<?php echo $row3['st2']; ?>" style="width:200px;"/><br><br>
<input type="text" name="st3_<?php echo $row3['id']; ?>" id="st3_<?php echo $row3['id']; ?>" value="<?php echo $row3['st3']; ?>" style="width:200px;"/><br><br>




<?php
$id_group=$row3['id_group'];
$rs_group=$mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$id_group."'");
while ($row_group = $rs_group->fetch_assoc()){
	//echo $row_group['name'];
?>
Переместить в группу: 	
<select id="curgroup_<?php echo $row3['id']; ?>" name="curgroup_<?php echo $row3['id']; ?>">
<?php
$rs_curgroup=$mysqli->query('SELECT * FROM `active_categorii`');
while ($row_curgroup = $rs_curgroup->fetch_assoc()){
?>
                    
<option <?php if($row_curgroup['id']==$id_group){ echo"selected"; $curgroup1=$row_curgroup['name']; }  ?> value="<?php echo $row_curgroup['id']; ?>"><?php echo $row_curgroup['name']; ?></option>                    
                
					
<?php
}
?>                    
                        
</select>	

<input type="button" value="Выполнить" onclick="save_participant_group(<?php echo $row3['id']; ?>)" style="margin-left:5px; margin-right:20px;"/>


	
<?php	
	//наименование группы
	break;
}
?>













<?php
$id_group=$row3['id_group'];
$rs_group=$mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$id_group."'");
while ($row_group = $rs_group->fetch_assoc()){
	//echo $row_group['name'];
?>
Копировать в группу: 	
<select id="curgroup2_<?php echo $row3['id']; ?>" name="curgroup2_<?php echo $row3['id']; ?>">
<?php
$rs_curgroup=$mysqli->query('SELECT * FROM `active_categorii`');
while ($row_curgroup = $rs_curgroup->fetch_assoc()){
?>
                    
<option <?php if($row_curgroup['id']==$id_group){ echo"selected"; }  ?> value="<?php echo $row_curgroup['id']; ?>"><?php echo $row_curgroup['name'];  ?></option>                    
                
					
<?php
}
?>                    
                        
</select>	

<input type="button" value="Выполнить" onclick="save_participant_group_copy(<?php echo $row3['id']; ?>)" style="margin-left:5px; margin-right:20px;"/>


	
<?php	
	//наименование группы
	break;
}
?>
















<?php

$rs_1=$mysqli->query("SELECT * FROM `active_turnir_participants` WHERE id_participant='".$row3['id']."'");
while ($row_1 = $rs_1->fetch_assoc()){
	$id_otdelenie=$row_1['id_otdelenie'];//идентификатор отделения, в котором будет участвовать пара/солист
	break;
}


$rs_1=$mysqli->query("SELECT * FROM `active_turnir` WHERE id='".$id_otdelenie."'");
while ($row_1 = $rs_1->fetch_assoc()){

$id_turnir=$row_1['id_turnir'];
$id_otd=$row_1['id_otd'];
$date=$row_1['date'];

break;

}




$rs_1=$mysqli->query("SELECT * FROM `info_turnir` WHERE id='".$id_turnir."'");
while ($row_1 = $rs_1->fetch_assoc()){
//echo $row_1['name']."<br>";//наименование турнира
?>






<?php
break;
}

//echo "Отделение: ".$id_otd."<br>";
//echo "Дата отделения:".$date."<br>";



//вывести турнир - дату - отделение
?>

<select id="curgroup_otd_<?php echo $row3['id']; ?>" class="tmp1" name="curgroup_otd_<?php echo $row3['id']; ?>">
					<?php
					$rs_curgroup_otd=$mysqli->query('SELECT * FROM `active_turnir` ORDER BY date');
					while ($row_curgroup_otd = $rs_curgroup_otd->fetch_assoc()){
					?>
						<option  <?php if($id_otdelenie==$row_curgroup_otd['id']){ echo "selected"; } ?> value="<?php echo $row_curgroup_otd['id']; ?>"><?php 
						
						//echo $row['name'];  
						//$id_turnir1=$row_curgroup_otd['id_turnir'];
						//$rs2_curgroup_otd=$mysqli->query("SELECT * FROM `info_turnir` WHERE id='".$id_turnir1."'");
						//while ($row2_curgroup_otd = $rs2_curgroup_otd->fetch_assoc()){
							echo $row_curgroup_otd['name_turnir']."  ::  ".$row_curgroup_otd['date']."  ::  Отделение ".$row_curgroup_otd['id_otd'];
						//	break;
						//}
						
						?></option>                    
                    <?php
					}
					?>                    
                        
</select>








<script type="text/javascript">


function save_participant_group_copy(id){
	
var group_id=$('#curgroup2_'+id+' :selected').val();




	$.ajax({
          url: "ajax/save_participant_group_copy.php",
		  type: "POST",
		  data: {id:id,group_id:group_id},
          // обработка успешного выполнения запроса
          success: function(data){
	
			alert(data);
			window.location.reload();
		
		  }
		  
	})	
	
}






function save_participant_group(id){
	
var group_id=$('#curgroup_'+id).val();

	$.ajax({
          url: "ajax/save_participant_group.php",
		  type: "POST",
		  data: {id:id,group_id:group_id},
          // обработка успешного выполнения запроса
          success: function(data){
	
			alert(data);
			
		
		  }
		  
	})	
	
}





function delete_participant(id){


if (confirm("Вы действительно хотите удалить участника ?")) {


	$.ajax({
          url: "ajax/delete_participant.php",
		  type: "POST",
		  data: {id:id},
          // обработка успешного выполнения запроса
          success: function(data){
	
			alert(data);
			window.location.reload();
		
		  }
		  
	})





} else {
	



}




}

</script>

<script type="text/javascript">
function save_participant(id){


var number=$('#number_'+id).val();
var surname_m=$('#surname_m_'+id).val();
var name_m=$('#name_m_'+id).val();
var date_m=$('#date_m_'+id).val();
var kst_m=$('#kst_m_'+id).val();
var kla_m=$('#kla_m_'+id).val();
var kmn_m=$('#kmn_m_'+id).val();
var ctk1_name=$('#ctk1_name_'+id).val();
var ctk1_city=$('#ctk1_city_'+id).val();
var ctk1_country=$('#ctk1_country_'+id).val();
var surname_j=$('#surname_j_'+id).val();
var name_j=$('#name_j_'+id).val();
var date_j=$('#date_j_'+id).val();
var kst_j=$('#kst_j_'+id).val();
var kla_j=$('#kla_j_'+id).val();
var kmn_j=$('#kmn_j_'+id).val();
var ctk2_name=$('#ctk2_name_'+id).val();
var ctk2_city=$('#ctk2_city_'+id).val();
var ctk2_country=$('#ctk2_country_'+id).val();
var st1=$('#st1_'+id).val();
var st2=$('#st2_'+id).val();
var st3=$('#st3_'+id).val();
var curgroup=$('#curgroup_'+id).val();
var curgroup_otd=$('#curgroup_otd_'+id).val();

/*
alert("number- "+number);
alert("surname_m- "+surname_m);
alert("name_m- "+name_m);
alert("date_m- "+date_m);
alert("kst_m- "+kst_m);
alert("kla_m- "+kla_m);
alert("kmn_m- "+kmn_m);
alert("ctk1_name- "+ctk1_name);
alert("ctk1_city- "+ctk1_city);
alert("ctk1_country- "+ctk1_country);
alert("surname_j- "+surname_j);
alert("name_j- "+name_j);
alert("date_j- "+date_j);
alert("kst_j- "+kst_j);
alert("kla_j- "+kla_j);
alert("kmn_j- "+kmn_j);
alert("ctk2_name- "+ctk2_name);
alert("ctk2_city- "+ctk2_city);
alert("ctk2_country- "+ctk2_country);
alert("st1- "+st1);
alert("st2- "+st2);
alert("st3- "+st3);
alert("curgroup- "+curgroup);
alert("curgroup_otd- "+curgroup_otd);
*/




	$.ajax({
          url: "ajax/save_participant.php",
		  type: "POST",
		  data: {id:id,number:number,surname_m:surname_m,name_m:name_m,date_m:date_m,kst_m:kst_m,kla_m:kla_m,kmn_m:kmn_m,ctk1_name:ctk1_name,ctk1_city:ctk1_city,ctk1_country:ctk1_country,surname_j:surname_j,name_j:name_j,date_j:date_j,kst_j:kst_j,kla_j:kla_j,kmn_j:kmn_j,ctk2_name:ctk2_name,ctk2_city:ctk2_city,ctk2_country:ctk2_country,st1:st1,st2:st2,st3:st3,curgroup:curgroup,curgroup_otd:curgroup_otd},
          // обработка успешного выполнения запроса
          success: function(data){
			alert(data);
		
		
		//	$('.button_reg_access_'+id).val('Разрешить регистрацию в этой группе');
		//	$('.button_reg_access_'+id).attr("onClick","reg_access_y("+id+")");
		  }
		  
	})

	
}


</script>





<div style="width:100%; position:absolute; top:5px; left:5px;">
<span style="margin-left:10px; margin-right:10px; width:20px; display:inline-block;"><?php echo $row3['number']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:100px; display:inline-block;"><?php echo $row3['surname_m']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:100px; display:inline-block;"><?php echo $row3['name_m']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:80px; display:inline-block;"><?php echo $row3['date_m']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kst_m; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kla_m; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kmn_m; ?></span>
<span style="margin-left:10px; margin-right:10px; width:100px; display:inline-block;"><?php echo $row3['surname_j']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:100px; display:inline-block;"><?php echo $row3['name_j']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:80px; display:inline-block;"><?php echo $row3['date_j']; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kst_j; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kla_j; ?></span>
<span style="margin-left:10px; margin-right:10px; width:30px; display:inline-block;"><?php echo $kmn_j; ?></span>
<span style="margin-left:10px; margin-right:10px; width:100px; display:inline-block;"><?php echo $curgroup1; ?></span>



<span style="cursor:pointer; margin-left:5px; text-decoration:underline;" class="spoiler" onclick="spoiler(<?php echo $row3['id']; ?>);">Развернуть</span>

</div>


</div>













<?php
}
?>



<script type="text/javascript">
function spoiler(id){
	
if($('#container_partner_'+id+' .button_save').css('display')=="none"){
	//разворачивание
	
	$('#container_partner_'+id+' .button_save').css('display','block');
	$('#container_partner_'+id+' .spoiler').html('Свернуть');
	$('#container_partner_'+id+'').animate({'height':'980px'},500);
	$('#container_partner_'+id+'').animate({'padding-top':'40px'},500);
	
	
	
	
}else{
	//сворачивание
	
	$('#container_partner_'+id+' .button_save').css('display','none');
	$('#container_partner_'+id+' .spoiler').html('Развернуть');
	$('#container_partner_'+id+'').animate({'height':'0px'},500);
	$('#container_partner_'+id+'').animate({'padding-top':'32px'},500);
	
	
	
}
	
	
}
</script>



<script type="text/javascript">
function order(){

var order_by=$('#order_by').val();
var direction=$('#direction').val();

if(order_by=="-"){ return false; };
if(direction=="-"){ return false; };


window.location.href="/index.php?page=participants&order_by="+order_by+"&direction="+direction+"";



}
</script>



<?php
}else if($_GET['page']=='reg-group'){
?>


<h2 class="head1">Управление разрешением регистрации в группах</h2>
<a class="link1" href="/index.php">Перейти на страницу регистрации</a>
	
<?php	






$rs_1=$mysqli->query("SELECT * FROM `active_categorii`");
while ($row_1 = $rs_1->fetch_assoc()){	
?>

<p><span style="width:200px; display:inline-block"><?php echo $row_1['name'];  ?></span><input type="button" class="button_reg_access_<?php echo $row_1['id'];  ?>" value="<?php 

$rs_2=$mysqli->query("SELECT * FROM `active_reg_access_closed` WHERE id_group='".$row_1['id']."'");
if(mysqli_num_rows($rs_2)){
echo"Разрешить регистрацию в этой группе";
}else{
echo"Запретить регистрацию в этой группе";	
}

 ?>" 
onclick="reg_access_<?php if(mysqli_num_rows($rs_2)){ echo"y"; }else{ echo"n"; }  ?>(<?php echo $row_1['id'];  ?>)"/></span></p>

<?php	
}
?>

  
<script type="text/javascript">
function reg_access_n(id){
	
	$.ajax({
          url: "ajax/reg_access_closed.php",
		  type: "POST",
		  data: {id : id},
          // обработка успешного выполнения запроса
          success: function(data){
			alert(data);
			$('.button_reg_access_'+id).val('Разрешить регистрацию в этой группе');
			$('.button_reg_access_'+id).attr("onClick","reg_access_y("+id+")");
		  }
		  
	})
	
	
}
</script>  
  
<script type="text/javascript">
function reg_access_y(id){
	
	$.ajax({
          url: "ajax/reg_access_closed_y.php",
		  type: "POST",
		  data: {id : id},
          // обработка успешного выполнения запроса
          success: function(data){
			alert(data);
			$('.button_reg_access_'+id).val('Запретить регистрацию в этой группе');
			$('.button_reg_access_'+id).attr("onClick","reg_access_n("+id+")");
		  }
		  
	})
	
	
}
</script> 





    
    
<?php	
}else if($_GET['page']=='classes'){

?>


<div class="fix_block" style="display:none; position:fixed; top:10px; left:10px; width:40px; height:40px; background-color:blue; z-index:99999;">

</div>


<div class="fix_block2" style="display:none; position:fixed; top:10px; left:10px; width:40px; height:40px; background-color:green; color:#fff; z-index:99999;">

</div>


<h2 class="head1">Управление классами участников</h2>
<a class="link1" href="/index.php">Перейти на страницу регистрации</a>



<?php
//вывести пары

$rs_1=$mysqli->query("SELECT * FROM `info_dancer_m` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_m=$row_1['id'];
$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	
	$id_w=$row_2['id_w'];//идентификатор партнёрши 
	$cnt1=1;	
}

if($cnt1==0){ continue; }


?>

<div class="classes">
<span class="id"><?php //echo $row_1['id']; ?></span>
<span class="name"><?php echo $row_1['sname']." ".$row_1['name']; ?></span>
<span class="date"><?php echo $row_1['date']; ?></span>

<?php



$rs_3=$mysqli->query("SELECT * FROM `info_dancer_w` WHERE id='".$id_w."'");
while ($row_3 = $rs_3->fetch_assoc()){	
	
?>
<span class="name2"><?php echo $row_3['sname']." ".$row_3['name']; ?></span>
<span class="date2"><?php echo $row_3['date']; ?></span>
<?php
$year_w=$row_3['date'];
$kstw=$row_3['kst'];
$klaw=$row_3['kla'];
$kmnw=$row_3['kmn'];

}
?>

<?php
//сколько лет участнику

$years=date('Y-m-d')-$row_1['date'];//возраст партнёра
$years_w=date('Y-m-d')-$year_w;//возраст партнёрши


//echo $years;
if($years_w>$years){
	$years_r=$years_w;//возраст старшего партнёра
}else{
	$years_r=$years;//возраст старшего партнёра
}



?>


Классы группы (выводятся классы старшего партнёра)<br>
<div style="float:right; width:100%; text-align:right;">
<span class="kst kst_<?php echo $id_m; ?>">
kst
<span id="spanm_<?php echo $id_m; ?>" style="display:none;"><?php echo $id_w; ?></span>
<select id="mkst_<?php echo $id_m; ?>" name="mkst_<?php echo $id_m; ?>" class="para">﻿
	<option value="-">-</option>
    
    <?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
		
		//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years_r<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years_r<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years_r<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years_r<16 ){ continue; }
		}
		
		
		
		
		
		
		
		
	?>                                
    <?php
    if($years_w>$years){
	?>
    
    <option value="<?php echo $row['id'];  ?>"  <?php  if($kstw==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    <?php
	}else{
	?>
    
    <option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kst']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
	<?php
    }
    ?>
    
	
    
    <?php
		}
	?>
</select>
</span>

<span class="kla">
kla

<select id="mkla_<?php echo $id_m; ?>" name="mkla_<?php echo $id_m; ?>" class="para">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years_r<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years_r<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years_r<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years_r<16 ){ continue; }
		}
		
		
	?>                                
    
    
    
    <?php
    if($years_w>$years){
	?>
    
    <option value="<?php echo $row['id'];  ?>"  <?php  if($klaw==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    <?php
	}else{
	?>
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kla']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    <?php
	}
	?>
    
    
    
    
    
    
    <?php
		}
	?>
</select>
</span>

<span class="kmn">
kmn
<select id="mkmn_<?php echo $id_m; ?>" name="mkmn_<?php echo $id_m; ?>" class="para">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years_r<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years_r<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years_r<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years_r<16 ){ continue; }
		}
		
		
	?> 
    
    
    <?php
    if($years_w>$years){
	?>
    
    <option value="<?php echo $row['id'];  ?>"  <?php  if($kmnw==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    <?php
	}else{
	?>
    
                                   
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kmn']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    <?php
	}
	?>
	
    
    
    
    
    
    
    <?php
		}
	?>
</select>
</span>
<span style="cursor:pointer; margin-left:5px;" onclick="save_classes_para(<?php echo $id_m;  ?>,<?php echo $id_w;  ?>)">Сохранить</span> 
</div>
<br><br> 
 

</div>

<?php
}
?>













<?php
//вывести одиночек-мужчин

$rs_1=$mysqli->query("SELECT * FROM `info_dancer_m` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_m=$row_1['id'];
$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	
	$id_w=$row_2['id_w'];//идентификатор партнёрши 
	$cnt1=1;	
}

if($cnt1==1){ continue; }


?>

<div class="classes">
<span class="id"><?php //echo $row_1['id']; ?></span>
<span class="name"><?php echo $row_1['sname']." ".$row_1['name']; ?></span>
<span class="date"><?php echo $row_1['date']; ?></span>

<?php




?>
<span class="name2"><?php //echo $row_3['sname']." ".$row_3['name']; ?></span>
<span class="date2"><?php //echo $row_3['date']; ?></span>

<?php
//сколько лет участнику

$years=date('Y-m-d')-$row_1['date'];
//echo $years;



?>



<span class="kst kst_<?php echo $id_m; ?>">
kst
<select id="mkst_<?php echo $id_m; ?>" name="mkst_<?php echo $id_m; ?>" class="m">﻿
	<option value="-">-</option>
    
    <?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kst']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="kla">
kla
<select id="mkla_<?php echo $id_m; ?>" name="mkla_<?php echo $id_m; ?>" class="m">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kla']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="kmn">
kmn
<select id="mkmn_<?php echo $id_m; ?>" name="mkmn_<?php echo $id_m; ?>" class="m">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kmn']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>
 <span style="cursor:pointer; margin-left:5px;" onclick="save_classes_m(<?php echo $id_m;  ?>)">Сохранить</span> 
 
 

</div>

<?php
}
?>

















<?php
//вывести одиночек-женщин

$rs_1=$mysqli->query("SELECT * FROM `info_dancer_w` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_w=$row_1['id'];
$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_w='".$id_w."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	
	$id_m=$row_2['id_w'];//идентификатор партнёра 
	$cnt1=1;	
}

if($cnt1==1){ continue; }


?>

<div class="classes">
<span class="id"><?php //echo $row_1['id']; ?></span>
<span class="name"><?php echo $row_1['sname']." ".$row_1['name']; ?></span>
<span class="date"><?php echo $row_1['date']; ?></span>

<?php




?>
<span class="name2"><?php //echo $row_3['sname']." ".$row_3['name']; ?></span>
<span class="date2"><?php //echo $row_3['date']; ?></span>


<?php
//сколько лет участнику

$years=date('Y-m-d')-$row_1['date'];
//echo $years;



?>


<span class="kst kst_<?php echo $id_w; ?>">
kst
<select id="wkst_<?php echo $id_w; ?>" name="wkst_<?php echo $id_w; ?>" class="w">﻿
	<option value="-">-</option>
    
    <?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kst']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="kla">
kla
<select id="wkla_<?php echo $id_w; ?>" name="wkla_<?php echo $id_w; ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			
				//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kla']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="kmn">
kmn
<select id="wkmn_<?php echo $id_w; ?>" name="wkmn_<?php echo $id_w; ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs=$mysqli->query('SELECT * FROM `info_k`');
		while ($row = $rs->fetch_assoc()){
			
			//проверка на попадание по возрасту
			
		if($row['name']=="C"){
			if(	$years<11 ){ continue; }
		}
		
		if($row['name']=="B"){
			if(	$years<12 ){ continue; }
		}
		
		if($row['name']=="A"){
			if(	$years<14 ){ continue; }
		}
		
		if(($row['name']=="S")||($row['name']=="I")){
			if(	$years<16 ){ continue; }
		}
		
		
	?>                                
    
	<option value="<?php echo $row['id'];  ?>"  <?php  if($row_1['kmn']==$row['id']){ echo "selected"; } ?>><?php echo $row['name']; ?></option>
    
    
    <?php
		}
	?>
</select>
</span>
 
<span style="cursor:pointer; margin-left:5px;" onclick="save_classes_w(<?php echo $id_w;  ?>)">Сохранить</span> 
 
 
</div>

<?php
}
?>

<script type="text/javascript">
function save_classes_para(id_m,id_w){

var kst=$("#mkst_"+id_m).val();
var kla=$("#mkla_"+id_m).val();
var kmn=$("#mkmn_"+id_m).val();
	
//alert(kst+" "+kla+" "+kmn);
	
	$.ajax({
          url: "ajax/save_classes_para.php",
		  type: "POST",
		  data: {id_m:id_m,id_w:id_w,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(1);
			
			$(".fix_block").fadeOut(1);
		  }
		  
	})	
	
	
}

function save_classes_m(id_m){

var kst=$("#mkst_"+id_m).val();
var kla=$("#mkla_"+id_m).val();
var kmn=$("#mkmn_"+id_m).val();

	
	$.ajax({
          url: "ajax/save_classes_m.php",
		  type: "POST",
		  data: {id_m:id_m,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(1);
			
			$(".fix_block").fadeOut(1);
		  }
		  
	})
	
}

function save_classes_w(id_w){

var kst=$("#wkst_"+id_w).val();
var kla=$("#wkla_"+id_w).val();
var kmn=$("#wkmn_"+id_w).val();

	//alert(id_w+" = "+kst+" - "+kla+" - "+kmn);
	
	
	
	$.ajax({
          url: "ajax/save_classes_w.php",
		  type: "POST",
		  data: {id_w:id_w,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(1);
			
			$(".fix_block").fadeOut(1);
		  }
		  
	})
	
}

</script>



<script type="text/javascript">
$(document).ready(function(){

function sec() {

//alert("прошла секунда");


$('select').each(function(i,elem) {
	var	id1=this.id;
    var m1=id1.split("_");	
	var id2=m1[1];
		
	
	
		
	
	
	var class1=$(this).attr('class');
	
	
	
	//alert(class1);
	
	//if(class1=="w"){ alert("111");  }
	
	
	
	

	
	
	
	if(class1=="para"){
		
		
		var kst=$("#mkst_"+id2).val();	
		var kla=$("#mkla_"+id2).val();
		var kmn=$("#mkmn_"+id2).val();

		var id_w=$('#spanm_'+id2).html();
	
		//alert(class1+" + "+kst+" + "+kla+" + "+kmn+" + "+id2+" + "+id_w);
		$.ajax({
          url: "ajax/save_classes_para.php",
		  type: "POST",
		  data: {id_m:id2,id_w:id_w,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(50);
			
			$(".fix_block").fadeOut(50);
		  }
		  
		})
	
		
	}else if(class1=="m"){
		var kst=$("#mkst_"+id2).val();	
		var kla=$("#mkla_"+id2).val();
		var kmn=$("#mkmn_"+id2).val();

		
		//alert(class1+" "+kst+" "+kla+" "+kmn+" "+id2);
		$.ajax({
          url: "ajax/save_classes_m.php",
		  type: "POST",
		  data: {id_m:id2,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(50);
			
			$(".fix_block").fadeOut(50);
		  }
		  
		})
	
		
		
	}else{
	
	//alert(id2);
		var kst=$("#wkst_"+id2).val();
		var kla=$("#wkla_"+id2).val();
		var kmn=$("#wkmn_"+id2).val();
		
		
		//alert(class1+" "+kst+" "+kla+" "+kmn+" "+id2);
		
		return false;
		$.ajax({
          url: "ajax/save_classes_w.php",
		  type: "POST",
		  data: {id_w:id2,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			//alert(data);
			$(".fix_block").fadeIn(50);
			
			$(".fix_block").fadeOut(50);
		  }
		  
		})
	
		
		
	}
	
	//return false;
	
	

	/*$.ajax({
          url: "ajax/save_classes_w.php",
		  type: "POST",
		  data: {id_w:id_w,kst:kst,kla:kla,kmn:kmn},
          // обработка успешного выполнения запроса
          success: function(data){
			alert(data);
			
		  }
		  
	})*/




});


//alert("прошла секунда1");


}

setInterval(sec, 900000) 



});
</script>



<script type="text/javascript">
$(document).ready(function(){

/*
$('select').each(function(i,elem) {


var	id1=this.id;
var size=$("select[id="+id1+"] option").size();
//генерация случайного числа

//var random1=Math.floor( Math.random( ) * (size+1) );

var random1=Math.floor( Math.random( ) * (size - 1 + 1) ) + 1

$('select[id='+id1+'] option').eq(random1).prop('selected', true);

//$(".fix_block2").fadeIn(50);
//$(".fix_block2").html(id1+" "+size);			
//$(".fix_block2").fadeOut(50);




})

*/

});
</script>





<?php

}else if($_GET['page']=="categorii"){

?>

<h2 class="head1">Управление категориями</h2>
<a class="link1" href="/index.php">Перейти на страницу регистрации</a>

<?php
$rs=$mysqli->query('SELECT * FROM `info_categorii`');
while ($row = $rs->fetch_assoc()){

$id=$row['id'];
$name=$row['name'];	

	$rs2=$mysqli->query('SELECT * FROM `active_categorii` WHERE id_info="'.$id.'"');
	if(mysqli_num_rows($rs2)){
		
	}else{
		$rs3=$mysqli->query('INSERT INTO `active_categorii` (name,id_info) VALUES ("'.$name.'","'.$id.'")');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
			
	}
	
	
	
}
		

?>


<?php

$rs=$mysqli->query('SELECT * FROM `active_categorii`');
while ($row = $rs->fetch_assoc()){
	
?>

<div class="classes">

<input type="text" value="<?php echo $row['name']; ?>" class="name" id="name_<?php echo $row['id']; ?>"/>

<span class="class_min">
Минимальный класс: 
<select id="class_min_<?php echo $row['id']; ?>" name="class_min_<?php echo $row['id']; ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs2=$mysqli->query('SELECT * FROM `info_k`');
		while ($row2 = $rs2->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row2['id']; ?>"  <?php  if($row['class_min']==$row2['id']){ echo "selected"; } ?>><?php 
	
	echo $row2['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="class_max">
Максимальный класс: 
<select id="class_max_<?php echo $row['id']; ?>" name="class_max_<?php echo $row['id']; ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs2=$mysqli->query('SELECT * FROM `info_k`');
		while ($row2 = $rs2->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row2['id']; ?>"  <?php  if($row['class_max']==$row2['id']){ echo "selected"; } ?>><?php 
	
	echo $row2['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
</select>
</span>

<span class="years_min">
Минимальный возраст: 
<input type="text" class="years_min" id="years_min_<?php echo $row['id']; ?>" value="<?php echo $row["years_min"]; ?>"/>
</span>


<span class="years_max">
Максимальный возраст:
<input type="text" class="years_max" id="years_max_<?php echo $row['id']; ?>" value="<?php echo $row["years_max"]; ?>"/>
</span>



<input type="button" value="Сохранить" onclick="active_categorii_save(<?php  echo $row['id']; ?>);"/>


</div>

<?php
}
?>


<script type="text/javascript">

function active_categorii_save(id){

var name=$('#name_'+id).val();
var class_min=$('#class_min_'+id).val();
var class_max=$('#class_max_'+id).val();
var years_min=$('#years_min_'+id).val();
var years_max=$('#years_max_'+id).val();

/*
alert(name);
alert(class_min);
alert(class_max);
alert(years_min);
alert(years_max);
*/

if((years_max=="")||(years_max==undefined)){ years_max=99; }

//alert(years_max);

		$.ajax({
          url: "ajax/active_categorii_save.php",
		  type: "POST",
		  data: {id:id,name:name,class_min:class_min,class_max:class_max,years_min:years_min,years_max:years_max},
          // обработка успешного выполнения запроса
          success: function(data){
			alert(data);
			
		  }
		  
		})



	
}


</script>








<?php
}else if($_GET['page']=="categorii-dancer"){
?>
<h2 class="head1">Управление принадлежностью участников к категории</h2>
<a class="link1" href="/index.php">Перейти на страницу регистрации</a>

<div class="fixed_green" style="width:50px; height:50px; background-color:green; position:fixed; top:10px; left:10px; z-index:999999; display:none;"></div>


<?php
//формирование таблиц
//формирование таблицы пар


$rs_1=$mysqli->query("SELECT * FROM `info_dancer_m` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_m=$row_1['id'];



$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	

	$id_w=$row_2['id_w'];//идентификатор партнёрши 

	$cnt1=1;	
}

if($cnt1==1){

	$rs_3=$mysqli->query("SELECT * FROM `active_categorii_dancer_para` WHERE id_dancer_m='".$id_m."' AND id_dancer_w='".$id_w."' ");
	if(mysqli_num_rows($rs_3)){
			
		
	}else{
	
		$rs_4=$mysqli->query("INSERT INTO `active_categorii_dancer_para` (id_dancer_m,id_dancer_w) VALUES ('".$id_m."','".$id_w."')");
		if ($rs_4===false) {
			printf("Ошибка #21: %s\n", $mysqli->error);
		}
		
		
	}



	
}

}




//формирование таблицы участника-мужчины

$rs_1=$mysqli->query("SELECT * FROM `info_dancer_m` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_m=$row_1['id'];
$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	
	$id_w=$row_2['id_w'];//идентификатор партнёрши 
	$cnt1=1;	
}

if($cnt1==1){ continue; }



$rs_3=$mysqli->query("SELECT * FROM `active_categorii_dancer_m` WHERE id_dancer='".$id_m."' ");
	if(mysqli_num_rows($rs_3)){
			
		
	}else{
	
		$rs_4=$mysqli->query("INSERT INTO `active_categorii_dancer_m` (id_dancer) VALUES ('".$id_m."')");
		if ($rs_4===false) {
			printf("Ошибка #22: %s\n", $mysqli->error);
		}
		
		
	}

}







//формирование таблицы участника-женщины

$rs_1=$mysqli->query("SELECT * FROM `info_dancer_w` ORDER BY sname,name");
while ($row_1 = $rs_1->fetch_assoc()){	



$id_w=$row_1['id'];
$rs_2=$mysqli->query("SELECT * FROM `info_couple` WHERE id_w='".$id_w."'");
$cnt1=0;
while ($row_2 = $rs_2->fetch_assoc()){	
	$id_m=$row_2['id_w'];//идентификатор партнёра 
	$cnt1=1;	
}

if($cnt1==1){ continue; }


$rs_3=$mysqli->query("SELECT * FROM `active_categorii_dancer_w` WHERE id_dancer='".$id_w."' ");
	if(mysqli_num_rows($rs_3)){
			
		
	}else{
	
		$rs_4=$mysqli->query("INSERT INTO `active_categorii_dancer_w` (id_dancer) VALUES ('".$id_w."')");
		if ($rs_4===false) {
			printf("Ошибка #23: %s\n", $mysqli->error);
		}
		
		
	}


}







//вывод пар
$rs=$mysqli->query("SELECT * FROM `active_categorii_dancer_para`");
while ($row = $rs->fetch_assoc()){
?>

<div class="classes">
<?php

$id_dancer_m=$row['id_dancer_m'];
$id_dancer_w=$row['id_dancer_w'];


//получение сведений об участниках
$rs1=$mysqli->query("SELECT * FROM `info_dancer_m` WHERE id='".$id_dancer_m."'");
while ($row1 = $rs1->fetch_assoc()){
	$sname1=$row1['sname'];
	$name1=$row1['name'];
	$date1=$row1['date'];
$years=date('Y-m-d')-$row1['date'];//возраст партнёра	
//	echo $years." ";
}

$rs1=$mysqli->query("SELECT * FROM `info_dancer_w` WHERE id='".$id_dancer_w."'");
while ($row1 = $rs1->fetch_assoc()){
	$sname2=$row1['sname'];
	$name2=$row1['name'];
	$date2=$row1['date'];
$years_w=date('Y-m-d')-$row1['date'];//возраст партнёрши
//	echo $years_w." ";
	
}


?>

<span class="name1 name2"><?php echo $sname1." ".$name1; ?></span>
<span class="date1 date2"><?php echo $date1; ?></span>

<span class="name2"><?php echo $sname2." ".$name2; ?></span>
<span class="date2"><?php echo $date2; ?></span>


<?php

//echo $years;
if($years_w>$years){
	$years_r=$years_w;//возраст старшего партнёра
}else{
	$years_r=$years;//возраст старшего партнёра
}

//echo $years_r." ";
?>



<select id="group_<?php echo $row['id']; ?>" name="group_<?php echo $row['id']; ?>">﻿
<option value="-">-</option>
<?php

$rs2=$mysqli->query("SELECT * FROM `active_categorii`");
while ($row2 = $rs2->fetch_assoc()){
?>

<?php
$years_min=$row2['years_min'];
$years_max=$row2['years_max'];



?>


    <option <?php  
	
	if(($years_r>=$years_min)&&($years_r<=$years_max)){ 
		echo ' class="ok" ';
	}else{
		echo ' class="warning" ';
	}
	
	 ?> value="<?php echo $row2['id'];  ?>_<?php  if(($years>=$years_min)&&($years<=$years_max)){ 
		echo 'ok';
	}else{
		echo 'warning';
	} ?>"  <?php  
	
	if($row2['id']==$row['id_active_cat']){ echo " selected "; }
	
	 ?> ><?php echo $row2['name']; ?></option>

<?php
}
?>
</select>


<input type="button" value="Сохранить" onclick="save_active_cat_para(<?php echo $row['id'];  ?>)"/>



</div>

<?php
}








//вывод участников-мужчин
$rs=$mysqli->query("SELECT * FROM `active_categorii_dancer_m`");
while ($row = $rs->fetch_assoc()){
?>
<div class="classes">
<?php
$id_dancer=$row['id_dancer'];
$rs1=$mysqli->query("SELECT * FROM `info_dancer_m` WHERE id='".$id_dancer."'");
while ($row1 = $rs1->fetch_assoc()){
	$sname1=$row1['sname'];
	$name1=$row1['name'];
	$date1=$row1['date'];
	
	$years=date('Y-m-d')-$row1['date'];//возраст 	
	//echo $years." ";
}
?>
<span class="name1 name2"><?php echo $sname1." ".$name1; ?></span>
<span class="date1 date2"><?php echo $date1; ?></span>


<select id="group_<?php echo $row['id']; ?>" name="group_<?php echo $row['id']; ?>">﻿
<option value="-">-</option>



<?php

$rs2=$mysqli->query("SELECT * FROM `active_categorii`");
while ($row2 = $rs2->fetch_assoc()){
?>

<?php
$years_min=$row2['years_min'];
$years_max=$row2['years_max'];

?>

    <option <?php  
	
	if(($years>=$years_min)&&($years<=$years_max)){ 
		echo ' class="ok" ';
	}else{
		echo ' class="warning" ';
	}
	
	 ?> value="<?php echo $row2['id'];  ?>_<?php  if(($years>=$years_min)&&($years<=$years_max)){ 
		echo 'ok';
	}else{
		echo 'warning';
	} ?>"  <?php  
	
	if($row2['id']==$row['id_active_cat']){ echo " selected "; }
	
	 ?> ><?php echo $row2['name']; ?></option>

<?php
}
?>
</select>


<input type="button" value="Сохранить" onclick="save_active_cat_m(<?php echo $row['id'];  ?>)"/>



</div>

<?php
}
?>










<?php
//вывод участников-женщин
$rs=$mysqli->query("SELECT * FROM `active_categorii_dancer_w`");
while ($row = $rs->fetch_assoc()){
?>
<div class="classes">
<?php
$id_dancer=$row['id_dancer'];
$rs1=$mysqli->query("SELECT * FROM `info_dancer_w` WHERE id='".$id_dancer."'");
while ($row1 = $rs1->fetch_assoc()){
	$sname1=$row1['sname'];
	$name1=$row1['name'];
	$date1=$row1['date'];

$years=date('Y-m-d')-$row1['date'];//возраст 
	
}
?>
<span class="name1 name2"><?php echo $sname1." ".$name1; ?></span>
<span class="date1 date2"><?php echo $date1; ?></span>


<select id="group_<?php echo $row['id']; ?>" name="group_<?php echo $row['id']; ?>">﻿
<option value="-">-</option>



<?php

$rs2=$mysqli->query("SELECT * FROM `active_categorii`");
while ($row2 = $rs2->fetch_assoc()){
?>


<?php
$years_min=$row2['years_min'];
$years_max=$row2['years_max'];

?>


    <option <?php  
	
	if(($years>=$years_min)&&($years<=$years_max)){ 
		echo ' class="ok" ';
	}else{
		echo ' class="warning" ';
	}
	
	 ?> value="<?php echo $row2['id'];  ?>_<?php  if(($years>=$years_min)&&($years<=$years_max)){ 
		echo 'ok';
	}else{
		echo 'warning';
	} ?>"  <?php  
	
	if($row2['id']==$row['id_active_cat']){ echo " selected "; }
	
	 ?> ><?php echo $row2['name']; ?></option>

<?php
}
?>
</select>

<input type="button" value="Сохранить" onclick="save_active_cat_w(<?php echo $row['id'];  ?>)"/>


</div>

<?php
}
?>









<script type="text/javascript">

$("select").change(function(){
 //alert("123");
  var value1=$(this).children(":selected").val();

var arr = value1.split('_'); 

//alert(arr[1]);
if(arr[1]=="warning"){

	if (confirm("Вы хотите сменить класс участнику на тот, который не допустим по возрастным ограничениям. Вы действительно хотите выполнить данную операцию?")) {

	} else {
		$(this).val(this.lastValue); 
	}

	
	
}



});

</script>


<script type="text/javascript">
function save_active_cat_para(id){

var select1=$('#group_'+id).val();
var arr = select1.split('_'); 

	$.ajax({
          url: "ajax/save_active_cat_para.php",
		  type: "POST",
		  data: {id:id,select1:arr[0]},
          // обработка успешного выполнения запроса
          success: function(data){
			$('.fixed_green').fadeIn(1);
			$('.fixed_green').fadeOut(1);
			//alert(data);
			
		  }
		  
		})

	
}

function save_active_cat_m(id){


var select1=$('#group_'+id).val();
var arr = select1.split('_'); 

	$.ajax({
          url: "ajax/save_active_cat_m.php",
		  type: "POST",
		  data: {id:id,select1:arr[0]},
          // обработка успешного выполнения запроса
          success: function(data){
			$('.fixed_green').fadeIn(1);
			$('.fixed_green').fadeOut(1);
			//alert(data);
			
		  }
		  
		})

	
}

function save_active_cat_w(id){

var select1=$('#group_'+id).val();
var arr = select1.split('_'); 

	$.ajax({
          url: "ajax/save_active_cat_w.php",
		  type: "POST",
		  data: {id:id,select1:arr[0]},
          // обработка успешного выполнения запроса
          success: function(data){
			$('.fixed_green').fadeIn(1);
			$('.fixed_green').fadeOut(1);
			//alert(data);
			
		  }
		  
		})


	
}


</script>





<?php
}else if($_GET['page']=="dynamic-turnir"){
?>






<h2 class="head1">Управление турнирами</h2>
<a href="/index.php" class="link1">Перейти на страницу регистрации</a>

<p style="font-weight:bold;">Добавление нового турнира</p>

<input type="text" name="name_turnir" id="name_turnir" placeholder="Наименование турнира" style="width:400px; margin-right:40px;"/>
<span style="margin-right:20px;">Дата начала <input type="date" name="date_start_turnir" id="date_start_turnir" class="calendar hasDatepicker"></span>
<input type="text" name="count_days" id="count_days" placeholder="Количество дней" style="width:150px;"/>
<p style="font-weight:bold;">Группы</p>



<?php
for($i=0;$i<100;$i++){

?>



<div class="classes" <?php if($i!=0){ echo 'style="display:none; "'; }  ?>>
<input type="text" class="name" id="name_<?php echo $i;  ?>" placeholder="Наименование группы">
<span class="class_min">
Минимальный класс: 
<select id="class_min_<?php echo $i;  ?>" name="class_min_<?php echo $i;  ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs2=$mysqli->query('SELECT * FROM `info_k`');
		while ($row2 = $rs2->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row2['id']; ?>"><?php 
	
	echo $row2['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
    </select>
</span>
<span class="class_max">
Максимальный класс: 
<select id="class_max_<?php echo $i;  ?>" name="class_max_<?php echo $i;  ?>" class="w">﻿
	<option value="-">-</option>
	<?php
		$rs2=$mysqli->query('SELECT * FROM `info_k`');
		while ($row2 = $rs2->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row2['id']; ?>"><?php 
	
	echo $row2['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
    </select>
</span>
<span class="years_min">
Минимальный возраст: 
<input type="text" class="years_min" id="years_min_<?php echo $i;  ?>" value="">
</span>
<span class="years_max">
Максимальный возраст:
<input type="text" class="years_max" id="years_max_<?php echo $i;  ?>" value="">
</span>
<span style="display:inline-block;"> 
Автозаполнение из справочника:
<select class="curgroup" id="curgroup_<?php echo $i; ?>" name="curgroup_<?php echo $i; ?>" style="display:block;">
<?php
$rs=$mysqli->query('SELECT * FROM `active_categorii`');
while ($row = $rs->fetch_assoc()){
?>

<option value="<?php echo $row['id']; ?>"><?php echo $row['name'];  ?></option>                    

<?php
}
?>                    
                        
</select>
</span>



<span style="display:block; float:right;">
К какому отделению отнести:
<select id="group_<?php echo $i; ?>" name="group_<?php echo $i; ?>" size="1" multiple="" style="display:block; width:50px;" class="group">
	<option value="1">-</option>                    
</select>

</span>





</div>


<?php
}
?>









<input type="button" value="Ещё" onclick="add_form_group();"/>


<div style="width:100%; height:20px;"></div>




<input type="button" value="Сохранить" onclick="save_new_turnir();"/>


<style type="text/css">

span{
font-size:12px !important;	
}

.classes{
float:left;	
}

</style>



<script type="text/javascript">



$('#count_days').focusout(function(){

	var count_days=$(this).val();
	
	var html="";
	for(i=1;i<=count_days;i++){
	
	html=html+'<option value="'+i+'">'+i+'</option>';
	
	}
	$(".group").html(html);
	
	
	
	if(count_days<10){
		$(".group").attr("size", count_days)
		
	}else{
		$(".group").attr('size','10');
		
	}


});



function add_form_group(){
	
$('.classes').each(function(){
        var display1=$(this).css('display');
		if(display1=="none"){ $(this).css('display','block'); return false; }
	
    });
	
}

$(".curgroup").change(function(){

var id1=$(this).attr('id');
var id1_mas=id1.split("_");

id1=id1_mas[1];

//alert(id1);
var id2=$(this).children(":selected").val();
//получение информации о выбранной категории




$.ajax({
          url: "ajax/info_active_cat.php",
		  type: "POST",
		  data: {id:id2},
          // обработка успешного выполнения запроса
          success: function(data){
			
			//alert(data);
			
			var data1 = JSON.parse ( data );
			
			
			
			var name=data1[0];
			var class_min=data1[1];
			var class_max=data1[2];
			var years_min=data1[3];
			var years_max=data1[4];
			
		//	alert(name+" "+class_min+" "+class_max+" "+years_min+" "+years_max);
			
			//заполнение полей
			$("#name_"+id1).val(name);
			$('#class_min_'+id1).val(class_min).change();
			$('#class_max_'+id1).val(class_max).change();
			$('#years_min_'+id1).val(years_min).change();
			$('#years_max_'+id1).val(years_max).change();
			
			
			
			
		  }
		  
		})







})




function save_new_turnir(){


//alert("111");	
	
var name_turnir=$("#name_turnir").val();
var date_start_turnir=$("#date_start_turnir").val();
var count_days=$("#count_days").val();

var cnt=0;	

var name="";
var class_min="";
var class_max="";
var years_min="";
var years_max="";
var text_otd2="";

$('.classes').each(function(){
	
	if(cnt==0){
	
	name=name+""+$("#name_"+cnt).val();
	class_min=class_min+""+$("#class_min_"+cnt).children(":selected").val();
	class_max=class_max+""+$("#class_max_"+cnt).children(":selected").val();	
	years_min=years_min+""+$("#years_min_"+cnt).val();
	years_max=years_max+""+$("#years_max_"+cnt).val();
	
	var len=document.getElementById('group_'+cnt).length;
    var text_otd="";
	for (i = 0; i < len; i++) {
		if(document.getElementById('group_'+cnt+'').options[i].selected==true){
			var val = document.getElementById('group_'+cnt+'').options[i].value;
			text_otd=text_otd+val+";";
		}
	}
	text_otd=text_otd.substring(0, text_otd.length - 1);
	text_otd2=text_otd2+""+text_otd;
	
	}else{
	
	name=name+":"+$("#name_"+cnt).val();
	class_min=class_min+":"+$("#class_min_"+cnt).children(":selected").val();
	class_max=class_max+":"+$("#class_max_"+cnt).children(":selected").val();	
	years_min=years_min+":"+$("#years_min_"+cnt).val();
	years_max=years_max+":"+$("#years_max_"+cnt).val();
		
	
	var len=document.getElementById('group_'+cnt).length;
    var text_otd="";
	for (i = 0; i < len; i++) {
		if(document.getElementById('group_'+cnt+'').options[i].selected==true){
			var val = document.getElementById('group_'+cnt+'').options[i].value;
			text_otd=text_otd+val+";";
		}
	}
	text_otd=text_otd.substring(0, text_otd.length - 1);	
	text_otd2=text_otd2+":"+text_otd;
		
	}
	
	
	
	
	//alert(text_otd);
	
	
	cnt=cnt+1;	
		
})

//alert(name_turnir);
//alert(date_start_turnir);
//alert(count_days);
//alert(name);
//alert(class_min);
//alert(class_max);
//alert(years_min);
//alert(years_max);
//alert(text_otd2);


$.ajax({
          url: "ajax/insert_active_turnir.php",
		  type: "POST",
		  data: {name_turnir:name_turnir,date_start_turnir:date_start_turnir,count_days:count_days,name:name,class_min:class_min,class_max:class_max,years_min:years_min,years_max:years_max,text_otd2:text_otd2},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();
			
			
		  }
		  
		})





	
}


</script>








<hr size="2"/>



<p style="font-weight:bold;">Список активных турниров</p>


<?php



$rs=$mysqli->query('SELECT * FROM `active_turnir` WHERE id_otd="1" ORDER BY date DESC');
while ($row = $rs->fetch_assoc()){
	

?>


<div style="width:calc(100% - 42px); padding-left:20px; padding-right:20px; margin-bottom:2px; border:1px black solid; padding-top:20px; padding-bottom:20px; text-align:left; ">
<input type="hidden" value="<?php echo $row['id_turnir']; ?>" id="id_turnir_<?php echo $row['id_turnir']; ?>"/>
<input type="text" value="<?php echo $row['name_turnir']; ?>" id="name_turnir_<?php echo $row['id_turnir']; ?>" style="width:300px;"/>
<input type="date" name="date_start_turnir_<?php echo $row['id_turnir']; ?>" id="date_start_turnir_<?php echo $row['id_turnir']; ?>" class="calendar hasDatepicker" value="<?php echo $row['date']; ?>">






<input type="button" value="Cохранить" onclick="edit_tunir_save(<?php echo $row['id_turnir']; ?>);" style="float:right;"/>

<input type="button" value="Удалить турнир" onclick="delete_active_turnir(<?php echo $row['id_turnir']; ?>);" style="float:right; margin-right:5px;"/>



<div style="width:100%; margin-bottom:10px;">



<?php


$rs_otd=$mysqli->query('SELECT * FROM `active_turnir` WHERE id_turnir="'.$row['id_turnir'].'"');
while ($row_otd = $rs_otd->fetch_assoc()){
?>

<span style="margin-right:10px;">Отделение <?php  echo $row_otd['id_otd']; ?></span><span><?php echo $row_otd['date'];  ?></span>

<br>

<?php
$groups=$row_otd['groups'];
$groups_m=explode(";",$groups);
//вывести сведения о группах
$count = count($groups_m);
for ($i=0; $i<$count; $i++)
{
	if($groups_m[$i]==""){ continue; }
	//$groups_m[$i]; - идентификатор группы

	$rs_group=$mysqli->query('SELECT * FROM `active_categorii` WHERE id="'.$groups_m[$i].'"');
	while ($row_group = $rs_group->fetch_assoc()){
	?>
		<div style="width:100%; margin-bottom:5px;">
        	<input type="text" name="name_group_<?php  echo $row_group['id']; ?>" id="name_group_<?php  echo $row_group['id']; ?>" value="<?php  echo $row_group['name']; ?>" style="width:200px; " disabled/> 
            
            <span class="class_min" >
Минимальный класс: 
<select id="class_min_<?php  echo $row_group['id']; ?>" name="class_min_<?php  echo $row_group['id']; ?>" class="w" disabled>﻿
	<option value="-">-</option>
	
    
    <?php
		$rs_k=$mysqli->query('SELECT * FROM `info_k`');
		while ($row_k = $rs_k->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row_k['id']; ?>" <?php  if($row_k['id']==$row_group['class_min']){  echo "selected"; }  ?>><?php 
	
	echo $row_k['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
    
    
        </select>
</span>


            <span class="class_max">
Максимальный класс: 
<select id="class_max_<?php  echo $row_group['id']; ?>" name="class_max_<?php  echo $row_group['id']; ?>" class="w" disabled>﻿
	<option value="-">-</option>
	
    
    <?php
		$rs_k=$mysqli->query('SELECT * FROM `info_k`');
		while ($row_k = $rs_k->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row_k['id']; ?>" <?php  if($row_k['id']==$row_group['class_min']){  echo "selected"; }  ?>><?php 
	
	echo $row_k['name']; 
	
	?></option>
    
    
    <?php
		}
	?>
    
    
        </select>
</span>



<span class="years_min">
Минимальный возраст: 
<input type="text" class="years_min" id="years_min_<?php  echo $row_group['id']; ?>" value="<?php echo $row_group['years_min']; ?>" style="width:100px;" disabled>
</span>


<span class="years_max">
Максимальный возраст:
<input type="text" class="years_max" id="years_max_<?php  echo $row_group['id']; ?>" value="<?php echo $row_group['years_max']; ?>" style="width:100px;" disabled>
</span>


<input type="button" value="Удалить категорию из отделения" onClick="delete_cat_from_otdel(<?php echo $row_group['id']; ?>,<?php echo $row_otd['id']; ?>)"/>


        </div>










		
	<?php	
	}
?>	
	

<?php
}


?>




<!------------------Добавить категорию в это отделение--------------------->
<div style="width:calc(100% - 12px); margin-left:0px; margin-right:0px; border:1px black solid; margin-bottom:40px; padding:5px;">
<span>Добавить категорию в это отделение:</span>

<div style="width:100%;">
<input type="text" class="name" id="name_insert_<?php echo $row_otd['id'];  ?>" placeholder="Наименование группы" style="width:200px;">
<span class="class_min">
Минимальный класс: 
<select id="class_min_insert_<?php echo $row_otd['id'];  ?>" name="class_min_insert_<?php echo $row_otd['id'];  ?>" class="w">﻿
	<option value="-">-</option>
<?php
		$rs_k=$mysqli->query('SELECT * FROM `info_k`');
		while ($row_k = $rs_k->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row_k['id']; ?>"><?php 
	
	echo $row_k['name']; 
	
	?></option>
    
    
    <?php
		}
	?>    
</select>
</span>

<span class="class_max">
Максимальный класс: 
<select id="class_max_insert_<?php echo $row_otd['id'];  ?>" name="class_max_insert_<?php echo $row_otd['id'];  ?>" class="w">﻿
	<option value="-">-</option>
<?php
		$rs_k=$mysqli->query('SELECT * FROM `info_k`');
		while ($row_k = $rs_k->fetch_assoc()){
		
	?>                                
    
	<option value="<?php echo $row_k['id']; ?>"><?php 
	
	echo $row_k['name']; 
	
	?></option>
    
    
    <?php
		}
	?> 
</select>
</span>


<span class="years_min">
Минимальный возраст: 
<input type="text" class="years_min" id="years_min_insert_<?php echo $row_otd['id'];  ?>" value="" style="width:150px;">
</span>


<span class="years_max">
Максимальный возраст:
<input type="text" class="years_max" id="years_max_insert_<?php echo $row_otd['id'];  ?>" value="" style="width:150px;">
</span>


<span style="display:inline-block;"> 
Автозаполнение из справочника:
<select class="curgroup2" id="curgroup_insert_<?php echo $row_otd['id'];  ?>" name="curgroup_insert_<?php echo $row_otd['id'];  ?>" style="display:block;">

<?php
$rs_a=$mysqli->query('SELECT * FROM `active_categorii`');
while ($row_a = $rs_a->fetch_assoc()){
?>

<option value="<?php echo $row_a['id']; ?>"><?php echo $row_a['name'];  ?></option>                    

<?php
}
?>                    
                  
                        
</select>
</span>

<div style="width:100%; margin-top:4px;">
<input type="button" value="Добавить" onclick="insert_group_to_otdel(<?php echo $row_otd['id']; ?>);"/>
</div>



</div>
</div>
<!------------------Добавить категорию в это отделение--------------------->




<?php
}
?>
</div>



<div style="width:100%; ">

<input type="button" value="Добавить отделение" onclick="insert_otdel(<?php echo $row['id_turnir']; ?>);"/>
<input type="button" value="Удалить последнее отделение" onclick="delete_last_otdel(<?php echo $row['id_turnir']; ?>);"/>

</div>




</div> 
 





<?php
}
?>


<script type="text/javascript">


function delete_last_otdel(id_turnir){
	
if (confirm("Вы действительно хотите удалить последнее отделение турнира ?")) {
				
$.ajax({
          url: "ajax/delete_last_otdel.php",
		  type: "POST",
		  data: {id_turnir:id_turnir},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();	
		  }
		  
	})	

		
			} else {
			
			}	
	
	
	

	
}



function insert_otdel(id_turnir){



	
	$.ajax({
          url: "ajax/insert_otdel.php",
		  type: "POST",
		  data: {id_turnir:id_turnir},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();	
		  }
		  
	})	
	
	
}

function insert_group_to_otdel(id_otd){
	
var name_insert=$('#name_insert_'+id_otd).val();
var class_min_insert=$('#class_min_insert_'+id_otd).children(":selected").val();	
var class_max_insert=$('#class_max_insert_'+id_otd).children(":selected").val();
var years_min_insert=$('#years_min_insert_'+id_otd).val();
var years_max_insert=$('#years_max_insert_'+id_otd).val();


	
	$.ajax({
          url: "ajax/insert_group_to_otdel.php",
		  type: "POST",
		  data: {id_otd:id_otd,class_min_insert:class_min_insert,class_max_insert:class_max_insert,years_min_insert:years_min_insert,years_max_insert:years_max_insert,name_insert:name_insert},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();	
		  }
		  
	})



}









$(".curgroup2").change(function(){

var id1=$(this).attr('id');
var id1_mas=id1.split("_");

id1=id1_mas[2];

//alert(id1);
var id2=$(this).children(":selected").val();
//получение информации о выбранной категории




$.ajax({
          url: "ajax/info_active_cat.php",
		  type: "POST",
		  data: {id:id2},
          // обработка успешного выполнения запроса
          success: function(data){
			
			//alert(data);
			
			var data1 = JSON.parse ( data );
			
			
			
			var name=data1[0];
			var class_min=data1[1];
			var class_max=data1[2];
			var years_min=data1[3];
			var years_max=data1[4];
			
		//	alert(name+" "+class_min+" "+class_max+" "+years_min+" "+years_max);
			
			//заполнение полей
			$("#name_insert_"+id1).val(name);
			$('#class_min_insert_'+id1).val(class_min).change();
			$('#class_max_insert_'+id1).val(class_max).change();
			$('#years_min_insert_'+id1).val(years_min).change();
			$('#years_max_insert_'+id1).val(years_max).change();
			
			
			
			
		  }
		  
		})







})








function delete_cat_from_otdel(id_cat,id_otdel){

//alert(id_cat);
//alert(id_otdel);

	
	$.ajax({
          url: "ajax/delete_cat_from_otdel.php",
		  type: "POST",
		  data: {id_cat:id_cat,id_otdel:id_otdel},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();	
		  }
		  
	})
	
}



function edit_tunir_save(id_turnir){
	
	
	var name_turnir=$('#name_turnir_'+id_turnir).val();
	var date_start_turnir=$('#date_start_turnir_'+id_turnir).val();


$.ajax({
          url: "ajax/edit_tunir_save.php",
		  type: "POST",
		  data: {id_turnir:id_turnir,name_turnir:name_turnir,date_start_turnir:date_start_turnir},
          // обработка успешного выполнения запроса
          success: function(data){
			
			alert(data);
			window.location.reload();	
		  }
		  
})




	
}


function delete_active_turnir(id_turnir){
	
$.ajax({
          url: "ajax/delete_active_turnir.php",
		  type: "POST",
		  data: {id_turnir:id_turnir},
          // обработка успешного выполнения запроса
          success: function(data){
			
			if (confirm("Вы действительно хотите удалить турнир ?")) {
				alert(data);
				window.location.reload();		
			} else {
			
			}

			
			
		  }
		  
})
	
	
}


</script>














<?php
}else if($_GET['page']=="test1"){
?>

<h2 class="head1">Список существующих пар</h2>
<a href="/index.php" class="link1">Перейти на страницу регистрации</a>

<div style="text-align:left; width:calc(100% - 40px); padding-left:20px; padding-right:20px;">
<?php
$rs_a=$mysqli->query('SELECT * FROM `info_couple` ORDER BY id_m');
while ($row_a = $rs_a->fetch_assoc()){
	
$id_para=$row_a['id'];

echo "#".$id_para." | ";
$id_m=$row_a['id_m'];	
$id_w=$row_a['id_w'];
	$rs_m=$mysqli->query('SELECT * FROM `info_dancer_m` WHERE id="'.$id_m.'"');
	while ($row_m = $rs_m->fetch_assoc()){
		echo $id_m." | ".$row_m['sname']." | ".$row_m['name']." | ".$row_m['date']." | ";
	}
	$rs_m=$mysqli->query('SELECT * FROM `info_class_dancer_m` WHERE id_dancer="'.$id_m.'" ORDER BY id_class DESC LIMIT 1');
	while ($row_m = $rs_m->fetch_assoc()){
		$id_class=$row_m['id_class'];
	}
	$rs_m=$mysqli->query('SELECT * FROM `info_k` WHERE id="'.$id_class.'"');
	while ($row_m = $rs_m->fetch_assoc()){
		echo $row_m['name']." | ".$row_m['name']." | ".$row_m['name']." | ";	
	}
	
	
	//$rs_m=$mysqli->query('SELECT * FROM `info_couple_club` WHERE couple="'.$id_para.'"');
	//while ($row_m = $rs_m->fetch_assoc()){
	//	$id_club=$row_m['club'];
	//}
	
	//$rs_m=$mysqli->query('SELECT * FROM `info_club` WHERE id="'.$id_club.'"');
	//while ($row_m = $rs_m->fetch_assoc()){
	//	echo  $row_m['name']." | ";
	//	$id_city=$row_m['city'];
	//}
	
	//$rs_m=$mysqli->query('SELECT * FROM `info_city` WHERE id="'.$id_city.'"');
	//while ($row_m = $rs_m->fetch_assoc()){
	//	echo  $row_m['name']." | ";
	//}
	
	
	$rs_w=$mysqli->query('SELECT * FROM `info_dancer_w` WHERE id="'.$id_w.'"');
	while ($row_w = $rs_w->fetch_assoc()){
		echo $id_w." | ".$row_w['sname']." | ".$row_w['name']." | ".$row_w['date']." | ";
	}
	$rs_w=$mysqli->query('SELECT * FROM `info_class_dancer_w` WHERE id_dancer="'.$id_w.'" ORDER BY id_class DESC LIMIT 1');
	while ($row_w = $rs_w->fetch_assoc()){
		$id_class=$row_w['id_class'];
	}
	$rs_w=$mysqli->query('SELECT * FROM `info_k` WHERE id="'.$id_class.'"');
	while ($row_w = $rs_w->fetch_assoc()){
		echo $row_w['name']." | ".$row_w['name']." | ".$row_w['name']." | ";	
	}
	
	
	$rs_w=$mysqli->query('SELECT * FROM `info_couple_club` WHERE couple="'.$id_para.'"');
	while ($row_w = $rs_w->fetch_assoc()){
		$id_club=$row_w['club'];
		//echo "-".$id_club."-";
		$rs_w2=$mysqli->query('SELECT * FROM `info_club` WHERE id="'.$id_club.'"');
		while ($row_w2 = $rs_w2->fetch_assoc()){
			echo  "(".$row_w2['name']." | ";
			$id_city=$row_w2['city'];
		}
		
		
		$rs_w2=$mysqli->query('SELECT * FROM `info_city` WHERE id="'.$id_city.'"');
		while ($row_w2 = $rs_w2->fetch_assoc()){
			echo  "".$row_w2['name'].") | ";
		}
		
	}

	
	echo "<br>";

	
	
	
	
	
	

}
?>
</div>



<?php
}
?>

</body>
</html>