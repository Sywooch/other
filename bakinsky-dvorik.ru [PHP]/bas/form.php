<?php

include('admin/smspilot.php');
 
if(!isset($_COOKIE['mov'])) setcookie ("mov", "2",  time()+86400,"/");
$check_mov="";
$check_mov1="";
$check_mov2="";
 if(isset($_COOKIE['bas']))
 {
      $list=file("admin/db/price.txt");
      $conf=file("admin/conf/sett.txt");
      for($i=0; $i<count($conf); $i++) $conf[$i]=trim($conf[$i]);

      $name=array();
      $price=array();
      foreach($list as $line)
       {
       	 $line=trim($line);
       	 $expl=explode("*",$line);
       	 $name[$expl[2]]=$expl[0];
       	 $price[$expl[2]]=$expl[1];
       }

      $expl=explode("|",$_COOKIE['bas']);
      $count_staf=array_count_values($expl);

       $info="";
      if(isset($_POST['go']))
        {
          if($conf[1]!="")
            {
              $_POST['fam']=trim($_POST['fam']);
              $_POST['fam']=htmlspecialchars($_POST['fam']);
              $_POST['fam']=stripcslashes($_POST['fam']);
              if($_POST['fam']=="")$info="Введите все данные";
            }
           if($conf[2]!="")
            {
              $_POST['nam']=trim($_POST['nam']);
              $_POST['nam']=htmlspecialchars($_POST['nam']);
              $_POST['nam']=stripcslashes($_POST['nam']);
              if($_POST['nam']=="")$info="Введите все данные";
            }
           if($conf[3]!="")
            {
              $_POST['user_mail']=trim($_POST['user_mail']);
              $_POST['user_mail']=htmlspecialchars($_POST['user_mail']);
              $_POST['user_mail']=stripcslashes($_POST['user_mail']);
              if($_POST['user_mail']=="")$info="Введите все данные";
            }

           if($conf[4]!="")
            {
              $_POST['fone']=trim($_POST['fone']);
              $_POST['fone']=htmlspecialchars($_POST['fone']);
              $_POST['fone']=stripcslashes($_POST['fone']);
              if($_POST['fone']=="")$info="Введите все данные";
            }
			
			if($conf[14]!="") {
				$_POST['street'] = stripcslashes(htmlspecialchars(trim($_POST['street'])));
				if($_POST['street'] == "") $info="Введите все данные";
			}
			if($conf[15]!="") {
				$_POST['house'] = stripcslashes(htmlspecialchars(trim($_POST['house'])));
				if($_POST['house'] == "") $info="Введите все данные";
			}
			if($conf[16]!="") {
				$_POST['korp'] = stripcslashes(htmlspecialchars(trim($_POST['korp'])));
				if($_POST['korp'] == "") $info="Введите все данные";
			}
			if($conf[17]!="") {
				$_POST['apartment'] = stripcslashes(htmlspecialchars(trim($_POST['apartment'])));
				if($_POST['apartment'] == "") $info="Введите все данные";
			}
			if($conf[18]!="") {
				$_POST['intercom'] = stripcslashes(htmlspecialchars(trim($_POST['intercom'])));
				if($_POST['intercom'] == "") $info="Введите все данные";
			}
			if($conf[19]!="") {
				$_POST['floor'] = stripcslashes(htmlspecialchars(trim($_POST['floor'])));
				if($_POST['floor'] == "") $info="Введите все данные";
			}
			if($conf[20]!="") {
				$_POST['porch'] = stripcslashes(htmlspecialchars(trim($_POST['porch'])));
				if($_POST['porch'] == "") $info="Введите все данные";
			}
			if($conf[21]!="") {
				$_POST['metro'] = stripcslashes(htmlspecialchars(trim($_POST['metro'])));
				if($_POST['metro'] == "") $info="Введите все данные";
			}
			if($conf[22]!="") {
				$_POST['regular'] = stripcslashes(htmlspecialchars(trim($_POST['regular'])));
				if($_POST['regular'] == "") $info="Введите все данные";
			}			
          if($conf[5]!="")
            {
              $_POST['adr']=trim($_POST['adr']);
              $_POST['adr']=htmlspecialchars($_POST['adr']);
              $_POST['adr']=stripcslashes($_POST['adr']);
              if($_POST['adr']=="")$info="Введите все данные";
            }

           if($conf[6]!="")
            {
              $_POST['metr']=trim($_POST['metr']);
              $_POST['metr']=htmlspecialchars($_POST['metr']);
              $_POST['metr']=stripcslashes($_POST['metr']);
              if($_POST['metr']=="")$info="Введите все данные";
            }

           if($info=="" && $conf[0]!="")
             {
		
                 $css="<style>
                  #tab1
                       {
                           border-style:solid;
                           border-color:#3E0D03;
                           border-width: 1px;
                           font-family:Times New Roman, serif;
                           font-size:11pt;
                           font-style:normal;
                           color:#595959;
                      }
#sett1
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 2px;
          border-right-width: 0px;
          border-top-width: 0px;
          border-bottom-width: 2px;
       }
#sett2
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 0px;
          border-right-width: 2px;
          border-bottom-width: 1px;
          border-top-width: 0px;
       }
#sett3
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 0px;
          border-right-width: 2px;
          border-bottom-width: 0px;
          border-top-width: 0px;
       }
                      </style>";

                 $tab_staf="<table  id=tab1 CELLPADDING=10 CELLSPACING=0 align=center width=90%>
                             <tr><td id=sett1>Блюдо</td><td id=sett1>Количество</td><td id=sett1>Цена</td><td id=sett2>Стоимость</td></tr>";
                  $i=0;
                  foreach($count_staf as $k=>$v)
                   {
                     $oll=$price[$k]*$v;
                     $tab_staf.="<tr><td id=sett1>$name[$k]</td><td align=center id=sett1>$v</td><td  align=center id=sett1>$price[$k]&nbsp;$conf[8]</td><td id=sett1 align=center>$oll&nbsp;$conf[8]</td></tr>";
                     $i+=$oll;
                   }


                   if($_COOKIE['mov']=="1")
                    {
            	     $i+=$conf[7];
            	     $info_mov="Cтоимость заказа с доставкой по Москве: $i&nbsp;$conf[8]";
                    }
                   if($_COOKIE['mov']=="2")
                    {
                     $info_mov="Cтоимость заказа без доставки: $i&nbsp;$conf[8]";
                    }

                   if($_COOKIE['mov']=="3")
                    {
            	     $i+=$conf[9];
            	     $info_mov="Cтоимость заказа с доставкой по МО: $i&nbsp;$conf[8]";
                    }

                  //$i+=$conf[7];
                  $tab_staf.="<tr><td colspan=4>$info_mov</td></tr></table><br /><br />";

                  $tab_user="<table  id=tab1 CELLPADDING=10 CELLSPACING=0 align=center width=90%>";

                  if($conf[1]!="")$tab_user.= "<tr><td id=sett1>Фамилия</td><td id=sett2>$_POST[fam]</td></tr>";
                  if($conf[2]!="")$tab_user.= "<tr><td id=sett1>Имя</td><td id=sett2>$_POST[nam]</td></tr>";
                  if($conf[3]!="")$tab_user.= "<tr><td id=sett1>E-mail</td><td id=sett2>$_POST[user_mail]</td></tr>";
                  if($conf[4]!="")$tab_user.= "<tr><td id=sett1>Телефон</td><td id=sett2>$_POST[fone]</td></tr>";
 
                  if($conf[14]!="")$tab_user.= "<tr><td id=sett1>Улица</td><td id=sett2>$_POST[street]</td></tr>";
                  if($conf[15]!="")$tab_user.= "<tr><td id=sett1>Дом №</td><td id=sett2>$_POST[house]</td></tr>";
                  if($conf[16]!="")$tab_user.= "<tr><td id=sett1>Корпус</td><td id=sett2>$_POST[korp]</td></tr>";
                  if($conf[17]!="")$tab_user.= "<tr><td id=sett1>Квартира</td><td id=sett2>$_POST[apartment]</td></tr>";
                  if($conf[18]!="")$tab_user.= "<tr><td id=sett1>Домофон</td><td id=sett2>$_POST[intercom]</td></tr>";
                  if($conf[19]!="")$tab_user.= "<tr><td id=sett1>Этаж</td><td id=sett2>$_POST[floor]</td></tr>";
                  if($conf[20]!="")$tab_user.= "<tr><td id=sett1>Подъезд №</td><td id=sett2>$_POST[porch]</td></tr>";
                  if($conf[21]!="")$tab_user.= "<tr><td id=sett1>Ближайшая станция метро</td><td id=sett2>$_POST[metro]</td></tr>";
                  if($conf[22]!="")$tab_user.= "<tr><td id=sett1>Делали ли Вы ранее заказы в нашем ресторане?</td><td id=sett2>$_POST[regular]</td></tr>";
                 
                  if($conf[5]!="")$tab_user.= "<tr><td id=sett1>Вариант оплаты</td><td id=sett2>$_POST[adr]</td></tr>";
                  if($conf[6]!="")$tab_user.= "<tr><td id=sett1>Комментарий</td><td id=sett2>$_POST[metr]</td></tr>";
                  $tab_user.="</table>";

                   //сохраняем заказ
                   $tab_staf_save=str_replace("\r\n","",$tab_staf);
                   $tab_user_save=str_replace("\r\n","",$tab_user);

                   $f=fopen("admin/db/order/".time(),"w+");
                   fwrite($f,date("d.m.Y H:i")."\r\n".$tab_staf_save.$tab_user_save);
                   fclose($f);	
				   
				   if ($conf[10] != '')
				   {				   
					   if (!defined('SMSPILOT_APIKEY')) define('SMSPILOT_APIKEY', $conf[11]);
					   $sms_text = "На сайте $conf[12] оформлен новый заказ!";
					   // $sms_from = str_replace("www","",$_SERVER['SERVER_NAME']);
					   $sms_from = false;
					   sms($conf[13], $sms_text, $sms_from);
					}
					
                   $subject="Новый заказ на сайте $_SERVER[SERVER_NAME]";
                   $headers= "MIME-Version: 1.0\r\n";
                   $headers.= "Content-type: text/html; charset=windows-1251\r\n";
                   $label=str_replace("www","",$_SERVER['SERVER_NAME']);
                   $label="admin@".$label;
                   $headers.= "From: Administrator<$label>\r\n";
                   $messag=$css.$tab_staf.$tab_user;
                   mail("$conf[0]", $subject, $messag,$headers);
                   setcookie ("bas", "", time() - 3600,"/");
                   setcookie ("mov", "", time() - 3600,"/");
                   echo "<meta http-equiv=refresh content='0; url=form.php?op=3'>";
                   exit();
             }
        }

       if(isset($_GET['d']))
        {
            $expl1=array();
            $search=false;
            foreach($expl as $line)
             {
                if($line==$_GET['d'] && $search==false)
                  {
                  	 $search=true;
                  	 continue;
                  }

               	$expl1[]=$line;
             }
          $expl1=implode("|",$expl1);
          $expl1=urldecode($expl1);
          setcookie ("bas", $expl1,  time()+86400,"/");

          echo "<meta http-equiv=refresh content='0; url=form.php?op=1'>";
          exit();
        }

         if(isset($_GET['add']))
        {
            $search=false;
            foreach($expl as $line)
             {
                if($line==$_GET['add'])
                  {
                  	 $search=true;
                  	 break;
                  }
             }

          if($search)
             {
             	$expl[]=$_GET['add'];
             	$expl=implode("|",$expl);
                $expl=urldecode($expl);
                setcookie ("bas", $expl,  time()+86400,"/");
             }


          echo "<meta http-equiv=refresh content='0; url=form.php?op=1'>";
          exit();
        }


 }
