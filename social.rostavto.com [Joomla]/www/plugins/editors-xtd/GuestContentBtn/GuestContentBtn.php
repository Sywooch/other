<?php
/**
 * @version		$Id: readmore.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Editor Readmore buton
 *
 * @package		Joomla.Plugin
 * @subpackage	Editors-xtd.readmore
 * @since 1.5
 */
class plgButtonGuestContentBtn extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * readmore button
	 * @return array A two element array of (imageName, textToInsert)
	 */
	public function onDisplay($name)
	{
		$app = JFactory::getApplication();

		$doc		= JFactory::getDocument();
		$template	= $app->getTemplate();

		// button is not active in specific content components

		$getContent = $this->_subject->getContent($name);
		$js = "
			function insertGuestContentBtn(editor) {
				var content = $getContent
				    var jsbtntext = '{gcontent}hidetext{/gcontent}';
				    jInsertEditorText(jsbtntext, editor);
			}
			";

		$doc->addScriptDeclaration($js);

		$button = new JObject;
		$doc->addStyleSheet( '/plugins/editors-xtd/GuestContentBtn/GuestContentBtn.css', 'text/css', null, array() );
		$button->set('modal', false);
		$button->set('onclick', 'insertGuestContentBtn(\''.$name.'\');return false;');
		$button->set('text', JText::_('Hide Content'));
		$button->set('name', 'GuestContentBtn');
		$button->set('link', '#');

		return $button;
	}
}
