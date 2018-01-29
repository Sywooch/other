<?php

// no direct access 2
defined('_REXEC') or die;
?>
<style>
   input[type="text"]:focus { outline: none; }
   select:focus { outline: none; }
  </style>
<form action="<?php echo JRoute::_('index.php');?>" method="post">
	<div align="left" class="search<?php echo $moduleclass_sfx ?>">
	<div style="width:455px; height:45px; float:left;"></div>
	<div style="width:470px; height:45px; float:left;">
		<div style="width:210px; padding-top:14px; height:30px; float:left; " >
		<?php
			$output = '<label for="module-search-searchword">'.''.'</label>
			<input style="width:200px !important; outline: none !important; border:0 !important" name="searchword" 
			id="module-search-searchword" maxlength="'.$maxlength.'"  class="inputbox'.$moduleclass_sfx.'" type="text"  
			value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" 
			onfocus="if (this.value==\''.$text.'\') this.value=\'\';" /></div>
		
<div style="width:223px; padding-top:14px; height:30px; float:left; " >
	<select size=1 name="par" style="width:200px;margin-left:20px;background-color:white; outline:none;
  border:0;"  onfocus="blur()";>
<option value="1">Все категории</option>
<option style="border:0;" value="2"></option>
<option style="border:0;" value="3"></option>
<option style="border:0;" value="4"></option>
</select></div>
';


			if ($button) :
				if ($imagebutton) :
					$button = '<input style="margin-left:6px !important; margin-top:8px !important" 
					type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="images/button_search.png" onclick="this.form.searchword.focus();"/>';
				else :
					$button = '<input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/>';
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
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="elementid" value="<?php echo $melementid; ?>" />
	</div>
	
	
	</div>
</form>
