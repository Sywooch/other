<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="">Кабинет пользователя</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
        
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class=""></i>ПЕРЕЙТИ<b class="caret"></b></a>
                            <ul class="dropdown-menu">
              <li><a href="http://kondratik.ru/">НАШ САЙТ</a></li>
              <li><a href="http://vk.com/kondratik_ru">ГРУППА ВКОНТАКТЕ</a></li>
                           </ul> 
		</li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class=""></i>БАЛАНС<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="http://kondratik.ru/account/index.php?route=account/add">ПОПОЛНИТЬ</a></li>
              <li><a href="http://kondratik.ru/account/index.php?route=account/out">ВЫВЕСТИ</a></li>
            </ul>
        </li>
		
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo $this->customer->getEmail(); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/account/index.php?route=account/edit">ПРОФИЛЬ</a></li>
              <li><a href="/account/index.php?route=account/logout">ВЫХОД</a></li>
            </ul>
          </li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li ><a href=""><i class="icon-home"></i></i><span>ГЛАВНАЯ</span> </a> </li>
        <li ><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ВАШ ПРОФИЛЬ</span> </a> </li>
        <li><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ПАРТНЕРСКАЯ ПРОГРАММА</span> </a></li>
        <li><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ВАШИ ИНВЕСТИЦИИ</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>ДОПОЛНИТЕЛЬНО</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/account/index.php?route=account/newsletter">FAQ</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->


  <!-- Контент страницы ##############################################################-->  
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
 <div class="span12">
                <div class="widget ">
	      		<div class="widget-header">
	      		<i class="icon-user"></i>
	      				<h3>Заявка на вывод</h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">
						
						
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="content" style="scrolling: none;">
      <table class="form">
		<tr>
          <td><b>Платежная система:</b><br>
          <select name="type">
		  <option value="Yandex" selected="selected">Яндекс.Деньги</option>
		  <option value="Qiwi" selected="selected">Киви</option>
		  </select></td>
        </tr>
        <tr>
          <td><b>Номер кошелька:</b><br>
          <input type="text" name="wallet" value="<?php echo $wallet; ?>" /></td>
        </tr>
		<tr>
          <td><b>Сумма (Руб):</b><br>
          <input type="text" name="amount" value="<?php echo $amount; ?>" /></td>
        </tr>
		<tr>
          <td><strong>Доступная для снятия сумма: <?php echo $total; ?> руб.</strong></td>
        </tr>
		
      </table>
	  
     <br>
        <input type="submit" value="  Отправить  " class="btn btn-large btn-success btn-support-ask" />
    
    </div>
    
  </form>
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
				</div>
	      	   </div>
	      	 </div>
	      	</div>
	      	</div>
	      	
	      	
	      	<!-- Контент страницы ##############################################################-->  

<?php echo $footer; ?>