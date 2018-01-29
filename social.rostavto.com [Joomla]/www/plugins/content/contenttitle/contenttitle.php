<?php
/**
 * @package		Joomla.Site
 * @subpackage	plg_contenttitle
 * @autor		Usov Dima (usovdm@gmail.com, http://myext.eu)
 * @copyright	Copyright (C) 2005 - 2012, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgContentContenttitle extends JPlugin
{
	function plgContentContenttitle(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	function onContentBeforeSave($context, &$article, $isNew){
		$form_names = array('com_content.article','com_categories.category');
		if(in_array($context,$form_names)){
			$metadata = json_decode($article->metadata);
			$metadata->browser_title = $_REQUEST['jform']['browser_title'];
			$metadata = json_encode($metadata);
			$article->metadata = $metadata;
		}
	}
	
	public function onContentPrepareForm($form, $data)
	{
		$form_names = array('com_content.article','com_categories.categorycom_content');
		if(in_array($form->getName(),$form_names)){
			$browser_title = isset($data->metadata['browser_title']) ? $data->metadata['browser_title'] : '';
			$js = "
				window.addEvent('domready', function() {
					var jform_title = $('jform_title').getParent();
					var browser_title_li = new Element('li', {}).inject(jform_title, 'after');
					new Element('label', {id: 'browser_title-lbl',for:'jform[browser_title]',type:'text',class:'inputbox',html:'Title tag'}).inject(browser_title_li);
					new Element('input', {id: 'browser_title',name:'jform[browser_title]',type:'text',class:'inputbox',value:'".$browser_title."',size:55}).inject(browser_title_li);
				});
			";
			$doc = JFactory::getDocument();
			$doc->addScriptDeclaration($js);
		}
	}
}

?>