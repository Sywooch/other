<?php
//////////////////////////////////////////////////////////////
///  phpThumb() by James Heinrich <info@silisoftware.com>   //
//        available at http://phpthumb.sourceforge.net     ///
//////////////////////////////////////////////////////////////
///                                                         //
// See: phpthumb.readme.txt for usage instructions          //
//                                                         ///
//////////////////////////////////////////////////////////////

ob_start();
if (!include_once(dirname(__FILE__).'/phpthumb.functions.php')) {
	ob_end_flush();
	die('failed to include_once("'.realpath(dirname(__FILE__).'/phpthumb.functions.php').'")');
}
ob_end_clean();

class JUNewsUltraPHPThumb {

	// public:
	// START PARAMETERS (for object mode and phpThumb.php)
	// See phpthumb.readme.txt for descriptions of what each of these values are
	var $src  = null;     // SouRCe filename
	var $new  = null;     // NEW image (phpThumb.php only)
	var $w    = null;     // Width
	var $h    = null;     // Height
	var $wp   = null;     // Width  (Portrait Images Only)
	var $hp   = null;     // Height (Portrait Images Only)
	var $wl   = null;     // Width  (Landscape Images Only)
	var $hl   = null;     // Height (Landscape Images Only)
	var $ws   = null;     // Width  (Square Images Only)
	var $hs   = null;     // Height (Square Images Only)
	var $f    = null;     // output image Format
	var $q    = 75;       // jpeg output Quality
	var $sx   = null;     // Source crop top-left X position
	var $sy   = null;     // Source crop top-left Y position
	var $sw   = null;     // Source crop Width
	var $sh   = null;     // Source crop Height
	var $zc   = null;     // Zoom Crop
	var $bc   = null;     // Border Color
	var $bg   = null;     // BackGround color
	var $fltr = array();  // FiLTeRs
	var $goto = null;     // GO TO url after processing
	var $err  = null;     // default ERRor image filename
	var $xto  = null;     // extract eXif Thumbnail Only
	var $ra   = null;     // Rotate by Angle
	var $ar   = null;     // Auto Rotate
	var $aoe  = null;     // Allow Output Enlargement
	var $far  = null;     // Fixed Aspect Ratio
	var $iar  = null;     // Ignore Aspect Ratio
	var $maxb = null;     // MAXimum Bytes
	var $down = null;     // DOWNload thumbnail filename
	var $md5s = null;     // MD5 hash of Source image
	var $sfn  = 0;        // Source Frame Number
	var $dpi  = 150;      // Dots Per Inch for vector source formats
	var $sia  = null;     // Save Image As filename

	var $file = null;     // >>>deprecated, DO NOT USE, will be removed in future versions<<<

	var $phpThumbDebug = null;
	// END PARAMETERS


	// public:
	// START CONFIGURATION OPTIONS (for object mode only)
	// See phpThumb.config.php for descriptions of what each of these settings do

	// * Directory Configuration
	var $config_cache_directory                      = null;
	var $config_cache_directory_depth                = 0;
	var $config_cache_disable_warning                = true;
	var $config_cache_source_enabled                 = false;
	var $config_cache_source_directory               = null;
	var $config_temp_directory                       = null;
	var $config_document_root                        = null;

	// * Default output configuration:
	var $config_output_format                        = 'jpeg';
	var $config_output_maxwidth                      = 0;
	var $config_output_maxheight                     = 0;
	var $config_output_interlace                     = true;

	// * Error message configuration
	var $config_error_image_width                    = 400;
	var $config_error_image_height                   = 100;
	var $config_error_message_image_default          = '';
	var $config_error_bgcolor                        = 'CCCCFF';
	var $config_error_textcolor                      = 'FF0000';
	var $config_error_fontsize                       = 1;
	var $config_error_die_on_error                   = false;
	var $config_error_silent_die_on_error            = false;
	var $config_error_die_on_source_failure          = true;

	// * Anti-Hotlink Configuration:
	var $config_nohotlink_enabled                    = true;
	var $config_nohotlink_valid_domains              = array();
	var $config_nohotlink_erase_image                = true;
	var $config_nohotlink_text_message               = 'Off-server thumbnailing is not allowed';
	// * Off-server Linking Configuration:
	var $config_nooffsitelink_enabled                = false;
	var $config_nooffsitelink_valid_domains          = array();
	var $config_nooffsitelink_require_refer          = false;
	var $config_nooffsitelink_erase_image            = true;
	var $config_nooffsitelink_watermark_src          = '';
	var $config_nooffsitelink_text_message           = 'Off-server linking is not allowed';

	// * Border & Background default colors
	var $config_border_hexcolor                      = '000000';
	var $config_background_hexcolor                  = 'FFFFFF';

	// * TrueType Fonts
	var $config_ttf_directory                        = './fonts';

	var $config_max_source_pixels                    = null;
	var $config_use_exif_thumbnail_for_speed         = false;
	var $allow_local_http_src                        = false;

	var $config_imagemagick_path                     = null;
	var $config_prefer_imagemagick                   = true;
	var $config_imagemagick_use_thumbnail            = true;

	var $config_cache_maxage                         = null;
	var $config_cache_maxsize                        = null;
	var $config_cache_maxfiles                       = null;
	var $config_cache_source_filemtime_ignore_local  = false;
	var $config_cache_source_filemtime_ignore_remote = true;
	var $config_cache_default_only_suffix            = false;
	var $config_cache_force_passthru                 = true;
	var $config_cache_prefix                         = '';    // default value set in the constructor below

	// * MySQL
	var $config_mysql_query                          = null;
	var $config_mysql_hostname                       = null;
	var $config_mysql_username                       = null;
	var $config_mysql_password                       = null;
	var $config_mysql_database                       = null;

	// * Security
	var $config_high_security_enabled                = false;
	var $config_high_security_password               = null;
	var $config_disable_debug                        = true;
	var $config_allow_src_above_docroot              = false;
	var $config_allow_src_above_phpthumb             = true;

	// * HTTP fopen
	var $config_http_fopen_timeout                   = 10;
	var $config_http_follow_redirect                 = true;

	// * Compatability
	var $config_disable_pathinfo_parsing             = false;
	var $config_disable_imagecopyresampled           = false;
	var $config_disable_onlycreateable_passthru      = false;

	var $config_http_user_agent                      = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7';

	// END CONFIGURATION OPTIONS


	// public: error messages (read-only; persistant)
	var $debugmessages = array();
	var $debugtiming   = array();
	var $fatalerror    = null;


	// private: (should not be modified directly)
	var $thumbnailQuality = 75;
	var $thumbnailFormat  = null;

	var $sourceFilename   = null;
	var $rawImageData     = null;
	var $IMresizedData    = null;
	var $outputImageData  = null;

	var $useRawIMoutput   = false;

	var $gdimg_output     = null;
	var $gdimg_source     = null;

	var $getimagesizeinfo = null;

	var $source_width  = null;
	var $source_height = null;

	var $thumbnailCropX = null;
	var $thumbnailCropY = null;
	var $thumbnailCropW = null;
	var $thumbnailCropH = null;

	var $exif_thumbnail_width  = null;
	var $exif_thumbnail_height = null;
	var $exif_thumbnail_type   = null;
	var $exif_thumbnail_data   = null;
	var $exif_raw_data         = null;

	var $thumbnail_width        = null;
	var $thumbnail_height       = null;
	var $thumbnail_image_width  = null;
	var $thumbnail_image_height = null;

	var $tempFilesToDelete = array();
	var $cache_filename    = null;

	var $AlphaCapableFormats = array('png', 'ico', 'gif');
	var $is_alpha = false;

	var $iswindows  = null;
	var $issafemode = null;

	var $phpthumb_version = '1.7.11-201108081537';

	//////////////////////////////////////////////////////////////////////

	// public: constructor
	function phpThumb() {
		$this->DebugTimingMessage('phpThumb() constructor', __FILE__, __LINE__);
		$this->DebugMessage('phpThumb() v'.$this->phpthumb_version, __FILE__, __LINE__);
		$this->config_max_source_pixels = round(max(intval(ini_get('memory_limit')), intval(get_cfg_var('memory_limit'))) * 1048576 * 0.20); // 20% of memory_limit
		$this->iswindows  = (bool) (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
		$this->issafemode = (bool) preg_match('#(1|ON)#i', ini_get('safe_mode'));
		$this->config_document_root = (!empty($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT']   : $this->config_document_root);
		$this->config_cache_prefix  = ( isset($_SERVER['SERVER_NAME'])   ? $_SERVER['SERVER_NAME'].'_' : '');

		$this->purgeTempFiles(); // purge existing temp files if re-initializing object

		$php_sapi_name = strtolower(function_exists('php_sapi_name') ? php_sapi_name() : '');
		if ($php_sapi_name == 'cli') {
			$this->config_allow_src_above_docroot = true;
		}
	}

	function __destruct() {
		$this->purgeTempFiles();
	}

	// public:
	function purgeTempFiles() {
		foreach ($this->tempFilesToDelete as $tempFileToDelete) {
			if (file_exists($tempFileToDelete)) {
				$this->DebugMessage('Deleting temp file "'.$tempFileToDelete.'"', __FILE__, __LINE__);
				@unlink($tempFileToDelete);
			}
		}
		$this->tempFilesToDelete = array();
		return true;
	}

	// public:
	function setSourceFilename($sourceFilename) {
		//$this->resetObject();
		//$this->rawImageData   = null;
		$this->sourceFilename = $sourceFilename;
		$this->src            = $sourceFilename;
		if (is_null($this->config_output_format)) {
			$sourceFileExtension = strtolower(substr(strrchr($sourceFilename, '.'), 1));
			if (preg_match('#^[a-z]{3,4}$#', $sourceFileExtension)) {
				$this->config_output_format = $sourceFileExtension;
				$this->DebugMessage('setSourceFilename('.$sourceFilename.') set $this->config_output_format to "'.$sourceFileExtension.'"', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('setSourceFilename('.$sourceFilename.') did NOT set $this->config_output_format to "'.$sourceFileExtension.'" because it did not seem like an appropriate image format', __FILE__, __LINE__);
			}
		}
		$this->DebugMessage('setSourceFilename('.$sourceFilename.') set $this->sourceFilename to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		return true;
	}

	// public:
	function setSourceData($rawImageData, $sourceFilename='') {
		//$this->resetObject();
		//$this->sourceFilename = null;
		$this->rawImageData   = $rawImageData;
		$this->DebugMessage('setSourceData() setting $this->rawImageData ('.strlen($this->rawImageData).' bytes; magic="'.substr($this->rawImageData, 0, 4).'" ('.phpthumb_functions::HexCharDisplay(substr($this->rawImageData, 0, 4)).'))', __FILE__, __LINE__);
		if ($this->config_cache_source_enabled) {
			$sourceFilename = ($sourceFilename ? $sourceFilename : md5($rawImageData));
			if (!is_dir($this->config_cache_source_directory)) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not a directory');
			} elseif (!@is_writable($this->config_cache_source_directory)) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not writable');
			}
			$this->DebugMessage('setSourceData() attempting to save source image to "'.$this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename).'"', __FILE__, __LINE__);
			if ($fp = @fopen($this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename), 'wb')) {
				fwrite($fp, $rawImageData);
				fclose($fp);
			} elseif (!$this->phpThumbDebug) {
				$this->ErrorImage('setSourceData() failed to write to source cache ('.$this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename).')');
			}
		}
		return true;
	}

	// public:
	function setSourceImageResource($gdimg) {
		//$this->resetObject();
		$this->gdimg_source = $gdimg;
		return true;
	}

	// public:
	function setParameter($param, $value) {
		if ($param == 'src') {
			$this->setSourceFilename($this->ResolveFilenameToAbsolute($value));
		} elseif (@is_array($this->$param)) {
			if (is_array($value)) {
				foreach ($value as $arraykey => $arrayvalue) {
					array_push($this->$param, $arrayvalue);
				}
			} else {
				array_push($this->$param, $value);
			}
		} else {
			$this->$param = $value;
		}
		return true;
	}

	// public:
	function getParameter($param) {
		//if (property_exists('phpThumb', $param)) {
			return $this->$param;
		//}
		//$this->DebugMessage('setParameter() attempting to get non-existant parameter "'.$param.'"', __FILE__, __LINE__);
		//return false;
	}


	// public:
	function GenerateThumbnail() {

		$this->setOutputFormat();
			$this->phpThumbDebug('8a');
		$this->ResolveSource();
			$this->phpThumbDebug('8b');
		$this->SetCacheFilename();
			$this->phpThumbDebug('8c');
		$this->ExtractEXIFgetImageSize();
			$this->phpThumbDebug('8d');
		if ($this->useRawIMoutput) {
			$this->DebugMessage('Skipping rest of GenerateThumbnail() because ($this->useRawIMoutput == true)', __FILE__, __LINE__);
			return true;
		}
			$this->phpThumbDebug('8e');
		if (!$this->SourceImageToGD()) {
			$this->DebugMessage('SourceImageToGD() failed', __FILE__, __LINE__);
			return false;
		}
			$this->phpThumbDebug('8f');
		$this->Rotate();
			$this->phpThumbDebug('8g');
		$this->CreateGDoutput();
			$this->phpThumbDebug('8h');

		switch ($this->far) {
			case 'L':
			case 'TL':
			case 'BL':
				$destination_offset_x = 0;
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'R':
			case 'TR':
			case 'BR':
				$destination_offset_x =  round($this->thumbnail_width  - $this->thumbnail_image_width);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'T':
			case 'TL':
			case 'TR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = 0;
				break;
			case 'B':
			case 'BL':
			case 'BR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y =  round($this->thumbnail_height - $this->thumbnail_image_height);
				break;
			case 'C':
			default:
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
		}

//		// copy/resize image to appropriate dimensions
//		$borderThickness = 0;
//		if (!empty($this->fltr)) {
//			foreach ($this->fltr as $key => $value) {
//				if (preg_match('#^bord\|([0-9]+)#', $value, $matches)) {
//					$borderThickness = $matches[1];
//					break;
//				}
//			}
//		}
//		if ($borderThickness > 0) {
//			//$this->DebugMessage('Skipping ImageResizeFunction() because BorderThickness="'.$borderThickness.'"', __FILE__, __LINE__);
//			$this->thumbnail_image_height /= 2;
//		}
		$this->ImageResizeFunction(
			$this->gdimg_output,
			$this->gdimg_source,
			$destination_offset_x,
			$destination_offset_y,
			$this->thumbnailCropX,
			$this->thumbnailCropY,
			$this->thumbnail_image_width,
			$this->thumbnail_image_height,
			$this->thumbnailCropW,
			$this->thumbnailCropH
		);

		$this->DebugMessage('memory_get_usage() after copy-resize = '.(function_exists('memory_get_usage') ? @memory_get_usage() : 'n/a'), __FILE__, __LINE__);
		ImageDestroy($this->gdimg_source);
		$this->DebugMessage('memory_get_usage() after ImageDestroy = '.(function_exists('memory_get_usage') ? @memory_get_usage() : 'n/a'), __FILE__, __LINE__);

			$this->phpThumbDebug('8i');
		$this->AntiOffsiteLinking();
			$this->phpThumbDebug('8j');
		$this->ApplyFilters();
			$this->phpThumbDebug('8k');
		$this->AlphaChannelFlatten();
			$this->phpThumbDebug('8l');
		$this->MaxFileSize();
			$this->phpThumbDebug('8m');

		$this->DebugMessage('GenerateThumbnail() completed successfully', __FILE__, __LINE__);
		return true;
	}


