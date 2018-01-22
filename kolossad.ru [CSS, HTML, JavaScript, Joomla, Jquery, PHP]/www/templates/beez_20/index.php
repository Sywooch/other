<?php
/**
 * @package                Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright        Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license                GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// check modules
$showRightColumn        = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom                        = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft                        = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
        $showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$color              = $this->params->get('templatecolor');
$logo               = $this->params->get('logo');
$navposition        = $this->params->get('navposition');
$app                = JFactory::getApplication();
$doc				= JFactory::getDocument();
$templateparams     = $app->getTemplate(true)->params;

$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/md_stylechanger.js', 'text/javascript', true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
        <head>
                <jdoc:include type="head" />
<?php

 $document = & JFactory::getDocument();
$config = & JFactory::getConfig();
$fulltitle = $document->title.' - '.$config->getValue('sitename').', детский сад "Колосок", Нижнекалинов';
$document->setTitle( $fulltitle ); 

?>
        

 
 <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/position.css" type="text/css" media="screen,projection" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/layout.css" type="text/css" media="screen,projection" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/print.css" type="text/css" media="print" />
<?php
        $files = JHtml::_('stylesheet', 'templates/'.$this->template.'/css/general.css', null, false, true);
        if ($files):
                if (!is_array($files)):
                        $files = array($files);
                endif;
                foreach($files as $file):
?>
                <link rel="stylesheet" href="<?php echo $file;?>" type="text/css" />
<?php
                 endforeach;
        endif;
?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/<?php echo htmlspecialchars($color); ?>.css" type="text/css" />
<?php			if ($this->direction == 'rtl') : ?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_rtl.css" type="text/css" />
<?php				if (file_exists(JPATH_SITE . '/templates/beez_20/css/' . $color . '_rtl.css')) :?>
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/<?php echo $color ?>_rtl.css" type="text/css" />
<?php				endif; ?>
<?php			endif; ?>
                <!--[if lte IE 6]>
                <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ieonly.css" rel="stylesheet" type="text/css" />

                <?php if ($color=="personal") : ?>
                <style type="text/css">
                #line
                {      width:98% ;
                }
                .logoheader
                {
                        height:200px;

                }
                #header ul.menu
                {
                display:block !important;
                      width:98.2% ;


                }
                 </style>
                <?php endif;  ?>
                <![endif]-->
                <!--[if IE 7]>
                        <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
                <![endif]-->
                <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/javascript/hide.js"></script>

                <script type="text/javascript">
                        var big ='<?php echo (int)$this->params->get('wrapperLarge');?>%';
                        var small='<?php echo (int)$this->params->get('wrapperSmall'); ?>%';
                        var altopen='<?php echo JText::_('TPL_BEEZ2_ALTOPEN', true); ?>';
                        var altclose='<?php echo JText::_('TPL_BEEZ2_ALTCLOSE', true); ?>';
                        var bildauf='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/plus.png';
                        var bildzu='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/minus.png';
                        var rightopen='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTOPEN', true); ?>';
                        var rightclose='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?>';
                        var fontSizeTitle='<?php echo JText::_('TPL_BEEZ2_FONTSIZE'); ?>';
                        var bigger='<?php echo JText::_('TPL_BEEZ2_BIGGER'); ?>';
                        var reset='<?php echo JText::_('TPL_BEEZ2_RESET'); ?>';
                        var smaller='<?php echo JText::_('TPL_BEEZ2_SMALLER'); ?>';
                        var biggerTitle='<?php echo JText::_('TPL_BEEZ2_INCREASE_SIZE'); ?>';
                        var resetTitle='<?php echo JText::_('TPL_BEEZ2_REVERT_STYLES_TO_DEFAULT'); ?>';
                        var smallerTitle='<?php echo JText::_('TPL_BEEZ2_DECREASE_SIZE'); ?>';
                </script>

        </head>

        <body style="padding:0; margin:0; border:0; background-color:white !important;">



<div align="center" style="width:100%; background-color:transparent;padding:0; margin:0; border:0; ">
<div align="center" style="width:1000px; padding:0; margin:0; border:0; ">
<div align="center" style="width:1000px; background-color:#8ecf1d;  display:inline;
position:relative; float:left;padding:0; margin:0; border:0; 
background-image:url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/fon/fon_up.png);
background-repeat:no-repeat; background-position:center top; 
">


<div align="center" style="width:1000px;padding:0; margin:0; border:0; ">
<div align="center" style="width:1000px; background-color:relative; 
position:relative;  display:inline; float:left;padding:0; margin:0; border:0; ">
<!--

<!--шапка с меню-->
<div style="width:1000px; background-color:transparent; height:430px; border-bottom:0px black solid; 
position:relative;  display:inline; float:left;padding:0; margin:0; border:0; ">


<!--меню-->
<div style="width:1000px; height:40px; background-color:transparent;">
<div align="center" style="width:760px; height:40px; background-color:transparent; overflow:hidden;
font-size:14pt; float:right;"><strong>
<jdoc:include type="modules" name="position-12"   />
</strong>
</div>
</div>
<!--меню-->


</div>
<!--шапка с меню-->

<!--блок с двумя столбцами-->
<div align="left" style="width:1000px; background-color:transparent; position:relative;  display:inline; float:left; ">


<!--левый столбец-->
<div style="width:440px; height:550px; background-color:transparent; border-right:0px black solid;
 float:left; position:relative;display:inline;">
</div>
<!--левый столбец-->

<!--правый столбец-->
<div style="width:550px;  background-color:transparent; border-right:0px black solid;
 float:left; position:relative; display:inline;">

<div align="left" style="width:550px; background-color:transparent; padding-bottom:180px; color:white;">
<jdoc:include type="message" />
<jdoc:include type="component" />
<jdoc:include type="modules" name="position-22" />
</div>


</div>
<!--правый столбец-->



</div>
<!--блок с двумя столбцами-->





<!--
<div id="all" style="background-color:transparent !important; border:0px black solid; width:940px !important;">
        <div id="back" style="background-color:transparent !important; width:940px !important;
		height:182px !important;">
                <div id="header" style="border:0px black solid; background-color:transparent !important; 
				width:940px !important; height:182px !important; 
				background-image:url(<?php //echo $this->baseurl ?>/templates/<?php //echo $this->template ?>/images/fon/header_bg_main.png);
				background-repeat:no-repeat !important; padding:0px !important; margin:0px !important;
				border:0px !important;">
                                
				<div style="width:185px; height:182px; background-color:transparent; float:left;
				background-image:url(<?php //echo $this->baseurl ?>/templates/<?php //echo $this->template ?>/images/fon/logo.png);
				background-repeat:no-repeat; "></div>
                                      <!--  
                                        <jdoc:include type="modules" name="position-1" />
                                        -->

                </div><!-- end header -->
                     <!--   <div id="<?php //echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>" 
						>
                                       
<!--
								<div id="breadcrumbs">

                                                        <jdoc:include type="modules" name="position-2" />

                                        </div>

                                        <?php //if ($navposition=='left' and $showleft) : ?>


                                                        <div class="left1 <?php //if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
                                                   <jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
                                                                <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                                                <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />


                                                        </div><!-- end navi -->
               <?php //endif; ?>

                             <!--           <div id="<?php //echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>"
													<?php //if (isset($showno)){echo 'class="shownocolumns"';}?>>

                                                <div id="main">

                                                <?php //if ($this->countModules('position-12')): ?>
                                                        <div id="top"><jdoc:include type="modules" name="position-12"   />
                                                        </div>
                                                <?php //endif; ?>
-->
                                                        
<!--
                                                </div><!-- end main -->

                                <!--        </div><!-- end wrapper -->

                                <?php //if ($showRightColumn) : ?>
                             <!--           <h2 class="unseen">
                                                <?php //echo JText::_('TPL_BEEZ2_ADDITIONAL_INFORMATION'); ?>
                                        </h2>
                                        <div id="close">
                                                <a href="#" onclick="auf('right')">
                                                        <span id="bild">
                                                                <?php //echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?></span></a>
                                        </div>


                                        <div id="right">
                                                <a id="additional"></a>
                                                <jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3"/>
                                                <jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3"  />
                                                <jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3"  />
                                        </div><!-- end right -->
                                        <?php //endif; ?>

                        <?php //if ($navposition=='center' and $showleft) : ?>

                                 <!--       <div class="left <?php //if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav" >

                                                <jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
                                                <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                                <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />


                                        </div><!-- end navi -->
                   <?php //endif; ?>

                            <!--    <div class="wrap"></div>
								
								-->
								

                        <!--        </div> <!-- end contentarea -->

                        </div><!-- back -->

<!--горизонтальное меню-->
<!--<div style="width:938px; height:38px; background-color:white; border:1px black solid; overflow:hidden;">


</div>
<!--горизонтальное меню-->


<!--контент-->
<!--<div style="width:940px; background-color:white; color:black; position:relative;  display:inline; float:left;  ">


<div style="width:690px; padding:5px; display:inline; float:left; position:relative; background-color:white;">




<?php
/*
$a=$_SERVER['REQUEST_URI']; 

$data=$a;
$result = count_chars($data, 0);

//ASCII код символа /
$kod= ord ("/");
$count=$result[$kod];

if($count>3){


}else{

echo'';

}


*/
?>


