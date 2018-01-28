<?php echo $header; ?>
<?php if($this->customer->getAdmin()) { ?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="">Кабинет админа</a>
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
                            class="icon-user"></i> <?php echo $this->customer->getEmail(); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
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
        <li class="active"><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ЗАЯВКИ НА ВВОД</span> </a> </li>
        <li ><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ЗАЯВКИ НА ВЫВОД</span> </a></li>
        <li><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ИНВЕСТОРЫ</span> </a> </li>
       <li><a href="/account/index.php?route=account/wishlist"><i class=" icon-signal"></i><span>ПОЧТА</span> </a> </li>
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
	    <?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>  

          
          
	      	
	      	<div class="span12">      		
	      	<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Заявки на ввод</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                   <th class="right">Дата</th>
        <th class="left">Контакты</th>
        <th class="right">Имя</th>
		<th class="right">Cитема</th>
		<th class="right">Сумма</th>
		<th class="right">Действия</th>
                  </tr>
                </thead>
                <tbody>
                   <?php if ($outs) { ?>
      <?php foreach ($outs  as $out) { ?>
      <tr>
	   <td class="left"><?php echo $out['date_added']; ?></td>
        <td class="left"><?php echo $out['email']; ?><br><?php echo $out['telephone']; ?></td>
        <td class="right"><?php echo $out['firstname']; ?></td>
        <td class="left"><?php echo $out['type']; ?></td>
        <td class="left"><?php echo (float)$out['amount']; ?> руб.</td>
        <td class="right">
		<?php if(!$out['status']){ ?><a href="<?php echo $out['add']; ?>" class="button">Зачислить</a>
		<?php } else { ?> <b>Зачислено</b> <?php } ?>
		<br><a href="<?php echo $out['del']; ?>">Удалить</a></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td class="center" colspan="6">Заявок нет</td>
      </tr>
      <?php } ?>
                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>
	      		
	      		
	      		
	      		
	      		
	      	
	      	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->


<?php } else { ?>

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
        <li class="active"><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ВАШ ПРОФИЛЬ</span> </a> </li>
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
	  <?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

 <div class="span12">
                <div class="widget ">
	      		<div class="widget-header">
	      		<i class="icon-user"></i>
	      				<h3>Ваш профиль</h3>
	  				</div> <!-- /widget-header -->
					<div class="widget-content">
						
						
						
						
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <h2><?php echo $text_your_details; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><span class="required">*</span> Имя:</td>
          <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
            <?php if ($error_firstname) { ?>
            <span class="error"><?php echo $error_firstname; ?></span>
            <?php } ?></td>
        </tr>
       
        <tr>
          <td><span class="required">*</span> <?php echo $entry_email; ?></td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <?php if ($error_email) { ?>
            <span class="error"><?php echo $error_email; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
          <td><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
            <?php if ($error_telephone) { ?>
            <span class="error"><?php echo $error_telephone; ?></span>
            <?php } ?></td>
        </tr>
      
      </table>
    </div><br><br>
    
      <div class="left" style="float: left;margin-right: 30px;"><input type="submit" value="  Изменить  " class="btn btn-large btn-success btn-support-ask" /></div>
      <div class="right" style="float: left;">
	
        <a href="/account/index.php?route=account/password" class="btn btn-large btn-success btn-support-ask">&nbsp&nbsp&nbspСменить пароль&nbsp&nbsp </a>
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

  

<?php } ?>
<?php echo $footer; ?>