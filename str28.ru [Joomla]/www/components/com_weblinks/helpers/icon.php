<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
jimport('retina.application.component.helper');
/**
 * Weblink Component HTML Helper
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since 1.5
 */
class JHtmlIcon
{
	static function create($weblink, $params)
	{
		$uri = JFactory::getURI();

		$url = JRoute::_(WeblinksHelperRoute::getFormRoute(0, base64_encode($uri)));
		$text = JHtml::_('image', 'main/new.png', RText::_('JNEW'), NULL, true);
		$button = JHtml::_('link', $url, $text);
		$output = '<span class="hasTip" title="'.RText::_('COM_WEBLINKS_FORM_CREATE_WEBLINK').'">'.$button.'</span>';
		return $output;
	}

	static function edit($weblink, $params, $attribs = array())
	{
		$user = JFactory::getUser();
		$uri = JFactory::getURI();

		if ($params && $params->get('popup')) {
			return;
		}

		if ($weblink->state < 0) {
			return;
		}

		JHtml::_('behavior.tooltip');
		$url	= WeblinksHelperRoute::getFormRoute($weblink->id, base64_encode($uri));
		$icon	= $weblink->state ? 'edit.png' : 'edit_unpublished.png';
		$text	= JHtml::_('image', 'main/'.$icon, RText::_('RGLOBAL_EDIT'), NULL, true);

		if ($weblink->state == 0) {
			$overlib = RText::_('JUNPUBLISHED');
		}
		else {
			$overlib = RText::_('JPUBLISHED');
		}

		$date = JHtml::_('date', $weblink->created);
		$author = $weblink->created_by_alias ? $weblink->created_by_alias : $weblink->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= htmlspecialchars($author, ENT_COMPAT, 'UTF-8');

		$button = JHtml::_('link', JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.RText::_('COM_WEBLINKS_EDIT').' :: '.$overlib.'">'.$button.'</span>';

		return $output;
	}
}
