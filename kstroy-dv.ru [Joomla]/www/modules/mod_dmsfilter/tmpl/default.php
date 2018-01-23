<?php
/**
 * @package     mod_dmsfilter
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @author      Misha Datsko <misha@datsko.info> - http://datsko.info
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$document = JFactory::getDocument();
if($inmodal){
	JHTML::_('behavior.modal');
}
?>
	<div class="filter<?php echo $moduleclass_sfx ?>">
		<ul class="filterlist">
        <?php
		$jqueryui = array();
		foreach($filterdata as $name=>$fd){
			echo '<li>'.($show_titles?'<'.$title_tag.'>'.${'title_'.$name}.'</'.$title_tag.'>':'').'<ul>';
			foreach($fd['data'] as $data){
				switch($fd->filtertype){
					default:
					case'checkbox':{
						echo '<li><label><input type="checkbox" name="'.$name.'[]" value="'.$data->id.'" />'.$data->filtername.'</label></li>';
						break;
					}
					case'slider':{
						$min = floor($data->min);
						$max = ceil($data->max);
						echo '<li><label class="'.$name.'">
							<span>От <input type="text" name="'.$name.'min" class="'.$name.'min" value="'.$min.'" /></span>
							<span>До <input type="text" name="'.$name.'max" class="'.$name.'max" value="'.$max.'" /></span>'.$data->filtername.'</label>
							<div class="slider'.$name.'"></div></li>';
						$document->addScriptDeclaration('jQuery(document).ready(function($){
								$(\'.slider'.$name.'\').slider({
									range: true,
									min: '.$min.',
									max: '.$max.',
									values: ['.$min.','.$max.'],
									slide: function(event,ui){
										$(\'.'.$name.'min\').val(ui.values[0]);
										$(\'.'.$name.'max\').val(ui.values[1]);
									},
									stop: function(event,ui){
										FilterResults($(\'.filter\').find(\'input\').serialize(),$(\'.filter\').find(\'input\').serializeObject());
									}
								});
							});');
						break;
					}
				}
			}
			echo '</ul></li>';
		}
		?>
		</ul>
		
		<div id="product_template" style="display:none;">
			<div class="product col-lg-3">
				<a href="?tmpl=component" class="image modal" rel="{size: {x: 1024, y: 612},classOverlay:'over'}">
					<span class="sale" title="">Sale 10%</span>
					<div class="img"></div>
					<div class="mfname"></div>
					<div class="name"></div>
					<div class="product-price marginbottom12">
						<div class="PricesalesPrice"><span class="PricesalesPrice"></span></div>
						<div class="PricepriceWithoutTax"><span class="PricepriceWithoutTax"></span></div>
					</div>
					<span class="btn-quick"><?php //echo JText::_ ('COM_VIRTUEMART_PRODUCT_DETAILS')?></span>
				</a>
			</div>
		</div>
	</div>
<script>
	jQuery(document).ready(function($){
		$('.filter<?php echo $moduleclass_sfx ?> [type=checkbox]').click(function(){
			FilterResults($('.filter<?php echo $moduleclass_sfx ?>').find('input').serialize(),'<?php echo $cbrowse ?>',<?php echo $prow ?>,<?php echo $inmodal ?>);
		});
	});
</script>
