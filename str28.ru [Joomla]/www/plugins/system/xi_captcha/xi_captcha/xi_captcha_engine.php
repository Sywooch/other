<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class CaptchaEngine
{
	var $width		= 	150;
	var $height		=	40;
	var $length		=   6 ;
	
	var $text 		= '#789539';
	var $background	= '#FDFCE5'; 
    var $noise		= '#EEEEEC';
	
	var	$fontSize	= 26;
	var	$fontName	= 'monofont.ttf';
	
	var $noiseLevel	= '100';
	var $_debugMode;
	
	// initalize arguments
	function __construct($params, $debugMode)
	{
		assert($params);
		
		$this->width	= 	$params->get('xiWidth','160');
		$this->height	= 	$params->get('xiHeight','40');
		$this->length	= 	$params->get('xiChars','6');
		
		$this->fontSize	= 	$params->get('xiFontSize','26');
		$this->fontName	=   'plugins/system/xi_captcha/fonts/'.$params->get('xiFontName','monofont').'.ttf';
		
		$this->text			= 	$params->get('xiTextColor','#000000');
		$this->background	= 	$params->get('xiBackgroundColor','#E8E8E8');
		$this->noise		= 	$params->get('xiNoiseColor','#FC8E30');
		$this->_debugMode	=	$debugMode;
		
	}
	
	// gives a random captcha string 
	function _getRandomString() 
	{
		$charSet = '23456789bcdfghjkmnpqrstvwxyz';
		$charSetLength = strlen($charSet)-1; 
		$xiString = '';
		
		$i = 0;
		while ($i < $this->length) { 
			$xiString  .= substr($charSet, mt_rand(0,$charSetLength),1);
			$i++;
		}
		
		
		return $xiString ;
	}

	// generate numbers
	function _genRnd($limit)
	{
		switch($limit)
		{
			case 'w' :
				return mt_rand(0,$this->width);
			case 'h' :
				return mt_rand(0,$this->height);
			case 'l' :
				return mt_rand(0,$this->length);
			
			default :
				assert(0);
				return 0;
		}
	}
	
	//
	function _genImage() 
	{
		// get string
		$code 		= $this->_getRandomString();
		
		// init image
		$img 			= 	ImageCreateTrueColor($this->width, $this->height) 
								or die('Cannot initialize GD Image');
		$Cbackground	=	$this->__getColor($img, $this->background);
		$Ctext			=	$this->__getColor($img, $this->text);
		$Cnoise			=	$this->__getColor($img, $this->noise);
		
		// fill background color
		imagefilledrectangle($img,	0,	0,	$this->width,	$this->height,	$Cbackground);
		
		/* generate noise*/
		for( $i=0; $i < $this->noiseLevel; $i++ )
		{
			imagefilledellipse($img, $this->_genRnd('w'), $this->_genRnd('h'), 1, 1, $Cnoise);
			if($i%10 == 0)
				imageline($img, $this->_genRnd('w'), $this->_genRnd('h'), 
								$this->_genRnd('w'), $this->_genRnd('h'), $Cnoise);
		}
		
		// print string
		$textbox = imagettfbbox($this->fontSize, 0, $this->fontName, $code);
		$x = ($this->width - $textbox[4])/2;
		$y = ($this->height - $textbox[5])/2; 
		
		imagettftext($img, $this->fontSize, 0, $x, $y, $Ctext, $this->fontName, $code);

		if($this->_debugMode && $img==false)
        {
             echo "Image file generation error";
             return NULL;
        }
        
        header('Content-type: image/jpeg');
		imagejpeg($img,NULL,70);
		imagedestroy($img);
		return $code;
	}
	
	function __getColor($img , $hexcode)
	{
		assert($img);
		$color	= CaptchaEngine::__html2rgb($hexcode);
		return imagecolorallocate($img, $color[0],$color[1],$color[2]);
	}
	
	// convert color into RGB
	function __html2rgb($color)
	{
	    if ($color[0] == '#')
	        $color = substr($color, 1);

	    if (strlen($color) == 6)
	        list($r, $g, $b) = array($color[0].$color[1],
	                                 $color[2].$color[3],
	                                 $color[4].$color[5]);
	    elseif (strlen($color) == 3)
	        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	    else
	        return false;

	    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
	    return array($r, $g, $b);
	}
}
