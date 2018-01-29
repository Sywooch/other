<?php // no direct access 2
defined('_REXEC') or die('Restricted access'); ?>
<!--BEGIN Search Box -->
<form action="<?php echo JRoute::_('index.php?option=com_retinashop&view=category&search=true&limitstart=0&retinashop_category_id='.$category_id ); ?>" method="get">
<div class="search<?php echo $params->get('moduleclass_sfx'); ?>">
<?php $output = '<input style="height:16px;vertical-align :middle;" name="keyword" id="mod_retinashop_search" maxlength="'.$maxlength.'" alt="'.$button_text.'" class="inputbox'.$moduleclass_sfx.'" type="text" size="'.$width.'" value="'.$text.'"  onblur="if(this.value==\'\') this.value=\''.$text.'\';" onfocus="if(this.value==\''.$text.'\') this.value=\'\';" />'; 
 $image = JURI::base().'component/com_retinashop/retina_097115115101116115/images/rsgeneral/search.png' ;
 			
			if ($button) :
			    if ($imagebutton) :
			        $button = '<input style="vertical-align :middle;height:16px;border: 1px solid #CCC;" type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$image.'" onclick="this.form.keyword.focus();"/>';
			    else :
			        $button = '<input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.keyword.focus();"/>';
			    endif;
			endif;

			switch ($button_pos) :
			    case 'top' :
				    $button = $button.'<br />';
				    $output = $button.$output;
				    break;

			    case 'bottom' :
				    $button = '<br />'.$button;
				    $output = $output.$button;
				    break;

			    case 'right' :
				    $output = $output.$button;
				    break;

			    case 'left' :
			    default :
				    $output = $button.$output;
				    break;
			endswitch;

			echo $output;
?>
</div>
		<input type="hidden" name="limitstart" value="0" />
		<input type="hidden" name="option" value="com_retinashop" />
		<input type="hidden" name="view" value="category" />
	  </form>

<!-- End Search Box -->