<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access');

class JElementSections extends JElement
{
	var	$_name = 'Sections';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$mainframe	= JFactory::getApplication();
		$db			= EasyBlogHelper::db();
		$doc 		= JFactory::getDocument();

		$query = 'SELECT s.`id`, s.`title` FROM `#__sections` AS s';
		$query .= ' ORDER BY s.ordering';

		$db->setQuery($query);

		$sections   = $db->loadObjectList();

		ob_start();
		?>
		<select name="<?php echo $control_name;?>[<?php echo $name;?>]">
			<option value="0"<?php echo $value == 0 ? ' selected="selected"' :'';?>><?php echo JText::_('Select a section');?></option>
		<?php
		foreach($sections as $section)
		{
			$selected	= $section->id == $value ? ' selected="selected"' : '';
		?>
			<option value="<?php echo $section->id;?>"<?php echo $selected;?>><?php echo $section->title;?></option>
		<?php
		}
		?>
		</select>
		<?php
		$html	= ob_get_contents();
		ob_end_clean();
		return $html;
	}
}
