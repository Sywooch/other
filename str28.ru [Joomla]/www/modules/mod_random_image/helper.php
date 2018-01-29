<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_random_image
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modRandomImageHelper
{
	static function getRandomImage(&$params, $images)
	{
		$width	= $params->get('width');
		$height	= $params->get('height');

		$i			= count($images);
		$random		= mt_rand(0, $i - 1);
		$image		= $images[$random];
		$size		= getimagesize (RPATH_BASE . '/' . $image->folder . '/' . $image->name);


		if ($width == '') {
			$width = 100;
		}

		if ($size[0] < $width) {
			$width = $size[0];
		}

		$coeff = $size[0]/$size[1];
		if ($height == '') {
			$height = (int) ($width/$coeff);
		} else {
			$newheight = min ($height, (int) ($width/$coeff));
			if ($newheight < $height) {
				$height = $newheight;
			} else {
				$width = $height * $coeff;
			}
		}

		$image->width	= $width;
		$image->height	= $height;
		$image->folder	= str_replace('\\', '/', $image->folder);

		return $image;
	}

	static function getImages(&$params, $folder)
	{
		$type		= $params->get('type', 'jpg');

		$files	= array();
		$images	= array();

		$dir = RPATH_BASE . '/' . $folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html') {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $img)
			{
				if (!is_dir($dir . '/' . $img))
				{
					if (preg_match('/'.$type.'/', $img)) {
						$images[$i] = new stdClass;

						$images[$i]->name	= $img;
						$images[$i]->folder	= $folder;
						$i++;
					}
				}
			}
		}

		return $images;
	}

	static function getFolder(&$params)
	{
		$folder	= $params->get('folder');

		$LiveSite	= JURI::base();

		// if folder includes livesite info, remove
		if (JString::strpos($folder, $LiveSite) === 0) {
			$folder = str_replace($LiveSite, '', $folder);
		}
		// if folder includes absolute path, remove
		if (JString::strpos($folder, RPATH_SITE) === 0) {
			$folder= str_replace(RPATH_BASE, '', $folder);
		}
		$folder = str_replace('\\', DS, $folder);
		$folder = str_replace('/', DS, $folder);

		return $folder;
	}
}
