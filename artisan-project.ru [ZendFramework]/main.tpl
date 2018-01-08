
<!doctype html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  
	<title>{$meta.title|default:$title}</title>
	<meta name="keywords" content="{$meta.keywords}">
	<meta name="description" content="{$meta.description}">
	<meta name="author" content="{$meta.author}">
	<link rel="Shortcut Icon" href="/public/site/img/favicon.ico">
    
    
    
 {if (strpos($smarty.server.REQUEST_URI, 'profile')  != false) or (strpos($smarty.server.REQUEST_URI, 'requests')  != false) or (strpos($smarty.server.REQUEST_URI, 'shipment')  != false) or (strpos($smarty.server.REQUEST_URI, 'complaints')  != false) }
 
 {else}
    
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
    <script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"/></script>
    
    <link rel="stylesheet" href="/public/site1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/site1/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/public/site1/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/public/site1/css/prettyPhoto.css">
    <link rel="stylesheet" href="/public/site1/scroll/jquery.scrollbar.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <script src="/public/site1/js/bootstrap.min.js"></script>
    <script src="/public/site1/js/jquery.fancybox.pack.js"></script>
    <script src="/public/site1/js/jquery.custom-scrollbar.js"></script>
    <script src="/public/site1/js/jquery.scroll-min.js"></script>
    <script src="/public/site1/js/scripts.js"></script>
    <script src="/public/site1/js/jquery.prettyPhoto.js"></script>
    <script src="/public/site1/js/jquery.validate.min.js"></script>
    <script src="/public/site1/js/scripts.js"></script>
    
    <script src="/public/site1/js/spin.js"></script>

    {if (strpos($smarty.server.REQUEST_URI, 'about/transportation')  != false)}
    <script src="/public/site1/js/delivery.js"></script>
    {/if}
    <script src="/public/site1/js/map.js"></script>
	
	<script src="/public/site1/js/jquery.nicescroll.js"></script>
    <script src="/public/site1/scroll/jquery.scrollbar.js"></script>
    
    <!--<script src='http://api-maps.yandex.ru/1.1/index.xml?key=AD3J8U4BAAAAtmXLFgIA16GE6GRdjd6GS54xXIEOTWZBCV4AAAAAAAAAAABrutC0HICJATowvCaUQi_qH5hH0Q==&23927' type='text/javascript'></script>
    -->
    
    
    <!--<script src="http://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>-->
    <!--<script src="https://api-maps.yandex.ru/1.1.21/?lang=ru_RU" type="text/javascript"/></script>-->
    
    <script src="/public/site1/js/jquery.session.js"></script>
    <script src="/public/site1/js/jquery.textchange.min.js"></script>

    <script src="/public/site1/js/jquery.bxslider.min.js"></script>

    <link href="/public/site1/css/main.css" rel="stylesheet">
    
 {/if}   
    
    
{if (strpos($smarty.server.REQUEST_URI, 'profile')  != false) or (strpos($smarty.server.REQUEST_URI, 'requests')  != false) or (strpos($smarty.server.REQUEST_URI, 'shipment')  != false) or (strpos($smarty.server.REQUEST_URI, 'complaints')  != false) }

{loadview name=lk_head}


{else}



{/if}

  
  
  
{if (strpos($smarty.server.REQUEST_URI, 'complaints')  !== false)}  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    <script src="/public/site1/js/jquery.fancybox.pack.js"></script>

    <script src="/public/site1/js/scripts.js"></script>


  
{/if}
  
  
  
  

          
  
</head>




{if strpos($smarty.server.REQUEST_URI, 'profile')  != false }
<body class="lichnyeDannye">
{elseif strpos($smarty.server.REQUEST_URI, 'shipment/archive')  != false  }
<body class="otgruzkiPage">
{elseif strpos($smarty.server.REQUEST_URI, 'shipment')  != false  }
<body class="otgruzkiPage otgruzkiSecond zajavki">
{elseif strpos($smarty.server.REQUEST_URI, 'complaints/history/id')  != false  }
<body class="oneClaim">
{elseif strpos($smarty.server.REQUEST_URI, 'requests/archive')  != false  }
<body class="zajavki">
{elseif strpos($smarty.server.REQUEST_URI, 'requests')  != false  }
<body class="zajavki novajaZajavka">
{else}
<body>
{/if}







