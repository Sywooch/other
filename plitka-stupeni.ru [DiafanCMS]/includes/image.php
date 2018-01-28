<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Image
 * Набор функций для работы с изображениями
 */
class Image
{
	/**
	 * Изменяет размеры изображения
	 * @param string $src_image путь к файлу
	 * @param integer $dest_width новая ширина изображения
	 * @param integer $dest_height новая высота изображения
	 * @param integer $quality качество изображения
	 * @param  boolean $max изменять по максимальной стороне
	 */
	public static function resize($src_image, $dest_width, $dest_height, $quality = 80, $max = false)
	{ 
		if (! $quality)
		{
			$quality = 80;
		}
		if (! $src_image) 
			return false;
	
		$dest_image = $src_image;
	
		$info = getImageSize($src_image); 
		switch ($info[2])
		{ 
			case 1: 
				$src_img = imageCreateFromGIF($src_image); 
				break; 
			case 2: 
				$src_img = imageCreateFromJPEG($src_image); 
				break; 
			case 3: 
				$src_img = imageCreateFromPNG($src_image); 
				break; 
			default: 
				return false; 
		}

		$src_width = imageSX ($src_img); 
		$src_height = imageSY ($src_img); 
		
		if($dest_width > $src_width && $dest_height > $src_height)
			return false;

		$mc1 = $dest_width / $src_width; 
		$mc2 = $dest_height / $src_height;

		if ($max)
		{
			$k = max($mc1, $mc2);
		}
		else
		{
			$k = min($mc1, $mc2);
		}

		$dest_width = round($src_width * $k); 
		$dest_height = round($src_height * $k);
		if($max && ($dest_width > $src_width || $dest_height > $src_height))
		{
			$k = min($mc1, $mc2);
			$dest_width = round($src_width * $k); 
			$dest_height = round($src_height * $k);
		}
		$dst_img = imageCreateTrueColor($dest_width, $dest_height); 
		
		//png
		imagecolortransparent($dst_img , imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
		imagealphablending($dst_img , false);
		imagesavealpha($dst_img , true);
		
		imageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);

		switch($info[2])
		{ 
			case 1: 
				imageGIF($dst_img, $dest_image);
				break; 
			case 2: 
				imageJPEG($dst_img, $dest_image, $quality); 
				break; 
			case 3:
				imagePNG($dst_img, $dest_image);
				break; 
			default: 
				return false; 
		}
		imageDestroy($src_img); 
		imageDestroy($dst_img);

		return true; 
	}

	/**
	 * Обрезает изображение
	 * @param string $original путь к файлу
	 * @param integer $width новая ширина изображения
	 * @param integer $height новая высота изображения
	 * @param integer $quality качество изображения
	 * @param string $vertical вертикальное расположение знака (top, middle, bottom)
	 * @param integer $sy отступ по вертикале
	 * @param string $horizontal горизонтальное расположение знака (left, center, right)
	 * @param integer $sx отступ по горизонтале
	 * @return boolean
	 */
	public static function crop($original, $width, $height, $quality, $vertical, $sy, $horizontal, $sx)
	{
		$original_url =  $original;
		$original = urldecode($original);
		$info   = @getImageSize($original); 

		if (! $info)
			return false;

		switch(trim($vertical))
		{ 
			case 'bottom': 
				$y = $info[1] - $height - (int)$sy;
				break; 
			case 'middle': 
				$y = ceil($info[1]/2) - ceil($height/2) + (int)$sy;
				break; 
			default: 
				$y = (int)$sy;
				break; 
		} 
		switch (trim($horizontal))
		{ 
			case 'right': 
				$x = $info[0] - $width - (int)$sx; 
				break; 
			case 'center': 
				$x = ceil($info[0]/2) - ceil($width/2) + (int)$sx; 
				break; 
			default: 
				$x = (int)$sx; 
				break; 
		} 
		$out       = imageCreateTrueColor($width, $height); 

		//png
		if($info[2] == 3)
		{
			imagefill($out, 0, 0, imagecolorallocatealpha ($out, 0, 0, 0, 127));
			$original = imagecreatefrompng($original);
			imagesavealpha($out, true);
		}
		else
		{
			$original = @imageCreateFromString(file_get_contents($original));
			imagealphablending($out , false);
			imagesavealpha($out , true);
		}

		imageCopy($out, $original, 0, 0, $x, $y, $width, $height);

		switch ($info[2])
		{ 
			case 1: 
				imageGIF($out, $original_url); 
				break;

			case 2: 
				imageJPEG($out, $original_url, $quality); 
				break;

			case 3: 
				imagePNG($out, $original_url); 
				break; 
		}

		imageDestroy($out); 
		imageDestroy($original);
		return true;
	}