	// public:
	function RenderOutput() {
		if (!$this->useRawIMoutput && !is_resource($this->gdimg_output)) {
			$this->DebugMessage('RenderOutput() failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (!$this->thumbnailFormat) {
			$this->DebugMessage('RenderOutput() failed because $this->thumbnailFormat is empty', __FILE__, __LINE__);
			return false;
		}
		if ($this->useRawIMoutput) {
			$this->DebugMessage('RenderOutput copying $this->IMresizedData ('.strlen($this->IMresizedData).' bytes) to $this->outputImage', __FILE__, __LINE__);
			$this->outputImageData = $this->IMresizedData;
			return true;
		}

		$builtin_formats = array();
		if (function_exists('ImageTypes')) {
			$imagetypes = ImageTypes();
			$builtin_formats['wbmp'] = (bool) ($imagetypes & IMG_WBMP);
			$builtin_formats['jpg']  = (bool) ($imagetypes & IMG_JPG);
			$builtin_formats['gif']  = (bool) ($imagetypes & IMG_GIF);
			$builtin_formats['png']  = (bool) ($imagetypes & IMG_PNG);
		}
		$this->DebugMessage('RenderOutput() attempting Image'.strtoupper(@$this->thumbnailFormat).'($this->gdimg_output)', __FILE__, __LINE__);
		ob_start();
		switch ($this->thumbnailFormat) {
			case 'wbmp':
				if (!@$builtin_formats['wbmp']) {
					$this->DebugMessage('GD does not have required built-in support for WBMP output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageJPEG($this->gdimg_output, null, $this->thumbnailQuality);
				$this->outputImageData = ob_get_contents();
				break;

			case 'jpeg':
			case 'jpg':  // should be "jpeg" not "jpg" but just in case...
				if (!@$builtin_formats['jpg']) {
					$this->DebugMessage('GD does not have required built-in support for JPEG output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageJPEG($this->gdimg_output, null, $this->thumbnailQuality);
				$this->outputImageData = ob_get_contents();
				break;

			case 'png':
				if (!@$builtin_formats['png']) {
					$this->DebugMessage('GD does not have required built-in support for PNG output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImagePNG($this->gdimg_output);
				$this->outputImageData = ob_get_contents();
				break;

			case 'gif':
				if (!@$builtin_formats['gif']) {
					$this->DebugMessage('GD does not have required built-in support for GIF output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageGIF($this->gdimg_output);
				$this->outputImageData = ob_get_contents();
				break;

			case 'bmp':
				$ImageOutFunction = '"builtin BMP output"';
				if (!@include_once(dirname(__FILE__).'/phpthumb.bmp.php')) {
					$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.bmp.php" which is required for BMP format output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				$phpthumb_bmp = new phpthumb_bmp();
				$this->outputImageData = $phpthumb_bmp->GD2BMPstring($this->gdimg_output);
				unset($phpthumb_bmp);
				break;

			case 'ico':
				$ImageOutFunction = '"builtin ICO output"';
				if (!@include_once(dirname(__FILE__).'/phpthumb.ico.php')) {
					$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.ico.php" which is required for ICO format output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				$phpthumb_ico = new phpthumb_ico();
				$arrayOfOutputImages = array($this->gdimg_output);
				$this->outputImageData = $phpthumb_ico->GD2ICOstring($arrayOfOutputImages);
				unset($phpthumb_ico);
				break;

			default:
				$this->DebugMessage('RenderOutput failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
				ob_end_clean();
				return false;
		}
		ob_end_clean();
		if (!$this->outputImageData) {
			$this->DebugMessage('RenderOutput() for "'.$this->thumbnailFormat.'" failed', __FILE__, __LINE__);
			ob_end_clean();
			return false;
		}
		$this->DebugMessage('RenderOutput() completing with $this->outputImageData = '.strlen($this->outputImageData).' bytes', __FILE__, __LINE__);
		return true;
	}


	// public:
	function RenderToFile($filename) {
		if (preg_match('#^(f|ht)tps?\://#i', $filename)) {
			$this->DebugMessage('RenderToFile() failed because $filename ('.$filename.') is a URL', __FILE__, __LINE__);
			return false;
		}
		// render thumbnail to this file only, do not cache, do not output to browser
		//$renderfilename = $this->ResolveFilenameToAbsolute(dirname($filename)).DIRECTORY_SEPARATOR.basename($filename);
		$renderfilename = $filename;
		if (($filename{0} != '/') && ($filename{0} != '\\') && ($filename{1} != ':')) {
			$renderfilename = $this->ResolveFilenameToAbsolute($renderfilename);
		}
		if (!@is_writable(dirname($renderfilename))) {
			$this->DebugMessage('RenderToFile() failed because "'.dirname($renderfilename).'/" is not writable', __FILE__, __LINE__);
			return false;
		}
		if (@is_file($renderfilename) && !@is_writable($renderfilename)) {
			$this->DebugMessage('RenderToFile() failed because "'.$renderfilename.'" is not writable', __FILE__, __LINE__);
			return false;
		}

		if ($this->RenderOutput()) {
			if (file_put_contents($renderfilename, $this->outputImageData)) {
				$this->DebugMessage('RenderToFile('.$renderfilename.') succeeded', __FILE__, __LINE__);
				return true;
			}
			if (!@file_exists($renderfilename)) {
				$this->DebugMessage('RenderOutput ['.$this->thumbnailFormat.'('.$renderfilename.')] did not appear to fail, but the output image does not exist either...', __FILE__, __LINE__);
			}
		} else {
			$this->DebugMessage('RenderOutput ['.$this->thumbnailFormat.'('.$renderfilename.')] failed', __FILE__, __LINE__);
		}
		return false;
	}


	// public:
	function OutputThumbnail() {
		$this->purgeTempFiles();

		if (!$this->useRawIMoutput && !is_resource($this->gdimg_output)) {
			$this->DebugMessage('OutputThumbnail() failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (headers_sent()) {
			return $this->ErrorImage('OutputThumbnail() failed - headers already sent');
			exit;
		}

		$downloadfilename = phpthumb_functions::SanitizeFilename(is_string($this->sia) ? $this->sia : ($this->down ? $this->down : 'phpThumb_generated_thumbnail'.'.'.$this->thumbnailFormat));
		$this->DebugMessage('Content-Disposition header filename set to "'.$downloadfilename.'"', __FILE__, __LINE__);
		if ($downloadfilename) {
			header('Content-Disposition: '.($this->down ? 'attachment' : 'inline').'; filename="'.$downloadfilename.'"');
		} else {
			$this->DebugMessage('failed to send Content-Disposition header because $downloadfilename is empty', __FILE__, __LINE__);
		}

		if ($this->useRawIMoutput) {

			header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
			echo $this->IMresizedData;

		} else {

			$this->DebugMessage('ImageInterlace($this->gdimg_output, '.intval($this->config_output_interlace).')', __FILE__, __LINE__);
			ImageInterlace($this->gdimg_output, intval($this->config_output_interlace));
			switch ($this->thumbnailFormat) {
				case 'jpeg':
					header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output, '', $this->thumbnailQuality);
					break;

				case 'png':
				case 'gif':
					header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output);
					break;

				case 'bmp':
					if (!@include_once(dirname(__FILE__).'/phpthumb.bmp.php')) {
						$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.bmp.php" which is required for BMP format output', __FILE__, __LINE__);
						return false;
					}
					$phpthumb_bmp = new phpthumb_bmp();
					if (is_object($phpthumb_bmp)) {
						$bmp_data = $phpthumb_bmp->GD2BMPstring($this->gdimg_output);
						unset($phpthumb_bmp);
						if (!$bmp_data) {
							$this->DebugMessage('$phpthumb_bmp->GD2BMPstring() failed', __FILE__, __LINE__);
							return false;
						}
						header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
						echo $bmp_data;
					} else {
						$this->DebugMessage('new phpthumb_bmp() failed', __FILE__, __LINE__);
						return false;
					}
					break;

				case 'ico':
					if (!@include_once(dirname(__FILE__).'/phpthumb.ico.php')) {
						$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.ico.php" which is required for ICO format output', __FILE__, __LINE__);
						return false;
					}
					$phpthumb_ico = new phpthumb_ico();
					if (is_object($phpthumb_ico)) {
						$arrayOfOutputImages = array($this->gdimg_output);
						$ico_data = $phpthumb_ico->GD2ICOstring($arrayOfOutputImages);
						unset($phpthumb_ico);
						if (!$ico_data) {
							$this->DebugMessage('$phpthumb_ico->GD2ICOstring() failed', __FILE__, __LINE__);
							return false;
						}
						header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
						echo $ico_data;
					} else {
						$this->DebugMessage('new phpthumb_ico() failed', __FILE__, __LINE__);
						return false;
					}
					break;

				default:
					$this->DebugMessage('OutputThumbnail failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
					return false;
					break;
			}

		}
		return true;
	}


	// public:
	function CleanUpCacheDirectory() {
		$this->DebugMessage('CleanUpCacheDirectory() set to purge ('.(is_null($this->config_cache_maxage) ? 'NULL' : number_format($this->config_cache_maxage / 86400, 1)).' days; '.(is_null($this->config_cache_maxsize) ? 'NULL' : number_format($this->config_cache_maxsize / 1048576, 2)).' MB; '.(is_null($this->config_cache_maxfiles) ? 'NULL' : number_format($this->config_cache_maxfiles)).' files)', __FILE__, __LINE__);

		if (!is_writable($this->config_cache_directory)) {
			$this->DebugMessage('CleanUpCacheDirectory() skipped because "'.$this->config_cache_directory.'" is not writable', __FILE__, __LINE__);
			return true;
		}

		// cache status of cache directory for 1 hour to avoid hammering the filesystem functions
		$phpThumbCacheStats_filename = $this->config_cache_directory.DIRECTORY_SEPARATOR.'phpThumbCacheStats.txt';
		if (file_exists($phpThumbCacheStats_filename) && is_readable($phpThumbCacheStats_filename) && (filemtime($phpThumbCacheStats_filename) >= (time() - 3600))) {
			$this->DebugMessage('CleanUpCacheDirectory() skipped because "'.$phpThumbCacheStats_filename.'" is recently modified', __FILE__, __LINE__);
			return true;
		}
		touch($phpThumbCacheStats_filename);

		$DeletedKeys = array();
		$AllFilesInCacheDirectory = array();
		if (($this->config_cache_maxage > 0) || ($this->config_cache_maxsize > 0) || ($this->config_cache_maxfiles > 0)) {
			$CacheDirOldFilesAge  = array();
			$CacheDirOldFilesSize = array();
			$AllFilesInCacheDirectory = phpthumb_functions::GetAllFilesInSubfolders($this->config_cache_directory);
			foreach ($AllFilesInCacheDirectory as $fullfilename) {
				if (preg_match('#^'.preg_quote($this->config_cache_prefix).'#i', $fullfilename) && file_exists($fullfilename)) {
					$CacheDirOldFilesAge[$fullfilename] = @fileatime($fullfilename);
					if ($CacheDirOldFilesAge[$fullfilename] == 0) {
						$CacheDirOldFilesAge[$fullfilename] = @filemtime($fullfilename);
					}
					$CacheDirOldFilesSize[$fullfilename] = @filesize($fullfilename);
				}
			}
			if (empty($CacheDirOldFilesSize)) {
				return true;
			}
			$DeletedKeys['zerobyte'] = array();
			foreach ($CacheDirOldFilesSize as $fullfilename => $filesize) {
				// purge all zero-size files more than an hour old (to prevent trying to delete just-created and/or in-use files)
				$cutofftime = time() - 3600;
				if (($filesize == 0) && ($CacheDirOldFilesAge[$fullfilename] < $cutofftime)) {
					$this->DebugMessage('deleting "'.$fullfilename.'"', __FILE__, __LINE__);
					if (@unlink($fullfilename)) {
						$DeletedKeys['zerobyte'][] = $fullfilename;
						unset($CacheDirOldFilesSize[$fullfilename]);
						unset($CacheDirOldFilesAge[$fullfilename]);
					}
				}
			}
			$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['zerobyte']).' zero-byte files', __FILE__, __LINE__);
			asort($CacheDirOldFilesAge);

			if ($this->config_cache_maxfiles > 0) {
				$TotalCachedFiles = count($CacheDirOldFilesAge);
				$DeletedKeys['maxfiles'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($TotalCachedFiles > $this->config_cache_maxfiles) {
						$this->DebugMessage('deleting "'.$fullfilename.'"', __FILE__, __LINE__);
						if (@unlink($fullfilename)) {
							$TotalCachedFiles--;
							$DeletedKeys['maxfiles'][] = $fullfilename;
						}
					} else {
						// there are few enough files to keep the rest
						break;
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxfiles']).' files based on (config_cache_maxfiles='.$this->config_cache_maxfiles.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxfiles'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

			if ($this->config_cache_maxage > 0) {
				$mindate = time() - $this->config_cache_maxage;
				$DeletedKeys['maxage'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($filedate > 0) {
						if ($filedate < $mindate) {
							$this->DebugMessage('deleting "'.$fullfilename.'"', __FILE__, __LINE__);
							if (@unlink($fullfilename)) {
								$DeletedKeys['maxage'][] = $fullfilename;
							}
						} else {
							// the rest of the files are new enough to keep
							break;
						}
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxage']).' files based on (config_cache_maxage='.$this->config_cache_maxage.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxage'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

			if ($this->config_cache_maxsize > 0) {
				$TotalCachedFileSize = array_sum($CacheDirOldFilesSize);
				$DeletedKeys['maxsize'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($TotalCachedFileSize > $this->config_cache_maxsize) {
						$this->DebugMessage('deleting "'.$fullfilename.'"', __FILE__, __LINE__);
						if (@unlink($fullfilename)) {
							$TotalCachedFileSize -= $CacheDirOldFilesSize[$fullfilename];
							$DeletedKeys['maxsize'][] = $fullfilename;
						}
					} else {
						// the total filesizes are small enough to keep the rest of the files
						break;
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxsize']).' files based on (config_cache_maxsize='.$this->config_cache_maxsize.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxsize'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

		} else {
			$this->DebugMessage('skipping CleanUpCacheDirectory() because config set to not use it', __FILE__, __LINE__);
		}
		$totalpurged = 0;
		foreach ($DeletedKeys as $key => $value) {
			$totalpurged += count($value);
		}
		$this->DebugMessage('CleanUpCacheDirectory() purged '.$totalpurged.' files (from '.count($AllFilesInCacheDirectory).') based on config settings', __FILE__, __LINE__);
		if ($totalpurged > 0) {
			$empty_dirs = array();
			foreach ($AllFilesInCacheDirectory as $fullfilename) {
				if (is_dir($fullfilename)) {
					$empty_dirs[realpath($fullfilename)] = 1;
				} else {
					unset($empty_dirs[realpath(dirname($fullfilename))]);
				}
			}
			krsort($empty_dirs);
			$totalpurgeddirs = 0;
			foreach ($empty_dirs as $empty_dir => $dummy) {
				if ($empty_dir == $this->config_cache_directory) {
					// shouldn't happen, but just in case, don't let it delete actual cache directory
					continue;
				} elseif (@rmdir($empty_dir)) {
					$totalpurgeddirs++;
				} else {
					$this->DebugMessage('failed to rmdir('.$empty_dir.')', __FILE__, __LINE__);
				}
			}
			$this->DebugMessage('purged '.$totalpurgeddirs.' empty directories', __FILE__, __LINE__);
		}
		return true;
	}

	//////////////////////////////////////////////////////////////////////

	// private: re-initializator (call between rendering multiple images with one object)
	function resetObject() {
		$class_vars = get_class_vars(get_class($this));
		foreach ($class_vars as $key => $value) {
			// do not clobber debug or config info
			if (!preg_match('#^(config_|debug|fatalerror)#i', $key)) {
				$this->$key = $value;
			}
		}
		$this->phpThumb(); // re-initialize some class variables
		return true;
	}

	//////////////////////////////////////////////////////////////////////

	function ResolveSource() {
		if (is_resource($this->gdimg_source)) {
			$this->DebugMessage('ResolveSource() exiting because is_resource($this->gdimg_source)', __FILE__, __LINE__);
			return true;
		}
		if ($this->rawImageData) {
			$this->sourceFilename = null;
			$this->DebugMessage('ResolveSource() exiting because $this->rawImageData is set ('.number_format(strlen($this->rawImageData)).' bytes)', __FILE__, __LINE__);
			return true;
		}
		if ($this->sourceFilename) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->sourceFilename);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		} elseif ($this->src) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->src);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'" from $this->src ('.$this->src.')', __FILE__, __LINE__);
		} else {
			return $this->ErrorImage('$this->sourceFilename and $this->src are both empty');
		}
		if ($this->iswindows && ((substr($this->sourceFilename, 0, 2) == '//') || (substr($this->sourceFilename, 0, 2) == '\\\\'))) {
			// Windows \\share\filename.ext
		} elseif (preg_match('#^(f|ht)tps?\://#i', $this->sourceFilename)) {
			// URL
			if ($this->config_http_user_agent) {
				ini_set('user_agent', $this->config_http_user_agent);
			}
		} elseif (!@file_exists($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" does not exist');
		} elseif (!@is_file($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" is not a file');
		}
		return true;
	}

	function setOutputFormat() {
		static $alreadyCalled = false;
		if ($this->thumbnailFormat && $alreadyCalled) {
			return true;
		}
		$alreadyCalled = true;

		$AvailableImageOutputFormats = array();
		$AvailableImageOutputFormats[] = 'text';
		if (@is_readable(dirname(__FILE__).'/phpthumb.ico.php')) {
			$AvailableImageOutputFormats[] = 'ico';
		}
		if (@is_readable(dirname(__FILE__).'/phpthumb.bmp.php')) {
			$AvailableImageOutputFormats[] = 'bmp';
		}

		$this->thumbnailFormat = 'ico';

		// Set default output format based on what image types are available
		if (function_exists('ImageTypes')) {
			$imagetypes = ImageTypes();
			if ($imagetypes & IMG_WBMP) {
				$this->thumbnailFormat         = 'wbmp';
				$AvailableImageOutputFormats[] = 'wbmp';
			}
			if ($imagetypes & IMG_GIF) {
				$this->thumbnailFormat         = 'gif';
				$AvailableImageOutputFormats[] = 'gif';
			}
			if ($imagetypes & IMG_PNG) {
				$this->thumbnailFormat         = 'png';
				$AvailableImageOutputFormats[] = 'png';
			}
			if ($imagetypes & IMG_JPG) {
				$this->thumbnailFormat         = 'jpeg';
				$AvailableImageOutputFormats[] = 'jpeg';
			}
		} else {
			//return $this->ErrorImage('ImageTypes() does not exist - GD support might not be enabled?');
			$this->DebugMessage('ImageTypes() does not exist - GD support might not be enabled?',  __FILE__, __LINE__);
		}
		if ($this->ImageMagickVersion()) {
			$IMformats = array('jpeg', 'png', 'gif', 'bmp', 'ico', 'wbmp');
			$this->DebugMessage('Addding ImageMagick formats to $AvailableImageOutputFormats ('.implode(';', $AvailableImageOutputFormats).')', __FILE__, __LINE__);
			foreach ($IMformats as $key => $format) {
				$AvailableImageOutputFormats[] = $format;
			}
		}
		$AvailableImageOutputFormats = array_unique($AvailableImageOutputFormats);
		$this->DebugMessage('$AvailableImageOutputFormats = array('.implode(';', $AvailableImageOutputFormats).')', __FILE__, __LINE__);

		$this->f = preg_replace('#[^a-z]#', '', strtolower($this->f));
		if (strtolower($this->config_output_format) == 'jpg') {
			$this->config_output_format = 'jpeg';
		}
		if (strtolower($this->f) == 'jpg') {
			$this->f = 'jpeg';
		}
		if (phpthumb_functions::CaseInsensitiveInArray($this->config_output_format, $AvailableImageOutputFormats)) {
			// set output format to config default if that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->config_output_format "'.strtolower($this->config_output_format).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->config_output_format);
		} elseif ($this->config_output_format) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->config_output_format ('.strtolower($this->config_output_format).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}
		if ($this->f && (phpthumb_functions::CaseInsensitiveInArray($this->f, $AvailableImageOutputFormats))) {
			// override output format if $this->f is set and that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->f "'.strtolower($this->f).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->f);
		} elseif ($this->f) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->f ('.strtolower($this->f).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}

		// for JPEG images, quality 1 (worst) to 99 (best)
		// quality < 25 is nasty, with not much size savings - not recommended
		// problems with 100 - invalid JPEG?
		$this->thumbnailQuality = max(1, min(99, ($this->q ? intval($this->q) : 75)));
		$this->DebugMessage('$this->thumbnailQuality set to "'.$this->thumbnailQuality.'"', __FILE__, __LINE__);

		return true;
	}

	function setCacheDirectory() {
		// resolve cache directory to absolute pathname
		$this->DebugMessage('setCacheDirectory() starting with config_cache_directory = "'.$this->config_cache_directory.'"', __FILE__, __LINE__);
		if (substr($this->config_cache_directory, 0, 1) == '.') {
			if (preg_match('#^(f|ht)tps?\://#i', $this->src)) {
				if (!$this->config_cache_disable_warning) {
					$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') cannot be used for remote images. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
				}
			} elseif ($this->src) {
				// resolve relative cache directory to source image
				$this->config_cache_directory = dirname($this->ResolveFilenameToAbsolute($this->src)).DIRECTORY_SEPARATOR.$this->config_cache_directory;
			} else {
				// $this->new is probably set
			}
		}
		if (substr($this->config_cache_directory, -1) == '/') {
			$this->config_cache_directory = substr($this->config_cache_directory, 0, -1);
		}
		if ($this->iswindows) {
			$this->config_cache_directory = str_replace('/', DIRECTORY_SEPARATOR, $this->config_cache_directory);
		}
		if ($this->config_cache_directory) {
			$real_cache_path = realpath($this->config_cache_directory);
			if (!$real_cache_path) {
				$this->DebugMessage('realpath($this->config_cache_directory) failed for "'.$this->config_cache_directory.'"', __FILE__, __LINE__);
				if (!is_dir($this->config_cache_directory)) {
					$this->DebugMessage('!is_dir('.$this->config_cache_directory.')', __FILE__, __LINE__);
				}
			}
			if ($real_cache_path) {
				$this->DebugMessage('setting config_cache_directory to realpath('.$this->config_cache_directory.') = "'.$real_cache_path.'"', __FILE__, __LINE__);
				$this->config_cache_directory = $real_cache_path;
			}
		}
		if (!is_dir($this->config_cache_directory)) {
			if (!$this->config_cache_disable_warning) {
				$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') does not exist. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
			}
			$this->DebugMessage('$this->config_cache_directory ('.$this->config_cache_directory.') is not a directory', __FILE__, __LINE__);
			$this->config_cache_directory = null;
		} elseif (!@is_writable($this->config_cache_directory)) {
			$this->DebugMessage('$this->config_cache_directory is not writable ('.$this->config_cache_directory.')', __FILE__, __LINE__);
		}

		$this->InitializeTempDirSetting();
		if (!@is_dir($this->config_temp_directory) && !@is_writable($this->config_temp_directory) && @is_dir($this->config_cache_directory) && @is_writable($this->config_cache_directory)) {
			$this->DebugMessage('setting $this->config_temp_directory = $this->config_cache_directory ('.$this->config_cache_directory.')', __FILE__, __LINE__);
			$this->config_temp_directory = $this->config_cache_directory;
		}
		return true;
	}


	function ResolveFilenameToAbsolute($filename) {
		if (empty($filename)) {
			return false;
		}

		if (preg_match('#^[a-z0-9]+\:/{1,2}#i', $filename)) {
			// eg: http://host/path/file.jpg (HTTP URL)
			// eg: ftp://host/path/file.jpg  (FTP URL)
			// eg: data1:/path/file.jpg      (Netware path)

			//$AbsoluteFilename = $filename;
			return $filename;

		} elseif ($this->iswindows && isset($filename{1}) && ($filename{1} == ':')) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($this->iswindows && ((substr($filename, 0, 2) == '//') || (substr($filename, 0, 2) == '\\\\'))) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($filename{0} == '/') {

			if (@is_readable($filename) && !@is_readable($this->config_document_root.$filename)) {

				// absolute filename (*nix)
				$AbsoluteFilename = $filename;

			} elseif (isset($filename{1}) && ($filename{1} == '~')) {

				// /~user/path
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray($filename)) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'];
				} else {
					$AbsoluteFilename = realpath($filename);
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath($filename)', __FILE__, __LINE__);
					} elseif (is_dir(dirname($AbsoluteFilename))) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname($filename).'", but the correct directory ('.dirname($AbsoluteFilename).') seems to have been resolved with realpath(.)', __FILE__, __LINE__);
					} else {
						return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'". This has been known to fail on Apache2 - try using the absolute filename for the source image (ex: "/home/user/httpdocs/image.jpg" instead of "/~user/image.jpg")');
					}
				}

			} else {

				// relative filename (any OS)
				if (preg_match('#^'.preg_quote($this->config_document_root).'#', $filename)) {
					$AbsoluteFilename = $filename;
					$this->DebugMessage('ResolveFilenameToAbsolute() NOT prepending $this->config_document_root ('.$this->config_document_root.') to $filename ('.$filename.') resulting in ($AbsoluteFilename = "'.$AbsoluteFilename.'")', __FILE__, __LINE__);
				} else {
					$AbsoluteFilename = $this->config_document_root.$filename;
					$this->DebugMessage('ResolveFilenameToAbsolute() prepending $this->config_document_root ('.$this->config_document_root.') to $filename ('.$filename.') resulting in ($AbsoluteFilename = "'.$AbsoluteFilename.'")', __FILE__, __LINE__);
				}

			}

		} else {

			// relative to current directory (any OS)
			//$AbsoluteFilename = $this->config_document_root.preg_replace('#[/\\\\]#', DIRECTORY_SEPARATOR, dirname(@$_SERVER['PHP_SELF'])).DIRECTORY_SEPARATOR.preg_replace('#[/\\\\]#', DIRECTORY_SEPARATOR, $filename);
			$AbsoluteFilename = dirname(__FILE__).DIRECTORY_SEPARATOR.preg_replace('#[/\\\\]#', DIRECTORY_SEPARATOR, $filename);

			//if (!@file_exists($AbsoluteFilename) && @file_exists(realpath($this->DotPadRelativeDirectoryPath($filename)))) {
			//	$AbsoluteFilename = realpath($this->DotPadRelativeDirectoryPath($filename));
			//}

			if (substr(dirname(@$_SERVER['PHP_SELF']), 0, 2) == '/~') {
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray(dirname(@$_SERVER['PHP_SELF']))) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'].DIRECTORY_SEPARATOR.$filename;
				} else {
					$AbsoluteFilename = realpath('.').DIRECTORY_SEPARATOR.$filename;
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath(.)/$filename', __FILE__, __LINE__);
					} elseif (is_dir(dirname($AbsoluteFilename))) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'", but the correct directory ('.dirname($AbsoluteFilename).') seems to have been resolved with realpath(.)', __FILE__, __LINE__);
					} else {
						return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'". This has been known to fail on Apache2 - try using the absolute filename for the source image');
					}
				}
			}

		}
		if (is_link($AbsoluteFilename)) {
			$this->DebugMessage('is_link()==true, changing "'.$AbsoluteFilename.'" to "'.readlink($AbsoluteFilename).'"', __FILE__, __LINE__);
			$AbsoluteFilename = readlink($AbsoluteFilename);
		}
		if (realpath($AbsoluteFilename)) {
			$AbsoluteFilename = realpath($AbsoluteFilename);
		}
		if ($this->iswindows) {
			$AbsoluteFilename = preg_replace('#^'.preg_quote(realpath($this->config_document_root)).'#i', realpath($this->config_document_root), $AbsoluteFilename);
			$AbsoluteFilename = str_replace(DIRECTORY_SEPARATOR, '/', $AbsoluteFilename);
		}
		if (!$this->config_allow_src_above_docroot && !preg_match('#^'.preg_quote(str_replace(DIRECTORY_SEPARATOR, '/', realpath($this->config_document_root))).'#', $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_docroot therefore setting "'.$AbsoluteFilename.'" (outside "'.realpath($this->config_document_root).'") to null', __FILE__, __LINE__);
			return false;
		}
		if (!$this->config_allow_src_above_phpthumb && !preg_match('#^'.preg_quote(str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__))).'#', $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_phpthumb therefore setting "'.$AbsoluteFilename.'" (outside "'.dirname(__FILE__).'") to null', __FILE__, __LINE__);
			return false;
		}
		return $AbsoluteFilename;
	}

	function file_exists_ignoreopenbasedir($filename, $cached=true) {
		static $open_basedirs = null;
		static $file_exists_cache = array();
		if (!$cached || !isset($file_exists_cache[$filename])) {
			if (is_null($open_basedirs)) {
				$open_basedirs = explode(';', ini_get('open_basedir'));
			}
			if (empty($open_basedirs) || in_array(dirname($filename), $open_basedirs)) {
				$file_exists_cache[$filename] = file_exists($filename);
			} elseif ($this->iswindows) {
				$ls_filename = trim(phpthumb_functions::SafeExec('dir '.escapeshellarg($filename)));
				$file_exists_cache[$filename] = !preg_match('#File Not Found#i', $ls_filename);
			} else {
				$ls_filename = trim(phpthumb_functions::SafeExec('ls '.escapeshellarg($filename)));
				$file_exists_cache[$filename] = ($ls_filename == $filename);
			}
		}
		return $file_exists_cache[$filename];
	}

	function ImageMagickWhichConvert() {
		static $WhichConvert = null;
		if (is_null($WhichConvert)) {
			if ($this->iswindows) {
				$WhichConvert = false;
			} else {
				$WhichConvert = trim(phpthumb_functions::SafeExec('which convert'));
			}
		}
		return $WhichConvert;
	}

	function ImageMagickCommandlineBase() {
		static $commandline = null;
		if (is_null($commandline)) {
			if ($this->issafemode) {
				$commandline = '';
				return $commandline;
			}
			$commandline = (!is_null($this->config_imagemagick_path) ? $this->config_imagemagick_path : '');

			if ($this->config_imagemagick_path && ($this->config_imagemagick_path != realpath($this->config_imagemagick_path))) {
				if (@is_executable(realpath($this->config_imagemagick_path))) {
					$this->DebugMessage('Changing $this->config_imagemagick_path ('.$this->config_imagemagick_path.') to realpath($this->config_imagemagick_path) ('.realpath($this->config_imagemagick_path).')', __FILE__, __LINE__);
					$this->config_imagemagick_path = realpath($this->config_imagemagick_path);
				} else {
					$this->DebugMessage('Leaving $this->config_imagemagick_path as ('.$this->config_imagemagick_path.') because !is_execuatable(realpath($this->config_imagemagick_path)) ('.realpath($this->config_imagemagick_path).')', __FILE__, __LINE__);
				}
			}
			$this->DebugMessage('                  file_exists('.$this->config_imagemagick_path.') = '.intval(                        @file_exists($this->config_imagemagick_path)), __FILE__, __LINE__);
			$this->DebugMessage('file_exists_ignoreopenbasedir('.$this->config_imagemagick_path.') = '.intval($this->file_exists_ignoreopenbasedir($this->config_imagemagick_path)), __FILE__, __LINE__);
			$this->DebugMessage('                      is_file('.$this->config_imagemagick_path.') = '.intval(                            @is_file($this->config_imagemagick_path)), __FILE__, __LINE__);
			$this->DebugMessage('                is_executable('.$this->config_imagemagick_path.') = '.intval(                      @is_executable($this->config_imagemagick_path)), __FILE__, __LINE__);

			if ($this->file_exists_ignoreopenbasedir($this->config_imagemagick_path)) {
				$this->DebugMessage('using ImageMagick path from $this->config_imagemagick_path ('.$this->config_imagemagick_path.')', __FILE__, __LINE__);
				if ($this->iswindows) {
					$commandline = substr($this->config_imagemagick_path, 0, 2).' && cd '.escapeshellarg(str_replace('/', DIRECTORY_SEPARATOR, substr(dirname($this->config_imagemagick_path), 2))).' && '.escapeshellarg(basename($this->config_imagemagick_path));
				} else {
					$commandline = escapeshellarg($this->config_imagemagick_path);
				}
				return $commandline;
			}

			$which_convert = $this->ImageMagickWhichConvert();
			$IMversion     = $this->ImageMagickVersion();

			if ($which_convert && ($which_convert{0} == '/') && $this->file_exists_ignoreopenbasedir($which_convert)) {

				// `which convert` *should* return the path if "convert" exist, or nothing if it doesn't
				// other things *may* get returned, like "sh: convert: not found" or "no convert in /usr/local/bin /usr/sbin /usr/bin /usr/ccs/bin"
				// so only do this if the value returned exists as a file
				$this->DebugMessage('using ImageMagick path from `which convert` ('.$which_convert.')', __FILE__, __LINE__);
				$commandline = 'convert';

			} elseif ($IMversion) {

				$this->DebugMessage('setting ImageMagick path to $this->config_imagemagick_path ('.$this->config_imagemagick_path.') ['.$IMversion.']', __FILE__, __LINE__);
				$commandline = $this->config_imagemagick_path;

			} else {

				$this->DebugMessage('ImageMagickThumbnailToGD() aborting because cannot find convert in $this->config_imagemagick_path ('.$this->config_imagemagick_path.'), and `which convert` returned ('.$which_convert.')', __FILE__, __LINE__);
				$commandline = '';

			}
		}
		return $commandline;
	}

	function ImageMagickVersion($returnRAW=false) {
		static $versionstring = null;
		if (is_null($versionstring)) {
			$versionstring = array(0=>false, 1=>false);
			$commandline = $this->ImageMagickCommandlineBase();
			$commandline = (!is_null($commandline) ? $commandline : '');

			if ($commandline) {
				$commandline .= ' --version';
				$this->DebugMessage('ImageMagick version checked with "'.$commandline.'"', __FILE__, __LINE__);
				$versionstring[1] = trim(phpthumb_functions::SafeExec($commandline));
				if (preg_match('#^Version: [^0-9]*([ 0-9\\.\\:Q/\\-]+) (http|file)\:#i', $versionstring[1], $matches)) {
					$versionstring[0] = $matches[1];
				} else {
					$versionstring[0] = false;
					$this->DebugMessage('ImageMagick did not return recognized version string ('.$versionstring[1].')', __FILE__, __LINE__);
				}
				$this->DebugMessage('ImageMagick convert --version says "'.@$matches[0].'"', __FILE__, __LINE__);
			}
		}
		return $versionstring[intval($returnRAW)];
	}

	function ImageMagickSwitchAvailable($switchname) {
		static $IMoptions = null;
		if (is_null($IMoptions)) {
			$IMoptions = array();
			$commandline = $this->ImageMagickCommandlineBase();
			if (!is_null($commandline)) {
				$commandline .= ' -help';
				$IMhelp_lines = explode("\n", phpthumb_functions::SafeExec($commandline));
				foreach ($IMhelp_lines as $line) {
					if (preg_match('#^[\\+\\-]([a-z\\-]+) #', trim($line), $matches)) {
						$IMoptions[$matches[1]] = true;
					}
				}
			}
		}
		if (is_array($switchname)) {
			$allOK = true;
			foreach ($switchname as $key => $value) {
				if (!isset($IMoptions[$value])) {
					$allOK = false;
					break;
				}
			}
			$this->DebugMessage('ImageMagickSwitchAvailable('.implode(';', $switchname).') = '.intval($allOK).'', __FILE__, __LINE__);
		} else {
			$allOK = isset($IMoptions[$switchname]);
			$this->DebugMessage('ImageMagickSwitchAvailable('.$switchname.') = '.intval($allOK).'', __FILE__, __LINE__);
		}
		return $allOK;
	}

	function ImageMagickFormatsList() {
		static $IMformatsList = null;
		if (is_null($IMformatsList)) {
			$IMformatsList = '';
			$commandline = $this->ImageMagickCommandlineBase();
			if (!is_null($commandline)) {
				$commandline = dirname($commandline).DIRECTORY_SEPARATOR.str_replace('convert', 'identify', basename($commandline));
				$commandline .= ' -list format';
				$IMformatsList = phpthumb_functions::SafeExec($commandline);
			}
		}
		return $IMformatsList;
	}

	function SourceDataToTempFile() {
		if ($IMtempSourceFilename = $this->phpThumb_tempnam()) {
			$IMtempSourceFilename = realpath($IMtempSourceFilename);
			ob_start();
			$fp_tempfile = fopen($IMtempSourceFilename, 'wb');
			$tempfile_open_error  = ob_get_contents();
			ob_end_clean();
			if ($fp_tempfile) {
				fwrite($fp_tempfile, $this->rawImageData);
				fclose($fp_tempfile);
				$this->sourceFilename = $IMtempSourceFilename;
				$this->DebugMessage('ImageMagickThumbnailToGD() setting $this->sourceFilename to "'.$IMtempSourceFilename.'" from $this->rawImageData ('.strlen($this->rawImageData).' bytes)', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('ImageMagickThumbnailToGD() FAILED setting $this->sourceFilename to "'.$IMtempSourceFilename.'" (failed to open for writing: "'.$tempfile_open_error.'")', __FILE__, __LINE__);
			}
			unset($tempfile_open_error, $IMtempSourceFilename);
			return true;
		}
		$this->DebugMessage('SourceDataToTempFile() FAILED because $this->phpThumb_tempnam() failed', __FILE__, __LINE__);
		return false;
	}

	function ImageMagickThumbnailToGD() {
		// http://www.imagemagick.org/script/command-line-options.php

		$this->useRawIMoutput = true;
		if (phpthumb_functions::gd_version()) {
			// if GD is not available, must use whatever ImageMagick can output

			// $UnAllowedParameters contains options that can only be processed in GD, not ImageMagick
			// note: 'fltr' *may* need to be processed by GD, but we'll check that in more detail below
			$UnAllowedParameters = array('xto', 'ar', 'bg', 'bc');
			// 'ra' may be part of this list, if not a multiple of 90°
			foreach ($UnAllowedParameters as $parameter) {
				if (isset($this->$parameter)) {
					$this->DebugMessage('$this->useRawIMoutput=false because "'.$parameter.'" is set', __FILE__, __LINE__);
					$this->useRawIMoutput = false;
					break;
				}
			}
		}
		$this->DebugMessage('$this->useRawIMoutput='.($this->useRawIMoutput ? 'true' : 'false').' after checking $UnAllowedParameters', __FILE__, __LINE__);
		$outputFormat = $this->thumbnailFormat;
		if (phpthumb_functions::gd_version()) {
			if ($this->useRawIMoutput) {
				switch ($this->thumbnailFormat) {
					case 'gif':
						$ImageCreateFunction = 'ImageCreateFromGIF';
						$this->is_alpha = true;
						break;
					case 'png':
						$ImageCreateFunction = 'ImageCreateFromPNG';
						$this->is_alpha = true;
						break;
					case 'jpg':
					case 'jpeg':
						$ImageCreateFunction = 'ImageCreateFromJPEG';
						break;
					default:
						$this->DebugMessage('Forcing output to PNG because $this->thumbnailFormat ('.$this->thumbnailFormat.' is not a GD-supported format)', __FILE__, __LINE__);
						$outputFormat = 'png';
						$ImageCreateFunction = 'ImageCreateFromPNG';
						$this->is_alpha = true;
						$this->useRawIMoutput = false;
						break;
				}
				if (!function_exists(@$ImageCreateFunction)) {
					// ImageMagickThumbnailToGD() depends on ImageCreateFromPNG/ImageCreateFromGIF
					//$this->DebugMessage('ImageMagickThumbnailToGD() aborting because '.@$ImageCreateFunction.'() is not available', __FILE__, __LINE__);
					$this->useRawIMoutput = true;
					//return false;
				}
			} else {
				$outputFormat = 'png';
				$ImageCreateFunction = 'ImageCreateFromPNG';
				$this->is_alpha = true;
				$this->useRawIMoutput = false;
			}
		}

		// http://freealter.org/doc_distrib/ImageMagick-5.1.1/www/convert.html
		if (!$this->sourceFilename && $this->rawImageData) {
			$this->SourceDataToTempFile();
		}
		if (!$this->sourceFilename) {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because $this->sourceFilename is empty', __FILE__, __LINE__);
			$this->useRawIMoutput = false;
			return false;
		}
		if ($this->issafemode) {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because safe_mode is enabled', __FILE__, __LINE__);
			$this->useRawIMoutput = false;
			return false;
		}
// TO BE FIXED
//if (true) {
//	$this->DebugMessage('ImageMagickThumbnailToGD() aborting it is broken right now', __FILE__, __LINE__);
//	$this->useRawIMoutput = false;
//	return false;
//}

		$commandline = $this->ImageMagickCommandlineBase();
		if ($commandline) {
			if ($IMtempfilename = $this->phpThumb_tempnam()) {
				$IMtempfilename = realpath($IMtempfilename);

				$IMuseExplicitImageOutputDimensions = false;
				if ($this->ImageMagickSwitchAvailable('thumbnail') && $this->config_imagemagick_use_thumbnail) {
					$IMresizeParameter = 'thumbnail';
				} else {
					$IMresizeParameter = 'resize';

					// some (older? around 2002) versions of IM won't accept "-resize 100x" but require "-resize 100x100"
					$commandline_test = $this->ImageMagickCommandlineBase().' logo: -resize 1x '.escapeshellarg($IMtempfilename).' 2>&1';
					$IMresult_test = phpthumb_functions::SafeExec($commandline_test);
					$IMuseExplicitImageOutputDimensions = preg_match('#image dimensions are zero#i', $IMresult_test);
					$this->DebugMessage('IMuseExplicitImageOutputDimensions = '.intval($IMuseExplicitImageOutputDimensions), __FILE__, __LINE__);
					if ($fp_im_temp = @fopen($IMtempfilename, 'wb')) {
						// erase temp image so ImageMagick logo doesn't get output if other processing fails
						fclose($fp_im_temp);
					}
				}


				if (!is_null($this->dpi) && $this->ImageMagickSwitchAvailable('density')) {
					// for raster source formats only (WMF, PDF, etc)
					$commandline .= ' -density '.escapeshellarg($this->dpi);
				}
				ob_start();
				$getimagesize = GetImageSize($this->sourceFilename);
				$GetImageSizeError = ob_get_contents();
				ob_end_clean();
				if (is_array($getimagesize)) {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') SUCCEEDED: '.print_r($getimagesize, true), __FILE__, __LINE__);
				} else {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') FAILED with error "'.$GetImageSizeError.'"', __FILE__, __LINE__);
				}
				if (is_array($getimagesize)) {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') returned [w='.$getimagesize[0].';h='.$getimagesize[1].';f='.$getimagesize[2].']', __FILE__, __LINE__);
					$this->source_width  = $getimagesize[0];
					$this->source_height = $getimagesize[1];
					$this->DebugMessage('source dimensions set to '.$this->source_width.'x'.$this->source_height, __FILE__, __LINE__);
					$this->SetOrientationDependantWidthHeight();

					if (!preg_match('#('.implode('|', $this->AlphaCapableFormats).')#i', $outputFormat)) {
						// not a transparency-capable format
						$commandline .= ' -background '.escapeshellarg('#'.($this->bg ? $this->bg : 'FFFFFF'));
						if ($getimagesize[2] == IMAGETYPE_GIF) {
							$commandline .= ' -flatten';
						}
					}
					if ($getimagesize[2] == IMAGETYPE_GIF) {
						$commandline .= ' -coalesce'; // may be needed for animated GIFs
					}
					if ($this->source_width || $this->source_height) {
						if ($this->zc) {

							$borderThickness = 0;
							if (!empty($this->fltr)) {
								foreach ($this->fltr as $key => $value) {
									if (preg_match('#^bord\|([0-9]+)#', $value, $matches)) {
										$borderThickness = $matches[1];
										break;
									}
								}
							}
							$wAll = intval(max($this->w, $this->wp, $this->wl, $this->ws)) - (2 * $borderThickness);
							$hAll = intval(max($this->h, $this->hp, $this->hl, $this->hs)) - (2 * $borderThickness);
							$imAR = $this->source_width / $this->source_height;
							$zcAR = (($wAll && $hAll) ? $wAll / $hAll : 1);
							$side  = phpthumb_functions::nonempty_min($this->source_width, $this->source_height, max($wAll, $hAll));
							$sideX = phpthumb_functions::nonempty_min($this->source_width,                       $wAll, round($hAll * $zcAR));
							$sideY = phpthumb_functions::nonempty_min(                     $this->source_height, $hAll, round($wAll / $zcAR));

							$thumbnailH = round(max($sideY, ($sideY * $zcAR) / $imAR));
							$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg(($IMuseExplicitImageOutputDimensions ? $thumbnailH : '').'x'.$thumbnailH);

							switch (strtoupper($this->zc)) {
								case 'T':
									$commandline .= ' -gravity north';
									break;
								case 'B':
									$commandline .= ' -gravity south';
									break;
								case 'L':
									$commandline .= ' -gravity west';
									break;
								case 'R':
									$commandline .= ' -gravity east';
									break;
								case 'TL':
									$commandline .= ' -gravity northwest';
									break;
								case 'TR':
									$commandline .= ' -gravity northeast';
									break;
								case 'BL':
									$commandline .= ' -gravity southwest';
									break;
								case 'BR':
									$commandline .= ' -gravity southeast';
									break;
								case '1':
								case 'C':
								default:
									$commandline .= ' -gravity center';
									break;
							}

							if (($wAll > 0) && ($hAll > 0)) {
								$commandline .= ' -crop '.escapeshellarg($wAll.'x'.$hAll.'+0+0');
							} else {
								$commandline .= ' -crop '.escapeshellarg($side.'x'.$side.'+0+0');
							}
							if ($this->ImageMagickSwitchAvailable('repage')) {
								$commandline .= ' +repage';
							} else {
								$this->DebugMessage('Skipping "+repage" because ImageMagick (v'.$this->ImageMagickVersion().') does not support it', __FILE__, __LINE__);
							}

						} elseif ($this->sw || $this->sh || $this->sx || $this->sy) {

							$crop_param   = '';
							$crop_param  .=     ($this->sw ? (($this->sw < 2) ? round($this->sw * $this->source_width)  : $this->sw) : $this->source_width);
							$crop_param  .= 'x'.($this->sh ? (($this->sh < 2) ? round($this->sh * $this->source_height) : $this->sh) : $this->source_height);
							$crop_param  .= '+'.(($this->sx < 2) ? round($this->sx * $this->source_width)  : $this->sx);
							$crop_param  .= '+'.(($this->sy < 2) ? round($this->sy * $this->source_height) : $this->sy);
// TO BE FIXED
// makes 1x1 output
// http://trainspotted.com/phpThumb/phpThumb.php?src=/content/CNR/47/CNR-4728-LD-L-20110723-898.jpg&w=100&h=100&far=1&f=png&fltr[]=lvl&sx=0.05&sy=0.25&sw=0.92&sh=0.42
// '/usr/bin/convert' -density 150 -thumbnail 100x100 -contrast-stretch '0.1%' '/var/www/vhosts/trainspotted.com/httpdocs/content/CNR/47/CNR-4728-LD-L-20110723-898.jpg[0]' png:'/var/www/vhosts/trainspotted.com/httpdocs/phpThumb/_cache/pThumbIIUlvj'
//							$commandline .= ' -crop '.escapeshellarg($crop_param);

							// this is broken for aoe=1, but unsure how to fix. Send advice to info@silisoftware.com
							if ($this->w || $this->h) {
								//if ($this->ImageMagickSwitchAvailable('repage')) {
if (false) {
// TO BE FIXED
// newer versions of ImageMagick require -repage <geometry>
									$commandline .= ' -repage';
								} else {
									$this->DebugMessage('Skipping "-repage" because ImageMagick (v'.$this->ImageMagickVersion().') does not support it', __FILE__, __LINE__);
								}
								if ($IMuseExplicitImageOutputDimensions) {
									if ($this->w && !$this->h) {
										$this->h = ceil($this->w / ($this->source_width / $this->source_height));
									} elseif ($this->h && !$this->w) {
										$this->w = ceil($this->h * ($this->source_width / $this->source_height));
									}
								}
								$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg($this->w.'x'.$this->h);
							}

						} else {

							if ($this->iar && (intval($this->w) > 0) && (intval($this->h) > 0)) {
								list($nw, $nh) = phpthumb_functions::TranslateWHbyAngle($this->w, $this->h, $this->ra);
								$nw = ((round($nw) != 0) ? round($nw) : '');
								$nh = ((round($nh) != 0) ? round($nh) : '');
								$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg($nw.'x'.$nh.'!');
							} else {
								$this->w = ((($this->aoe || $this->far) && $this->w) ? $this->w : ($this->w ? phpthumb_functions::nonempty_min($this->w, $getimagesize[0]) : ''));
								$this->h = ((($this->aoe || $this->far) && $this->h) ? $this->h : ($this->h ? phpthumb_functions::nonempty_min($this->h, $getimagesize[1]) : ''));
								if ($this->w || $this->h) {
									if ($IMuseExplicitImageOutputDimensions) {
										if ($this->w && !$this->h) {
											$this->h = ceil($this->w / ($this->source_width / $this->source_height));
										} elseif ($this->h && !$this->w) {
											$this->w = ceil($this->h * ($this->source_width / $this->source_height));
										}
									}
									list($nw, $nh) = phpthumb_functions::TranslateWHbyAngle($this->w, $this->h, $this->ra);
									$nw = ((round($nw) != 0) ? round($nw) : '');
									$nh = ((round($nh) != 0) ? round($nh) : '');
									$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg($nw.'x'.$nh);
								}
							}
						}
					}

				} else {

					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') failed', __FILE__, __LINE__);
					if ($this->w || $this->h) {
						$exactDimensionsBang = (($this->iar && (intval($this->w) > 0) && (intval($this->h) > 0)) ? '!' : '');
						if ($IMuseExplicitImageOutputDimensions) {
							// unknown source aspect ratio, just put large number and hope IM figures it out
							$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg(($this->w ? $this->w : '9999').'x'.($this->h ? $this->h : '9999').$exactDimensionsBang);
						} else {
							$commandline .= ' -'.$IMresizeParameter.' '.escapeshellarg($this->w.'x'.$this->h.$exactDimensionsBang);
						}
					}

				}

				if ($this->ra) {
					$this->ra = intval($this->ra);
					if ($this->ImageMagickSwitchAvailable('rotate')) {
						if (!preg_match('#('.implode('|', $this->AlphaCapableFormats).')#i', $outputFormat) || phpthumb_functions::version_compare_replacement($this->ImageMagickVersion(), '6.3.7', '>=')) {
							$this->DebugMessage('Using ImageMagick rotate', __FILE__, __LINE__);
							$commandline .= ' -rotate '.escapeshellarg($this->ra);
							if (($this->ra % 90) != 0) {
								if (preg_match('#('.implode('|', $this->AlphaCapableFormats).')#i', $outputFormat)) {
									// alpha-capable format
									$commandline .= ' -background rgba(255,255,255,0)';
								} else {
									$commandline .= ' -background '.escapeshellarg('#'.($this->bg ? $this->bg : 'FFFFFF'));
								}
							}
							$this->ra = 0;
						} else {
							$this->DebugMessage('Not using ImageMagick rotate because alpha background buggy before v6.3.7', __FILE__, __LINE__);
						}
					} else {
						$this->DebugMessage('Not using ImageMagick rotate because not supported', __FILE__, __LINE__);
					}
				}

				$successfullyProcessedFilters = array();
				foreach ($this->fltr as $filterkey => $filtercommand) {
					@list($command, $parameter) = explode('|', $filtercommand, 2);
					switch ($command) {
						case 'brit':
							if ($this->ImageMagickSwitchAvailable('modulate')) {
								$commandline .= ' -modulate '.escapeshellarg((100 + intval($parameter)).',100,100');
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'cont':
							if ($this->ImageMagickSwitchAvailable('contrast')) {
								$contDiv10 = round(intval($parameter) / 10);
								if ($contDiv10 > 0) {
									$contDiv10 = min($contDiv10, 100);
									for ($i = 0; $i < $contDiv10; $i++) {
										$commandline .= ' -contrast'; // increase contrast by 10%
									}
								} elseif ($contDiv10 < 0) {
									$contDiv10 = max($contDiv10, -100);
									for ($i = $contDiv10; $i < 0; $i++) {
										$commandline .= ' +contrast'; // decrease contrast by 10%
									}
								} else {
									// do nothing
								}
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'ds':
							if ($this->ImageMagickSwitchAvailable(array('colorspace', 'modulate'))) {
								if ($parameter == 100) {
									$commandline .= ' -colorspace GRAY';
									$commandline .= ' -modulate 100,0,100';
								} else {
									$commandline .= ' -modulate '.escapeshellarg('100,'.(100 - intval($parameter)).',100');
								}
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'sat':
							if ($this->ImageMagickSwitchAvailable(array('colorspace', 'modulate'))) {
								if ($parameter == -100) {
									$commandline .= ' -colorspace GRAY';
									$commandline .= ' -modulate 100,0,100';
								} else {
									$commandline .= ' -modulate '.escapeshellarg('100,'.(100 + intval($parameter)).',100');
								}
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'gray':
							if ($this->ImageMagickSwitchAvailable(array('colorspace', 'modulate'))) {
								$commandline .= ' -colorspace GRAY';
								$commandline .= ' -modulate 100,0,100';
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'clr':
							if ($this->ImageMagickSwitchAvailable(array('fill', 'colorize'))) {
								@list($amount, $color) = explode('|', $parameter);
								$commandline .= ' -fill '.escapeshellarg('#'.preg_replace('#[^0-9A-F]#i', '', $color));
								$commandline .= ' -colorize '.escapeshellarg(min(max(intval($amount), 0), 100));
							}
							break;

						case 'sep':
							if ($this->ImageMagickSwitchAvailable('sepia-tone')) {
								@list($amount, $color) = explode('|', $parameter);
								$amount = ($amount ? $amount : 80);
								if (!$color) {
									$commandline .= ' -sepia-tone '.escapeshellarg(min(max(intval($amount), 0), 100).'%');
									$successfullyProcessedFilters[] = $filterkey;
								}
							}
							break;

						case 'gam':
							@list($amount) = explode('|', $parameter);
							$amount = min(max(floatval($amount), 0.001), 10);
							if (number_format($amount, 3) != '1.000') {
								if ($this->ImageMagickSwitchAvailable('gamma')) {
									$commandline .= ' -gamma '.escapeshellarg($amount);
									$successfullyProcessedFilters[] = $filterkey;
								}
							}
							break;

						case 'neg':
							if ($this->ImageMagickSwitchAvailable('negate')) {
								$commandline .= ' -negate';
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'th':
							@list($amount) = explode('|', $parameter);
							if ($this->ImageMagickSwitchAvailable(array('threshold', 'dither', 'monochrome'))) {
								$commandline .= ' -threshold '.escapeshellarg(round(min(max(intval($amount), 0), 255) / 2.55).'%');
								$commandline .= ' -dither';
								$commandline .= ' -monochrome';
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'rcd':
							if ($this->ImageMagickSwitchAvailable(array('colors', 'dither'))) {
								@list($colors, $dither) = explode('|', $parameter);
								$colors = ($colors                ?  (int) $colors : 256);
								$dither  = ((strlen($dither) > 0) ? (bool) $dither : true);
								$commandline .= ' -colors '.escapeshellarg(max($colors, 8)); // ImageMagick will otherwise fail with "cannot quantize to fewer than 8 colors"
								$commandline .= ($dither ? ' -dither' : ' +dither');
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'flip':
							if ($this->ImageMagickSwitchAvailable(array('flip', 'flop'))) {
								if (strpos(strtolower($parameter), 'x') !== false) {
									$commandline .= ' -flop';
								}
								if (strpos(strtolower($parameter), 'y') !== false) {
									$commandline .= ' -flip';
								}
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'edge':
							if ($this->ImageMagickSwitchAvailable('edge')) {
								$parameter = (!empty($parameter) ? $parameter : 2);
								$commandline .= ' -edge '.escapeshellarg(!empty($parameter) ? intval($parameter) : 1);
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'emb':
							if ($this->ImageMagickSwitchAvailable(array('emboss', 'negate'))) {
								$parameter = (!empty($parameter) ? $parameter : 2);
								$commandline .= ' -emboss '.escapeshellarg(intval($parameter));
								if ($parameter < 2) {
									$commandline .= ' -negate'; // ImageMagick negates the image for some reason with '-emboss 1';
								}
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'lvl':
							@list($band, $method, $threshold) = explode('|', $parameter);
							$band      = ($band ? preg_replace('#[^RGBA\\*]#', '', strtoupper($band))       : '*');
							$method    = ((strlen($method) > 0)    ? intval($method)                        :   2);
							$threshold = ((strlen($threshold) > 0) ? min(max(floatval($threshold), 0), 100) : 0.1);

							$band = preg_replace('#[^RGBA\\*]#', '', strtoupper($band));

							if (($method > 1) && !$this->ImageMagickSwitchAvailable(array('channel', 'contrast-stretch'))) {
								// Because ImageMagick processing happens before PHP-GD filters, and because some
								// clipping is involved in the "lvl" filter, if "lvl" happens before "wb" then the
								// "wb" filter will have (almost) no effect. Therefore, if "wb" is enabled then
								// force the "lvl" filter to be processed by GD, not ImageMagick.
								foreach ($this->fltr as $fltr_key => $fltr_value) {
									list($fltr_cmd) = explode('|', $fltr_value);
									if ($fltr_cmd == 'wb') {
										$this->DebugMessage('Setting "lvl" filter method to "0" (from "'.$method.'") because white-balance filter also enabled', __FILE__, __LINE__);
										$method = 0;
									}
								}
							}

							switch ($method) {
								case 0: // internal RGB
								case 1: // internal grayscale
									break;
								case 2: // ImageMagick "contrast-stretch"
									if ($this->ImageMagickSwitchAvailable('contrast-stretch')) {
										if ($band != '*') {
											$commandline .= ' -channel '.escapeshellarg(strtoupper($band));
										}
										$threshold = preg_replace('#[^0-9\\.]#', '', $threshold); // should be unneccesary, but just to be double-sure
										//$commandline .= ' -contrast-stretch '.escapeshellarg($threshold.'%');
										$commandline .= ' -contrast-stretch \''.$threshold.'%\'';
										if ($band != '*') {
											$commandline .= ' +channel';
										}
										$successfullyProcessedFilters[] = $filterkey;
									}
									break;
								case 3: // ImageMagick "normalize"
									if ($this->ImageMagickSwitchAvailable('normalize')) {
										if ($band != '*') {
											$commandline .= ' -channel '.escapeshellarg(strtoupper($band));
										}
										$commandline .= ' -normalize';
										if ($band != '*') {
											$commandline .= ' +channel';
										}
										$successfullyProcessedFilters[] = $filterkey;
									}
									break;
								default:
									$this->DebugMessage('unsupported method ('.$method.') for "lvl" filter', __FILE__, __LINE__);
									break;
							}
							if (isset($this->fltr[$filterkey]) && ($method > 1)) {
								$this->fltr[$filterkey] = $command.'|'.$band.'|0|'.$threshold;
								$this->DebugMessage('filter "lvl" remapped from method "'.$method.'" to method "0" because ImageMagick support is missing', __FILE__, __LINE__);
							}
							break;

						case 'wb':
							if ($this->ImageMagickSwitchAvailable(array('channel', 'contrast-stretch'))) {
								@list($threshold) = explode('|', $parameter);
								$threshold = (!empty($threshold) ? min(max(floatval($threshold), 0), 100) : 0.1);
								$threshold = preg_replace('#[^0-9\\.]#', '', $threshold); // should be unneccesary, but just to be double-sure
								//$commandline .= ' -channel R -contrast-stretch '.escapeshellarg($threshold.'%'); // doesn't work on Windows because most versions of PHP do not properly
								//$commandline .= ' -channel G -contrast-stretch '.escapeshellarg($threshold.'%'); // escape special characters (such as %) and just replace them with spaces
								//$commandline .= ' -channel B -contrast-stretch '.escapeshellarg($threshold.'%'); // https://bugs.php.net/bug.php?id=43261
								$commandline .= ' -channel R -contrast-stretch \''.$threshold.'%\'';
								$commandline .= ' -channel G -contrast-stretch \''.$threshold.'%\'';
								$commandline .= ' -channel B -contrast-stretch \''.$threshold.'%\'';
								$commandline .= ' +channel';
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'blur':
							if ($this->ImageMagickSwitchAvailable('blur')) {
								@list($radius) = explode('|', $parameter);
								$radius = (!empty($radius) ? min(max(intval($radius), 0), 25) : 1);
								$commandline .= ' -blur '.escapeshellarg($radius);
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'gblr':
							@list($radius) = explode('|', $parameter);
							$radius = (!empty($radius) ? min(max(intval($radius), 0), 25) : 1);
							// "-gaussian" changed to "-gaussian-blur" sometime around 2009
							if ($this->ImageMagickSwitchAvailable('gaussian-blur')) {
								$commandline .= ' -gaussian-blur '.escapeshellarg($radius);
								$successfullyProcessedFilters[] = $filterkey;
							} elseif ($this->ImageMagickSwitchAvailable('gaussian')) {
								$commandline .= ' -gaussian '.escapeshellarg($radius);
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'usm':
							if ($this->ImageMagickSwitchAvailable('unsharp')) {
								@list($amount, $radius, $threshold) = explode('|', $parameter);
								$amount    = ($amount            ? min(max(intval($radius), 0), 255) : 80);
								$radius    = ($radius            ? min(max(intval($radius), 0), 10)  : 0.5);
								$threshold = (strlen($threshold) ? min(max(intval($radius), 0), 50)  : 3);
								$commandline .= ' -unsharp '.escapeshellarg(number_format(($radius * 2) - 1, 2, '.', '').'x1+'.number_format($amount / 100, 2, '.', '').'+'.number_format($threshold / 100, 2, '.', ''));
								$successfullyProcessedFilters[] = $filterkey;
							}
							break;

						case 'bord':
							if ($this->ImageMagickSwitchAvailable(array('border', 'bordercolor', 'thumbnail', 'crop'))) {
								if (!$this->zc) {
									@list($width, $rX, $rY, $color) = explode('|', $parameter);
									$width = intval($width);
									$rX    = intval($rX);
									$rY    = intval($rY);
									if ($width && !$rX && !$rY) {
										if (!phpthumb_functions::IsHexColor($color)) {
											$color = ((!empty($this->bc) && phpthumb_functions::IsHexColor($this->bc)) ? $this->bc : '000000');
										}
										$commandline .= ' -border '.escapeshellarg(intval($width));
										$commandline .= ' -bordercolor '.escapeshellarg('#'.$color);

										if (preg_match('# \\-crop "([0-9]+)x([0-9]+)\\+0\\+0" #', $commandline, $matches)) {
											$commandline = str_replace(' -crop "'.$matches[1].'x'.$matches[2].'+0+0" ', ' -crop '.escapeshellarg(($matches[1] - (2 * $width)).'x'.($matches[2] - (2 * $width)).'+0+0').' ', $commandline);
										} elseif (preg_match('# \\-'.$IMresizeParameter.' "([0-9]+)x([0-9]+)" #', $commandline, $matches)) {
											$commandline = str_replace(' -'.$IMresizeParameter.' "'.$matches[1].'x'.$matches[2].'" ', ' -'.$IMresizeParameter.' '.escapeshellarg(($matches[1] - (2 * $width)).'x'.($matches[2] - (2 * $width))).' ', $commandline);
										}
										$successfullyProcessedFilters[] = $filterkey;
									}
								}
							}
							break;

						case 'crop':
							break;

						case 'sblr':
							break;

						case 'mean':
							break;

						case 'smth':
							break;

						case 'bvl':
							break;

						case 'wmi':
							break;

						case 'wmt':
							break;

						case 'over':
							break;

						case 'hist':
							break;

						case 'fram':
							break;

						case 'drop':
							break;

						case 'mask':
							break;

						case 'elip':
							break;

						case 'ric':
							break;

						case 'stc':
							break;

						case 'size':
							break;

						default:
							$this->DebugMessage('Unknown $this->fltr['.$filterkey.'] ('.$filtercommand.') -- deleting filter command', __FILE__, __LINE__);
							$successfullyProcessedFilters[] = $filterkey;
							break;
					}
					if (!isset($this->fltr[$filterkey])) {
						$this->DebugMessage('Processed $this->fltr['.$filterkey.'] ('.$filtercommand.') with ImageMagick', __FILE__, __LINE__);
					} else {
						$this->DebugMessage('Skipping $this->fltr['.$filterkey.'] ('.$filtercommand.') with ImageMagick', __FILE__, __LINE__);
					}
				}
				$this->DebugMessage('Remaining $this->fltr after ImageMagick: ('.$this->phpThumbDebugVarDump($this->fltr).')', __FILE__, __LINE__);
				if (count($this->fltr) > 0) {
					$this->useRawIMoutput = false;
				}

				if (preg_match('#jpe?g#i', $outputFormat) && $this->q) {
					if ($this->ImageMagickSwitchAvailable(array('quality', 'interlace'))) {
						$commandline .= ' -quality '.escapeshellarg($this->thumbnailQuality);
						if ($this->config_output_interlace) {
							// causes weird things with animated GIF... leave for JPEG only
							$commandline .= ' -interlace line '; // Use Line or Plane to create an interlaced PNG or GIF or progressive JPEG image
						}
					}
				}
				$commandline .= ' '.escapeshellarg(preg_replace('#[/\\\\]#', DIRECTORY_SEPARATOR, $this->sourceFilename).(($outputFormat == 'gif') ? '' : '['.intval($this->sfn).']')); // [0] means first frame of (GIF) animation, can be ignored
				$commandline .= ' '.$outputFormat.':'.escapeshellarg($IMtempfilename);
				if (!$this->iswindows) {
					$commandline .= ' 2>&1';
				}
				$this->DebugMessage('ImageMagick called as ('.$commandline.')', __FILE__, __LINE__);
				$IMresult = phpthumb_functions::SafeExec($commandline);
				clearstatcache();
				if (!@file_exists($IMtempfilename) || !@filesize($IMtempfilename)) {
					$this->FatalError('ImageMagick failed with message ('.trim($IMresult).')');
					$this->DebugMessage('ImageMagick failed with message ('.trim($IMresult).')', __FILE__, __LINE__);
					if ($this->iswindows && !$IMresult) {
						$this->DebugMessage('Check to make sure that PHP has read+write permissions to "'.dirname($IMtempfilename).'"', __FILE__, __LINE__);
					}

				} else {

					foreach ($successfullyProcessedFilters as $dummy => $filterkey) {
						unset($this->fltr[$filterkey]);
					}
					$this->IMresizedData = file_get_contents($IMtempfilename);
					$getimagesize_imresized = @GetImageSize($IMtempfilename);
					$this->DebugMessage('GetImageSize('.$IMtempfilename.') returned [w='.$getimagesize_imresized[0].';h='.$getimagesize_imresized[1].';f='.$getimagesize_imresized[2].']', __FILE__, __LINE__);
					if (($this->config_max_source_pixels > 0) && (($getimagesize_imresized[0] * $getimagesize_imresized[1]) > $this->config_max_source_pixels)) {
						$this->DebugMessage('skipping ImageMagickThumbnailToGD::'.$ImageCreateFunction.'() because IM output is too large ('.$getimagesize_imresized[0].'x'.$getimagesize_imresized[0].' = '.($getimagesize_imresized[0] * $getimagesize_imresized[1]).' > '.$this->config_max_source_pixels.')', __FILE__, __LINE__);
					} elseif (function_exists(@$ImageCreateFunction) && ($this->gdimg_source = @$ImageCreateFunction($IMtempfilename))) {
						$this->source_width  = ImageSX($this->gdimg_source);
						$this->source_height = ImageSY($this->gdimg_source);
						$this->DebugMessage('ImageMagickThumbnailToGD::'.$ImageCreateFunction.'() succeeded, $this->gdimg_source is now ('.$this->source_width.'x'.$this->source_height.')', __FILE__, __LINE__);
						$this->DebugMessage('ImageMagickThumbnailToGD() returning $this->IMresizedData ('.strlen($this->IMresizedData).' bytes)', __FILE__, __LINE__);
					} else {
						$this->useRawIMoutput = true;
						$this->DebugMessage('$this->useRawIMoutput set to TRUE because '.@$ImageCreateFunction.'('.$IMtempfilename.') failed', __FILE__, __LINE__);
					}
					return true;

				}
				if (file_exists($IMtempfilename)) {
					$this->DebugMessage('deleting "'.$IMtempfilename.'"', __FILE__, __LINE__);
					@unlink($IMtempfilename);
				}

			} elseif ($this->issafemode) {
				$this->DebugMessage('ImageMagickThumbnailToGD() aborting because PHP safe_mode is enabled and phpThumb_tempnam() failed', __FILE__, __LINE__);
				$this->useRawIMoutput = false;
			} else {
				if (file_exists($IMtempfilename)) {
					$this->DebugMessage('deleting "'.$IMtempfilename.'"', __FILE__, __LINE__);
					@unlink($IMtempfilename);
				}
				$this->DebugMessage('ImageMagickThumbnailToGD() aborting, phpThumb_tempnam() failed', __FILE__, __LINE__);
			}
		} else {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because ImageMagickCommandlineBase() failed', __FILE__, __LINE__);
		}
		$this->useRawIMoutput = false;
		return false;
	}


	function Rotate() {
		if ($this->ra || $this->ar) {
			if (!function_exists('ImageRotate')) {
				$this->DebugMessage('!function_exists(ImageRotate)', __FILE__, __LINE__);
				return false;
			}
			if (!include_once(dirname(__FILE__).'/phpthumb.filters.php')) {
				$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.filters.php" which is required for applying filters ('.implode(';', $this->fltr).')', __FILE__, __LINE__);
				return false;
			}

			$this->config_background_hexcolor = ($this->bg ? $this->bg : $this->config_background_hexcolor);
			if (!phpthumb_functions::IsHexColor($this->config_background_hexcolor)) {
				return $this->ErrorImage('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "bg"');
			}

			$rotate_angle = 0;
			if ($this->ra) {

				$rotate_angle = floatval($this->ra);

			} else {

				if ($this->ar == 'x') {
					if (phpthumb_functions::version_compare_replacement(phpversion(), '4.2.0', '>=')) {
						if ($this->sourceFilename) {
							if (function_exists('exif_read_data')) {
								if ($exif_data = @exif_read_data($this->sourceFilename, 'IFD0')) {
									// http://sylvana.net/jpegcrop/exif_orientation.html
									switch (@$exif_data['Orientation']) {
										case 1:
											$rotate_angle = 0;
											break;
										case 3:
											$rotate_angle = 180;
											break;
										case 6:
											$rotate_angle = 270;
											break;
										case 8:
											$rotate_angle = 90;
											break;

										default:
											$this->DebugMessage('EXIF auto-rotate failed because unknown $exif_data[Orientation] "'.@$exif_data['Orientation'].'"', __FILE__, __LINE__);
											return false;
											break;
									}
									$this->DebugMessage('EXIF auto-rotate set to '.$rotate_angle.' degrees ($exif_data[Orientation] = "'.@$exif_data['Orientation'].'")', __FILE__, __LINE__);
								} else {
									$this->DebugMessage('failed: exif_read_data('.$this->sourceFilename.')', __FILE__, __LINE__);
									return false;
								}
							} else {
								$this->DebugMessage('!function_exists(exif_read_data)', __FILE__, __LINE__);
								return false;
							}
						} else {
							$this->DebugMessage('Cannot auto-rotate from EXIF data because $this->sourceFilename is empty', __FILE__, __LINE__);
							return false;
						}
					} else {
						$this->DebugMessage('Cannot auto-rotate from EXIF data because PHP is less than v4.2.0 ('.phpversion().')', __FILE__, __LINE__);
						return false;
					}
				} elseif (($this->ar == 'l') && ($this->source_height > $this->source_width)) {
					$rotate_angle = 270;
				} elseif (($this->ar == 'L') && ($this->source_height > $this->source_width)) {
					$rotate_angle = 90;
				} elseif (($this->ar == 'p') && ($this->source_width > $this->source_height)) {
					$rotate_angle = 90;
				} elseif (($this->ar == 'P') && ($this->source_width > $this->source_height)) {
					$rotate_angle = 270;
				}

			}
			if ($rotate_angle % 90) {
				$this->is_alpha = true;
			}
			phpthumb_filters::ImprovedImageRotate($this->gdimg_source, $rotate_angle, $this->config_background_hexcolor, $this->bg);
			$this->source_width  = ImageSX($this->gdimg_source);
			$this->source_height = ImageSY($this->gdimg_source);
		}
		return true;
	}


	function FixedAspectRatio() {
		// optional fixed-dimension images (regardless of aspect ratio)

		if (!$this->far) {
			// do nothing
			return true;
		}

		if (!$this->w || !$this->h) {
			return false;
		}
		$this->thumbnail_width  = $this->w;
		$this->thumbnail_height = $this->h;
		$this->is_alpha = true;
		if ($this->thumbnail_image_width >= $this->thumbnail_width) {

			if ($this->w) {
				$aspectratio = $this->thumbnail_image_height / $this->thumbnail_image_width;
				$this->thumbnail_image_height = round($this->thumbnail_image_width * $aspectratio);
				$this->thumbnail_height = ($this->h ? $this->h : $this->thumbnail_image_height);
			} elseif ($this->thumbnail_image_height < $this->thumbnail_height) {
				$this->thumbnail_image_height = $this->thumbnail_height;
				$this->thumbnail_image_width  = round($this->thumbnail_image_height / $aspectratio);
			}

		} else {
			if ($this->h) {
				$aspectratio = $this->thumbnail_image_width / $this->thumbnail_image_height;
				$this->thumbnail_image_width = round($this->thumbnail_image_height * $aspectratio);
			} elseif ($this->thumbnail_image_width < $this->thumbnail_width) {
				$this->thumbnail_image_width = $this->thumbnail_width;
				$this->thumbnail_image_height  = round($this->thumbnail_image_width / $aspectratio);
			}

		}
		return true;
	}


	function OffsiteDomainIsAllowed($hostname, $allowed_domains) {
		static $domain_is_allowed = array();
		$hostname = strtolower($hostname);
		if (!isset($domain_is_allowed[$hostname])) {
			$domain_is_allowed[$hostname] = false;
			foreach ($allowed_domains as $valid_domain) {
				$starpos = strpos($valid_domain, '*');
				if ($starpos !== false) {
					$valid_domain = substr($valid_domain, $starpos + 1);
					if (preg_match('#'.preg_quote($valid_domain).'$#', $hostname)) {
						$domain_is_allowed[$hostname] = true;
						break;
					}
				} else {
					if (strtolower($valid_domain) === $hostname) {
						$domain_is_allowed[$hostname] = true;
						break;
					}
				}
			}
		}
		return $domain_is_allowed[$hostname];
	}


	function AntiOffsiteLinking() {
		// Optional anti-offsite hijacking of the thumbnail script
		$allow = true;
		if ($allow && $this->config_nooffsitelink_enabled && (@$_SERVER['HTTP_REFERER'] || $this->config_nooffsitelink_require_refer)) {
			$this->DebugMessage('AntiOffsiteLinking() checking $_SERVER[HTTP_REFERER] "'.@$_SERVER['HTTP_REFERER'].'"', __FILE__, __LINE__);
			foreach ($this->config_nooffsitelink_valid_domains as $key => $valid_domain) {
				// $_SERVER['HTTP_HOST'] contains the port number, so strip it out here to make default configuration work
				list($clean_domain) = explode(':', $valid_domain);
				$this->config_nooffsitelink_valid_domains[$key] = $clean_domain;
			}
			$parsed_url = phpthumb_functions::ParseURLbetter(@$_SERVER['HTTP_REFERER']);
			if (!$this->OffsiteDomainIsAllowed(@$parsed_url['host'], $this->config_nooffsitelink_valid_domains)) {
				$allow = false;
				$erase   = $this->config_nooffsitelink_erase_image;
				$message = $this->config_nooffsitelink_text_message;
$this->ErrorImage('AntiOffsiteLinking() - "'.@$parsed_url['host'].'" is NOT in $this->config_nooffsitelink_valid_domains ('.implode(';', $this->config_nooffsitelink_valid_domains).')');
exit;
				$this->DebugMessage('AntiOffsiteLinking() - "'.@$parsed_url['host'].'" is NOT in $this->config_nooffsitelink_valid_domains ('.implode(';', $this->config_nooffsitelink_valid_domains).')', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('AntiOffsiteLinking() - "'.@$parsed_url['host'].'" is in $this->config_nooffsitelink_valid_domains ('.implode(';', $this->config_nooffsitelink_valid_domains).')', __FILE__, __LINE__);
			}
		}

		if ($allow && $this->config_nohotlink_enabled && preg_match('#^(f|ht)tps?\://#i', $this->src)) {
			$parsed_url = phpthumb_functions::ParseURLbetter($this->src);
			//if (!phpthumb_functions::CaseInsensitiveInArray(@$parsed_url['host'], $this->config_nohotlink_valid_domains)) {
			if ($this->OffsiteDomainIsAllowed(@$parsed_url['host'], $this->config_nohotlink_valid_domains)) {
				// This domain is not allowed
				$allow = false;
				$erase   = $this->config_nohotlink_erase_image;
				$message = $this->config_nohotlink_text_message;
				$this->DebugMessage('AntiOffsiteLinking() - "'.$parsed_url['host'].'" is NOT in $this->config_nohotlink_valid_domains ('.implode(';', $this->config_nohotlink_valid_domains).')', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('AntiOffsiteLinking() - "'.$parsed_url['host'].'" is in $this->config_nohotlink_valid_domains ('.implode(';', $this->config_nohotlink_valid_domains).')', __FILE__, __LINE__);
			}
		}

		if ($allow) {
			$this->DebugMessage('AntiOffsiteLinking() says this is allowed', __FILE__, __LINE__);
			return true;
		}

		if (!phpthumb_functions::IsHexColor($this->config_error_bgcolor)) {
			return $this->ErrorImage('Invalid hex color string "'.$this->config_error_bgcolor.'" for $this->config_error_bgcolor');
		}
		if (!phpthumb_functions::IsHexColor($this->config_error_textcolor)) {
			return $this->ErrorImage('Invalid hex color string "'.$this->config_error_textcolor.'" for $this->config_error_textcolor');
		}
		if ($erase) {

			return $this->ErrorImage($message, $this->thumbnail_width, $this->thumbnail_height, $this->config_error_bgcolor, $this->config_error_textcolor, $this->config_error_fontsize);

		} else {

			$this->config_nooffsitelink_watermark_src = $this->ResolveFilenameToAbsolute($this->config_nooffsitelink_watermark_src);
			if (is_file($this->config_nooffsitelink_watermark_src)) {

				if (!include_once(dirname(__FILE__).'/phpthumb.filters.php')) {
					$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.filters.php" which is required for applying watermark', __FILE__, __LINE__);
					return false;
				}
				$watermark_img = $this->ImageCreateFromStringReplacement(file_get_contents($this->config_nooffsitelink_watermark_src));
				$phpthumbFilters = new phpthumb_filters();
				$phpthumbFilters->phpThumbObject = &$this;
				$opacity = 50;
				$margin  = 5;
				$phpthumbFilters->WatermarkOverlay($this->gdimg_output, $watermark_img, '*', $opacity, $margin);
				ImageDestroy($watermark_img);
				unset($phpthumbFilters);

			} else {

				$nohotlink_text_array = explode("\n", wordwrap($message, floor($this->thumbnail_width / ImageFontWidth($this->config_error_fontsize)), "\n"));
				$nohotlink_text_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_output, $this->config_error_textcolor);

				$topoffset = round(($this->thumbnail_height - (count($nohotlink_text_array) * ImageFontHeight($this->config_error_fontsize))) / 2);

				$rowcounter = 0;
				$this->DebugMessage('AntiOffsiteLinking() writing '.count($nohotlink_text_array).' lines of text "'.$message.'" (in #'.$this->config_error_textcolor.') on top of image', __FILE__, __LINE__);
				foreach ($nohotlink_text_array as $textline) {
					$leftoffset = max(0, round(($this->thumbnail_width - (strlen($textline) * ImageFontWidth($this->config_error_fontsize))) / 2));
					ImageString($this->gdimg_output, $this->config_error_fontsize, $leftoffset, $topoffset + ($rowcounter++ * ImageFontHeight($this->config_error_fontsize)), $textline, $nohotlink_text_color);
				}

			}

		}
		return true;
	}


	function AlphaChannelFlatten() {
		if (!$this->is_alpha) {
			// image doesn't have alpha transparency, no need to flatten
			$this->DebugMessage('skipping AlphaChannelFlatten() because !$this->is_alpha', __FILE__, __LINE__);
			return false;
		}
		switch ($this->thumbnailFormat) {
			case 'png':
			case 'ico':
				// image has alpha transparency, but output as PNG or ICO which can handle it
				$this->DebugMessage('skipping AlphaChannelFlatten() because ($this->thumbnailFormat == "'.$this->thumbnailFormat.'")', __FILE__, __LINE__);
				return false;
				break;

			case 'gif':
				// image has alpha transparency, but output as GIF which can handle only single-color transparency
				$CurrentImageColorTransparent = ImageColorTransparent($this->gdimg_output);
				if ($CurrentImageColorTransparent == -1) {
					// no transparent color defined

					if (phpthumb_functions::gd_version() < 2.0) {
						$this->DebugMessage('AlphaChannelFlatten() failed because GD version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
						return false;
					}

					if ($img_alpha_mixdown_dither = @ImageCreateTrueColor(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output))) {

						for ($i = 0; $i <= 255; $i++) {
							$dither_color[$i] = ImageColorAllocate($img_alpha_mixdown_dither, $i, $i, $i);
						}

						// scan through current truecolor image copy alpha channel to temp image as grayscale
						for ($x = 0; $x < $this->thumbnail_width; $x++) {
							for ($y = 0; $y < $this->thumbnail_height; $y++) {
								$PixelColor = phpthumb_functions::GetPixelColor($this->gdimg_output, $x, $y);
								ImageSetPixel($img_alpha_mixdown_dither, $x, $y, $dither_color[($PixelColor['alpha'] * 2)]);
							}
						}

						// dither alpha channel grayscale version down to 2 colors
						ImageTrueColorToPalette($img_alpha_mixdown_dither, true, 2);

						// reduce color palette to 256-1 colors (leave one palette position for transparent color)
						ImageTrueColorToPalette($this->gdimg_output, true, 255);

						// allocate a new color for transparent color index
						$TransparentColor = ImageColorAllocate($this->gdimg_output, 1, 254, 253);
						ImageColorTransparent($this->gdimg_output, $TransparentColor);

						// scan through alpha channel image and note pixels with >50% transparency
						$TransparentPixels = array();
						for ($x = 0; $x < $this->thumbnail_width; $x++) {
							for ($y = 0; $y < $this->thumbnail_height; $y++) {
								$AlphaChannelPixel = phpthumb_functions::GetPixelColor($img_alpha_mixdown_dither, $x, $y);
								if ($AlphaChannelPixel['red'] > 127) {
									ImageSetPixel($this->gdimg_output, $x, $y, $TransparentColor);
								}
							}
						}
						ImageDestroy($img_alpha_mixdown_dither);

						$this->DebugMessage('AlphaChannelFlatten() set image to 255+1 colors with transparency for GIF output', __FILE__, __LINE__);
						return true;

					} else {
						$this->DebugMessage('AlphaChannelFlatten() failed ImageCreate('.ImageSX($this->gdimg_output).', '.ImageSY($this->gdimg_output).')', __FILE__, __LINE__);
						return false;
					}

				} else {
					// a single transparent color already defined, leave as-is
					$this->DebugMessage('skipping AlphaChannelFlatten() because ($this->thumbnailFormat == "'.$this->thumbnailFormat.'") and ImageColorTransparent returned "'.$CurrentImageColorTransparent.'"', __FILE__, __LINE__);
					return true;
				}
				break;
		}
		$this->DebugMessage('continuing AlphaChannelFlatten() for output format "'.$this->thumbnailFormat.'"', __FILE__, __LINE__);
		// image has alpha transparency, and is being output in a format that doesn't support it -- flatten
		if ($gdimg_flatten_temp = phpthumb_functions::ImageCreateFunction($this->thumbnail_width, $this->thumbnail_height)) {

			$this->config_background_hexcolor = ($this->bg ? $this->bg : $this->config_background_hexcolor);
			if (!phpthumb_functions::IsHexColor($this->config_background_hexcolor)) {
				return $this->ErrorImage('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "bg"');
			}
			$background_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_output, $this->config_background_hexcolor);
			ImageFilledRectangle($gdimg_flatten_temp, 0, 0, $this->thumbnail_width, $this->thumbnail_height, $background_color);
			ImageCopy($gdimg_flatten_temp, $this->gdimg_output, 0, 0, 0, 0, $this->thumbnail_width, $this->thumbnail_height);

			ImageAlphaBlending($this->gdimg_output, true);
			ImageSaveAlpha($this->gdimg_output, false);
			ImageColorTransparent($this->gdimg_output, -1);
			ImageCopy($this->gdimg_output, $gdimg_flatten_temp, 0, 0, 0, 0, $this->thumbnail_width, $this->thumbnail_height);

			ImageDestroy($gdimg_flatten_temp);
			return true;

		} else {
			$this->DebugMessage('ImageCreateFunction() failed', __FILE__, __LINE__);
		}
		return false;
	}


	function ApplyFilters() {
		if ($this->fltr && is_array($this->fltr)) {
			if (!include_once(dirname(__FILE__).'/phpthumb.filters.php')) {
				$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.filters.php" which is required for applying filters ('.implode(';', $this->fltr).')', __FILE__, __LINE__);
				return false;
			}
			$phpthumbFilters = new phpthumb_filters();
			$phpthumbFilters->phpThumbObject = &$this;
			foreach ($this->fltr as $filtercommand) {
				@list($command, $parameter) = explode('|', $filtercommand, 2);
				$this->DebugMessage('Attempting to process filter command "'.$command.'('.$parameter.')"', __FILE__, __LINE__);
				switch ($command) {
					case 'brit': // Brightness
						$phpthumbFilters->Brightness($this->gdimg_output, $parameter);
						break;

					case 'cont': // Contrast
						$phpthumbFilters->Contrast($this->gdimg_output, $parameter);
						break;

					case 'ds': // Desaturation
						$phpthumbFilters->Desaturate($this->gdimg_output, $parameter, '');
						break;

					case 'sat': // Saturation
						$phpthumbFilters->Saturation($this->gdimg_output, $parameter, '');
						break;

					case 'gray': // Grayscale
						$phpthumbFilters->Grayscale($this->gdimg_output);
						break;

					case 'clr': // Colorize
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Colorize() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($amount, $color) = explode('|', $parameter, 2);
						$phpthumbFilters->Colorize($this->gdimg_output, $amount, $color);
						break;

					case 'sep': // Sepia
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Sepia() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($amount, $color) = explode('|', $parameter, 2);
						$phpthumbFilters->Sepia($this->gdimg_output, $amount, $color);
						break;

					case 'gam': // Gamma correction
						$phpthumbFilters->Gamma($this->gdimg_output, $parameter);
						break;

					case 'neg': // Negative colors
						$phpthumbFilters->Negative($this->gdimg_output);
						break;

					case 'th': // Threshold
						$phpthumbFilters->Threshold($this->gdimg_output, $parameter);
						break;

					case 'rcd': // ReduceColorDepth
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping ReduceColorDepth() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($colors, $dither) = explode('|', $parameter, 2);
						$colors = ($colors                ?  (int) $colors : 256);
						$dither  = ((strlen($dither) > 0) ? (bool) $dither : true);
						$phpthumbFilters->ReduceColorDepth($this->gdimg_output, $colors, $dither);
						break;

					case 'flip': // Flip
						$phpthumbFilters->Flip($this->gdimg_output, (strpos(strtolower($parameter), 'x') !== false), (strpos(strtolower($parameter), 'y') !== false));
						break;

					case 'edge': // EdgeDetect
						$phpthumbFilters->EdgeDetect($this->gdimg_output);
						break;

					case 'emb': // Emboss
						$phpthumbFilters->Emboss($this->gdimg_output);
						break;

					case 'bvl': // Bevel
						@list($width, $color1, $color2) = explode('|', $parameter, 3);
						$phpthumbFilters->Bevel($this->gdimg_output, $width, $color1, $color2);
						break;

					case 'lvl': // autoLevels
						@list($band, $method, $threshold) = explode('|', $parameter, 3);
						$band      = ($band ? preg_replace('#[^RGBA\\*]#', '', strtoupper($band)) : '*');
						$method    = ((strlen($method) > 0)    ? intval($method)                  :   2);
						$threshold = ((strlen($threshold) > 0) ? floatval($threshold)             : 0.1);

						$phpthumbFilters->HistogramStretch($this->gdimg_output, $band, $method, $threshold);
						break;

					case 'wb': // WhiteBalance
						$phpthumbFilters->WhiteBalance($this->gdimg_output, $parameter);
						break;

					case 'hist': // Histogram overlay
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping HistogramOverlay() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($bands, $colors, $width, $height, $alignment, $opacity, $margin_x, $margin_y) = explode('|', $parameter, 8);
						$bands     = ($bands     ? $bands     :  '*');
						$colors    = ($colors    ? $colors    :   '');
						$width     = ($width     ? $width     : 0.25);
						$height    = ($height    ? $height    : 0.25);
						$alignment = ($alignment ? $alignment : 'BR');
						$opacity   = ($opacity   ? $opacity   :   50);
						$margin_x  = ($margin_x  ? $margin_x  :    5);
						$margin_y  = $margin_y; // just to note it wasn't forgotten, but let the value always pass unchanged
						$phpthumbFilters->HistogramOverlay($this->gdimg_output, $bands, $colors, $width, $height, $alignment, $opacity, $margin_x, $margin_y);
						break;

					case 'fram': // Frame
						@list($frame_width, $edge_width, $color_frame, $color1, $color2) = explode('|', $parameter, 5);
						$phpthumbFilters->Frame($this->gdimg_output, $frame_width, $edge_width, $color_frame, $color1, $color2);
						break;

					case 'drop': // DropShadow
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping DropShadow() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$this->is_alpha = true;
						@list($distance, $width, $color, $angle, $fade) = explode('|', $parameter, 5);
						$phpthumbFilters->DropShadow($this->gdimg_output, $distance, $width, $color, $angle, $fade);
						break;

					case 'mask': // Mask cropping
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Mask() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$mask_filename = $this->ResolveFilenameToAbsolute($parameter);
						if (@is_readable($mask_filename) && ($fp_mask = @fopen($mask_filename, 'rb'))) {
							$MaskImageData = '';
							do {
								$buffer = fread($fp_mask, 8192);
								$MaskImageData .= $buffer;
							} while (strlen($buffer) > 0);
							fclose($fp_mask);
							if ($gdimg_mask = $this->ImageCreateFromStringReplacement($MaskImageData)) {
								$this->is_alpha = true;
								$phpthumbFilters->ApplyMask($gdimg_mask, $this->gdimg_output);
								ImageDestroy($gdimg_mask);
							} else {
								$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$mask_filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('Cannot open mask file "'.$mask_filename.'"', __FILE__, __LINE__);
						}
						break;

					case 'elip': // Elipse cropping
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Elipse() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$this->is_alpha = true;
						$phpthumbFilters->Elipse($this->gdimg_output);
						break;

					case 'ric': // RoundedImageCorners
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping RoundedImageCorners() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						@list($radius_x, $radius_y) = explode('|', $parameter, 2);
						if (($radius_x < 1) || ($radius_y < 1)) {
							$this->DebugMessage('Skipping RoundedImageCorners('.$radius_x.', '.$radius_y.') because x/y radius is less than 1', __FILE__, __LINE__);
							break;
						}
						$this->is_alpha = true;
						$phpthumbFilters->RoundedImageCorners($this->gdimg_output, $radius_x, $radius_y);
						break;

					case 'crop': // Crop
						@list($left, $right, $top, $bottom) = explode('|', $parameter, 4);
						$phpthumbFilters->Crop($this->gdimg_output, $left, $right, $top, $bottom);
						break;

					case 'bord': // Border
						@list($border_width, $radius_x, $radius_y, $hexcolor_border) = explode('|', $parameter, 4);
						$this->is_alpha = true;
						$phpthumbFilters->ImageBorder($this->gdimg_output, $border_width, $radius_x, $radius_y, $hexcolor_border);
						break;

					case 'over': // Overlay
						@list($filename, $underlay, $margin, $opacity) = explode('|', $parameter, 4);
						$underlay = (bool) ($underlay              ? $underlay : false);
						$margin   =        ((strlen($margin)  > 0) ? $margin   : ($underlay ? 0.1 : 0.0));
						$opacity  =        ((strlen($opacity) > 0) ? $opacity  : 100);
						if (($margin > 0) && ($margin < 1)) {
							$margin = min(0.499, $margin);
						} elseif (($margin > -1) && ($margin < 0)) {
							$margin = max(-0.499, $margin);
						}

						$filename = $this->ResolveFilenameToAbsolute($filename);
						if (@is_readable($filename) && ($fp_watermark = @fopen($filename, 'rb'))) {
							$WatermarkImageData = '';
							do {
								$buffer = fread($fp_watermark, 8192);
								$WatermarkImageData .= $buffer;
							} while (strlen($buffer) > 0);
							fclose($fp_watermark);
							if ($img_watermark = $this->ImageCreateFromStringReplacement($WatermarkImageData)) {
								if ($margin < 1) {
									$resized_x = max(1, ImageSX($this->gdimg_output) - round(2 * (ImageSX($this->gdimg_output) * $margin)));
									$resized_y = max(1, ImageSY($this->gdimg_output) - round(2 * (ImageSY($this->gdimg_output) * $margin)));
								} else {
									$resized_x = max(1, ImageSX($this->gdimg_output) - round(2 * $margin));
									$resized_y = max(1, ImageSY($this->gdimg_output) - round(2 * $margin));
								}

								if ($underlay) {

									if ($img_watermark_resized = phpthumb_functions::ImageCreateFunction(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output))) {
										ImageAlphaBlending($img_watermark_resized, false);
										ImageSaveAlpha($img_watermark_resized, true);
										$this->ImageResizeFunction($img_watermark_resized, $img_watermark, 0, 0, 0, 0, ImageSX($img_watermark_resized), ImageSY($img_watermark_resized), ImageSX($img_watermark), ImageSY($img_watermark));
										if ($img_source_resized = phpthumb_functions::ImageCreateFunction($resized_x, $resized_y)) {
											ImageAlphaBlending($img_source_resized, false);
											ImageSaveAlpha($img_source_resized, true);
											$this->ImageResizeFunction($img_source_resized, $this->gdimg_output, 0, 0, 0, 0, ImageSX($img_source_resized), ImageSY($img_source_resized), ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
											$phpthumbFilters->WatermarkOverlay($img_watermark_resized, $img_source_resized, 'C', $opacity, $margin);
											ImageCopy($this->gdimg_output, $img_watermark_resized, 0, 0, 0, 0, ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
										} else {
											$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.$resized_x.', '.$resized_y.')', __FILE__, __LINE__);
										}
										ImageDestroy($img_watermark_resized);
									} else {
										$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.ImageSX($this->gdimg_output).', '.ImageSY($this->gdimg_output).')', __FILE__, __LINE__);
									}

								} else { // overlay

									if ($img_watermark_resized = phpthumb_functions::ImageCreateFunction($resized_x, $resized_y)) {
										ImageAlphaBlending($img_watermark_resized, false);
										ImageSaveAlpha($img_watermark_resized, true);
										$this->ImageResizeFunction($img_watermark_resized, $img_watermark, 0, 0, 0, 0, ImageSX($img_watermark_resized), ImageSY($img_watermark_resized), ImageSX($img_watermark), ImageSY($img_watermark));
										$phpthumbFilters->WatermarkOverlay($this->gdimg_output, $img_watermark_resized, 'C', $opacity, $margin);
										ImageDestroy($img_watermark_resized);
									} else {
										$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.$resized_x.', '.$resized_y.')', __FILE__, __LINE__);
									}

								}
								ImageDestroy($img_watermark);

							} else {
								$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('Cannot open overlay file "'.$filename.'"', __FILE__, __LINE__);
						}
						break;

					case 'wmi': // WaterMarkImage
						@list($filename, $alignment, $opacity, $margin['x'], $margin['y'], $rotate_angle) = explode('|', $parameter, 6);
						// $margin can be pixel margin or percent margin if $alignment is text, or max width/height if $alignment is position like "50x75"
						$alignment    = ($alignment            ? $alignment            : 'BR');
						$opacity      = (strlen($opacity)      ? intval($opacity)      : 50);
						$rotate_angle = (strlen($rotate_angle) ? intval($rotate_angle) : 0);
						if (!preg_match('#^([0-9\\.\\-]*)x([0-9\\.\\-]*)$#i', $alignment, $matches)) {
							$margins = array('x', 'y');
							foreach ($margins as $xy) {
								$margin[$xy] = (strlen($margin[$xy]) ? $margin[$xy] : 5);
								if (($margin[$xy] > 0) && ($margin[$xy] < 1)) {
									$margin[$xy] = min(0.499, $margin[$xy]);
								} elseif (($margin[$xy] > -1) && ($margin[$xy] < 0)) {
									$margin[$xy] = max(-0.499, $margin[$xy]);
								}
							}
						}

						$filename = $this->ResolveFilenameToAbsolute($filename);
						if (@is_readable($filename)) {
							if ($img_watermark = $this->ImageCreateFromFilename($filename)) {
								if ($rotate_angle !== 0) {
									$phpthumbFilters->ImprovedImageRotate($img_watermark, $rotate_angle);
								}
								if (preg_match('#^([0-9\\.\\-]*)x([0-9\\.\\-]*)$#i', $alignment, $matches)) {
									$watermark_max_width  = intval($margin['x'] ? $margin['x'] : ImageSX($img_watermark));
									$watermark_max_height = intval($margin['y'] ? $margin['y'] : ImageSY($img_watermark));
									$scale = phpthumb_functions::ScaleToFitInBox(ImageSX($img_watermark), ImageSY($img_watermark), $watermark_max_width, $watermark_max_height, true, true);
									$this->DebugMessage('Scaling watermark by a factor of '.number_format($scale, 4), __FILE__, __LINE__);
									if (($scale > 1) || ($scale < 1)) {
										if ($img_watermark2 = phpthumb_functions::ImageCreateFunction($scale * ImageSX($img_watermark), $scale * ImageSY($img_watermark))) {
											ImageAlphaBlending($img_watermark2, false);
											ImageSaveAlpha($img_watermark2, true);
											$this->ImageResizeFunction($img_watermark2, $img_watermark, 0, 0, 0, 0, ImageSX($img_watermark2), ImageSY($img_watermark2), ImageSX($img_watermark), ImageSY($img_watermark));
											$img_watermark = $img_watermark2;
										} else {
											$this->DebugMessage('ImageCreateFunction('.($scale * ImageSX($img_watermark)).', '.($scale * ImageSX($img_watermark)).') failed', __FILE__, __LINE__);
										}
									}
									$watermark_dest_x = round($matches[1] - (ImageSX($img_watermark) / 2));
									$watermark_dest_y = round($matches[2] - (ImageSY($img_watermark) / 2));
									$alignment = $watermark_dest_x.'x'.$watermark_dest_y;
								}
								$phpthumbFilters->WatermarkOverlay($this->gdimg_output, $img_watermark, $alignment, $opacity, $margin['x'], $margin['y']);
								ImageDestroy($img_watermark);
								if (isset($img_watermark2) && is_resource($img_watermark2)) {
									ImageDestroy($img_watermark2);
								}
							} else {
								$this->DebugMessage('ImageCreateFromFilename() failed for "'.$filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('!is_readable('.$filename.')', __FILE__, __LINE__);
						}
						break;

					case 'wmt': // WaterMarkText
						@list($text, $size, $alignment, $hex_color, $ttffont, $opacity, $margin, $angle, $bg_color, $bg_opacity, $fillextend) = explode('|', $parameter, 11);
						$text       = ($text            ? $text       : '');
						$size       = ($size            ? $size       : 3);
						$alignment  = ($alignment       ? $alignment  : 'BR');
						$hex_color  = ($hex_color       ? $hex_color  : '000000');
						$ttffont    = ($ttffont         ? $ttffont    : '');
						$opacity    = (strlen($opacity) ? $opacity    : 50);
						$margin     = (strlen($margin)  ? $margin     : 5);
						$angle      = (strlen($angle)   ? $angle      : 0);
						$bg_color   = ($bg_color        ? $bg_color   : false);
						$bg_opacity = ($bg_opacity      ? $bg_opacity : 0);
						$fillextend = ($fillextend      ? $fillextend : '');

						if (basename($ttffont) == $ttffont) {
							$ttffont = realpath($this->config_ttf_directory.DIRECTORY_SEPARATOR.$ttffont);
						} else {
							$ttffont = $this->ResolveFilenameToAbsolute($ttffont);
						}
						$phpthumbFilters->WatermarkText($this->gdimg_output, $text, $size, $alignment, $hex_color, $ttffont, $opacity, $margin, $angle, $bg_color, $bg_opacity, $fillextend);
						break;

					case 'blur': // Blur
						@list($radius) = explode('|', $parameter, 1);
						$radius = ($radius ? $radius : 1);
						if (phpthumb_functions::gd_version() >= 2) {
							$phpthumbFilters->Blur($this->gdimg_output, $radius);
						} else {
							$this->DebugMessage('Skipping Blur() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
						}
						break;

					case 'gblr': // Gaussian Blur
						$phpthumbFilters->BlurGaussian($this->gdimg_output);
						break;

					case 'sblr': // Selective Blur
						$phpthumbFilters->BlurSelective($this->gdimg_output);
						break;

					case 'mean': // MeanRemoval blur
						$phpthumbFilters->MeanRemoval($this->gdimg_output);
						break;

					case 'smth': // Smooth blur
						$phpthumbFilters->Smooth($this->gdimg_output, $parameter);
						break;

					case 'usm': // UnSharpMask sharpening
						@list($amount, $radius, $threshold) = explode('|', $parameter, 3);
						$amount    = ($amount            ? $amount    : 80);
						$radius    = ($radius            ? $radius    : 0.5);
						$threshold = (strlen($threshold) ? $threshold : 3);
						if (phpthumb_functions::gd_version() >= 2.0) {
							ob_start();
							if (!@include_once(dirname(__FILE__).'/phpthumb.unsharp.php')) {
								$include_error = ob_get_contents();
								if ($include_error) {
									$this->DebugMessage('include_once("'.dirname(__FILE__).'/phpthumb.unsharp.php") generated message: "'.$include_error.'"', __FILE__, __LINE__);
								}
								$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.unsharp.php" which is required for unsharp masking', __FILE__, __LINE__);
								ob_end_clean();
								return false;
							}
							ob_end_clean();
							phpUnsharpMask::applyUnsharpMask($this->gdimg_output, $amount, $radius, $threshold);
						} else {
							$this->DebugMessage('Skipping unsharp mask because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						break;

					case 'size': // Resize
						@list($newwidth, $newheight, $stretch) = explode('|', $parameter);
						$newwidth  = (!$newwidth  ? ImageSX($this->gdimg_output) : ((($newwidth  > 0) && ($newwidth  < 1)) ? round($newwidth  * ImageSX($this->gdimg_output)) : round($newwidth)));
						$newheight = (!$newheight ? ImageSY($this->gdimg_output) : ((($newheight > 0) && ($newheight < 1)) ? round($newheight * ImageSY($this->gdimg_output)) : round($newheight)));
						$stretch   = ($stretch ? true : false);
						if ($stretch) {
							$scale_x = phpthumb_functions::ScaleToFitInBox(ImageSX($this->gdimg_output), ImageSX($this->gdimg_output), $newwidth,  $newwidth,  true, true);
							$scale_y = phpthumb_functions::ScaleToFitInBox(ImageSY($this->gdimg_output), ImageSY($this->gdimg_output), $newheight, $newheight, true, true);
						} else {
							$scale_x = phpthumb_functions::ScaleToFitInBox(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output), $newwidth, $newheight, true, true);
							$scale_y = $scale_x;
						}
						$this->DebugMessage('Scaling watermark ('.($stretch ? 'with' : 'without').' stretch) by a factor of "'.number_format($scale_x, 4).' x '.number_format($scale_y, 4).'"', __FILE__, __LINE__);
						if (($scale_x > 1) || ($scale_x < 1) || ($scale_y > 1) || ($scale_y < 1)) {
							if ($img_temp = phpthumb_functions::ImageCreateFunction(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output))) {
								ImageCopy($img_temp, $this->gdimg_output, 0, 0, 0, 0, ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
								//ImageDestroy($this->gdimg_output);
								if ($this->gdimg_output = phpthumb_functions::ImageCreateFunction($scale_x * ImageSX($img_temp), $scale_y * ImageSY($img_temp))) {
									ImageAlphaBlending($this->gdimg_output, false);
									ImageSaveAlpha($this->gdimg_output, true);
									$this->ImageResizeFunction($this->gdimg_output, $img_temp, 0, 0, 0, 0, ImageSX($this->gdimg_output), ImageSY($this->gdimg_output), ImageSX($img_temp), ImageSY($img_temp));
								} else {
									$this->DebugMessage('ImageCreateFunction('.($scale_x * ImageSX($img_temp)).', '.($scale_y * ImageSY($img_temp)).') failed', __FILE__, __LINE__);
								}
								ImageDestroy($img_temp);
							} else {
								$this->DebugMessage('ImageCreateFunction('.ImageSX($this->gdimg_output).', '.ImageSY($this->gdimg_output).') failed', __FILE__, __LINE__);
							}
						}
						break;

					case 'rot': // ROTate
						@list($angle, $bgcolor) = explode('|', $parameter, 2);
						$phpthumbFilters->ImprovedImageRotate($this->gdimg_output, $angle, 