if($_GET['op']==1)
 {
   if(isset($_POST['go_mov']))
    {
     if(isset($_POST['mov']))
       {
       	 if($_POST['mov1']=='mos')     setcookie ("mov", "1",  time()+86400,"/");
       	 else setcookie ("mov", "3",  time()+86400,"/");
       }
     else setcookie ("mov", "2",  time()+86400,"/");
      echo "<meta http-equiv=refresh content='0; url=form.php?op=1'>";
      exit();
    }
 }

?>

<html>
<head>
<style>

#tab1
        {
          border-style:solid;
          border-color:#3E0D03;
          border-width: 0px;
          border-top-width: 2px;
          border-left-width: 0px;
          font-family:"Times New Roman", "serif";
          font-size:11pt;
          font-style:normal;
          color:#000000;
       }
#tab
        {
          font-family:"Times New Roman", "serif";
          font-size:11pt;
          font-style:normal;
          color:#000000;
       }

#sett1
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 2px;
          border-right-width: 0px;
          border-top-width: 0px;
          border-bottom-width: 2px;
       }
#sett2
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 0px;
          border-right-width: 2px;
          border-bottom-width: 1px;
          border-top-width: 0px;
       }
#sett3
        {
          border-style:solid;
          border-color:#3E0D03;
          border-left-width: 2px;
          border-right-width: 2px;
          border-bottom-width: 2px;
          border-top-width: 0px;
       }
