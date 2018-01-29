<?php
/**
 * @package     retina.Platform
 * @subpackage  HTML
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Utility class to fire onContentPrepare for non-article based content.
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlContent
{
	/**
	 * Fire onContentPrepare for content that isn't part of an article.
	 *
	 * @param   string  $text     The content to be transformed.
	 * @param   array   $params   The content params.
	 * @param   string  $context  The context of the content to be transformed.
	 *
	 * @return  string   The content after transformation.
	 *
	 * @since   11.1
	 */
	public static function prepare($text, $params = null, $context = 'text')
	{
		if ($params === null)
		{
			$params = new JObject;
		}
		$article = new stdClass;
		$article->text = $text;
		JPluginHelper::importPlugin('content');
		$dispatcher = JDispatcher::getInstance();
		$dispatcher->trigger('onContentPrepare', array($context, &$article, &$params, 0));

		return $article->text;
	}
}
