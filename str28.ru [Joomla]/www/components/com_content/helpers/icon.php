<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * Content Component HTML Helper
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_content
 * @since 1.5
 */
class JHtmlIcon
{
	static function create($category, $params)
	{
		$uri = JFactory::getURI();

		$url = 'index.php?option=com_content&task=article.add&return='.base64_encode($uri).'&a_id=0&catid=' . $category->id;

		if ($params->get('show_icons')) {
			$text = JHtml::_('image', 'main/new.png', RText::_('JNEW'), NULL, true);
		} else {
			$text = RText::_('JNEW').'&#160;';
		}

		$button =  JHtml::_('link', JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.RText::_('COM_CONTENT_CREATE_ARTICLE').'">'.$button.'</span>';
		return $output;
	}

	static function email($article, $params, $attribs = array())
	{
		require_once RPATH_SITE . '/components/com_mailto/helpers/mailto.php';
		$uri	= JURI::getInstance();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$template = JFactory::getApplication()->getTemplate();
		$link	= $base.JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid) , false);
		$url	= 'index.php?option=com_mailto&tmpl=component&template='.$template.'&link='.MailToHelper::addLink($link);

		$status = 'width=400,height=350,menubar=yes,resizable=yes';

		if ($params->get('show_icons')) {
			$text = JHtml::_('image', 'main/emailButton.png', RText::_('RGLOBAL_EMAIL'), NULL, true);
		} else {
			$text = '&#160;'.RText::_('RGLOBAL_EMAIL');
		}

		$attribs['title']	= RText::_('RGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";

		$output = JHtml::_('link', JRoute::_($url), $text, $attribs);
		return $output;
	}

	/**
	 * Display an edit icon for the article.
	 *
	 * This icon will not display in a popup window, nor if the article is trashed.
	 * Edit access checks must be performed in the calling code.
	 *
	 * @param	object	$article	The article in question.
	 * @param	object	$params		The article parameters
	 * @param	array	$attribs	Not used??
	 *
	 * @return	string	The HTML for the article edit icon.
	 * @since	1.6
	 */
	static function edit($article, $params, $attribs = array())
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$uri	= JFactory::getURI();

		// Ignore if in a popup window.
		if ($params && $params->get('popup')) {
			return;
		}

		// Ignore if the state is negative (trashed).
		if ($article->state < 0) {
			return;
		}

		JHtml::_('behavior.tooltip');

		// Show checked_out icon if the article is checked out by a different user
		if (property_exists($article, 'checked_out') && property_exists($article, 'checked_out_time') && $article->checked_out > 0 && $article->checked_out != $user->get('id')) {
			$checkoutUser = JFactory::getUser($article->checked_out);
			$button = JHtml::_('image', 'main/checked_out.png', NULL, NULL, true);
			$date = JHtml::_('date', $article->checked_out_time);
			$tooltip = RText::_('RLIB_HTML_CHECKED_OUT').' :: '.RText::sprintf('COM_CONTENT_CHECKED_OUT_BY', $checkoutUser->name).' <br /> '.$date;
			return '<span class="hasTip" title="'.htmlspecialchars($tooltip, ENT_COMPAT, 'UTF-8').'">'.$button.'</span>';
		}

		$url	= 'index.php?option=com_content&task=article.edit&a_id='.$article->id.'&return='.base64_encode($uri);
		$icon	= $article->state ? 'edit.png' : 'edit_unpublished.png';
		$text	= JHtml::_('image', 'main/'.$icon, RText::_('RGLOBAL_EDIT'), NULL, true);

		if ($article->state == 0) {
			$overlib = RText::_('JUNPUBLISHED');
		}
		else {
			$overlib = RText::_('JPUBLISHED');
		}

		$date = JHtml::_('date', $article->created);
		$author = $article->created_by_alias ? $article->created_by_alias : $article->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= RText::sprintf('COM_CONTENT_WRITTEN_BY', htmlspecialchars($author, ENT_COMPAT, 'UTF-8'));

		$button = JHtml::_('link', JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.RText::_('COM_CONTENT_EDIT_element').' :: '.$overlib.'">'.$button.'</span>';

		return $output;
	}


	static function print_popup($article, $params, $attribs = array())
	{
		$url  = ContentHelperRoute::getArticleRoute($article->slug, $article->catid);
		$url .= '&tmpl=component&print=1&layout=default&page='.@ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHtml::_('image', 'main/printButton.png', RText::_('RGLOBAL_PRINT'), NULL, true);
		} else {
			$text = RText::_('RGLOBAL_ICON_SEP') .'&#160;'. RText::_('RGLOBAL_PRINT') .'&#160;'. RText::_('RGLOBAL_ICON_SEP');
		}

		$attribs['title']	= RText::_('RGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}

	static function print_screen($article, $params, $attribs = array())
	{
		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHtml::_('image', 'main/printButton.png', RText::_('RGLOBAL_PRINT'), NULL, true);
		} else {
			$text = RText::_('RGLOBAL_ICON_SEP') .'&#160;'. RText::_('RGLOBAL_PRINT') .'&#160;'. RText::_('RGLOBAL_ICON_SEP');
		}
		return '<a href="#" onclick="window.print();return false;">'.$text.'</a>';
	}

}