#button_b {
          width:146px;
          height:33px;
          background: url("/bas/button_b.png") no-repeat;
          font-family:"Times New Roman", "serif";
          color:#FEF6B9;
          font-size:12pt;
          font-weight:300;
          text-align:center;
          border:none;
          cursor: pointer;
      }
#button_close {
          width:134px;
          height:11px;
          background: url("/bas/return_shop.png") no-repeat;
          border:none;
          cursor: pointer;
      }
#button_strelka_right {
          width:12px;
          height:9px;
          background: url("/bas/strelka_right.png") no-repeat;
          border:none;
          cursor: pointer;
      }
#button_strelka_left {
          width:12px;
          height:9px;
          background: url("/bas/strelka_left.png") no-repeat;
          border:none;
          cursor: pointer;
      }
#copy a
        {
          text-decoration:none;
          font-family:"Times New Roman", "serif";
          font-size:9pt;
          font-style:normal;
          color:#C0C0C0;
       }
select {
background: url("/images/1px.png") repeat;
border: 1px solid #3E0D03;
}
input[type="text"] {
background: url("/images/1px.png") repeat;
color:#000000;
border: 1px solid #3E0D03;
}
</style>

<title>Ваша корзина</title>
</head>
<body onUnload="window.opener.rel();" background="/bas/fon_m.jpg">

