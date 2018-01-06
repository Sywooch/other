<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 * 
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

JLoader::import('joomla.filesystem.file');

// Check modules
$showRightColumn = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom      = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft        = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn == 0 and $showleft == 0)
{
	$showno = 0;
}

JHtml::_('behavior.framework', true);

// Get params
$color          = $this->params->get('templatecolor');
$logo           = $this->params->get('logo');
$navposition    = $this->params->get('navposition');
$headerImage    = $this->params->get('headerImage');
$doc            = JFactory::getDocument();
$app            = JFactory::getApplication();
$templateparams = $app->getTemplate(true)->params;
$config         = JFactory::getConfig();
$bootstrap      = explode(',', $templateparams->get('bootstrap'));
$jinput         = JFactory::getApplication()->input;
$option         = $jinput->get('option', '', 'cmd');

if (in_array($option, $bootstrap))
{
	// Load optional rtl Bootstrap css and Bootstrap bugfixes
	JHtml::_('bootstrap.loadCss', true, $this->direction);
}

$doc->addStyleSheet($this->baseurl . '/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/position.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/layout.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/print.css', $type = 'text/css', $media = 'print');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/general.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/' . htmlspecialchars($color) . '.css', $type = 'text/css', $media = 'screen,projection');

if ($this->direction == 'rtl')
{
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template_rtl.css');
	if (file_exists(JPATH_SITE . '/templates/' . $this->template . '/css/' . $color . '_rtl.css'))
	{
		$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/' . htmlspecialchars($color) . '_rtl.css');
	}
}

JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/md_stylechanger.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/hide.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/respond.src.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/template.js', 'text/javascript');

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<?php require __DIR__ . '/jsstrings.php';?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="YES" />

		<jdoc:include type="head" />

		<!--[if IE 7]>
		<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
		<![endif]-->
	</head>
	<body id="shadow">
    <div class="top_block">
    	<div class="center">
    		<div class="block_left1"><span>Курсы валют на</span></div>
    		<div class="block_right3"><span></span></div>
        	<div class="block_right2"><span><a href="mailto:amurtorg@mail.ru">amurtorg@mail.ru</a></span></div>
            <div class="block_right1"><span>+7 (914) 5-914-914</span></div>
    	</div>
    </div>
    <div class="block1">
    	<div class="center">
        	<a href="/" class="logo"></a>
        	<div class="search">
            	<jdoc:include type="modules" name="position-search" />
            </div>
            <div class="button1">
            	<span>Скачать каталог</span>
            </div>
            <div class="button2">
            	<span>Заказать обратный звонок</span>
            </div>
            
        </div>
    </div>
    
    <div class="block_menu1">
    	<div class="center">
    		<div class="menu">
        		<jdoc:include type="modules" name="position-menu1" />
        	</div>
        </div>
        
    </div>
    
    
    
    
		<?php if ($color == 'image'):?>
			<style type="text/css">
				.logoheader {
					background:url('<?php echo $this->baseurl . '/' . htmlspecialchars($headerImage); ?>') no-repeat right;
				}
				body {
					background: <?php echo $templateparams->get('backgroundcolor'); ?>;
				}
			</style>
		<?php endif; ?>

		<div id="all">
			<div id="back">
				
				<div id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>">
					

					<?php if ($navposition == 'left' and $showleft) : ?>
						<nav class="left1 <?php if ($showRightColumn == null) { echo 'leftbigger';} ?>" id="nav">
                        
                        
                        	<jdoc:include type="modules" name="position-left-menu" />
                        	<jdoc:include type="modules" name="position-banner1" />
                            <jdoc:include type="modules" name="position-banner2" />
                        <!--
							<jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
							<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />-->
						</nav><!-- end navi -->
					<?php endif; ?>

					<div id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>
						<div id="main">
							
                            
                            <?php if ($this->countModules('position-slider1')) : ?>
							<div class="slider_container">
                            	<jdoc:include type="modules" name="position-slider1" />
                                
                            
                            </div>

							<?php endif; ?>
                            
                            
							
							
							<?php //if ($this->countModules('position-catalog1')) : ?>
                            
                            <div class="tabs_container">
                            
                            	<div class="tabsLink">
        							<a class="link1 active">Техника в наличии</a>
        							<a class="link2">Распродажа</a>
                                    <a class="link3">Новые поступления</a>
        						</div>
        
        						
        						<div class="tab tab1" >
        							<jdoc:include type="modules" name="position-main-catalog1" />
       		 					</div>
        
        						<div class="tab tab2" >
    								<jdoc:include type="modules" name="position-main-catalog2" />
        						</div>
                                
        						<div class="tab tab3"  >
    								<jdoc:include type="modules" name="position-main-catalog3" />
        						</div>
                                
                                
                                <script type="text/javascript">
                                	var $j=jQuery.noConflict();
									$j('.tabsLink .link1').click(function(){
  										$j('.tabsLink a').removeClass('active');	
										$j('.tabsLink .link1').addClass('active');	
										$j('.tabs_container .tab').css('display','none');
										$j('.tabs_container .tab').css('visibility','hidden');
										$j('.tabs_container .tab.tab1').css('display','block');
										$j('.tabs_container .tab.tab1').css('visibility','visible');
										
											
									});
                                	
									$j('.tabsLink .link2').click(function(){
  										$j('.tabsLink a').removeClass('active');	
										$j('.tabsLink .link2').addClass('active');	
										$j('.tabs_container .tab').css('display','none');
										$j('.tabs_container .tab').css('visibility','hidden');
										$j('.tabs_container .tab.tab2').css('display','block');
										$j('.tabs_container .tab.tab2').css('visibility','visible');
											
									});
                                	
									$j('.tabsLink .link3').click(function(){
  										$j('.tabsLink a').removeClass('active');	
										$j('.tabsLink .link3').addClass('active');	
										$j('.tabs_container .tab').css('display','none');
										$j('.tabs_container .tab').css('visibility','hidden');
										$j('.tabs_container .tab.tab3').css('display','block');
										$j('.tabs_container .tab.tab3').css('visibility','visible');
											
									});
                                
                                </script>
                            
                            
                            </div>
                            
                            <jdoc:include type="modules" name="position-main-news" />
                            
                            <jdoc:include type="modules" name="position-main-text1" />
                            <jdoc:include type="modules" name="position-main-text2" />
                            
                            <jdoc:include type="modules" name="position-main-responses" />
                            
                            <jdoc:include type="modules" name="position-main-text3" />
                            
                            <jdoc:include type="modules" name="position-main-text4" />
                            
                            
                            <?php if ($this->countModules('position-main-sertifikates')) : ?>
                            <div class="sider_sertificates_container">
                            	<div class="sider_sertificates">
                            		<jdoc:include type="modules" name="position-main-sertifikates" />
                            	</div>
                            </div>
                            <?php endif; ?>
                            
                            
                            <?php //endif; ?>

							<?php if ($this->countModules('position-12')) : ?>
								<div id="top">
									<jdoc:include type="modules" name="position-12" />
								</div>
							<?php endif; ?>

							<jdoc:include type="message" />
							<jdoc:include type="component" />

						</div><!-- end main -->
					</div><!-- end wrapper -->

					<?php if ($showRightColumn) : ?>
						<div id="close">
							<a href="#" onclick="auf('right')">
							<span id="bild">
								<?php echo JText::_('TPL_BEEZ3_TEXTRIGHTCLOSE'); ?>
							</span>
							</a>
						</div>

						<aside id="right">
							<h2 class="unseen"><?php echo JText::_('TPL_BEEZ3_ADDITIONAL_INFORMATION'); ?></h2>
							<jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3" />
						</aside><!-- end right -->
					<?php endif; ?>

					<?php if ($navposition == 'center' and $showleft) : ?>
						<nav class="left <?php if ($showRightColumn == null) { echo 'leftbigger'; } ?>" id="nav" >

							<jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
							<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />

						</nav><!-- end navi -->
					<?php endif; ?>

					<div class="wrap"></div>
				</div> <!-- end contentarea -->
			</div><!-- back -->
		</div><!-- all -->



		<div id="footer-outer">
        
        
        
        
        
        
        
        
			<?php if ($showbottom) : ?>
				<div id="footer-inner" >

					<div id="bottom">
						<div class="box box1"> <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" /></div>
						<div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
						<div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>
					</div>

				</div>
			<?php endif; ?>

			<div id="footer-sub">
				<footer id="footer">
                
                	
                    <jdoc:include type="modules" name="position-text5" />
                    
                    <?php if ($this->countModules('position-rotator1')) : ?>
                    	<span class="head_rotator1">Наши клиенты</span>
                        <div class="rotator1">
                    		<jdoc:include type="modules" name="position-rotator1" />
                    	</div>
					<?php endif; ?>
                    
                    <?php if ($this->countModules('position-rotator2')) : ?>
                    	<span class="head_rotator2">Фото отгрузки товара</span>
                        <div class="rotator2">
                    		<jdoc:include type="modules" name="position-rotator2" />
                            <a class="more">Перейти в раздел ></a>
                        </div>
                	<?php endif; ?>
                	
					<jdoc:include type="modules" name="position-14" />
				</footer><!-- end footer -->
			</div>
		</div>
		<jdoc:include type="modules" name="debug" />
        
        
        
<div class="footer_container">
	<div class="footer1">
    
    	<a class="logo" href="/"></a>
    	<span class="adress1">675000, Россия, Амурская область,<br>г.Благовещенск, ул.Тенистая 127, офис 401</span>
    	
    	<span class="copy">&copy; 2011-<?php echo date('Y');?> Группа компаний "Амур-Торг"</span>
    	
    	<div class="vertical_line"></div>
    	
    	<span class="phone1">Тел.: 8-914-5-914-914</span>
    	<span class="phone2">Тел.: 8-914-5-914-914</span>
    	<span class="phone3">Тел.: 8-914-5-914-914</span>
    	<span class="phone4">E-mail: sales@amur-tg.ru</span>
    	
        
        <span class="note1">(Единый телефонный номер)</span>
        <span class="note2">(Отдел продаж)</span>
        <span class="note3">(Телефон поддержки проектов)</span>
        <span class="note4">(Отдел продаж)</span>
        
    	<span class="phone">+7 (914) 5-914-914</span>
    	<span class="note5">Единый телефонный номер для всех регионов<br>Российской Федерации</span>
        
        <a class="link1"><span>Скачать каталог</span></a>
        
        <a class="link2"><span>Заказать обратный звонок</span></a>
        
    
    </div> 
 
</div>       
        
        
        
        
        
        
        
        
        
        
	</body>
</html>
