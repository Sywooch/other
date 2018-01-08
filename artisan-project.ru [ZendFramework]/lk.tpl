<div class="header zeroBox">
        <div class="line">
            <div class="box">
                <a href="/">
                    <div class="imgWrap">
                        <img src="/public/site1/lk/images/logo.png" alt="logo">
                    </div>
                    <p>Оптовая продажа плитки, сантехники</p>
                </a>
            </div>
            <div class="box">
                <div class="block">
                    <p class="tel">8 495 989-7393</p>
                    <p><a href="/contacts#scroll1" style="color:rgb(60, 65, 69);text-decoration: underline;">Менеджеры</a></p>
                    <!--<a href="/contacts/">Все контакты</a>-->
                </div>
                <div class="block">
                    <p class="tel">8 495 933-5033</p>
                    <p><a href="/contacts#scroll17" style="color:rgb(60, 65, 69);text-decoration: underline;">Администраторы</a></p>
                </div>
            </div>
            <div class="box">
                <div class="block">
                    <a href="/complaints/">Написать директору</a>
                </div>
                
                
                
                <div class="block">
                    <p>Личный кабинет</p>
					<p><a href="/">Перейти на сайт</a></p>
                    <a href="javascript:void(0)">{php} echo $this->page->dealer['login']; {/php}</a>
                    <span><a href="/profile/logout">выйти</a></span>
                    
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
<div class="navigation">
        <div class="zeroBox">
            <div class="line">
                <ul class="nav">
                    <li><a {if $smarty.server.REQUEST_URI == '/requests' or $smarty.server.REQUEST_URI == '/requests/' or $smarty.server.REQUEST_URI == '/requests/archive' or $smarty.server.REQUEST_URI == '/requests/archive/'} class="active" {/if} href="/requests/archive/">Заявки</a></li>
                    <li><a
                    {if strpos($smarty.server.REQUEST_URI, 'shipment/archive')  != false } class="active" {/if}
                     href="/shipment/archive">Отгрузки</a></li>
                    <li><a 
                    {if strpos($smarty.server.REQUEST_URI, 'complaints')  != false } class="active" {/if}
                    href="/complaints/archive">Архив писем</a></li>
                    <li><a
                    {php} if(strpos($_SERVER['REQUEST_URI'], 'docs') !== false){ echo'class="active"'; } {/php}
                     href="/requests/docs/">Документы</a></li>
                    <li><a
                    {php} if(strpos($_SERVER['REQUEST_URI'], 'prise') !== false){ echo'class="active"'; } {/php}
                     href="/requests/prise/">Прайс-лист</a></li>
                    <li><a
                    {if $smarty.server.REQUEST_URI == '/profile/' or $smarty.server.REQUEST_URI == '/profile'} class="active" {/if}
                     href="/profile">Личные данные</a></li>
                    <li>
                        <a href="javascript:void(0)">
                            <input type="text" name="search" placeholder="Поиск">
                        </a>
                    </li>
                </ul>
                <div class="dropMenu">
                    <div class="firstLine">
                        <span>Меню</span>
                        <div class="dropButton"></div>
                    </div>
                    <ul class="dropped" style="display: none;">
                        <li><a {if $smarty.server.REQUEST_URI == '/requests' or $smarty.server.REQUEST_URI == '/requests/' or $smarty.server.REQUEST_URI == '/requests/archive' or $smarty.server.REQUEST_URI == '/requests/archive/'} class="active" {/if} href="/requests/archive/">Заявки</a></li>
                        <li><a
                        {if strpos($smarty.server.REQUEST_URI, 'shipment/archive')  != false } class="active" {/if}
                         href="/shipment/archive">Отгрузки</a></li>
                        <!--<li>
                        <a 
                        {if strpos($smarty.server.REQUEST_URI, 'complaints/archive')  != false } class="active" {/if}
                        href="/complaints/archive">Претензии</a></li>-->
                        <li><a
                    {php} if(strpos($_SERVER['REQUEST_URI'], 'docs') !== false){ echo'class="active"'; } {/php}
                     href="/requests/docs/">Документы</a></li>
                        <li><a
                    {php} if(strpos($_SERVER['REQUEST_URI'], 'prise') !== false){ echo'class="active"'; } {/php}
                     href="/requests/prise/">Прайс-лист</a></li>
                        <li><a
                    {if $smarty.server.REQUEST_URI == '/profile/' or $smarty.server.REQUEST_URI == '/profile'} class="active" {/if}
                     href="/profile">Личные данные</a></li>
                        <li>
                            <a href="javascript:void(0)">
                                <input type="text" name="search" placeholder="Поиск">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- лента -->
   <div class="container_feed">
   		<div class="feed">
        	<ul>
            {foreach from=$news_lk item=n}
         		<li><a target="_blank" data-h="{$n.title_full}" href="/about/news/id/{$n.id}/">{$n.title}</a><span>{$n.cdate|date_format:'%d'}
                {assign var=month value=$n.cdate|date_format:'%m'}
                {if $month == 1}
                    января
                {elseif $month == 2}
                    февраля
                {elseif $month == 3}
                    марта
                {elseif $month == 4}
                    апреля
                {elseif $month == 5}
                    мая
                {elseif $month == 6}
                    июня
                {elseif $month == 7}
                    июля
                {elseif $month == 8}
                    августа
                {elseif $month == 9}
                    сентября
                {elseif $month == 10}
                    октября
                {elseif $month == 11}
                    ноября
                {elseif $month == 12}
                    декабря
                {/if}
                {$n.cdate|date_format:'%Y'}</span></li>
            {/foreach}
            
            {foreach from=$docs_lk item=n}
         		<li><a data-h="{$n.title_full}" href="/requests/download/?link={$n.file}">{$n.title}</a><span>{$n.cdate|date_format:'%d'}
                {assign var=month value=$n.cdate|date_format:'%m'}
                {if $month == 1}
                    января
                {elseif $month == 2}
                    февраля
                {elseif $month == 3}
                    марта
                {elseif $month == 4}
                    апреля
                {elseif $month == 5}
                    мая
                {elseif $month == 6}
                    июня
                {elseif $month == 7}
                    июля
                {elseif $month == 8}
                    августа
                {elseif $month == 9}
                    сентября
                {elseif $month == 10}
                    октября
                {elseif $month == 11}
                    ноября
                {elseif $month == 12}
                    декабря
                {/if}
                {$n.cdate|date_format:'%Y'}</span></li>
            {/foreach}
            </ul>
        </div>
   </div> 
    
    
    
    
    {if   strpos($smarty.server.REQUEST_URI, 'requests/archive')  != false }
    {loadview name=lk_main}
    {/if}
	 {if   strpos($smarty.server.REQUEST_URI, 'requests/prise')  != false }
    {loadview name=lk_show}
    {/if}
	 {if   strpos($smarty.server.REQUEST_URI, 'requests/ok')  != false }
    {loadview name=lk_main_edit_ok}
    {/if}
     {if   strpos($smarty.server.REQUEST_URI, 'requests/docs')  != false }
    {loadview name=lk_docs}
    {/if}
    {if strpos($smarty.server.REQUEST_URI, 'requests/show/type/onorder/id')  != false  }
    {loadview name=lk_show}
    {/if} 
	 {if strpos($smarty.server.REQUEST_URI, 'requests/show/id')  != false  }
    {loadview name=lk_show}
    {/if}
    {if $smarty.server.REQUEST_URI == '/requests/selection' or $smarty.server.REQUEST_URI == '/requests/selection/' }
    {loadview name=lk_selection}
    {/if}
    
    {if $smarty.server.REQUEST_URI == '/requests' or $smarty.server.REQUEST_URI == '/requests/' or strpos($smarty.server.REQUEST_URI, 'requests?')  != false}
    {loadview name=lk_main_new}
    {/if}
    
    {if $smarty.server.REQUEST_URI == '/profile/' or $smarty.server.REQUEST_URI == '/profile'}
    {loadview name=lk_info}
    {/if}
    {if $smarty.server.REQUEST_URI == '/profile/edit/' or $smarty.server.REQUEST_URI == '/profile/edit'}
    {loadview name=lk_edit}
    {/if}
	{if $smarty.server.REQUEST_URI == '/profile/change_pass/' or $smarty.server.REQUEST_URI == '/profile/change_pass' or strpos($smarty.server.REQUEST_URI, 'profile/change_pass')  != false}
    {loadview name=lk_change_pass}
    {/if}
    {if $smarty.server.REQUEST_URI == '/shipment/archive' or $smarty.server.REQUEST_URI == '/shipment/archive/' or strpos($smarty.server.REQUEST_URI, 'shipment/archive')  !== false}
    {loadview name=lk_otgruzki}
    {/if}
    
    {if $smarty.server.REQUEST_URI == '/shipment' or $smarty.server.REQUEST_URI == '/shipment/' or strpos($smarty.server.REQUEST_URI, 'shipment?')  != false}
    {loadview name=lk_otgruzki_new}
    {/if}   
    
    {if strpos($smarty.server.REQUEST_URI, 'complaints/history/id')  != false  }
    {loadview name=lk_pretenzii_id}
    {/if} 
    
    {if $smarty.server.REQUEST_URI == '/complaints/archive' or $smarty.server.REQUEST_URI == '/complaints/archive/'}
    {loadview name=lk_pretenzii}
    {/if} 
    
    {if $smarty.server.REQUEST_URI == '/complaints' or $smarty.server.REQUEST_URI == '/complaints/'}
    {loadview name=lk_pretenzii_new}
    {/if}
    
    
