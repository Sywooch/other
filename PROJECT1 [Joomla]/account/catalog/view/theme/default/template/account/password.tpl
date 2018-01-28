<?php echo $header; ?>
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
        <li><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ВАШ ПРОФИЛЬ</span> </a> </li>
        <li><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ПАРТНЕРСКАЯ ПРОГРАММА</span> </a></li>
        <li ><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ВАШИ ИНВЕСТИЦИИ</span> </a> </li>
       <li class="dropdown" class="active"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>ДОПОЛНИТЕЛЬНО</span> <b class="caret"></b></a>
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
	      		
	      		<div class="widget">
						
					<div class="widget-header">
						<i class="icon-pushpin"></i>
						<h3>Изменение пароля</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_password; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><span class="required">*</span> <?php echo $entry_password; ?></td>
          <td><input type="password" name="password" value="<?php echo $password; ?>" />
            <?php if ($error_password) { ?>
            <span class="error"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_confirm; ?></td>
          <td><input type="password" name="confirm" value="<?php echo $confirm; ?>" />
            <?php if ($error_confirm) { ?>
            <span class="error"><?php echo $error_confirm; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </div>
    <div class="buttons">
      
	 <input style="margin-left: 10px;" type="submit" value="Изменить" class="button btn btn-success btn-large" /> <a href="<?php echo $back; ?>" class="button btn btn-success btn-large" style="margin-right: 10px;" type="submit"><?php echo $button_back; ?></a>  
    </div>
  </form>
 	</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
				
		    </div> <!-- /spa12 -->
		    
		    </div> <!-- /row -->
	
	    </div> <!-- /container -->
    
	</div> <!-- /main-inner -->
	    
</div> <!-- /main -->
<?php echo $footer; ?>