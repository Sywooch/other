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
<ul class="newsflash-vert<?php echo $params->get('moduleclass_sfx'); ?>">
<?php for ($i = 0, $n = count($list); $i < $n; $i ++) :
	$element = $list[$i]; ?>
	<li class="newsflash-element">
	<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_element');
	if ($n > 1 && (($i < $n - 1) || $params->get('showLastSeparator'))) : ?>
		<span class="article-separator">&#160;</span>
	<?php endif; ?>
	</li>
<?php endfor; ?>
</ul>
