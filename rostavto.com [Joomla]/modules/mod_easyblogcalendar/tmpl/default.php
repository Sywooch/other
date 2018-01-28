<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
?>

<div>

<?php
if($easyblogInstalled)
{
?>
	<script>
		EasyBlog.require().script('legacy').done(function($){
			ejax.load( 'archive' , 'loadCalendar', 'module', '<?php echo $itemId; ?>', 'small', 'blog');
		})
	</script>
	<div id="easyblogcalendar-module-wrapper" class="ezb-mod mod_easyblogcalendar">
		<div style="text-align:center;">
			<?php echo JText::_('MOD_EASYBLOGCALENDAR_LOADING'); ?>
		</div>
		<div style="text-align:center;">
			<img src="<?php echo rtrim(JURI::root(), '/').'/components/com_easyblog/assets/images/loader.gif'; ?>" />
		</div>
	</div>
<?php			
}
else
{
	echo JText::_('MOD_EASYBLOGCALENDAR_EASYBLOG_NOT_INSTALLED');
}
?>

</div>