{if (strpos($smarty.server.REQUEST_URI, 'profile')  != false) or (strpos($smarty.server.REQUEST_URI, 'requests') != false) or (strpos($smarty.server.REQUEST_URI, 'shipment')  != false) or (strpos($smarty.server.REQUEST_URI, 'complaints')  != false)  }

{loadview name=lk}

{else}
  


<div id="wrapper">

<div class="header_container">
    <div class="container">
        <div class="row row_header">
            <div class="col-md-2">
                <a href="/" id="logo">
                    <img src="/public/site1/images/logo.png">
                    <span>Оптовая продажа плитки</span>
                </a>
            </div>
            <div class="col-md-6">
                <div class="main_phones clearfix">
                    <div class="main_phones_container">
                        <span>8 (499) 724-28-10</span>
                        <i>Архитекторам и строителям</i>
                    </div>
                    <div class="main_phones_container">
                        <span>8 (495) 989 73 93</span>
                        <i>Дилерский отдел</i>
                    </div>
                    <div class="main_phones_container">
                        <span>8 (495) 742-40-40 </span>
                        <i>Розничный магазин</i>
                    </div>
                </div>
                <div class="header_center_fix">
                    <div class="header_zayavka">
                        <a href="#" data-toggle="modal" data-target="#request1">Заявка на сотрудничество</a>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
            {php}
            
            {/php}
                <div class="header_cart">
                    
                    <div class="header_total cart_block">
                    {php}
                  	//echo"<pre>";
                   // print_r($this->page->basket_goods);
                    //echo"</pre>";
                   // if($this->page->basket_goods == ""){ echo"==";  }
                    
                    {/php}
                    
                    {php} if( ((sizeof($this->page->basket)==0) && (sizeof($this->page->basket_goods)==0)) ){ {/php}
                        Корзина пуста
                    {php} 
                    
                    }else if(($this->page->basket_goods=="") && ($this->page->basket=="")){ 
                    	echo "Корзина пуста";
                    
                    
                    }else if(($this->page->basket_goods=="")){ 
                    	echo '<a href="/cart">'.(count($this->page->basket))." товаров".'</a>';
                    }else if(($this->page->basket=="")){ 
                    	echo '<a href="/cart">'.(count($this->page->basket_goods))." товаров".'</a>';
                    }else{   
                       echo '<a href="/cart">'.(sizeof($this->page->basket)+sizeof($this->page->basket_goods))." товаров".'</a>';
                    } 
                    {/php}
                    </div>
                    <div class="header_go_catalog">
                        <a href="/cat">Перейти в каталог</a>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="header_meta_links {php} if(isset($this->_tpl_vars['dealer']['login'])){ echo 'dealer'; } {/php}"> 
                	
                    {php}
                    if(isset($this->_tpl_vars['dealer']['login'])){
                    {/php}
 					<div class="header_cart">
                    <div class="header_total">
                       <a href="/requests/archive">{php} echo $this->_tpl_vars['dealer']['login'] {/php}</a>
					   <br>
					   <a style="text-decoration: underline;" href="/requests/archive">Войти в кабинет</a>
                    </div>
                    <div class="header_go_catalog">
                       <a href="/profile/logout">Выйти</a>
                    </div>
                	</div>
                    {php}
                    }else{
                    {/php}               	
                    <div class="hml_cont_1"><a href="#" data-toggle="modal" data-target="#login">Вход для дилера</a></div>
                    <div class="hml_cont_2"><a href="#" data-toggle="modal" data-target="#registration">Регистрация дилера</a></div>
                	{php}
                    }
                    {/php}
                
                </div>
            </div>
        </div>
    </div>
</div>

{php}
//echo "<pre>";
//print_r($this->_tpl_vars['dealer']['login']);
//echo "</pre>";
{/php}	

<section class="main_navigation">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar ">

                <div class="navbar-header">
                     
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                         <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>

                    </button>
                    <div class="sr-only-text">Меню</div>
                </div>
                 {loadview name=menu}
                
                
            </nav>
            </div>
        </div>
    </div>
</section>