<div class="footer">
        <div class="zeroBox">
            <p>
                © Артисан 2011-2015
            </p>
        </div>
    </div>
    
    
 <div class="shadowBoxPopUp"></div>
 
 
 <script src="/public/site1/lk/lib/jquery-2.1.4.min.js"></script>
 <script src="/public/site1/lk/lib/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
 <script src="/public/site1/lk/lib/jquery.mCustomScrollbar.concat.min.js"></script>
 <script src="/public/site1/lk/lib/jquery.formstyler.min.js"></script>
 <script src="/public/site1/lk/js/mainJS.js"></script>
 
 <script src="/public/site1/lk/js/zajavkiJS.js"></script>
 {if strpos($smarty.server.REQUEST_URI, 'shipment') === false}
 
 {/if}
 <script src="/public/site/js/jquery.simplemodal.js"></script>
 <script src="/public/site/css/jquery.simplemodal.css"></script>
   <script src="/public/site/js/shipment.js"></script>
  
 {if strpos($smarty.server.REQUEST_URI, 'requests') === false}
  <script src="/public/site1/lk/js/otgruzkiJS.js"></script>
 {/if}
  
{if strpos($smarty.server.REQUEST_URI, 'shipment/archive') !== false}

  <script src="/public/site1/lk/js/otgruzkiJS2.js"></script>

{/if}





    
{if ($smarty.server.REQUEST_URI == "/requests") or (strpos($smarty.server.REQUEST_URI, 'requests?') !== false)}  
    
  <script src="/public/site1/lk/js/zajavkiJS_2.js"></script>   
  <script src='/public/site/js/jquery.pnotify.js?23927' type='text/javascript'></script>
  <link href='/public/site/css/jquery.pnotify.css' rel='stylesheet' type='text/css'>
  
 <link href='/public/site1/lk/styles/buttons.css' rel='stylesheet' type='text/css'>
 <script src='/public/site1/lk/js/jquery.noty.packaged.js' type='text/javascript'></script>
   

{/if}




<div class="modal fade request_alert" id="success_modal" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ПОВТОРНОЕ ДОБАВЛЕНИЕ ОДИНАКОВЫХ НОМЕНКЛАТУР НЕ ДОПУСКАЕТСЯ</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="img" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><a href="">Скачать</a></h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>










