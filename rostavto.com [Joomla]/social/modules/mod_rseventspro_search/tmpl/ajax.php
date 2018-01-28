<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<div class="rsepro_search_ajax<?php echo $suffix; ?>">
	<input type="text" name="rsepro_ajax" value="" autocomplete="off" id="rsepro_ajax" />
	<div class="rsepro_ajax_container">
		<ul class="rsepro_ajax_list" id="rsepro_ajax_list"></ul>
	</div>
</div>

<script type="text/javascript">
window.addEvent('domready', function(){
	$('rsepro_ajax_list').setStyle('height','auto');
	RSEProSearch = new Fx.Slide('rsepro_ajax_list').hide();
	
	$('rsepro_ajax').addEvent('keydown', function() {
		clearTimeout(this.timeout);
		if (this.value.length == 0) {
			clearTimeout(this.timeout);
			RSEProSearch.slideOut();
			return true;
		}
		this.timeout = setTimeout("rsepro_search('<?php echo JURI::root(); ?>',<?php echo $itemid; ?>,<?php echo $links; ?>);", 1000);
	});
	
	$('rsepro_ajax').addEvent('focus', function() {
		if (this.value=='') {
			clearTimeout(this.timeout);
			this.value='';
			RSEProSearch.slideOut();
		}
	});
	
	$('rsepro_ajax').addEvent('blur', function() {
		if (this.value=='') {
			clearTimeout(this.timeout);
			RSEProSearch.slideOut();
		}
	});
});
</script>