</div>


<div style="width:230px; padding:5px;  display:inline; float:left; position:relative; background-color:white; ">
<jdoc:include type="modules" name="golos" />
</div>


</div>
<!--контент-->






  <!--              </div><!-- all -->

           <!--     <div id="footer-outer">
                        <?php //if ($showbottom) : ?>
                        <div id="footer-inner">

                                <div id="bottom">
                                        <div class="box box1"> <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>
                                </div>


                        </div>
                                <?php //endif ; ?>

                        <div id="footer-sub">-->

<!--
<div id="footer" style="width:940px !important; height:100px !important; 
background-color:#991c23 !important;">

<div align="left" style="width:470px; height:100px; background-color:transparent; float:left; ">
<div style="width:470px; height:20px; "></div>
<div align="left" style="width:450px; height:30px; padding-left:15px; padding-right:5px; ">
<span style="font-size:10pt; color:white;">2014 &copy; Региональное отделение  политической партии</br>
«РОССИЙСКАЯ ПАРТИЯ ПЕНСИОНЕРОВ ЗА СПРАВЕДЛИВОСТЬ» Амурской области</span>
</div>
</div>

<div align="left" style="width:470px; height:100px; background-color:transparent; float:left; ">
<div style="width:470px; height:20px; "></div>
<div align="right" style="width:450px; height:30px; padding-left:5px; padding-right:15px; ">
<span style="font-size:10pt; color:white;">Cоздание и поддержка сайта: <a href="http://www.retina-studio.ru">retina</a></span>
</div>
</div>
                                        <!--<jdoc:include type="modules" name="position-14" />-->
