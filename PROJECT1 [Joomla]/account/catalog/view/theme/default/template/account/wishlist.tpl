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
        <li ><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ИНВЕСТОРЫ</span> </a> </li>
       <li class="active"><a href="/account/index.php?route=account/wishlist"><i class=" icon-signal"></i><span>ПОЧТА</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->

<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?><form action="<?php echo $send; ?>" method="POST">
<table id="mail" class="form" style="width: 100%;">

          <tr>
            <td><span class="required">*</span> Tема сообшения</td>
            <td><input type="text" name="subject" value="" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span> Текст сообщения</td>
            <td><textarea name="message" style="width: 100%;height: 200px;"></textarea></td>
          </tr>
        </table>
		 <input type="submit" value="Отправить" class="btn btn-large btn-success btn-support-ask" />
		</form>
		</div></div></div></div><?php } ?>
<?php echo $footer; ?>