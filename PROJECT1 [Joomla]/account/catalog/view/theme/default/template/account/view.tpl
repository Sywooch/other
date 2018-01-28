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
        <li ><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ЗАЯВКИ НА ВЫВОД</span> </a></li>
        <li class="active"><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ИНВЕСТОРЫ</span> </a> </li>
       
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<?php } ?>
<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">

<?php if($this->customer->getAdmin()) { ?>
<div class="span12">      		
	      	<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Список финансовых операций</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content" style="padding: 20px;">
<h3>Имя: <?php echo $customer['firstname']; ?></h3>
<h3>Email: <?php echo $customer['email']; ?></h3>
<h3>Телефон: <?php echo $customer['telephone']; ?></h3>
<h3>Баланс: <?php echo (float)$customer['balance']; ?> руб.</h3>
<h3>Прибыль от рефералов: <?php echo (float)$customer['ref_balance']; ?> руб.</h3>
<h3>Зарегистрирован: <?php echo $customer['date_added']; ?></h3> </div> </div> </div>
<br>
 <div class="span12">      		
	      	<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Список финансовых операций</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Добавлено </th>
                    <th> Описание</th>
                    <th>Cумма</th>
                  </tr>
                </thead>
                <tbody>
					 <?php if ($transactions) { ?>
      <?php foreach ($transactions  as $transaction) { ?>
      <tr>
        <td ><?php echo $transaction['date_added']; ?></td>
        <td ><?php echo $transaction['description']; ?></td>
        <td ><?php echo $transaction['amount']; ?> руб.</td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td colspan="3"><?php echo $text_empty; ?></td>
      </tr>
      <?php } ?>
                  
                 
                </tbody>
              </table>
			  <div style="float: right;"><?php echo $pagination; ?></div>
            </div>
            <!-- /widget-content --> 
          </div>

<?php }  ?>
     </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
<?php echo $footer; ?>