<!--                                        
</div><!-- end footer -->

                  <!--      </div>

                </div>-->
				<!--
				<jdoc:include type="modules" name="debug" />
				-->


</div>			
</div>				

<!--footer-->
<div align="center" style="width:1000px; height:492px; ">
<div align="left" style="width:1000px; height:492px; margin-top:-175px; background-color:transparent; display:inline;
position:relative; float:left; 
background-image:url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/fon/fon_down.png);
background-repeat:no-repeat; background-position:center top;">

<div style="width:1000px; height:360px; border-bottom:0px black solid; background-color:transparent;"></div>


<div align="center" style="width:1000px; height:100px; border-bottom:0px black solid;">
<div style="width:745px; height:100px; background-color:transparent;">
<div align="left" style="width:530px; height:100px; float:left; background-color:transparent;">

<span style="font-family:arial, helvetica, sans-serif; 
font-size:10pt; color:#2f4412;">
2014 @ Муниципальное бюджетное дошкольное</br>
образовательное учреждение детский сад №6 «Колосок»</br>
Ростовская обл., Константиновский р-н, х. Нижнекалинов</span>

</div>



<div align="right" style="width:210px; height:100px; float:left;">
<span style="font-family:arial, helvetica, sans-serif; 
font-size:10pt; color:#2f4412;">Создание и обслуживание сайта:</br>
<a href="http://www.retina-studio.ru" style="color:#2f4412;">дизайн-студия retina</a></span>



</div>
</div>



</div>
</div>
<!--footer-->


</div><!--1000px-->		
</div><!--1000px-->	


</div><!--width:100%-->				
				
				
        </body>
</html>