<div class="alert alert-success alert-dismissable">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×
                </button>



                <div id="panel_top">
                    {$message_block_text1} <a class="alert-link panel-title collapsed" data-toggle="collapse" data-parent="#panel_top" href="#panel_top_child">
                        <span class="raz1">Развернуть</span>
                        <span class="raz2">Свернуть</span>

                    </a>
                        
                    <div id="panel_top_child" class="panel-collapse collapse">
                        <div>
                            {$message_block_text2}
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>


{if $smarty.server.REQUEST_URI == '/' or $smarty.server.REQUEST_URI == ''}
<section class="main_theme">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="sliderr">
                    <div class="slider_fix">
                    <!--
                    		{foreach from=$dealers_top_banners item=ban}
        					{$ban.url}={$ban.title|htmlspecialchars_decode|strip_tags}
            				={$ban.image|replace:'[dir]':'big'}={$ban.title|htmlspecialchars_decode|strip_tags}
            				={if $ban.title || $ban.descr}
            					={$ban.title|htmlspecialchars_decode}
                				={$ban.descr|htmlspecialchars_decode}
           					{/if}
        					{/foreach}
                        -->    
                            
                           
                            
                          
                    
                    
                        <ul class="bxslider_front">
                        
                        
                        {foreach from=$main_slider item=ban}
                        
                            <li>
                            
                            
                            
                            
                                <img src="{$ban.image|replace:'[dir]':'original'}" />
                                
                                <div class="slide_meta">
                                    <div class="slide_bg">
                                        <h3>{$ban.title|htmlspecialchars_decode|strip_tags}</h3>
                                        <p>{$ban.description|htmlspecialchars_decode|strip_tags}</p>
                                    </div>
                                    <div class="slide_more">
                                        <a href="{$ban.link}" class="yellow_button">Узнать подробнее</a>
                                    </div>
                                </div>
                            </li>   
                            
                        {/foreach}    
                            
                            
                            
                            
                            
                           


                        </ul>
                    </div>
                    <div id="slider_pager" class="clearfix">
                    {php}  $count=0;  {/php} 
                    {foreach from=$main_slider item=ban}
                        <a data-slide-index="{php}  echo $count;  $count++; {/php}" href=""><span>{$ban.title|htmlspecialchars_decode|strip_tags}</span></a>
                        
                    {/foreach}     
                    </div>
                </div>

            </div>
            {loadview name=mainnews}
        </div>
    </div>
</section>

     
<div class="front_manufacturer_continer">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <div class="front_manufacturer_block clearfix">
                    <span>Производители:</span>
					 <ul class="clearfix">
					{foreach from=$country item=ee}
                   
                        <li><a href="/cat/country/{$ee.url|strip_tags|trim}/"><i class="flag"><img src="{$ee.flag|replace:'[dir]':'icon'}" alt="{$ee.mtitle}" title="{$ee.mtitle}"></i>{$ee.import_title|strip_tags|trim}</a></li>
                    
					{/foreach}
                    
					</ul>
                </div>
            </div>

        </div>
    </div>
</div>   

	{loadview name=main_block1}
	{loadview name=main_block2}
	{loadview name=main_block3}

{else}

{php}
//print_r($this->page);
//echo $this->page->request['id'];
// 
//echo $this->page->page_content_back['title'];
{/php}

<section class="inner_content_header news_content_continer">
    <div class="container">
        <div class="row">
            {if strpos($smarty.server.REQUEST_URI, 'cat/id')  != false  }
            <div class="col-sm-8 text-left tmp1">
            {else}
            <div class="col-sm-6 text-left tmp1">
            {/if}
                {if strpos($smarty.server.REQUEST_URI, 'cat/id')  != false  }
                
                
                <h1 class="fabrique">Коллекция  {php}echo $this->page->collection_name; {/php}</h1>
                <span class="h1_fabrique">Фабрика <a href="/cat/{php}echo $this->page->current_factory['url'];{/php}">{php}echo $this->page->current_factory['name'];{/php} <i class="flag_es" 
