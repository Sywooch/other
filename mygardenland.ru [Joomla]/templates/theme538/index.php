<?php
/**
 * @version					$Id: index.php 20196 2011-01-09 02:40:25Z ian $
 * @package					Joomla.Site
 * @copyright				Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license					GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
//error_reporting('E_ALL');
$path = $this->baseurl.'/templates/'.$this->template;

JHTML::_('behavior.framework', true);
// get params

$app				= JFactory::getApplication();
$logo				= $this->params->get('logo');
$templateparams		= $app->getTemplate(true)->params;

$showLeftColumn = ($this->countModules('left'));
$showRightColumn = ($this->countModules('right'));
$showuser3 = ($this->countModules('user3'));
$showuser4 = ($this->countModules('user4'));
$showuser5 = ($this->countModules('user5'));
$showuser6 = ($this->countModules('user6'));
$showuser8 = ($this->countModules('user8'));
$showuser9 = ($this->countModules('user9'));
$showuser10 = ($this->countModules('user10'));
$showFeatured = ($this->countModules('user2'));
$showNew = ($this->countModules('new'));
$showSpecials = ($this->countModules('specials'));

$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');


$menu = $app->getMenu();
$menu      = $menu->getActive();
$pageclass   = "";

if (is_object( $menu )) : 
$params1 =  $menu->params;
$pageclass = $params1->get( 'pageclass_sfx' );
endif; 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>

<link href="/assets/css/bootstrap.css" rel="stylesheet">
<link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="<?php echo $path ?>/javascript/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo $path ?>/javascript/jquery.noconflict.js"></script>
<script type="text/javascript" src="<?php echo $path ?>/javascript/tm-stick-up.js"></script>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $path ?>/css/position.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="<?php echo $path ?>/css/layout.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="<?php echo $path ?>/css/print.css" type="text/css" media="Print" />
<link rel="stylesheet" href="<?php echo $path ?>/css/virtuemart.css" type="text/css"  />
<link rel="stylesheet" href="<?php echo $path ?>/css/products.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $path ?>/css/personal.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $path ?>/css/font-awesome.css" type="text/css" />
<!--[if IE 8]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie8only.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style>
.moduletable_socials .custom_socials li a{
 behavior:url(<?php echo $path ?>/PIE.php);
}
</style>
<!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative; z-index:9999;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0" &nbsp;alt="" /></a>
    </div>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo $path ?>/javascript/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo $path ?>/javascript/script.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(window).load(function(){
 // hide #back-top first
 $j("#back-top").hide();
 // fade in #back-top
 $j(function () {
  $j(window).scroll(function () {
   if ($j(this).scrollTop() > 200) {
    $j('#back-top').fadeIn();
   } else {
    $j('#back-top').fadeOut();
   }
  });
  // scroll body to 0px on click
  $j('#back-top a').click(function () {
   $j('body,html').animate({
    scrollTop: 0
   }, 800);
   return false;
  });
 });
});

</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>class=&quot;poping_links&quot;</title>


<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="/assets/ico/favicon.png">

</head>
<?php
$menu = $app->getMenu();
if ($menu->getActive() == $menu->getDefault()) {
    $body_class = 'first';
}else{
    $body_class = 'all';
}
?>
<body class="<?php echo $body_class." ".$pageclass;?>">
	<div class="body-top">
		<div id="header">
		
    
        
        <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
        <div class="container-fluid">
        
        <div class="header-menu">
        	
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
        
        	<div class="nav-collapse collapse">
				
                
                             
                
                
                <div class="menu">
					<jdoc:include type="modules" name="header-menu1" />
					
                    
					<div class="header_login">
						<a href="javascript:;" onClick="showThem('login_pop');return false;" id="openLogin">вход для партнёров</a>
					</div>
                    

					<div class="header_search">
						<jdoc:include type="modules" name="header-search" /> 
					</div>
					
                    
					<jdoc:include type="modules" name="header-login" />
				
				</div>
                
                
            </div>
            
            
            
            
            
		</div>
        
      	</div>
        </div>
        </div>  
        
        
        
        
        
        
        
			<!--main-->
			<div class="main">
				<div class="logoheader">
					<h5 id="logo">	
					<?php if ($logo != null ): ?>
					<a href="<?php echo $this->baseurl ?>">
                                      
                    <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" 
                    alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                    
                    </a>
					<?php else: ?>
					<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
					<?php endif; ?>
					<span class="header1">
					<?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
					</span>
                    </h5>
					
					<h5 id="logo">
					<a href="<?php echo $this->baseurl ?>">
					Просто собери свой сад
					</a>
					</h5>
				</div>
				
				<div class="textheader">
					<h5>
					<span>Магазин ландшафтных идей</span>
					</h5>
				</div>
				
				<?php if ($showuser5) : ?>
					<div class="currency" style="display:none;">
						<jdoc:include type="modules" name="user5" style="xhtml" />
					</div>
				<?php endif; ?>
				
                 <?php if ($showuser6) : ?>
                    <div class="cart">
                        <jdoc:include type="modules" name="user6" style="xhtml" />
                    </div>
                <?php endif; ?>
                
				<jdoc:include type="modules" name="user10" style="xhtml" />
					
				<div style="width:100%; height:2px; background-color:#e5e5ca; position:absolute; top:126px;"></div>
			</div>
            <!--main-->
            
            
            
            
            
            
            
            <?php if ($showuser3) : ?>
                <div id="topmenu" style="display:none;">
                    <div class="main">
                    <?php if ($showuser4) : ?>
                        <div id="search">
                            <jdoc:include type="modules" name="user4" style="xhtml" />
                        </div>
                    <?php endif; ?>
                    <jdoc:include type="modules" name="user3" style="xhtml" />
                    </div>
                </div>
            <?php endif; ?>
           <!-- <div class="fix">
            <div class="main">
                <jdoc:include type="modules" name="user7" style="xhtml" />
            </div> 
            </div> -->
			
		</div>
				<!-- END header -->
           

<div class="container-fluid">
<div class="row-fluid">
			<div id="content">
				<div class="main">
                                <div class="clear"></div>
                                <jdoc:include type="modules" name="new" style="xhtml" />
                                <div class="clear"></div>
				      <div class="wrapper2">
                        
					<?php if ($showLeftColumn): ?>
						<div id="left" class="span3">
						      <div class="wrapper2">
								<div class="extra-indent">
									<jdoc:include type="modules" name="left" style="left" />
											
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (($showRightColumn) && (($option!="com_virtuemart") || (!$pageclass))) : ?>

						<div id="right" class="span3">
							<div class="wrapper2">
								<div class="extra-indent">
									<jdoc:include type="modules" name="right" style="user" />
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php
					$class = 12;
					if($this->countModules('right') > 0 && $this->countModules('left') > 0){
					$class = 6;
					} elseif($this->countModules('right') > 0 || $this->countModules('left') > 0){ 
					$class = 9;
					}
					?>
							
					<div id="container-box" class="container span<?php echo $class?>">
                            	
                                        <jdoc:include type="modules" name="syndicate2" style="xhtml"/>
                             
					<div>
                             		<jdoc:include type="modules" name="user8" style="xhtml"/>	
					</div>	
							
					<div class="banners_types">
						<jdoc:include type="modules" name="banners_types" style="xhtml"/>
					</div>
							
					<jdoc:include type="modules" name="syndicate" style="xhtml"/>
								
					<?php if ($this->getBuffer('message')) : ?>
					<div class="error err-space">
					<jdoc:include type="message" />
					</div> 
					<?php endif; ?> 

					<div>
					<jdoc:include type="modules" name="user2" style="user" />
					</div>
					<div class="content-indent">
						<jdoc:include type="component" />
					</div>
                                
                                <div class="custom1">
                                <jdoc:include type="modules" name="custom1" style="xhtml"/>
                                </div>
                                
                                
                                <!--news and social-->
                                
                                <?php if(JURI::current()== JURI::base()){ ?>
								
                                
                                <h3 class="head_hews"><span>НОВОСТИ</span></h3>
                                
                                
                                <div class="block_news">
                                <jdoc:include type="modules" name="main_news" style="xhtml"/>
                                </div>
                                
                                <div class="block1">
                               		<div class="block_social"></div>
                                	<div class="block_info">
                                		<h3 class="step1">Выбираете услугу</h3>
                                        <h3 class="step2">Отправляете заявку</h3>
                                        <h3 class="step3">С Вами связывается менеджер</h3>                                        
                                	</div>
                                </div>
                                
                                <?php } ?>                                
                                <!--news and social-->
                                
                                
                                
							</div>
                            
                            
                            
                           
                            
                            
						</div>
                        
                        <div class="clear"></div>
                        <jdoc:include type="modules" name="new_bot" style="xhtml" />
						<div class="clear"></div>
				</div>
			</div>
		<!--end CONTENT-->
       
</div>
</div>






		<div class="clear"></div>
		<div id="foot">
			<?php if ($showuser9) : ?>
           	<div class="aside">
                <div class="main">
                    <jdoc:include type="modules" name="user9" style="xhtml" />
                </div>
            </div>    
            <?php endif; ?>
			
        <div class="col-left">
       		<div class="main">
			
			<div class="block_1">
			<span class="text_footer">СЕРВИС И ПОМОЩЬ</span>
			<div class="footer_logo">
			<div class="footer_logo1"></div>
			<span class="footer_text_underlogo">Просто собери свой сад</span>
			</div>
			<span class="text_footer2">&copy; 2014. MyGardenLand<br>тел.: 8 (499) 558 30 43</span>  
			</div>
			
            <p id="back-top">
					<a href="#top"><span></span></a>
                    <span class="up_button_text">НАВЕРХ</span>
			</p>
            
			
			<div class="block_2">
			<span class="text_footer">О КОМПАНИИ</span>
			<jdoc:include type="modules" name="footer-menu" />  
				<div class="block_order_call">
				<input type="button" class="order_call" value="ЗАКАЗАТЬ ЗВОНОК">
				</div>
			</div>
			
			<div class="space">
			
			            <!--<div class="footerText">
                        <jdoc:include type="modules" name="footer" />
                       
						<!--<div class="footer2<?php echo $moduleclass_sfx ?>"><?php echo JText::_('TM_FOOTER_LINE2'); ?>
						<jdoc:include type="modules" name="settings" style="xhtml" />
                        
						<?php
                       // if ($menu->getActive() == $menu->getDefault())  { ?>
                        <?php // }
                        ?>
						</div>-->
					<!--</div>-->
            </div>
            
			<div class="block_3">
            	<div class="created_logo"></div>
                <div class="created_text"></div>  
                <div class="copyright_text">
                Разработка<br>и продвижение сайтов
                </div>       
            </div>
			
			</div>
        </div>
	</div>	
</div>
<jdoc:include type="modules" name="debug" />
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Open+Sans:400,300,600,700,800:latin','Lato:400,100,300,700,900:latin' , 'Roboto:400,100,300,500,700,900:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
  
  

<!-- 
<script data-rocketsrc="/assets/js/jquery.js" type="text/rocketscript"></script>
-->
<!--
<script data-rocketsrc="/assets/js/bootstrap-transition.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-alert.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-modal.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-dropdown.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-scrollspy.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-tab.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-tooltip.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-popover.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-button.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-collapse.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-carousel.js" type="text/rocketscript"></script>
<script data-rocketsrc="/assets/js/bootstrap-typeahead.js" type="text/rocketscript"></script>
-->
<!--
<script type="text/javascript" src="/assets/js/jquery.js"></script>
-->

<script type="text/javascript" src="/assets/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-alert.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-scrollspy.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-button.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-carousel.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap-typeahead.js"></script>


  
  
  
  
</body>
</html>

