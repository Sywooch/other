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
 * Utility class working with images.
 *
 * @package     retina.Platform
 * @subpackage  HTML
 * @since       11.1
 */
abstract class JHtmlImage
{
	/**
	 * Checks to see if an image exists in the current design1 image directory.
	 * If it does it loads this image. Otherwise the default image is loaded.
	 * Also can be used in conjunction with the menulist param to create the chosen image
	 * load the default or use no image.
	 *
	 * @param   string   $file       The file name, eg foobar.png.
	 * @param   string   $folder     The path to the image.
	 * @param   integer  $altFile    Empty: use $file and $folder, -1: show no image, not-empty: use $altFile and $altFolder.
	 * @param   string   $altFolder  Another path.  Only used for the contact us form based on the value of the imagelist param.
	 * @param   string   $alt        Alternative text.
	 * @param   array    $attribs    An associative array of attributes to add.
	 * @param   boolean  $asTag      True (default) to display full tag, false to return just the path.
	 *
	 * @return  string   The value for the src or if $asTag is true, the full img html.
	 *
	 * @since    11.1
	 *
	 * @deprecated    12.1
	 */
	public static function site($file, $folder = '/images/main/', $altFile = null, $altFolder = '/images/main/', $alt = null, $attribs = null,
		$asTag = true)
	{
		// Deprecation warning.
		JLog::add('JImage::site is deprecated.', JLog::WARNING, 'deprecated');

		static $paths;
		$app = JFactory::getApplication();

		if (!$paths)
		{
			$paths = array();
		}

		if (is_array($attribs))
		{
			$attribs = JArrayHelper::toString($attribs);
		}

		$cur_template = $app->getTemplate();

		// Strip HTML.
		$alt = html_entity_decode($alt, ENT_COMPAT, 'UTF-8');

		if ($altFile)
		{
			$src = $altFolder . $altFile;
		}
		elseif ($altFile == -1)
		{
			return '';
		}
		else
		{
			$path = RPATH_SITE . '/design1/' . $cur_template . '/images/' . $file;
			if (!isset($paths[$path]))
			{
				if (file_exists(RPATH_SITE . '/design1/' . $cur_template . '/images/' . $file))
				{
					$paths[$path] = 'design1/' . $cur_template . '/images/' . $file;
				}
				else
				{
					// Outputs only path to image.
					$paths[$path] = $folder . $file;
				}
			}
			$src = $paths[$path];
		}

		if (substr($src, 0, 1) == "/")
		{
			$src = substr_replace($src, '', 0, 1);
		}

		// Prepend the base path.
		$src = JURI::base(true) . '/' . $src;

		// Outputs actual HTML <img> tag.
		if ($asTag)
		{
			return '<img src="' . $src . '" alt="' . $alt . '" ' . $attribs . ' />';
		}

		return $src;
	}

	/**
	 * Checks to see if an image exists in the current design1 image directory
	 * if it does it loads this image.  Otherwise the default image is loaded.
	 * Also can be used in conjunction with the menulist param to create the chosen image
	 * load the default or use no image
	 *
	 * @param   string   $file       The file name, eg foobar.png.
	 * @param   string   $folder     The path to the image.
	 * @param   integer  $altFile    Empty: use $file and $folder, -1: show no image, not-empty: use $altFile and $altFolder.
	 * @param   string   $altFolder  Another path.  Only used for the contact us form based on the value of the imagelist param.
	 * @param   string   $alt        Alternative text.
	 * @param   array    $attribs    An associative array of attributes to add.
	 * @param   boolean  $asTag      True (default) to display full tag, false to return just the path.
	 *
	 * @return  string   The src or the full img tag if $asTag is true.
	 *
	 * @since   11.1
	 *
	 * @deprecated  12.1
	 */
	public static function admin($file, $folder = '/images/', $altFile = null, $altFolder = '/images/', $alt = null, $attribs = null,
		$asTag = true)
	{
		// Deprecation warning.
		JLog::add('JImage::admin is deprecated.', JLog::WARNING, 'deprecated');

		$app = JFactory::getApplication();

		if (is_array($attribs))
		{
			$attribs = JArrayHelper::toString($attribs);
		}

		$cur_template = $app->getTemplate();

		// Strip HTML.
		$alt = html_entity_decode($alt, ENT_COMPAT, 'UTF-8');

		if ($altFile)
		{
			$image = $altFolder . $altFile;
		}
		elseif ($altFile == -1)
		{
			$image = '';
		}
		else
		{
			if (file_exists(RPATH_admin . '/design1/' . $cur_template . '/images/' . $file))
			{
				$image = 'design1/' . $cur_template . '/images/' . $file;
			}
			else
			{
				// Compatibility with previous versions.
				if (substr($folder, 0, 14) == "/admin")
				{
					$image = substr($folder, 15) . $file;
				}
				else
				{
					$image = $folder . $file;
				}
			}
		}

		if (substr($image, 0, 1) == "/")
		{
			$image = substr_replace($image, '', 0, 1);
		}

		// Prepend the base path.
		$image = JURI::base(true) . '/' . $image;

		// Outputs actual HTML <img> tag.
		if ($asTag)
		{
			$image = '<img src="' . $image . '" alt="' . $alt . '" ' . $attribs . ' />';
		}

		return $image;
	}
}