style="background-image:url({php} echo str_replace("[dir]","icon",$this->page->current_factory['flag']);{/php});"></i></a></span>
                
                {else}
                
                <h1>
                
                
                {if strpos($smarty.server.REQUEST_URI, 'cat/type/purpose')  != false}
                	{$purpose_name} 
                {elseif strpos($smarty.server.REQUEST_URI, 'cat/type/material')  != false}
                	{$material_name} 
                {elseif strpos($smarty.server.REQUEST_URI, 'cat/sale')  != false}
                	Распродажа 	
                {elseif strpos($smarty.server.REQUEST_URI, 'cat/novice')  != false}
                	Новинки  
                {elseif strpos($smarty.server.REQUEST_URI, 'cat/action')  != false}
                	Акции           	
                {elseif strpos($smarty.server.REQUEST_URI, 'merchfactory')  != false or strpos($smarty.server.REQUEST_URI, 'merchtype')  != false}
                	{php} echo $this->page->head; {/php}          	
                {else}
                	{php}
                    
					if($this->page->page_content_back['title']!=""){
					  echo $this->page->page_content_back['title'];
					}else{
					  echo $this->page->page_content['title'];
					}
                    
                	{/php}
                {/if}
                
                
                
                {php}
                
                if($this->page->page_content['title']==""){
                
                
                {/php}
                
                {if strpos($smarty.server.REQUEST_URI, 'cat')  != false and strpos($smarty.server.REQUEST_URI, 'cat/country')== false and  strpos($smarty.server.REQUEST_URI, 'cat/id') == false }
                Фабрика {$factory.title}
                {/if}
                
                {if strpos($smarty.server.REQUEST_URI, 'cat/country')  != false and $country.mtitle != ""}
         		{$country.mtitle}       
                {/if}
             	
                {if strpos($smarty.server.REQUEST_URI, 'search')  != false}
                Результаты поиска
                {/if}
         
                {if strpos($smarty.server.REQUEST_URI, 'cart')  != false}
                Корзина
                {/if}
                
                {php}
                }
                
				
				{/php}</h1>
                
                
                {/if}
                
                
                
                
                
            </div>
            
            {if strpos($smarty.server.REQUEST_URI, 'cat/id')  == false  }
            
            <div class="col-sm-3 text-right">
                
                {if $smarty.server.REQUEST_URI == '/contacts' or $smarty.server.REQUEST_URI == '/contacts/'}
                	{loadview name=contacts_print_link}
                
                
                {/if}

            </div>
            {/if}
            
            
            {if strpos($smarty.server.REQUEST_URI, 'cat/id')  != false  }
            <div class="col-sm-4 text-right">
            {else}
            <div class="col-sm-3 text-right">
            {/if}
                
                <div class="breadcrumbs">
				<span class="with_arrow"><a href="/">Главная</a></span>
				{php}
				$raw_data=$this->page->bread_crumbs;
                
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/country')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]=$this->page->country['mtitle'];
                }
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/sale')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Распродажа";
                }
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/novice')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Новинки";
                }
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/action')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Акции";
                }
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/type/purpose')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]=$this->page->purpose_name;
                    
                }
               
                if(strpos($_SERVER['REQUEST_URI'], 'cat/type/material')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]=$this->page->material_name;
                    
                } 
                
                if(isset($this->page->factory['title'])){
                	$raw_data[$_SERVER['REQUEST_URI']]=$this->page->factory['title'];
                }
                
                if(strpos($_SERVER['REQUEST_URI'], 'cat/id')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Коллекция ".$this->page->list_collections[$this->page->request['id']];
                	
                } 
                
                 if(strpos($_SERVER['REQUEST_URI'], 'search')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Результаты поиска";
                	
                } 
                
                if(strpos($_SERVER['REQUEST_URI'], 'cart')  != false){
                	$raw_data[$_SERVER['REQUEST_URI']]="Корзина";
                	
                } 
                
                if((strpos($_SERVER['REQUEST_URI'], 'merchfactory')  != false) || (strpos($_SERVER['REQUEST_URI'], 'merchtype')  != false)){
                	$raw_data[$_SERVER['REQUEST_URI']]=$this->page->head;
                	
                } 
                
				$s=1;
					foreach ($raw_data as $k=>$v) {
						if(count($raw_data)!=$s){
							echo '<span class="with_arrow"><a href="'.$k.'">'.$v.'</a></span>';
						}else{
							echo '<span><a href="'.$k.'">'.$v.'</a></span>';
						}
						$s++;
					}
					
					
				{/php}
			</div>

            </div>
        </div>
        
          
          {if $factory.title != ""  }
          
          {loadview name=catalog/factory_description}
       
    	  {/if}
    
    
    
    
    </div>
    
    
    
    
    
    
    
    
    
    
  
    
    
    
    
    
    
    
    
