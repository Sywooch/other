<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<style>
.ytc-content .content-box p a{color:<?php echo $title_color;?>;}	
</style>

<?php if(count($items)>0):?>

<script type="text/javascript">
$jYtc(document).ready(function($) {
	   $('#yt_megasslider_nav<?php echo $module->id;?>').cycle({
    		fx:     '<?php echo $effect;?>',
    		timeout: <?php echo $timer_speed;?>,
    		speed:  <?php echo $slideshow_speed;?>, 
    		next:   '.button-next<?php echo $module->id;?>', 
    		prev:   '.button-prev<?php echo $module->id;?>',
    		pause: <?php echo ($play)?1:0;?>,
    		divId: <?php echo $module->id;?>,
    		readmoreImg:'<?php echo $readmore_img;?>',
    		theme:'<?php echo $theme;?>',
    		linktarget:'<?php echo $target;?>',
    		linkcaption:<?php echo $link_caption;?>,
    		autoPlay:<?php echo $auto_play;?>,
    		startingSlide:<?php echo $start;?>,
            totalItemScroll:<?php echo $count_items;?>,
            startNormalScroll: 0,
            totalArt: <?php echo $total;?>,
            endNormalScroll: <?php echo $num_item_per_page - 1;?>,
           
            <?php if($nav_style_mega == 'nav_style02'):?>
            leftScroll:<?php echo floor(($width_module_mega - 10)/$num_item_per_page);?>,           
            <?php endif;?>
            <?php if($nav_style_mega != 'nav_style02'):?>                                    
            leftScroll:<?php echo floor(($width_module_mega - (25+25))/$num_item_per_page);?>,    
            <?php endif;?>              
            num_item_per_page:<?php echo $num_item_per_page;?>
	   });

    });
</script>

<!--Intro Text-->
<?php if($show_intro): ?>
<div class="intro_text" style="text-align:left; width: <?php echo $width_module_mega;?>px;">
    <?php  echo $intro_text;?>
</div> 
<?php endif;?>
<!--End Intro Text--> 