	/**
	 * Добавляет водяной знак на изображение
	 * @param string $original путь к файлу
	 * @param string $watermark путь к водяному знаку
	 * @param integer $quality качество изображения
	 * @param string $vertical вертикальное расположение знака (top, middle, bottom)
	 * @param integer $sy отступ по вертикале
	 * @param string $horizontal горизонтальное расположение знака (left, center, right)
	 * @param integer $sx отступ по горизонтале
	 * @return boolean
	 */
	public static function watermark($original, $watermark, $quality, $vertical, $sy, $horizontal, $sx)
	{
		$original_url =  $original;
		$original = urldecode($original);
		$info_o   = @getImageSize($original); 

		if (! $info_o) 
			return false;

		$info_w = @getImageSize($watermark); 
		if (! $info_w) 
			return false;

		switch(trim($vertical))
		{ 
			case 'bottom': 
				$y = $info_o[1] - $info_w[1] - (int)$sy; 
				break; 
			case 'middle': 
				$y = ceil($info_o[1]/2) - ceil($info_w[1]/2) + (int)$sy; 
				break; 
			default: 
				$y = (int)$sy; 
				break; 
		} 
		switch (trim($horizontal))
		{ 
			case 'right': 
				$x = $info_o[0] - $info_w[0] - (int)$sx; 
				break; 
			case 'center': 
				$x = ceil($info_o[0]/2) - ceil($info_w[0]/2) + (int)$sx; 
				break; 
			default: 
				$x = (int)$sx; 
				break; 
		} 

		$original  = @imageCreateFromString(file_get_contents($original));
		
		$out       = imageCreateTrueColor($info_o[0],$info_o[1]); 
		
		//png
		if($info_w[2] == 3)
		{
			imagefill($out, 0, 0, imagecolorallocatealpha ($out, 0, 0, 0, 127));
			$watermark = imagecreatefrompng($watermark);
			imagesavealpha($out, true);
		}
		else
		{
			$watermark = @imageCreateFromString(file_get_contents($watermark));
			imagecolortransparent($out , imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
			imagealphablending($out , false);
			imagesavealpha($out , true);
		}

		imageCopy($out, $original, 0, 0, 0, 0, $info_o[0], $info_o[1]); 

		if ($info_o[0] > 10 && $info_o[1] > 10)
		{
			imageCopy($out, $watermark, $x, $y, 0, 0, $info_w[0], $info_w[1]);
		} 
		switch ($info_o[2])
		{ 
			case 1: 
				imageGIF($out, $original_url); 
				break; 
			case 2: 
				imageJPEG($out, $original_url, $quality); 
				break; 
			case 3: 
				imagePNG($out, $original_url); 
				break; 
		}

		imageDestroy($out); 
		imageDestroy($original); 
		imageDestroy($watermark);
		return true;
	}

	/**
	 * Обесцвечивает изображение
	 * @param string $original путь к файлу
	 * @param integer $quality качество изображения
	 * @return boolean
	 */
	public static function wb($original, $quality)
	{
		$original_url =  $original;
		$original = urldecode($original);
		$info   = @getImageSize($original); 

		if (! $info)
			return false;

		switch ($info[2])
		{ 
			case 1:
				$out = imagecreatefromGIF($original);
				imagefilter($out, IMG_FILTER_GRAYSCALE);
				imageGIF($out, $original_url);
				break;

			case 2: 
				$out = imagecreatefromJPEG($original);
				imagefilter($out, IMG_FILTER_GRAYSCALE);
				imageJPEG($out, $original_url, $quality); 
				break;

			case 3: 
				$out = imagecreatefromPNG($original);
				imagefilter($out, IMG_FILTER_GRAYSCALE);
				imagePNG($out, $original_url); 
				break; 
		}
		imageDestroy($out);
		return true;
	}
}