</section>

   
                

{if $smarty.server.REQUEST_URI == '/cat' or $smarty.server.REQUEST_URI == '/cat/'}

{loadview name=section1}
{loadview name=section2}

{loadview name=front_content_subscribe}
{loadview name=whyus_container}
{loadview name=start_friendship_container}

{/if}






<section class="news_content_continer clearfix">
    <div class="container">
    
    	{if $smarty.server.REQUEST_URI == '/merchandising' or $smarty.server.REQUEST_URI == '/merchandising/'}

			{loadview name=mench_head}

		{/if}
        
        
        {if strpos($smarty.server.REQUEST_URI, 'cat/id')  != false  }
 
  			{loadview name=product_detail}
            {loadview name=product_detail2}
            {loadview name=product_detail3}
            {loadview name=product_detail4}
            {loadview name=product_detail5}
            {loadview name=product_detail6}
 
 		{/if}
    
        <div class="row">
        
        

{if strpos($smarty.server.REQUEST_URI, 'search') != false or strpos($smarty.server.REQUEST_URI, 'cart') != false }
<div class="col-sm-12">
{else}        
<div class="col-sm-9">
{/if}



				{if $smarty.server.REQUEST_URI != '/contacts' and $smarty.server.REQUEST_URI != '/contacts/' and $smarty.server.REQUEST_URI != '/cat' and $smarty.server.REQUEST_URI != '/cat/' and strpos($smarty.server.REQUEST_URI, 'cat/type/purpose')  == false and strpos($smarty.server.REQUEST_URI, 'cat/type/material')  == false and strpos($smarty.server.REQUEST_URI, 'cat/sale')  == false and strpos($smarty.server.REQUEST_URI, 'cat/novice')  == false and strpos($smarty.server.REQUEST_URI, 'cat/action')  == false and strpos($smarty.server.REQUEST_URI, 'about/news')  == false and strpos($smarty.server.REQUEST_URI, 'search')  == false and  trim($smarty.server.REQUEST_URI, '/')  != 'merchandising' and  strpos($smarty.server.REQUEST_URI, 'cat/id')  == false and strpos($smarty.server.REQUEST_URI, 'cart')  == false and strpos($smarty.server.REQUEST_URI, 'merchfactory')  == false and strpos($smarty.server.REQUEST_URI, 'merchtype')  == false}
                
                
                
                
                <div class="inner_content_box tmp0">
				 {php} if(isset($_GET['restore_access'])){ {/php}
                 Пароль успешно изменён
                 <script type="text/javascript">
				 
                 location.href="/";
				 
                 </script>
                 {php} }else{ {/php}
                 
                 <br>{if $page_content.content!=""}{$page_content.content}{/if}
				 
                 {$content}
                 {php} } {/php}
                </div>
                
                
                {/if}
                
              
 
 {if strpos($smarty.server.REQUEST_URI, 'cart')  != false}
{loadview name=cart}
{/if}   
 
{if strpos($smarty.server.REQUEST_URI, 'merchfactory')  != false}
{loadview name=mench_factories}
{/if}    

{if strpos($smarty.server.REQUEST_URI, 'merchtype')  != false}
{loadview name=mench_types}
{/if}               
				
{if $smarty.server.REQUEST_URI == '/about' or $smarty.server.REQUEST_URI == '/about/'}
<div class="inner_content_box " id="scroll2">
<br>
<div class="about_block__title">фотогалерея</div>
{loadview name=about_photogallery}

</div>

<div class="inner_content_box" id="scroll3">
<br>
<div class="about_block__title">наши клиенты</div>
{loadview name=about_clients}

</div>

<div class="inner_content_box" id="scroll4">
<br>
<div class="about_block__title">Товарная политика компании</div>
{loadview name=about_text1}

</div>

<div class="inner_content_box" id="scroll5">
<br>
<div class="about_block__title">наши партнеры</div>
{loadview name=about_partners}

</div>

