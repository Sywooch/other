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
jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldModal_Categories extends JFormField
{
	protected $type = 'Modal_Categories';

	protected function getInput()
	{
		$mainframe	= JFactory::getApplication();
		$doc 		= JFactory::getDocument();

		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'constants.php' );

		$options 		= array();
  		$attr 	 		= '';
  		$categoryList	= array();

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';

		// To avoid user's confusion, readonly="true" should imply disabled="true".
		if ( (string) $this->element['readonly'] == 'true' || (string) $this->element['disabled'] == 'true') {
			$attr .= ' disabled="disabled"';
		}

		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';

// 		$db = JFactory::getDBO();
// 		$query = 'SELECT c.id, c.title' .
// 			' FROM #__categories AS c' .
// 			' WHERE c.published = 1' .
// 			' AND c.extention = '.$db->Quote('com_content').
// 			' ORDER BY c.title';
//
// 		$db->setQuery($query);
//
// 		echo $query;exit;
//
// 		$categories = $db->loadObjectList();

		$categories = JHtml::_('category.options', 'com_content');

		if(count($categories) > 0)
		{
			$optgroup = JHTML::_('select.optgroup','Select category','id','title');
	 		array_push($categoryList,$optgroup);

			foreach ($categories as $row) {
			    $opt    = new stdClass();
			    $opt->id    = $row->value;
			    $opt->title = $row->text;
				array_push($categoryList,$opt);
			}
		}

		$html = JHTML::_('select.genericlist',  $categoryList, $this->name, trim($attr), 'id', 'title', $this->value );
		return $html;
	}

	function fetchElement_old($name, $value, &$node, $control_name)
	{
		$db = EasyBlogHelper::db();

		$section	= $node->attributes('section');
		$class		= $node->attributes('class');
		if (!$class) {
			$class = "inputbox";
		}

		if (!isset ($section)) {
			// alias for section
			$section = $node->attributes('scope');
			if (!isset ($section)) {
				$section = 'content';
			}
		}

		if ($section == 'content') {
			// This might get a conflict with the dynamic translation - TODO: search for better solution
			$query = 'SELECT c.id, CONCAT_WS( "/",s.title, c.title ) AS title' .
				' FROM #__categories AS c' .
				' LEFT JOIN #__sections AS s ON s.id=c.section' .
				' WHERE c.published = 1' .
				' AND s.scope = '.$db->Quote($section).
				' ORDER BY s.title, c.title';
		} else {
			$query = 'SELECT c.id, c.title' .
				' FROM #__categories AS c' .
				' WHERE c.published = 1' .
				' AND c.section = '.$db->Quote($section).
				' ORDER BY c.title';
		}
		$db->setQuery($query);
		$options = $db->loadObjectList();
		array_unshift($options, JHTML::_('select.option', '0', '- '.JText::_('Select Category').' -', 'id', 'title'));

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="'.$class.'"', 'id', 'title', $value, $control_name.$name );
	}
}
