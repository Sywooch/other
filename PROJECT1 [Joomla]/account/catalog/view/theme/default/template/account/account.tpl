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
        <li class="active"><a href=""><i class="icon-home"></i></i><span>ГЛАВНАЯ</span> </a> </li>
        <li><a href="/account/index.php?route=account/edit"><i class="icon-file"></i><span>ВАШ ПРОФИЛЬ</span> </a> </li>
        <li ><a href="/account/index.php?route=account/partner"><i class="icon-user"></i><span>ПАРТНЕРСКАЯ ПРОГРАММА</span> </a></li>
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
        <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3>СТАТИСТИКА НАЧИСЛЕНИЯ ПРОЦЕНТОВ ПО МЕСЯЦАМ ЗА ВЕСЬ ПЕРИОД</h3>
            </div>
            <p>
	<iframe align="center" frameborder="no" scrolling="no "height="420" src="http://kondratik.ru/account/grafiki/stata.html" width="1165px">Ваш браузер не поддерживает плавающие фреймы!</iframe></p>
     
      </div> </div>
      <div class="span12">
        <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3>СТАТИСТИКА РАСПРЕДЕЛЕНИЯ СРЕДСТВ НА СЧЕТАХ, В USD</h3>
            </div>
            <p>
	<iframe align="center" frameborder="no" scrolling="no "height="300" src="http://kondratik.ru/account/grafiki/raspredel.html" width="1165px">Ваш браузер не поддерживает плавающие фреймы!</iframe></p>
     
      </div> </div>
      <div class="span12">
        <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3>СТАТИСТИКА ДВИЖЕНИЯ СРЕДСТВ В ПРОЕКТЕ: ПОПОЛНЕНИЕ И ЗАРАБОТАННЫЕ СРЕДСТВА, В USD</h3>
            </div>
            <p>
	<iframe align="center" frameborder="no" scrolling="no "height="420" src="http://kondratik.ru/account/grafiki/dvizhenie.html" width="1165">Ваш браузер не поддерживает плавающие фреймы!</iframe></p>
     
      </div> </div>
      
       <!-- <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> Статистика доходности за Октябрь 2014 по счетам</h3>
            </div>
           
               <html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Счет БК Марафон',     27231],
          ['Счет БК Зенит',     32608],
          ['Счет БК Бетсити',  140257],
          ['Счет БК Бет365', 60807],
          ['Счет БК Пари матч',   54101]
        ]);

        var options = {
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 100%; height: 400px;"></div>
  </body>
</html> 
              </div> -->
            </div>
        
        <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Главные новости нашего проекта</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
                <li>
                  
                  <div class="news-item-date"> <span class="news-item-day">29</span> <span class="news-item-month">Августа</span> </div>
                  <div class="news-item-detail"> <a href="http://kondratik.ru/index.php/investitsii/84-news/120-otvety-na-voprosy" class="news-item-title" target="_blank">Вопросы касательно платежных систем</a>
                    <p class="news-item-preview"> Привет всем! Мне последнее время задают кучу вопросов касательно платежных систем, способов ввода и вывода, а также планов на будущее. Сейчас постараюсь ответить на некоторые из них </p>
                  </div>
                  
                </li>
                <li>
                  
                  <div class="news-item-date"> <span class="news-item-day">15</span> <span class="news-item-month">Ноября</span> </div>
                  <div class="news-item-detail"> <a href="http://kondratik.ru/account/index.php?route=account/transaction" class="news-item-title" target="_blank">Обновление Кабинета Инвесторов</a>
                    <p class="news-item-preview">Дорогие друзья! Наконец настал этот момент - запуск обновленного Кабинета!  С чем мы Вас и нас :-)  поздравляем! Заходите, чтобы оценить преимущества!
Удачных инвестиций, господа!</p>
                  </div>
                  
                </li>
                
                
                
                <li>
                  
                  <div class="news-item-date"> <span class="news-item-day">28</span> <span class="news-item-month">Ноября</span> </div>
                  <div class="news-item-detail"> <a href="#" class="news-item-title" target="_blank">Новости за неделю!</a>
                    <p class="news-item-preview">Дорогие друзья!<br>

Хочу вам рассказать о плохих и хороших новостях произошедших с нашим проектом на этой неделе. <br>

<b>Первая новость плохая:</b> мой аккаунт в социальной сети в контакте пытались взломать, поэтому его заблокировали,  восстановить доступ смогу только через неделю, поэтому вся связь через почту, VIP-клиенты - звоним на телефон.<br>

<b>Вторая новость лучше:</b> для пользователей нашего сайта стала доступна 3д-статистика и онлайн обзор матчей по адресу http://kondratik.ru/online.html <br>

<b>Третья новость хорошая:</b> мы уже подводим итоге по работе за прошлый месяц, скоро начисление процентов. <br>

<b>Четвертая:</b> я уезжаю на пару дней в Турцию на бизнес-конференцию (с 12 декабря - 18 декабря), поэтому буду отвечать реже, чем обычно.<br>

<b>Также</b> по случаю приближающихся праздников мы приукрасили наш сайт, также статистика начисления стала более понятной. Сейчас работаем над выведением статистики по каждому счету индивидуально. (счетов у нас 5, скоро откроем еще 2) <br>

Всех  с наступающими праздниками!<br>

С уважением, Михаил Кондратов!</p>
                  </div>
                   </li>
                  <li>
                  <div class="news-item-date"> <span class="news-item-day">6</span> <span class="news-item-month">Декабря</span> </div>
                  <div class="news-item-detail"> <a href="http://kondratik.ru/index.php/aktsii/87-aktsii/97-promo-rolik" class="news-item-title" target="_blank">Конкурс на проекте</a>
                  <p class="news-item-preview">Друзья, я хочу Вас всех поздравить
                      с наступающими праздниками, пожелать Вас успехов во всех Ваших начинаниях, финансового благополучия и крепкого здоровья. У меня возникла идея создать для проекта красивый видео промо-ролик.
                      Принять участие могут все желающие, независимо от статуса на проекте. Оценивать буду лично. Победитель получить в подарок кофемашину Bosch TES71221RW. Подробнее об этом  <a href="http://kondratik.ru/index.php/aktsii/87-aktsii/97-promo-rolik">на 
                      странице акции</a> Всем удачи!
                  </p>
                  </div>
                  
                  
                  
                  
                </li>
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        
        
        
          
          
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<!-- Контент страницы ##############################################################-->  
<?php echo $footer; ?> 