<div class="inner_content_box" id="scroll6">
<br>
<div class="about_block__title">Ценовая политика компании</div>
{loadview name=about_text2}

</div>

<div class="inner_content_box" >
<br>
<div class="about_block__title">Благодарственные письма</div>
{loadview name=about_sertificates}

</div>

<div class="inner_content_box" id="scroll7">
<br>
<div class="about_block__title">Рекламная политика компании</div>
{loadview name=about_reklama}

</div>

<div class="inner_content_box" id="scroll8">
<br>

{loadview name=about_rekvisit}

</div>

<div class="inner_content_box" id="scroll9">
<br>
<div class="about_block__title">Сервис компании</div>
{loadview name=about_service}

</div>


{/if}







<!------------0------------->


<div class="load_fon">
<img src="/public/site1/images/712.gif"/>
</div>





{if $smarty.server.REQUEST_URI == '/contacts' or $smarty.server.REQUEST_URI == '/contacts/'}

{loadview name=contacts_otdel1}



{/if}



{if $smarty.server.REQUEST_URI == '/about/employees' or $smarty.server.REQUEST_URI == '/about/employees/'}

<div class="inner_content_box inner_content_box_team">
{loadview name=employees_box1}
</div>


{loadview name=employees_box2}



{/if}





{if strpos($smarty.server.REQUEST_URI, 'about/news/page')  != false or $smarty.server.REQUEST_URI == '/about/news' or $smarty.server.REQUEST_URI == '/about/news/'}

{loadview name=list_news}

{/if}




{if strpos($smarty.server.REQUEST_URI, 'about/news/id')  != false}

{loadview name=detail_news}

{/if}


{if $smarty.server.REQUEST_URI == '/prise' or $smarty.server.REQUEST_URI == '/prise/' or $smarty.server.REQUEST_URI == '/docs' or $smarty.server.REQUEST_URI == '/docs/'}

{loadview name=text_all}

{/if}



{if $smarty.server.REQUEST_URI == '/merchandising' or $smarty.server.REQUEST_URI == '/merchandising/'}

{loadview name=mench_content}
{loadview name=mench_content2}
{loadview name=content_subscribe}


{/if}


{if strpos($smarty.server.REQUEST_URI, 'cat/type/purpose')!=false }
{loadview name=catalog/purpose}
{/if}

{if strpos($smarty.server.REQUEST_URI, 'cat/type/material')!=false }
{loadview name=catalog/material}
{/if}

{if strpos($smarty.server.REQUEST_URI, 'cat/sale')!=false }
{loadview name=catalog/sale}
{/if}

{if strpos($smarty.server.REQUEST_URI, 'cat/novice')!=false }
{loadview name=catalog/novice}
{/if}

{if strpos($smarty.server.REQUEST_URI, 'cat/action')!=false }
{loadview name=catalog/action}
{/if}


{if strpos($smarty.server.REQUEST_URI, 'search') != false}

{php}
if(isset($_GET['collections'])){
{/php}

{loadview name=search_collections}
{php}
}
{/php}
{/if}

</div>


			{if $smarty.server.REQUEST_URI != '/cat/' and $smarty.server.REQUEST_URI != '/cat' and  strpos($smarty.server.REQUEST_URI, 'cat/id')  == false and strpos($smarty.server.REQUEST_URI, 'search')==false and strpos($smarty.server.REQUEST_URI, 'cart')==false }
            
 			<div class="col-sm-3">
            
            	{if strpos($smarty.server.REQUEST_URI, 'cat/') != false and strpos($smarty.server.REQUEST_URI, 'cat/id') == false }
            		{loadview name=left_catalog_filter}
                
				{/if}
                
                
                
				{if $smarty.server.REQUEST_URI == '/about/employees' or $smarty.server.REQUEST_URI == '/about/employees/'}
					{loadview name=left_employees_otdel}

				{/if}
                

				{if $smarty.server.REQUEST_URI == '/about' or $smarty.server.REQUEST_URI == '/about/'}
					{loadview name=left_about_otdel}

				{/if}
                
                {if $smarty.server.REQUEST_URI == '/contacts' or $smarty.server.REQUEST_URI == '/contacts/'}
					{loadview name=left_contacts_otdel}

				{/if}
                

                {loadview name=left_news}

                <div class="widget widget_slider">
                    <ul>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                        <li><a href=""><img src="/public/site1/images_tmp/slider_image.jpg" alt="" title="" ></a></li>
                    </ul>
                </div>
            </div>
            {/if}
            
            
            
        </div>
    </div>
