<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_categories
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
foreach ($list as $element) :

?>
	<li <?php if ($_SERVER['PHP_SELF'] == JRoute::_(ContentHelperRoute::getCategoryRoute($element->id))) echo ' class="active"';?>> <?php $levelup=$element->level-$startLevel -1; ?>
  <h<?php echo $params->get('element_heading')+ $levelup; ?>>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($element->id)); ?>">
		<?php echo $element->title;?></a>
   </h<?php echo $params->get('element_heading')+ $levelup; ?>>

		<?php
		if($params->get('show_description', 0))
		{
			echo JHtml::_('content.prepare', $element->description, $element->getParams(), 'mod_articles_categories.content');
		}
		if($params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0) || ($params->get('maxlevel') >= ($element->level - $startLevel))) && count($element->getChildren()))
		{

			echo '<ul>';
			$temp = $list;
			$list = $element->getChildren();
			require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default').'_elements');
			$list = $temp;
			echo '</ul>';
		}
		?>
 </li>
<?php endforeach; ?>
