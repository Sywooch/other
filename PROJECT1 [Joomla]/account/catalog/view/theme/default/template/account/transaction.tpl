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
       <li><a href="/account/index.php?route=account/wishlist"><i class=" icon-signal"></i><span>ПОЧТА</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
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
        <li><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ПАРТНЕРСКАЯ ПРОГРАММА</span> </a></li>
        <li class="active"><a href="/account/index.php?route=account/transaction"><i class=" icon-signal"></i><span>ВАШИ ИНВЕСТИЦИИ</span> </a> </li>
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

<?php } ?>




<?php if($this->customer->getAdmin()) { ?>

   <!-- Контент страницы ##############################################################-->   

<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">
	      
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php if ($warning) { ?>
<div class="warning"><?php echo $warning; ?></div>
<?php } ?>
          
          
	      	
	      	<div class="span12">      		
	      	<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Инвесторы</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <th class="left">ID</th>
        <th class="left">Контакты</th>
        <th class="right">Имя</th>
		<th class="right">Пригласил</th>
		<th class="right">Баланс</th>
		<th class="right">Зарегистрирован</th>
		<th class="right">Действия</th>
                  </tr>
                </thead>
                <tbody>
                   <?php if ($customers) { ?>
      <?php foreach ($customers  as $customer) { ?>
      <tr>
	   <td class="left"><?php echo $customer['customer_id']; ?></td>
        <td class="left"><?php echo $customer['email']; ?><br><?php echo $customer['telephone']; ?></td>
        <td class="right"><?php echo $customer['firstname']; ?></td>
		 <td class="left"><?php echo $customer['partner']; ?></td>
        <td class="left"><?php echo $customer['balance']; ?> руб.</td>
        <td class="left"><?php echo $customer['date_added']; ?></td>
        <td class="right"><a href="<?php echo $customer['view']; ?>">Просмотр</a><br><a href="<?php echo $customer['del']; ?>">Удалить</a></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td class="center" colspan="7">Инвесторов нет</td>
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
</div>    
<?php } else { ?>

   <!-- Контент страницы ##############################################################-->   

<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">
	      
	    
	      <div class="span6">
	      <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> Движение средств по Вашему счету</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart" class="chart-holder" height="203px" width="538px" style="width: 538px; height: 203px;"></canvas>
              <!-- /area-chart --> 
            </div>
            <!-- /widget-content --> 
          </div>
          </div>
          
          <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> Статистика Вашего баланса</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <h6 class="bigstats"><b>Отображается текущее состояние Вашего баланса<!--, также статистика пополнения и вывода средств с Вашего счета --><br></h6>
                  <div id="big_stats" class="cf">
                    <div class="stat"> <i class="">Баланс</i> <span class="value"><?php echo $total; ?> руб.</span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="">Введено</i> <span class="value"><?php echo $total_out; ?> руб.</span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="">Выведено</i> <span class="value"><?php echo $total_in; ?> руб.</span> </div>
                    <!-- .stat --> 
                    
                   
                    <!-- .stat --> 
                  </div>
                </div>
                 </div>
                </div>
                <!-- /widget-content --> 
               </div>
           </div>	<!-- /span6 -->
	      	
	      	<div class="span12">      		
	      	<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>История финансовых операций</h3>
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
	      		
	      		
	      		
	      		
	     
	      	
	      	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    </div>      
   <!-- Контент страницы ##############################################################-->   

  
  <?php } ?>
  

<script language="javascript" type="text/javascript" src="catalog/view/theme/default/js/full-calendar/fullcalendar.min.js"></script>
 
<script src="catalog/view/theme/default/js/base.js"></script> 
<script>     

        var lineChartData = {
			 <?php if ($transactions) { $transactions = array_reverse($transactions);?>
			 labels: [<?php foreach ($transactions  as $transaction) { ?><?php if(end($transactions) == $transaction) { ?>"<?php echo $transaction['date_added']; ?>"<?php } else { ?>"<?php echo $transaction['date_added']; ?>",<?php } ?><?php } ?>],
			
	  
         
            datasets: [
				{
				    fillColor: "rgba(110,171,5,0.8)",
				    strokeColor: "rgba(220,220,220,1)",
				    pointColor: "rgba(220,220,220,1)",
				    pointStrokeColor: "#fff",
				    data: [<?php foreach ($transactions  as $transaction) { ?><?php if(end($transactions) == $transaction) { ?><?php echo $transaction['amount']; ?><?php } else { ?><?php echo $transaction['amount']; ?>,<?php } ?><?php } ?>]
				},
				/*{
				    fillColor: "rgba(151,187,205,0.5)",
				    strokeColor: "rgba(151,187,205,1)",
				    pointColor: "rgba(151,187,205,1)",
				    pointStrokeColor: "#fff",
				    data: [28, 48, 40, 19, 96, 27, 100]
				}*/
			] <?php }  else { ?>
			labels: [<?php echo date('Y-m-d');?>]
<?php } ?>
        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);


        var barChartData = {
            labels: ["Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь"],
            datasets: [
				{
				    fillColor: "rgba(220,220,220,0.5)",
				    strokeColor: "rgba(220,220,220,1)",
				    data: [65, 59, 90, 81, 56, 55, 40]
				},
				{
				    fillColor: "rgba(151,187,205,0.5)",
				    strokeColor: "rgba(151,187,205,1)",
				    data: [28, 48, 40, 19, 96, 27, 100]
				}
			]

        }    

        $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          selectable: true,
          selectHelper: true,
          select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
              calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }
            calendar.fullCalendar('unselect');
          },
          editable: true,
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1)
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d+5),
              end: new Date(y, m, d+7)
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d-3, 16, 0),
              allDay: false
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d+4, 16, 0),
              allDay: false
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d+1, 19, 0),
              end: new Date(y, m, d+1, 22, 30),
              allDay: false
            },
            {
              title: 'EGrappler.com',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://EGrappler.com/'
            }
          ]
        });
      });
    </script><!-- /Calendar -->
<?php echo $footer; ?>