</section>
 
 
 
 {/if}
 
 
 {if (strpos($smarty.server.REQUEST_URI, 'cat/id')  != false) }
  {loadview name=front_content_subscribe}
  {loadview name=whyus_container}
 {loadview name=start_friendship_container}
 {/if}
 
{if (strpos($smarty.server.REQUEST_URI, 'cat/')  != false) and (strpos($smarty.server.REQUEST_URI, 'cat/id')  == false)}
  {loadview name=whyus_container}
 {loadview name=start_friendship_container}


{/if}
 
 
 {if $smarty.server.REQUEST_URI == '/merchandising' or $smarty.server.REQUEST_URI == '/merchandising/'}
 
 {loadview name=whyus_container}
 {loadview name=start_friendship_container}
 
 
 {/if}
 
 
 
 
 
<div class="contacts_container">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Контакты</h3>

                <div class="contact_info">
                    <p>г. Москва, п.Сосенское, ул. Адмирала Корнилова, вл. 39«А», стр.1</p>

                    <div class="row">
                        <div class="col-sm-4">

                            <div class="main_phones_container">
                                <span>8 (499) 724-28-10</span>
                                <i>Архитекторам и строителям</i>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="main_phones_container">
                                <span>8 (495) 742 40 40</span>
                                <i>Дилерский отдел</i>
                            </div>                            
                        </div>
                        <div class="col-sm-4">
                            <a href="#" class="contact_feedback" data-toggle="modal" data-target="#feedback">Обратная связь</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="#">Контакты</a>
                        </div>
                    </div>

                    <div class="contact_info_title">центральный склад</div>
                    <img src="/public/site1/images/sklad.jpg">
                </div>
            </div>

            <div class="col-md-6">
                <div class="map" id="main_map">
                    <!--<img src="/public/site1/images/map.jpg">-->
                         
                </div>
            </div>

        </div>
    </div>
</div>

<section class="footer_menu_container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar" role="navigation">
                <div class="navbar-header">
                     
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                         <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> 
                    <div class="sr-only-text">Меню</div>
                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                    
                    	{foreach from=$bottom_menu item=ee}
                    		<li>
                            	<a href="{$ee.link}">{$ee.text}</a>
                        	</li>
						{/foreach}
                    
                    
                    </ul>
                </div>
                
            </nav>


            </div>
        </div>
    </div>
</section>

<footer class="footer_container">
    <div class="container">
       
        <div class="row row_header">
            <div class="col-md-9">
                <a href="#" id="logo">
                    <img src="/public/site1/images/logo_footer.png">
                </a>
                <div class="main_phones clearfix">
                    <div class="main_phones_container">
                        <span>8 (499) 724 28 10</span>
                        <i>Архитекторам и строителям</i>
                    </div>
                    <div class="main_phones_container">
                        <span>8 (495) 989 73 93</span>
                        <i>Дилерский отдел</i>
                    </div>
                    <div class="main_phones_container">
                        <span>8 (495) 742 40 40</span>
                        <i>Розничный магазин</i>
                    </div>
                </div>
                <div class="footer_zayavka">
                    <a href="#" data-toggle="modal" data-target="#request2">Оставить заявку</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer_contact_info">
                    <div class="fci_title">Основной пункт выдачи</div>
                    <div class="fci_adress">г. Москва, п.Сосенское,<br/>ул. Адмирала Корнилова, вл. 39«А», стр.1</div>
                    <!-- <div class="fci_link"><a href="#">Все адреса на карте</a></div> -->
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="footer_copyrights">
                    © Артисан 2011 — 2016
                </div>
            </div>
        </div>
    </div>
</footer>


</div>











{/if}




<div id="back-top">
    <a href="#" class="toplink"></a>
</div>







