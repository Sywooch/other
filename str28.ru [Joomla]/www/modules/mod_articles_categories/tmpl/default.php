<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_categories
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>
<ul class="categories-module<?php echo $moduleclass_sfx; ?>">
<?php
require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default').'_elements');
?></ul>
