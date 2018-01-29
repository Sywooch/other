
<? if(preg_match('/^orders/i', $uri)): ?>
    <li class="active"><a href="orders/list"><i class="icon-shopping-cart" title="Заказы"></i>Заказы <span class="badge">53</span></a></li>
<? else: ?>
    <li><a href="orders/list"><i class="icon-shopping-cart" title="Заказы"></i>Заказы <span class="badge badge-success">53</span></a></li>
<? endif; ?>


<? if(preg_match('/^pricing/i', $uri)): ?>
    <li class="active"><a href="pricing/currency"><i class="icon-usd" title="Ценообразование"></i>Ценообразование</a></li>
<? else: ?>
    <li><a href="pricing/currency"><i class="icon-usd" title="Ценообразование"></i>Ценообразование</a></li>
<? endif; ?>


<? if(preg_match('/^promo/i', $uri)): ?>
    <li class="active"><a href="promo/seo"><i class="icon-flag" title="Продвижение"></i>Продвижение</a></li>
<? else: ?>
    <li><a href="promo/seo"><i class="icon-flag" title="Продвижение"></i>Продвижение</a></li>
<? endif; ?>


<? if(preg_match('/^cat/i', $uri)): ?>
    <li class="active"><a href="cat/categories"><i class="icon-list-alt" title="Каталог"></i>Каталог</a></li>
<? else: ?>
    <li><a href="cat/categories"><i class="icon-list-alt" title="Каталог"></i>Каталог</a></li>
<? endif; ?>


<? if(preg_match('/^content/i', $uri)): ?>
    <li class="active"><a href="content/pages"><i class="icon-file" title="Содержание"></i>Содержание</a></li>
<? else: ?>
    <li><a href="content/pages"><i class="icon-file" title="Содержание"></i>Содержание</a></li>
<? endif; ?>


<? if(preg_match('/^users/i', $uri)): ?>
    <li class="active"><a href="users/customers"><i class="icon-group" title="Пользователи"></i>Пользователи</a></li>
<? else: ?>
    <li><a href="users/customers"><i class="icon-group" title="Пользователи"></i>Пользователи</a></li>
<? endif; ?>


<? if(preg_match('/^config/i', $uri)): ?>
    <li class="active"><a href="config/build"><i class="icon-wrench" title="Конфигурация"></i>Конфигурация</a></li>
<? else: ?>
    <li><a href="config/build"><i class="icon-wrench" title="Конфигурация"></i>Конфигурация</a></li>
<? endif; ?>


<? if(preg_match('/^reports/i', $uri)): ?>
    <li class="active"><a href="reports/service-stat"><i class="icon-bar-chart" title="Отчеты"></i>Отчеты</a></li>
<? else: ?>
    <li><a href="reports/service-stat"><i class="icon-bar-chart" title="Отчеты"></i>Отчеты</a></li>
<? endif; ?>




<?// if(preg_match('/^./i', $uri)): ?>
<!--    <li><a href="."><i class="icon-home"></i>Панель инструментов</span></a></li>-->
<?// else: ?>
<!--    <li class="active"><a href="."><i class="icon-home"></i>Панель инструментов</span></a></li>-->
<?// endif; ?>


<?/* if(preg_match('/^support/i', $uri)): */?><!--
    <li class="active"><a href="support"><i class="icon-envelope-alt"></i>Поддержка <span class="badge badge">12</span></span></a></li>
<?/* else: */?>
    <li><a href="support"><i class="icon-envelope-alt"></i>Поддержка</span> <span class="badge badge-success">12</span></a></li>
--><?/* endif; */?>