<!-- Modals -->
<div class="modal fade" id="request1" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Заявка на сотрудничество</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="request1-form">
          <div class="form-group row">
            <div class="col-md-4">
                <label for="name1">Имя</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="name1" name="name" placeholder="Введите имя" required>
                <span class="name_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="email1">Электронная почта</label>
            </div>
            <div class="col-md-8">
                <input type="email" id="email1" name="email" placeholder="mail@mail.ru" required>
                <span class="mail_alert input_alert">На этот адрес письмо не дойдёт</span>
                <span class="mail_alert2 input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="phone1">Телефон</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="phone1" name="phone" placeholder="+7">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="message1">Комментарий</label>
            </div>
            <div class="col-md-8">
                <textarea id="message1" name="message" placeholder="Ваш комментарий"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->


<!--  -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Вход для дилера</h4>
      </div>
      <div class="modal-body">
        <!--<form class="form" id="login-form">-->
        <form accept-charset="utf-8" class="form" enctype="multipart/form-data" name="login" action="" id="login_form" method="post" target="">
        <span class="auth_alert">Ошибка авторизации: неверный логин или пароль</span>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="login_login">Имя</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="login" value="" id="login_login" placeholder="Введите имя" required>
                <span class="name_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="login_pass">Пароль</label>
            </div>
            <div class="col-md-8">
                <input type="password" name="pass" id="login_pass" placeholder="Введите пароль" required>
                <span class="pass_alert input_alert">Поле необходимо заполнить</span>
                <a href="#" class="form-restore_pass_link">Восстановить</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->
<div class="modal fade" id="restore_pass" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Восстановление доступа</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="restore_pass-form">
          <div class="form-group row">
            <div class="col-md-2">
                <label for="res_login">Логин</label>
            </div>
            
            <div class="col-md-8">
                <input type="text" id="res_login" name="login" placeholder="" required>
                <span class="login_alert input_alert">Данный логин не зарегистрирован</span>
                <!--<span class="mail_alert2 input_alert">Поле необходимо заполнить</span>
                <span class="mail_alert3 input_alert">Адрес нам не известен</span>-->
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style="text-align:center;">
                <button type="submit" class="btn">Восстановить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->

<!--  -->
<div class="modal fade" id="registration" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Регистрация нового дилера</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="registration-form">
          <div class="form-group row">
            <div class="col-md-4">
                <label for="name2">Имя</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="name2" name="name" placeholder="Введите имя" required>
                <span class="name_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="email2">Электронная почта</label>
            </div>
            <div class="col-md-8">
                <input type="email" id="email2" name="email" placeholder="mail@mail.ru" required>
                <span class="mail_alert input_alert">Некорректрый e-mail</span>
                <span class="mail_alert2 input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="phone2">Телефон</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="phone2" name="phone" placeholder="+7">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="message2">Комментарий</label>
            </div>
            <div class="col-md-8">
                <textarea name="" id="message2" name="message" placeholder="Ваш комментарий"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->
<!--  -->
<div class="modal fade" id="feedback" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Обратная связь</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="feedback-form">
          <div class="form-group row">
            <div class="col-md-4">
                <label for="name3">Имя</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="name3" name="name" placeholder="Введите имя" required>
                <span class="name_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="email3">Электронная почта</label>
            </div>
            <div class="col-md-8">
                <input type="email" id="email3" name="email" placeholder="mail@mail.ru" required>
                <span class="mail_alert input_alert">На этот адрес письмо не дойдёт</span>
                <span class="mail_alert2 input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="phone3">Телефон</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="phone3" name="phone" placeholder="+7">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="message3">Сообщение</label>
            </div>
            <div class="col-md-8">
                <textarea name="" id="message3" name="message" placeholder="Ваше сообщение"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->

<div class="modal fade" id="request2" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Заявка</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="request2-form">
          <div class="form-group row">
            <div class="col-md-4">
                <label for="name4">Имя</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="name4" name="name" placeholder="Введите имя" required>
                <span class="name_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="phone4">Телефон</label>
            </div>
            <div class="col-md-4">
                <input type="text" id="phone4" name="phone" placeholder="+7" required>
                <span class="phone_alert input_alert">Поле необходимо заполнить</span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <label for="message4">Комментарий</label>
            </div>
            <div class="col-md-8">
                <textarea id="message4" name="message" placeholder="Ваш комментарий"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  -->
<div class="modal fade" id="success_modal" tabindex="-1" role="dialog" style="display:none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>






</body>
</html>