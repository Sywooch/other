<?php
/**
 * @version		1.0
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Article Date plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	Content.articledate
 */
class plgContentGuestContent extends JPlugin
{
	/**
	 * Constructor
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}
	function onContentPrepare($context, &$article, &$params, $page = 0)
	{
       	if (strpos($article->text, 'gcontent') === false && strpos($article->text, 'gcontent') === false) {
			return true;
		}
  		$regex = "#{gcontent}(.*?){/gcontent}#s";
		$plugin =&JPluginHelper::getPlugin('content', 'GuestContent');
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);
		$html 	= '';
		$user =& JFactory::getUser();
		if ($user->id) {
			$article->text = preg_replace('#{/gcontent}#s', '', (preg_replace('#{gcontent}#s', '', $article->text)));
		} else {
			$plugin =& JPluginHelper::getPlugin('content', 'guest_content');
        	$guest_only = $this->params->get( 'guest_text', '' );
			$html = '<div class="guest_only">'.$guest_only.'</div>';
			$article->text = preg_replace( $regex, $html, $article->text );
		}
		return true;
	}
}

