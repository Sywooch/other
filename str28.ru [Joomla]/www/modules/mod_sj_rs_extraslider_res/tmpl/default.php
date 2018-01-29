<?php
/**
 * @package Sj rs Extra Slider responsive
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2013 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
    defined('_REXEC') or die;
    $rs_currency_display = &CurrencyDisplay::getInstance();
    $image_elements_config = array(
    		'output_width'  => $params->get('element_image_width'),
    		'output_height' => $params->get('element_image_height'),
    		'function'		=> $params->get('element_image_function'),
    		'background'	=> $params->get('element_image_background')
    );    
    $options=$params->toObject();
	$count_element = count($elements);
	$element_of_page = $options->num_rows * $options->num_cols;
	$suffix = rand().time();
	$tag_id = 'sjextraslider_'.$suffix;	
	   
	if(!empty($elements)){?>
    <div id="<?php echo $tag_id;?>" class="sj-extraslider <?php if( $options->effect == 'slide' ){ echo $options->effect;}?> preset02-<?php echo $options->num_cols; ?>" data-pause='hover'>
		<?php if(!empty($options->pretext)) { ?>
			<div class="pre-text"><?php echo $options->pretext; ?></div>
		<?php } ?> 
        <?php if($options->title_slider_display == 1){?>
            <div class="heading-title"><?php echo $options->title_slider;?></div><!--end heading-title-->
        <?php }?>		    
    	<div class="extraslider-control  <?php if( $options->button_page == 'under' ){echo 'button-type2';}?>">
		    <a class="button-prev" href="<?php echo '#'.$tag_id;?>" data-jslide="prev"></a>
		    <?php if( $options->button_page == 'top' ){?>
		    <ul class="nav-page">
		    <?php $j = 0;$page = 0;
		    	foreach ($elements as $element){$j ++;
				$active_class = $page == 0 ? " active" : "";
		    		if( $j%$element_of_page == 1 || $element_of_page == 1 ){$page ++;?>
		    		<li class="page">
		    			<a class="button-page <?php if( $page==1 ){echo 'sel';}?>" href="<?php echo '#'.$tag_id;?>" data-jslide="<?php echo $page-1;?>"></a>
		    		</li>
	    		<?php }}?>
		    </ul>
		    <?php }?>
		    <a class="button-next" href="<?php echo '#'.$tag_id;?>" data-jslide="next"></a>
	    </div>
	    <div class="extraslider-inner">
	    <?php $count = 0; $i = 0; 
	    foreach($elements as $element){$count ++; $i++;?>
            <?php if($count%$element_of_page == 1 || $element_of_page == 1){?>
            <div class="element <?php if($i==1){echo "active";}?>">
            <?php }?>
                <?php if($count%$options->num_cols == 1 || $options->num_cols == 1 ){?>
                <div class="line">
                <?php }?>  
                
				    <div class="element-wrap <?php echo $options->theme; if($count%$options->num_cols == 0 || $count== $count_element && $options->num_cols !=1){echo " last";}?> ">
				    	<div class="element-image">
                            <a href="<?php echo $element->link;?>" <?php echo YTools::parseTarget($options->element_link_target);?> >
                                <img src="<?php echo YTools::resize($element->images, $image_elements_config);?>" alt="<?php echo $element->product_name;?>" title="<?php echo $element->product_name;?>"/>
                            </a>
				    	</div>
			    	<?php if( $options->element_title_display == 1 || $options->element_desc_display == 1  || $options->element_price_display == 1 || $options->element_readmore_display == 1 ){?>
				    	<div class="element-info">
				    	<?php if( $options->element_title_display == 1 ){?>
				    		<div class="element-title">
                                <a href="<?php echo $element->link;?>" <?php echo YTools::parseTarget($options->element_link_target);?>>
                                    <?php echo Ytools::truncate($element->product_name,$options->element_title_max_characs);?>
                            	</a>
				    		</div>
			    		<?php }?>
			    		<?php if( ($options->element_desc_display == 1 && !empty($element->product_s_desc)) || $options->element_price_display == 1 || $options->element_readmore_display == 1 ){?>
                            <div class="element-content">
                            <?php if( $options->element_desc_display == 1 ){?>
                                <div class="element-description">
									<?php
									 	$desc = "";
										if(!empty($element->product_s_desc)){
											YTools::extractImages($element->product_s_desc);
											$desc = $element->product_s_desc;	
										}else{
											YTools::extractImages($element->product_desc);
											$desc = $element->product_desc;	
										}
										if ( (int)$params->get('element_description_striptags', 1) ){
											$keep_tags = $params->get('element_description_keeptags', '');
											$keep_tags = str_replace(array(' '), array(''), $keep_tags);
											$tmp_desc = strip_tags($desc ,$keep_tags );
											echo YTools::truncate($tmp_desc, (int)$params->get('element_desc_max_characs'));
										} else {
											echo YTools::truncate($desc, (int)$params->get('element_desc_max_characs'));
										}?>                                
                                </div>
                            <?php }?>
                            
                                <?php if($options->element_price_display == 1){ ?>
           							<div class="element-price">
           								<div class="sale-price">
           									<?php	$currency = &CurrencyDisplay::getInstance();
												if ( !empty($element->prices['salesPrice']) ){
													echo $currency->createPriceDiv('salesPrice', '', $element->prices, true);
												}
												if ( !empty($element->prices['salesPriceWithDiscount']) ){
													echo $currency->createPriceDiv('salesPriceWithDiscount', '', $element->prices, true);
												}
											?>
           								</div>
           							</div>
           						<?php } ?>                             
                            
                            <?php if( $options->element_readmore_display == 1 ){?>
                                <div class="element-readmore">
			                        <a href="<?php echo $element->link;?>" target = "<?php echo $options->element_link_target;?>">
		                            	<?php echo $options->element_readmore_text;?>
			                        </a>                                
                                </div> 
                            <?php }?>                               
                            </div>
                        <?php }?>
				    	</div>
			    	<?php }?>
				    </div>                
                 
                <?php if($count%$options->num_cols == 0 || $count== $count_element){?>    
                </div><!--line-->
                <?php } ?>		    		
            <?php if(($count%$element_of_page == 0 || $count== $count_element)){?>    
            </div><!--end element--> 
            <?php }?>
	    <?php }?>
	    </div><!--end extraslider-inner -->
	    <?php if( $options->button_page == 'under' ){?>
	    <ul class="nav-page nav-under">
	    <?php $j = 0;$page = 0;
	    	foreach ($elements as $element){$j ++;
			$active_class = $page == 0 ? " active" : "";
	    		if( $j%$element_of_page == 1 || $element_of_page == 1 ){$page ++;?>
	    		<li class="page">
	    			<a class="button-page <?php if( $page==1 ){echo 'sel';}?>" href="<?php echo '#'.$tag_id;?>" data-jslide="<?php echo $page-1;?>"></a>
	    		</li>
    		<?php }}?>
	    </ul>
	    <?php }?>	    
		<?php if(!empty($options->posttext)) {  ?>
			<div class="post-text"><?php echo $options->posttext; ?></div>
		<?php }?>
    </div>
<?php }else{ echo RText::_('Has no element to show!');}?>

<script>
//<![CDATA[    					
	jQuery(function($){
		$('#<?php echo $tag_id;?>').each(function(){
			var $this = $(this), options = options = !$this.data('modal') && $.extend({}, $this.data());
			$this.jcarousel(options);
			$this.bind('jslide', function(e){
				var index = $(this).find(e.relatedTarget).index();

				// process for nav
				$('[data-jslide]').each(function(){
					var $nav = $(this), $navData = $nav.data(), href, $target = $($nav.attr('data-target') || (href = $nav.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''));
					if ( !$target.is($this) ) return;
					if (typeof $navData.jslide == 'number' && $navData.jslide==index){
						$nav.addClass('sel');
					} else {
						$nav.removeClass('sel');
					}
				});
			});
		});
		return ;
	});
//]]>	
</script>