<?php
  if(isset($_COOKIE['bas']))
    {

      if($_GET['op']==1)
        {
          echo"<form name=frm  method=post><br /><br />
<table id=tab width=90% align=center><tr><td><img src=/bas/cart_table.png border=0></td><td align=right><input id=button_strelka_right onclick=javascript:window.location.replace('form.php?op=2');></td></tr><tr><td colspan=2><br /><table  id=tab1 CELLPADDING=10 CELLSPACING=0 width=100%>
            <tr><td id=sett1 align=center><b>Блюдо</b></td><td id=sett1 align=center><b>Количество</b></td><td id=sett1 align=center><b>Цена</b></td>
            <td id=sett1 align=center><b>Стоимость</b></td><td id=sett3 align=center>&nbsp;</td></tr>";
           $i=0;
           foreach($count_staf as $k=>$v)
             {
               $oll=$price[$k]*$v;
               echo "<tr><td id=sett1>$name[$k]</td><td align=center id=sett1>$v</td><td  align=center id=sett1>$price[$k]&nbsp;$conf[8]</td>
               <td id=sett1 align=center>$oll&nbsp;$conf[8]</td><td id=sett3 align=center><a href=form.php?d=$k><img src=admin/img/min.png alt=удалить border=0></a>
               &nbsp;&nbsp;&nbsp;<a href=form.php?add=$k><img src=admin/img/add.png alt=добавить border=0></a></td></tr>";
               $i+=$oll;
             }

         if(isset($_COOKIE['mov']))
          {
            if($_COOKIE['mov']=="1")
              {
            	 $check_mov='checked';
            	 $check_mov1='selected';
            	 $i+=$conf[7];
            	 $info_mov="Cтоимость заказа с доставкой по Москве: $i&nbsp;$conf[8]";
              }
             if($_COOKIE['mov']=="2")
              {

                $info_mov="Cтоимость заказа без доставки: $i&nbsp;$conf[8]";
              }

             if($_COOKIE['mov']=="3")
              {
            	 $check_mov='checked';
            	 $check_mov2='selected';
            	 $i+=$conf[9];
            	 $info_mov="Cтоимость заказа с доставкой по МО: $i&nbsp;$conf[8]";
              }
          }
          else
          {
          	 $check_mov="";
             $info_mov="Cтоимость заказа без доставки: $i&nbsp;$conf[8]";
          }




          echo "<tr><td colspan=5>$info_mov</td></tr></table></td></tr><tr><td>

           <input name=mov type=checkbox value=ON  $check_mov>&nbsp;Доставка заказа:&nbsp;&nbsp;&nbsp;
           <select name=mov1>
           <option value=mos $check_mov1>Москва</option>
           <option value=mo $check_mov2>МО</option>
            </select>


           </td><td align=right>
<input type=submit value=Пересчитать id=button_b name=go_mov>

          </td></tr><tr><td><br /><br /><input id=button_close onclick=javascript:window.close();></td></tr></table></form><br />
          <div align=center><input value='Оформить заказ' id=button_b onclick=javascript:window.location.replace('form.php?op=2')></div>";
        }

      if($_GET['op']==2)
        {
          echo "<form method=post><br /><br /><br />
          <table  id=tab CELLPADDING=10 CELLSPACING=0 align=center>";
          if($info!="")echo "<tr><td><font color=red>$info</font></td></tr>";
echo "<tr><td><input id=button_strelka_left onclick=javascript:window.location.replace('form.php?op=1')><br /><br /></td></tr>";
          if($conf[1]!="")echo "<tr><td>Фамилия</td><td><input name=fam type=text value='".@$_POST['fam']."' size=50></td></tr>";
          if($conf[2]!="")echo "<tr><td>Имя</td><td><input name=nam type=text value='".@$_POST['nam']."' size=50></td></tr>";
          if($conf[3]!="")echo "<tr><td>E-mail</td><td><input name=user_mail type=text value='".@$_POST['user_mail']."' size=50></td></tr>";
          if($conf[4]!="")echo "<tr><td>Телефон</td><td><input name=fone type=text value='".@$_POST['fone']."' size=50></td></tr>";
         
          if($conf[14]!="")echo "<tr><td>Улица</td><td><input name=street type=text value='".@$_POST['street']."' size=50></td></tr>";
          if($conf[15]!="")echo "<tr><td>Дом №</td><td><input name=house type=text value='".@$_POST['house']."' size=50></td></tr>";
          if($conf[16]!="")echo "<tr><td>Корпус</td><td><input name=korp type=text value='".@$_POST['korp']."' size=50></td></tr>";
          if($conf[17]!="")echo "<tr><td>Квартира</td><td><input name=apartment type=text value='".@$_POST['apartment']."' size=50></td></tr>";
          if($conf[18]!="")echo "<tr><td>Домофон</td><td><input name=intercom type=text value='".@$_POST['intercom']."' size=50></td></tr>";
          if($conf[19]!="")echo "<tr><td>Этаж</td><td><input name=floor type=text value='".@$_POST['floor']."' size=50></td></tr>";
          if($conf[20]!="")echo "<tr><td>Подъезд №</td><td><input name=porch type=text value='".@$_POST['porch']."' size=50></td></tr>";
          if($conf[21]!="")echo "<tr><td>Ближайшая станция метро</td><td><input name=metro type=text value='".@$_POST['metro']."' size=50></td></tr>";

		  if($conf[5]!="")echo "<tr><td>Вариант оплаты</td><td><input name=adr type=text value='".@$_POST['adr']."' size=50></td></tr>";
          if($conf[6]!="")echo "<tr><td>Комментарий</td><td><input name=metr type=text value='".@$_POST['metr']."' size=50></td></tr>";
        
          if($conf[22]!="")echo "<tr><td>Делали ли Вы ранее заказы<br/>в нашем ресторане?</td><td><input name=regular type=text value='".@$_POST['regular']."' size=50></td></tr>";

		  echo"<tr><td></td><td align=right><input type=submit value='Отправить заказ' id=button_b name=go></td></tr></table></form>";

        }

    }
 if(!isset($_COOKIE['bas']) && @$_GET['op']!=3)
   {
   	 echo"<table  id=tab CELLPADDING=10 CELLSPACING=0 align=center valign=center><tr><td>
          Ваша корзина пуста!<br /><br />
           <div align=center><input value=Закрыть id=button_b onclick=window.close()></div>

           </td></tr></table>";
   }
  if($_GET['op']==3)
        {
           echo"<table  id=tab CELLPADDING=10 CELLSPACING=0 align=center valign=center><tr><td>
           Спасибо. Ваш заказ принят!<br /><br />
           <div align=center><input value=Закрыть id=button_b onclick=window.close()></div>
           </td></tr></table>";
        }
?>
</body>
</html>