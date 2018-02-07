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


// определяем тип login или logout
global $_CB_framework, $ueConfig, $_CB_PMS, $cbSpecialReturnAfterLogin, $cbSpecialReturnAfterLogout;
include_once( JPATH_ADMINISTRATOR . '/components/com_comprofiler/plugin.foundation.php' );
require_once( JPATH_SITE . '/modules/mod_cblogin/helper.php' );
$type								=	modCBLoginHelper::getType();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>

<link href="/assets/css/bootstrap.css" rel="stylesheet">
<link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="/templates/theme538/javascript/jquery-1.8.3.min.js"></script>

<!--<script type="text/javascript" src="<?php echo $path ?>/javascript/jquery-1.11.2.min.js"></script>-->
<script type="text/javascript" src="<?php echo $path ?>/javascript/jquery.noconflict.js"></script>
<!--<script type="text/javascript" src="<?php echo $path ?>/javascript/jquery-migrate-1.2.1.js"></script>-->
<script type="text/javascript" src="<?php echo $path ?>/javascript/tm-stick-up.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

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
jQuery.noConflict()
</script>


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



<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="/assets/ico/favicon.png">

<script type="text/javascript">

function moduletablemodelformprojectname(){
//alert("1234");
   //$('.moduletablemodelformprojectname').fadeIn(1000);
 
 
 var block1 = document.getElementById("modelformprojectname");
block1.style.display = "block";

 
}

function modelformprojectname_close(){
 var block1 = document.getElementById("modelformprojectname");
block1.style.display = "none";
}

function syndicate22(){

var block1 = document.getElementById("syndicate22");
block1.style.display = "block";
//	var $j = jQuery.noConflict();
//   	$j('#syndicate22 .moduletablemodelformconsultation').fadeIn(1000);
 

}


function syndicate22_close(){

var block1 = document.getElementById("syndicate22");
block1.style.display = "none";

	//var $j = jQuery.noConflict();
   	//$j('#syndicate22 .moduletablemodelformconsultation').fadeOut(1000);

}




function syndicate2(){

var block1 = document.getElementById("syndicate2");
block1.style.display = "block";


}

function syndicate2_close(){

var block1 = document.getElementById("syndicate2");
block1.style.display = "none";

}

</script>

<?php  if( (JURI::current()== (JURI::base()."aktsiya1")) ){ ?>

<link rel="stylesheet" href="/css_landing/style.css">
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />-->
<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>-->
<script src="http://vpitomnik.ru/scr/counter.js"></script>
<script type="text/javascript" src="http://vpitomnik.ru/scr/jssor.js"></script>
<script type="text/javascript" src="http://vpitomnik.ru/scr/jssor.slider.js"></script>
<script type="text/javascript" src="http://vpitomnik.ru/source/jquery.fancybox.js?v=2.1.5"></script>

	<link rel="stylesheet" type="text/css" href="http://vpitomnik.ru/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="http://vpitomnik.ru/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="http://vpitomnik.ru/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="http://vpitomnik.ru/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="http://vpitomnik.ru/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="http://vpitomnik.ru/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
<script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 3,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 160,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                $SlideWidth: 282,                                   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                $SlideHeight: 209,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 45, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 3,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                              //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)



                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 3                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        });
    </script>


<?php } ?>



<script type="text/javascript">

(function(w, d, e) {

var a = 'all', b = 'tou'; var src = b + 'c' +'h'; src = 'm' + 'o' + 'd.c' + a + src;

var jsHost = (("https:" == d.location.protocol) ? "https://" : "http://")+ src;

s = d.createElement(e); p = d.getElementsByTagName(e)[0]; s.async = 1; s.src = jsHost

+"."+"r"+"u/d_client.js?param;ref"+escape(d.referrer)+";url"+escape(d.URL)+";cook"+escape(d.cookie)+";";

if(!w.jQuery) { jq = d.createElement(e); jq.src = jsHost +"."+"r"+'u/js/jquery-1.7.min.js'; p.parentNode.insertBefore(jq, p);}

p.parentNode.insertBefore(s, p);

}(window, document, 'script'));

</script>





<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>
<?php
$menu = $app->getMenu();
if ($menu->getActive() == $menu->getDefault()) {
    $body_class = 'first';
}else{
    $body_class = 'all';
}
?>
<body class="<?php echo $body_class." ".$pageclass;?> proekty-i-idei">

<jdoc:include type="modules" name="form_popup" style="xhtml"/>

<jdoc:include type="modules" name="user88" style="xhtml"/>

<div class="hide">
	<jdoc:include type="modules" name="fixed_menu" style="xhtml"/>
