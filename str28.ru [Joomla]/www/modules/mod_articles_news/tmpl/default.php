<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_news
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<div class="newsflash<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $element) :?>

	<?php
	 require JModuleHelper::getLayoutPath('mod_articles_news', '_element');?>

<?php endforeach; ?>
</div>
