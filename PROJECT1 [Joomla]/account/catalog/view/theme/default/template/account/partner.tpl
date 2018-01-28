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
        <li ><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ЗАЯВКИ НА ВВОД</span> </a> </li>
        <li class="active"><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ЗАЯВКИ НА ВЫВОД</span> </a></li>
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
              <h3>Заявки на вывод</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <th class="right">Дата</th>
        <th class="left">Контакты</th>
        <th class="right">Имя</th>
		<th class="right">Cистема</th>
		<th class="right">Кошелек</th>
		<th class="right">Сумма</th>
		<th class="right">Баланс</th>
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
		<td class="left"><?php echo $out['wallet']; ?></td>
        <td class="left"><?php echo $out['amount']; ?> руб.</td>
		 <td class="left"><?php echo $out['total']; ?> руб.</td>
        <td class="right">
		<?php if(!$out['status']){ ?><a href="<?php echo $out['add']; ?>" class="button">Обработать</a>
		<?php } else { ?> <b>Обработано</b> <?php } ?>
		<br><a href="<?php echo $out['del']; ?>">Удалить</a></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td class="center" colspan="8">Заявок нет</td>
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
        <li><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ВАШ ПРОФИЛЬ</span> </a> </li>
        <li class="active"><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ПАРТНЕРСКАЯ ПРОГРАММА</span> </a></li>
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
	      	<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

	      	<div class="span12">
	      	
	      	<label>Партнерское вознаграждение составляет <b><?php echo PERCENTREF; ?>%</b> ежемесячно</label>
	      
	      	<div class="info-box">
               <div class="row-fluid stats-box">
                  <div class="span4">
                  	<div class="stats-box-title">Количество партнеров</div>
                    <div class="stats-box-all-info"><i class="icon-user" style="color:#3366cc;"></i> <?php echo $ref_count; ?></div>
                    
                  </div>
                  
                  <div class="span4">
                    <div class="stats-box-title">Активные партнеры</div>
                    <div class="stats-box-all-info"><i class="icon-ok-sign"  style="color:#F30"></i> <?php echo $actref; ?></div>
                    
                  </div> 
                  
                  <div class="span4">
                    <div class="stats-box-title">Получено прибыли от партнеров</div>
                    <div class="stats-box-all-info"><i class="icon-money" style="color:#3C3"></i> <?php echo $ref_balance; ?> руб.</div>
                    
                    </div>
                  
                     </div> 
                  </div>
               </div>
               </div>
                                 <hr/>           
                                      <div class="control-group">											
											<label class="control-label" for="firstname">Ваша партнерская ссылка</label>
											<div class="controls">
												<input type="text" class="span6" id="firstname" value="http://kondratik.ru/account/index.php?route=account/register&partner_id=<?php echo $this->customer->getId(); ?>">
											</div> <!-- /controls -->				
										</div>
                                            
                                             <hr/>  
                                           
                                            
               <div class="widget widget-plain">
					<label>Вы можете отправлять SMS со своей партнерской ссылкой знакомым</label>
					<div class="widget-content">
						
						<a href="http://cabinet.sms-reklama.by/index.php?r=profile/login" class="btn btn-large btn-success btn-support-ask"  width="20%">Отправить SMS другу</a>	
						
						<br /><br />
						
					    
					</div> <!-- /widget-content -->
					</div>	
				</div>
              </div>
              
         </div>      
	     
	      </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->

    
<!-- Контент страницы ##############################################################-->  

<?php } ?>
<?php echo $footer; ?>