</div>

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
						<!--<a href="javascript:;" onClick="showThem('login_pop');return false;" id="openLogin">вход для партнёров</a> -->
					
					<?php if ( $type == 'logout' ) { ?>
					
						<a href="http://mygardenland.ru/cb-login/logout" >выйти</a>
					
					<?php } else { ?>
					
						<a href="http://mygardenland.ru/cb-login/login" >вход для партнёров</a>
						
					<?php } ?>	
					
					</div>
                    

					<div class="header_search">
						<jdoc:include type="modules" name="header-search" /> 
					</div>
                    
                    <div class="header_phone">
                    <i class="fa fa-mobile"></i>
						<jdoc:include type="modules" name="header-phone" /> 
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
            
            	<div class="main_consultation">
                	<jdoc:include type="modules" name="main_consultation" style="xhtml" />                
                </div>
            
            
				<div class="logoheader">
					<h5 id="logo">	
					<?php if ($logo != null ): ?>
					<a class="main_logo" href="http://mygardenland.ru/">
                                      
                    <!--<img src="<?php //echo $this->baseurl ?>/<?php //echo htmlspecialchars($logo); ?>" 
                    alt="<?php //echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                    -->
					MyGardenLand
					
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
				
				
				<div class="menu_catalog">
				<jdoc:include type="modules" name="menu_catalog" style="xhtml" />
				</div>
				
				
				
				
				<?php if ($showuser5) : ?>
					<div class="currency" style="display:none;">
						<jdoc:include type="modules" name="user5" style="xhtml" />
					</div>
				<?php endif; ?>
				<jdoc:include type="modules" name="user66" style="xhtml" />
                 <?php if ($showuser6) : ?>
                    <div class="cart">
                        <jdoc:include type="modules" name="user6" style="xhtml" />
						
                    </div>
                <?php endif; ?>
                
				<jdoc:include type="modules" name="user10" style="xhtml" />
					
				<div style="width:100%; height:2px; background-color:#e5e5ca; position:absolute; top:126px;" class="line_header"></div>
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
									<div class="group_banners">
<jdoc:include type="modules" name="left2" style="left" />
</div>		
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
                            
					<div class="syndicate2" id="syndicate2">
					<jdoc:include type="modules" name="syndicate2" style="xhtml"/>
					</div>
	
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
					
					
					<div class="custom02">
                                <jdoc:include type="modules" name="custom02" style="xhtml"/>
                                </div>
					
					<div class="content-indent">
						<jdoc:include type="component" />
						
						
						
					</div>
								<div class="custom0">
                                <jdoc:include type="modules" name="custom0" style="xhtml"/>
                                </div>
								
								<div class="custom01">
                                <jdoc:include type="modules" name="custom01" style="xhtml"/>
                                </div>
								
								
								<div class="custom_filter">
                                <jdoc:include type="modules" name="custom_filter" style="xhtml"/>
                                </div>
								
					
                                
								<div class="custom_shop2">
                                <jdoc:include type="modules" name="custom_shop4" style="xhtml"/>
                                </div>
								
								
								<div class="custom_shop">
                                <jdoc:include type="modules" name="custom_shop" style="xhtml"/>
                                </div>
                                
								
								
								
								
								
								<div class="custom4">
                                <jdoc:include type="modules" name="custom4" style="xhtml"/>
								</div>
								
								
								
                                
								
                                <div class="custom1">
                                <jdoc:include type="modules" name="custom1" style="xhtml"/>
                                </div>
                                
								
								
								<?php  
								
								if(JURI::current()== (JURI::base()."parki-dvory-ozelenenie")){ ?>
								
								<div class="custom_clients">
								<div class="moduletable">
                                <jdoc:include type="modules" name="custom_clients" style="xhtml"/>
								</div>
								</div>
                                
								
								<?php } ?>

	<?php  
								
								if(JURI::current()== (JURI::base()."catalog/kompozitsii-iz-redkih-rasteniy")){
$url1="/catalog/kollektsionnyie-sadyi";
header('Location: ' . $url1);
} ?>		
								
								<div class="custom5  <?php  if((JURI::current()== (JURI::base()."rastenya-i-cviety"))||
								(JURI::current()== (JURI::base()."khvojnye"))||
								(JURI::current()== (JURI::base()."listvennye"))||
								(JURI::current()== (JURI::base()."plodovye"))||
								(JURI::current()== (JURI::base()."kustarniki"))||
								(JURI::current()== (JURI::base()."krupnomery"))||
								(JURI::current()== (JURI::base()."karlikovye-formy-dlya-mini-fasadov"))||
								(JURI::current()== (JURI::base()."bonsaj")))
								
								{  echo"flowers_slider_head"; }  ?>">
                                <jdoc:include type="modules" name="custom5" style="xhtml"/>
								</div>
								
								<div class="custom6_head">
                                <jdoc:include type="modules" name="custom6_head" style="xhtml"/>
								</div>
								
								<div class="custom6">
								<div class="block_responses1">
                                <jdoc:include type="modules" name="custom6" style="xhtml"/>
								</div>
								</div>
								
								
								<div class="custom_shop2">
                                <jdoc:include type="modules" name="custom_shop2" style="xhtml"/>
								</div>
								
								
								
								
                                <!--news and social-->
                                
                                <?php if(JURI::current()== JURI::base()){ ?>
								
                                
                                <h3 class="head_hews"><span>НОВОСТИ</span></h3>
                                	
                                
                                <div class="block_news">
                                <jdoc:include type="modules" name="main_news" style="xhtml"/>
                                </div>
                                
                                <div class="block1">
                               		<div class="block_social">
										<div class="block_social_head"><span>МЫ В СОЦИАЛЬНЫХ СЕТЯХ</span></div>
										<div class="block_social_body">
										<div class="wiget1">
										<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Ftrytopolya&amp;width=237&amp;height=270&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:237px; height:270px;" allowTransparency="true"></iframe>	
										</div>
										<div class="wiget2">
										<div id="ok_group_widget"></div>
										<script type="text/javascript">
										!function (d, id, did, st) {
										  var js = d.createElement("script");
										  js.src = "http://connect.ok.ru/connect.js";
										  js.onload = js.onreadystatechange = function () {
										  if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
											if (!this.executed) {
											  this.executed = true;
											  setTimeout(function () {
												OK.CONNECT.insertGroupWidget(id,did,st);
											  }, 0);
											}
										  }}
										  d.documentElement.appendChild(js);
										}(document,"ok_group_widget","52453705187398","{width:237,height:270}");
										</script>
										</div>
										
										<div class="wiget3">
										<a class="twitter-timeline"  href="https://twitter.com/Tri_Topolya" data-widget-id="562264275017023489">Твиты от @Tri_Topolya</a>
										<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
										</div>
										
										</div>
								
										
										

									
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


