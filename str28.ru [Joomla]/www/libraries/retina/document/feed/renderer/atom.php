<?php
/**
 * @package     retina.Platform
 * @subpackage  Document
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * JDocumentRenderer_Atom is a feed that implements the atom specification
 *
 * Please note that just by using this class you won't automatically
 * produce valid atom files. For example, you have to specify either an editor
 * for the feed or an author for every single feed element.
 *
 * @package     retina.Platform
 * @subpackage  Document
 * @see         http://www.atomenabled.org/developers/syndication/atom-format-spec.php
 * @since       11.1
 */
class JDocumentRendererAtom extends JDocumentRenderer
{
	/**
	 * Document mime type
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $_mime = "application/atom+xml";

	/**
	 * Render the feed.
	 *
	 * @param   string  $name     The name of the element to render
	 * @param   array   $params   Array of values
	 * @param   string  $content  Override the output of the renderer
	 *
	 * @return  string  The output of the script
	 *
	 * @see JDocumentRenderer::render()
	 * @since   11.1
	 */
	public function render($name = '', $params = null, $content = null)
	{
		$app = JFactory::getApplication();

		// Gets and sets timezone offset from site configuration
		$tz = new DateTimeZone($app->getCfg('offset'));
		$now = JFactory::getDate();
		$now->setTimeZone($tz);

		$data = &$this->_doc;

		$uri = JFactory::getURI();
		$url = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
		$syndicationURL = JRoute::_('&format=feed&type=atom');

		if ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $data->title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = RText::sprintf('JPAGETITLE', $data->title, $app->getCfg('sitename'));
		}
		else
		{
			$title = $data->title;
		}

		$feed_title = htmlspecialchars($title, ENT_COMPAT, 'UTF-8');

		$feed = "<feed xmlns=\"http://www.w3.org/2005/Atom\" ";
		if ($data->language != "")
		{
			$feed .= " xml:lang=\"" . $data->language . "\"";
		}
		$feed .= ">\n";
		$feed .= "	<title type=\"text\">" . $feed_title . "</title>\n";
		$feed .= "	<subtitle type=\"text\">" . htmlspecialchars($data->description, ENT_COMPAT, 'UTF-8') . "</subtitle>\n";
		if (empty($data->category) === false)
		{
			if (is_array($data->category))
			{
				foreach ($data->category as $cat)
				{
					$feed .= "	<category term=\"" . htmlspecialchars($cat, ENT_COMPAT, 'UTF-8') . "\" />\n";
				}
			}
			else
			{
				$feed .= "	<category term=\"" . htmlspecialchars($data->category, ENT_COMPAT, 'UTF-8') . "\" />\n";
			}
		}
		$feed .= "	<link rel=\"alternate\" type=\"text/html\" href=\"" . $url . "\"/>\n";
		$feed .= "	<id>" . str_replace(' ', '%20', $data->getBase()) . "</id>\n";
		$feed .= "	<updated>" . htmlspecialchars($now->toISO8601(true), ENT_COMPAT, 'UTF-8') . "</updated>\n";
		if ($data->editor != "")
		{
			$feed .= "	<author>\n";
			$feed .= "		<name>" . $data->editor . "</name>\n";
			if ($data->editorEmail != "")
			{
				$feed .= "		<email>" . htmlspecialchars($data->editorEmail, ENT_COMPAT, 'UTF-8') . "</email>\n";
			}
			$feed .= "	</author>\n";
		}
		$feed .= "	<generator uri=\"http://retina.org\" version=\"2.5\">" . $data->getGenerator() . "</generator>\n";
		$feed .= '	<link rel="self" type="application/atom+xml" href="' . str_replace(' ', '%20', $url . $syndicationURL) . "\"/>\n";

		for ($i = 0, $count = count($data->elements); $i < $count; $i++)
		{
			$feed .= "	<entry>\n";
			$feed .= "		<title>" . htmlspecialchars(strip_tags($data->elements[$i]->title), ENT_COMPAT, 'UTF-8') . "</title>\n";
			$feed .= '		<link rel="alternate" type="text/html" href="' . $url . $data->elements[$i]->link . "\"/>\n";

			if ($data->elements[$i]->date == "")
			{
				$data->elements[$i]->date = $now->toUnix();
			}
			$elementDate = JFactory::getDate($data->elements[$i]->date);
			$elementDate->setTimeZone($tz);
			$feed .= "		<published>" . htmlspecialchars($elementDate->toISO8601(true), ENT_COMPAT, 'UTF-8') . "</published>\n";
			$feed .= "		<updated>" . htmlspecialchars($elementDate->toISO8601(true), ENT_COMPAT, 'UTF-8') . "</updated>\n";
			if (empty($data->elements[$i]->guid) === true)
			{
				$feed .= "		<id>" . str_replace(' ', '%20', $url . $data->elements[$i]->link) . "</id>\n";
			}
			else
			{
				$feed .= "		<id>" . htmlspecialchars($data->elements[$i]->guid, ENT_COMPAT, 'UTF-8') . "</id>\n";
			}

			if ($data->elements[$i]->author != "")
			{
				$feed .= "		<author>\n";
				$feed .= "			<name>" . htmlspecialchars($data->elements[$i]->author, ENT_COMPAT, 'UTF-8') . "</name>\n";
				if ($data->elements[$i]->authorEmail != "")
				{
					$feed .= "			<email>" . htmlspecialchars($data->elements[$i]->authorEmail, ENT_COMPAT, 'UTF-8') . "</email>\n";
				}
				$feed .= "		</author>\n";
			}
			if ($data->elements[$i]->description != "")
			{
				$feed .= "		<summary type=\"html\">" . htmlspecialchars($data->elements[$i]->description, ENT_COMPAT, 'UTF-8') . "</summary>\n";
				$feed .= "		<content type=\"html\">" . htmlspecialchars($data->elements[$i]->description, ENT_COMPAT, 'UTF-8') . "</content>\n";
			}
			if (empty($data->elements[$i]->category) === false)
			{
				if (is_array($data->elements[$i]->category))
				{
					foreach ($data->elements[$i]->category as $cat)
					{
						$feed .= "		<category term=\"" . htmlspecialchars($cat, ENT_COMPAT, 'UTF-8') . "\" />\n";
					}
				}
				else
				{
					$feed .= "		<category term=\"" . htmlspecialchars($data->elements[$i]->category, ENT_COMPAT, 'UTF-8') . "\" />\n";
				}
			}
			if ($data->elements[$i]->enclosure != null)
			{
				$feed .= "		<link rel=\"enclosure\" href=\"" . $data->elements[$i]->enclosure->url . "\" type=\""
					. $data->elements[$i]->enclosure->type . "\"  length=\"" . $data->elements[$i]->enclosure->length . "\" />\n";
			}
			$feed .= "	</entry>\n";
		}
		$feed .= "</feed>\n";
		return $feed;
	}
}