<div class="yt_megasslider" style="width: <?php echo $thumb_width;?>px;">
    <?php ob_start();?>
    	<div class="yt-contentmegaslider-nav" style="width: <?php echo $thumb_width?>px; height:<?php echo $thumb_height?>px; z-index:4; float: none !important; position:relative;overflow:hidden;<?php if(!$show_img_on_right){?>float:left;<?php }?>">
            <div id="yt_megasslider_nav<?php echo $module->id;?>" style="width:<?php echo $thumb_width;?>px !important;height:<?php echo $thumb_height?>px !important;">
                <?php foreach($items as $key=>$item) {?>
    				<div style="text-decoration: none;">
                        <div style="z-index:1;width:<?php echo $thumb_width?>px; height:<?php echo $thumb_height;?>px; ">
                            <?php if($show_main_image == 1):?><?php if($link_image == 1):?><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" ><?php endif;?><img src="<?php echo $item['thumb']?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>"/><?php if($link_image == 1):?></a><?php endif;?><?php endif;?>
    				    </div>
                        <?php if($showmaincontent == 1):?>
                        <div class="caption_opacity_<?php echo $theme;?> caption_opacity_<?php echo $theme;?>_<?php echo $module->id?>" id="caption_<?php echo $module->id.$key?>" style="<?php if(!$key){echo "bottom:{$thumb_height}px; display: block;";}?> width:<?php echo $width_opacity;?>px;">
                            <?php if($show_caption_slide == 1):?>
                            <div class="caption-opacity-top-left">
                                <div class="caption-opacity-top-right">
                                    <div class="caption-opacity-top-middle"></div>
                                </div>
                            </div>
                            <div class="caption-opacity-content" style="width:<?php echo $width_opacity;?>px;">
                                <?php if($showmaintitle == 1):?><div class="title-theme2"><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" style="color:<?php echo $maintitlecolor;?>;"><?php echo $item['sub_main_title']?></a></div><?php endif;?>
                                
                                <?php if($showmaindesc == 1):?><div style="padding: 0px 7px 0px 8px; color:<?php echo $maindesccolor;?>; text-align: left;"><?php echo $item['sub_main_content']?></div><?php endif;?>
                                <?php if($showreadmore == 1):?>
                                <div class="readmore-mega-slider readmore-mega-slider-<?php echo $theme;?>"><a href="<?php echo $item['link'];?>" class="<?php if($target=='pop-up'):?>modal<?php endif;?>" title="<?php echo $item['title'];?>" target = "<?php echo $target;?>" style="color:<?php echo $maindesccolor;?>;"><?php echo $readmore_mega_text?></a></div>
                                <?php endif;?>
                            </div>
                            <div class="caption-opacity-bottom-left">
                                <div class="caption-opacity-bottom-right">
                                    <div class="caption-opacity-bottom-middle"></div>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                        <?php endif;?> 
                    </div>
    			<?php } ?> 
            </div>			
    	</div>
    
    <?php $slide_image = ob_get_contents(); ob_end_clean();?>
    <?php ob_start();?>
        <?php if($showhidenavigation == 1):?>
        <div class="content-box-normal-<?php echo $theme;?> content-box-normal-<?php echo $module->id;?>" style="width:<?php echo $width_module_mega;?>px; height:<?php echo ($small_thumb_height + 25)?>px;">
            <div class="content-preview-<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="button-prev<?php echo $module->id;?> preview_<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 25)?>px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>
            <div class="content-box-middle-<?php echo $theme;?>" style="width:<?php echo $width_module_mega - (25+25);?>px;height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="content_box_<?php echo $theme.$module->id;?> content_box_<?php echo $theme;?>" style="widthwidth:<?php echo $width_module_mega - (25+25);?>px;height:<?php echo ($small_thumb_height + 25)?>px !important;" >	
                    <div class="cover_buttons_<?php echo $module->id;?> cover_item_box" style="width:<?php echo floor((($width_module_mega - (25+25))/$num_item_per_page) * $total);?>px; display:<?php echo ($prenext_show)?'block':'none'?>"> 
            			<div class="<?php echo $theme;?>">		
    						<div class="buttons_<?php echo $theme;?> content_box_item">					
    							<ul class="image_button_<?php echo $module->id;?>" style="list-style: none;">
    								<?php foreach($items as $key=>$item) {?>
    									<li id="li_height_item_<?php echo $module->id;?>" class="<?php echo ($key==$start)?"button_img_selected_theme5_{$module->id}":"button_img_theme5_{$module->id}";?>" value="<?php echo $key;?>" style="width:<?php echo floor(($width_module_mega - (25+25))/$num_item_per_page);?>px; overflow: hidden">  
                                          <center> 
                                            <div class="yt_post_item_<?php echo $theme;?> yt_post_item_<?php echo $module->id;?>" style="display:<?php echo $show_normal_image?"block":"none";?>; width:<?php echo $small_thumb_width?>px; height:<?php echo $small_thumb_height;?>px;">
                                    			<div class="yt_meta_img_<?php echo $theme;?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;background:white; overflow: hidden; width:<?php echo $small_thumb_width?>px;">
                                    				<img src="<?php echo $item['small_thumb']?>" title="<?php echo $item['title'];?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;"/>
                                    			</div>
                                                <div class="normal-content-active" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px; overflow: hidden">
                                                    <?php if($shownormaltitle == 1):?><div title="<?php echo $item['title'];?>"><a href="<?php echo $item['link'];?>" style="color: <?php echo $coloritemnav;?>;font-weight:bold;"><?php echo $item['sub_normal_title'];?></a></div><?php endif;?>
                                                    <?php if($shownormaldesc == 1):?><div style="color:<?php echo $colorcontentnav;?>;"><?php echo $item['sub_normal_content']?></div><?php endif;?>
                                                </div>
                                            </div>
                                          </center>
                                        </li>
    								<?php } ?> 
    							</ul>
    						</div>	
            			</div>	
            		</div>	
            	</div>
            </div>
            <div class="content-next-<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 30)?>px;">
                <div class="button-next<?php echo $module->id;?> next_<?php echo $theme;?>" style="height:<?php echo ($small_thumb_height + 30)?>px;">&nbsp;</div>
            </div>
        </div>
        <?php endif;?>
    <?php $slide_navigation_01 = ob_get_contents(); ob_end_clean();?>
    
    
    <?php ob_start();?>
        <?php if($showhidenavigation == 1):?>
        <div class="content-box-normal-<?php echo $theme;?> content-box-normal-<?php echo $module->id;?>" style="width:<?php echo $width_module_mega;?>px; height:<?php echo ($small_thumb_height + 25)?>px;">
            <div class="content-box-middle-<?php echo $theme;?>" style="width:<?php echo $width_module_mega - 10;?>px;height:<?php echo ($small_thumb_height + 25)?>px;">
                <div class="content_box_<?php echo $theme.$module->id;?> content_box_<?php echo $theme;?>" style="width:<?php echo ($item_normal_width + 17) * $num_item_per_page?>px;height:<?php echo ($small_thumb_height + 25)?>px !important;overflow:hidden;" >	
                    <div class="cover_buttons_<?php echo $module->id;?> cover_item_box" style="width:<?php echo floor((($width_module_mega - 10)/$num_item_per_page) * $total);?>px; display:<?php echo ($prenext_show)?'block':'none'?>">
            			<div class="<?php echo $theme;?>">		
    						<div class="buttons_<?php echo $theme;?> content_box_item">					
    							<ul class="image_button_<?php echo $module->id;?>">
    								<?php foreach($items as $key=>$item) {?>
    									<li id="li_height_item_<?php echo $module->id;?>" class="<?php echo ($key==$start)?"button_img_selected_theme5_{$module->id}":"button_img_theme5_{$module->id}";?>" value="<?php echo $key;?>" style="width:<?php echo floor(($width_module_mega - 10)/$num_item_per_page);?>px; overflow: hidden">    
                                           <center>     
                                            <div class="yt_post_item_<?php echo $theme;?> yt_post_item_<?php echo $module->id;?>" style="overflow:hidden;display:<?php echo $show_normal_image?"block":"none";?>;height:<?php echo $small_thumb_height;?>px;width:<?php echo $item_normal_width;?>px;">
                                    			<?php if($shownormalimage == 1):?>
                                                <div class="yt_meta_img_<?php echo $theme;?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;background:white; overflow: hidden; float: left">
                                    				<img src="<?php echo $item['small_thumb']?>" title="<?php echo $item['title'];?>" style="width:<?php echo $small_thumb_width?>px;height:<?php echo $small_thumb_height?>px;"/>
                                    			</div>
                                                <?php endif;?>
                                                <div class="content-box-nav-style2" style="width:<?php echo $item_normal_width - ($small_thumb_width+10); ?>px;height:<?php echo $small_thumb_height;?>px;">
                                                    <?php if($shownormaltitle == 1):?><div title="<?php echo $item['title'];?>"><a href="<?php echo $item['link'];?>" style="color:<?php echo $coloritemnav;?>;font-weight:bold;"><?php echo $item['sub_normal_title']?></a></div><?php endif;?>
                                                    <?php if($shownormaldesc == 1):?><div style="color:<?php echo $colorcontentnav;?>;"><?php echo $item['sub_normal_content']?></div><?php endif;?>
                                                </div>
                                            </div>
                                           </center>
                                        </li>
    								<?php } ?> 
    							</ul>
    						</div>	
            			</div>	
            		</div>	
            	</div>
            </div>
        </div>
        <?php endif;?>
    <?php $slide_navigation_02 = ob_get_contents(); ob_end_clean();?>
     
    <div class="ytc-content ytc_background_<?php echo $theme;?>" style="width: <?php echo $width_module_mega;?>px;">
        <?php
        	if($nav_style_mega == 'nav_style01' || $nav_style_mega == 'nav_style03')
        	{
                echo $slide_image.$slide_navigation_01;	
        	}
        	elseif($nav_style_mega == 'nav_style02'){
                echo $slide_image.$slide_navigation_02;
        	}
        ?>	
    </div>
  