<div class="syndicate22" id="syndicate22">
<jdoc:include type="modules" name="syndicate22" style="xhtml"/>
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
			<span class="text_footer2">&copy; 2015. MyGardenLand<br>тел.: 8 (499) 558 30 43</span>  
			</div>
			
			<div class="block_3">
			<div class="block_order_call">
            <?php
			if( (JURI::current()== (JURI::base()."proekty-i-idei")) || (JURI::current()== (JURI::base()."proekty-i-idei-2")) ){ 
			?>
            
            <jdoc:include type="modules" name="ajax-form1" style="xhtml" />
			
        	<?php
			}else{
			?>
				<input type="button" class="order_call" value="ЗАКАЗАТЬ ЗВОНОК" onClick="order_consultation();">
			
			
			<?php
			}
			?>
			
	    
            
            </div>
			</div>
			
			
			
			</div>
        </div>
	</div>	
</div>




<jdoc:include type="modules" name="debug" />
<script type="text/javascript">
  /*WebFontConfig = {
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
  })(); */</script>
  




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
<!-- <script type="text/javascript" src="/assets/js/jquery.js"></script> -->


<script type="text/javascript">

//	 alert("121212");
	 
	 
document.getElementById('link3').target = '_blank';


 </script>  



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


 
<script type="text/javascript" src="/js/infografic.js"></script>   
<script src="/js/call_order_form.js"></script>
<script src="/js/left_menu.js"></script>

<script type="text/javascript">
var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('.vmgroup.sertificat8 .addtocart-button.cart-click').click(function(){
		location.href="http://mygardenland.ru/vm-search/cart";
	});
});
</script>




<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter28692706 = new Ya.Metrika({id:28692706,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    trackHash:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/28692706" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  
  
<script type="text/javascript">
    var button = document.querySelector('#modelformprojectname input[type="submit"]');
  	button.addEventListener("click", function() {
     yaCounter28692706.reachGoal('Otpravka1'); return true;
  	});
	
	var button2 = document.querySelector('.moduletablemodelformconsultation input[type="submit"]');
  	button.addEventListener("click", function() {
     yaCounter28692706.reachGoal('Otpravka2'); return true;
  	});
	
	
</script>  
  
  <!--
<script type="text/javascript">
var $j = jQuery.noConflict();
 $j(document).ready(function(){
 alert(jQuery.fn.jquery);
 });
 </script>  
  -->
  
  
  
<script type="text/javascript">
var $j = jQuery.noConflict();
$j('.total_products').click(function(){
 

	$j('.moduletableuptest').fadeIn(1000);
 
});


$j('.moduletableuptest i').click(function(){
 
	$j('.moduletableuptest').fadeOut(1000);
 
});


</script>

<?php

$currentMenuName = JSite::getMenu()->getActive()->id;
if($currentMenuName==780){

?>

<script type="text/javascript">
var $j = jQuery.noConflict();

$j('.floatright.col-2 .addtocart-bar2 .addtocart-button.cart-click').val("узнать больше");
$j('.floatright.col-2 .addtocart-bar2 .addtocart-button.cart-click').css({"font-size" : "9px"});
 
$j('.fright .addtocart-button.cart-click').val("узнать больше");
$j('.fright .addtocart-button.cart-click').css({"font-size" : "9px"});
 
var html = $j('span.addtocart-button').html();

$j('.res_b').click(function(){

	$j('.moduletableuptest').fadeIn(1000);

var title1=$j(this).attr("title");
//alert(title1);

$j('.moduletableuptest #sf2_415_tovar').val(title1);


});
</script>


<?php
	
};

?>


<script type="text/javascript">
var $j = jQuery.noConflict();
$j('#pwebcontact421_toggler .pweb-text').html("ХОЧУ ТАК ЖЕ");
$j('#pwebcontact422_toggler .pweb-text').html("ЗАКАЗАТЬ ЗВОНОК");
</script>
  
</body>
</html>
