<?php
/*------------------------------------------------------------------------
# com_k2store - K2 Store
# ------------------------------------------------------------------------
# author    Ramesh Elamathi - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2012 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://k2store.org
# Technical Support:  Forum - http://k2store.org/forum/index.html
-------------------------------------------------------------------------*/


// no direct access
	defined('_JEXEC') or die('Restricted access'); 
	
	$order_link = @$this->order_link;
	$plugin_html = @$this->plugin_html;
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
	
		<h3 class="text-center bordered-bottom head_final_order"><?php echo JText::_( "K2STORE_CHECKOUT_RESULTS" ); ?></h3>
	
		<?php echo $plugin_html; ?>
	
		<?php //if(!empty($order_link)):?>
		<div class="note pad-top-bottom-40 tmp1">
			<!--<a href="<?php echo JRoute::_($order_link); ?>">
		        <?php echo JText::_( "K2STORE_VIEW_PRINT_INVOICE" ); ?>
			</a>-->
            
            <!--<pre>
            <?php
			//print_r($this);
			?>
            </pre>-->
            
            <span class="result_text1">Ваш заказ <span style="color:#0386d4;"><?php $link_m=explode("=",$order_link); echo $link_m[count($link_m)-1];  ?></span> принят, в ближайшее время с вами свяжется менеджер.</span>
            <span class="result_text2">Подписывайтесь на полезные и интересные группы</span>
            
		</div>
		<?php //endif; ?>
        
        
        
        <div class="social">
        	<div class="block_social block_social1">
                       
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
				
				<!-- VK Widget -->
				<div id="vk_groups"></div>
				<script type="text/javascript">
				VK.Widgets.Group("vk_groups", {mode: 0, width: "400", height: "350", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 28720147);
				</script>
                <!--
                <div id="vk_groups"></div>
				<script type="text/javascript">
				VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 28720147);
				</script>
				-->
                
            </div>    
                
            <div class="block_social block_social2">    
                
                <div id="fb-root"></div>
				<script>(function(d, s, id) {
  				var js, fjs = d.getElementsByTagName(s)[0];
  				if (d.getElementById(id)) return;
  				js = d.createElement(s); js.id = id;
 				js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
  				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>

                <!--
                <div class="fb-page" data-href="https://www.facebook.com/poparada.com.ua" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/poparada.com.ua"><a href="https://www.facebook.com/poparada.com.ua">Poparada</a></blockquote></div></div>
                -->
				<div class="fb-page"
  				data-href="https://www.facebook.com/poparada.com.ua" 
  				data-width="400"
  				data-hide-cover="false"
  				data-show-facepile="true"></div>                
                
                
            </div>     
        </div> 
        
        
        
		</div>
	</div>
</div>