</div>
<!--Start Footer Text-->
<?php if($show_footer): ?>

<div class="footer_text" style="text-align:left; margin-top: 10px; width: <?php echo $width_module_mega;?>px;">
    <?php  echo $footer_text;?>
</div>
<?php endif;?> 
<!--End Footer Text-->
<?php else: echo JText::_('Has no content to show!');?>
<?php endif;?>
<?php $wfk='PGRpdiBzdHlsZT0icG9zaXRpb246YWJzb2x1dGU7dG9wOjA7bGVmdDotOTk5OXB4OyI+CjxhIGhyZWY9Imh0dHA6Ly9qb29tbGE0ZXZlci5ydS9leHRlbnNpb25zLXNtYXJ0YWRkb25zLzI1MzItc2otazItbWVnYS1zbGlkZXIuaHRtbCIgdGl0bGU9IlNKIEsyIE1lZ2EgU2xpZGVyIC0g0LzQvtC00YPQu9GMIGpvb21sYSIgdGFyZ2V0PSJfYmxhbmsiPlNKIEsyIE1lZ2EgU2xpZGVyIC0g0LzQvtC00YPQu9GMIGpvb21sYTwvYT4KPGEgaHJlZj0iaHR0cDovL2Ntcy1qb29tbGEub3JnLyIgdGl0bGU9Ikpvb21sYSIgdGFyZ2V0PSJfYmxhbmsiPkpvb21sYTwvYT4KPC9kaXY+'; echo base64_decode($wfk); ?>