<?php
#
#  ��� ������ � ��������
# ResizeType:
# 	0 - ��������
# 	1 - ���������������� ������ �� ������
# 	2 - ���������������� ������ �� ������
# 	3 - ������������������ ������
#
#	��� ResizeType = 3 ��������� ��� ��� �������
#	ResizeMethod:
#	1 - ������ � ��������� � �������� ��������
#	2 - ������ � ���������� ������� �� ������
#	3 - ������ � ���������� �� ������ �������� ����
#



class ClassImage {

	/** ������ �� ����� - ���������� �������  */
	public $std			= null;

	/** �������� ������, ������� ���������� ����� */
	public $mod_name	= '';

	public $sett_prefix	= '';

	/** ���� - ��������  */
	private $source		= "";

	/** ���� - �������  */
	private $result		= "";



	function  __construct(&$std)
	{
		$this->std = $std;
		
	}
	
	
	function __destruct()
	{
		# ��������, ����� �� ��������� �������� ����������� ����
		if ($this->std->settings[$this->mod_name.'_save_imgsource'] == '0')
		{
			# �������� ��������� ����
			@unlink($this->source);
		}
	}



	




	/**
	 * ��������� ������� ��������
	 *
	 * @param unknown_type $insource	- ���� � ��������� �����
	 * @param unknown_type $outsource	- ���� � ����� � �����������
	 */
	public function resize_img($insource, $outsource)
	{
		$this->source = $insource;
		$this->result = $outsource;		
		$this->sett_prefix = $this->mod_name.'_img_';
		$this->resize();
	}


	/**
	 * ��������� ������� ��������
	 *
	 * @param unknown_type $insource	- ���� � ��������� �����
	 * @param unknown_type $outsource	- ���� � ����� � �����������
	 */
	public function resize_th($insource, $outsource)
	{
		$this->source = $insource;
		$this->result = $outsource;
		$this->sett_prefix = $this->mod_name.'_th_';
		$this->resize();
	}
	
	/**
	 * ��������� ������� �������� ��������, � ����������
	 *
	 * @param unknown_type $insource	- ���� � ��������� �����
	 * @param unknown_type $outsource	- ���� � ����� � �����������
	 */
	public function resize_source($insource, $outsource)
	{		
		# ����� �� ������ ��������� �������� �����?
		if ($this->std->settings[$this->mod_name.'_save_imgsource'] == '1')
		{
			# ��, ��������� �����, ��������
			$this->source = $insource;
			$this->result = $outsource;
			$this->copyImage();
		}
	}


	/**
	 * �������� ����������� �����
	 *
	 */
	private function verifInitSource()
	{
		$error = '';

		if (!file_exists($this->source))
		{
			$error .= "slacc_image :: verifSource :: ���� ���������� ��� �������.".chr(13);
			$this->std->log($error);
			return $error;
		}
		else
		{
			# �������� ���� ����������� �����
			$this->createFolder();
		}


		return '';
	}
	
	
	/**
	 * �������� ���� �����, ����������� ��� �������� ������
	 *
	 */
	function createFolder()
	{
		# ����� ����� ��� ���� ������ ������
		$dir = $this->std->config['path_files'].'/'.$this->mod_name;			
		if (!file_exists($dir))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($dir))
			{		// ������� �������
				@chmod($dir, 0775);
			}
		}
		
		
		# ����� ��� �������� ����
		$source .= $dir.'/'.'source';
		if (!file_exists($source))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($source))
			{		// ������� �������
				@chmod($source, 0775);
			}
		}
		
		# ����� ��� �������� ����
		$img .= $dir.'/'.'img';
		if (!file_exists($img))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($img))
			{		// ������� �������
				@chmod($img, 0775);
			}
		}
		
		# ����� ��� ������
		$th .= $dir.'/'.'th';
		if (!file_exists($th))
		{		// �������� ��� ���, �� ����� �������
			if (@mkdir($th))
			{		// ������� �������
				@chmod($th, 0775);
			}
		}
		
		# ����� ��� �������� ���� � ���������� �� �������		
		if (!file_exists(dirname($this->result)))
		{
			if (@mkdir(dirname($this->result)))
			{		// ������� �������
				@chmod(dirname($this->result), 0775);
			}
		}
		
	}



	
	
	
	/**
	 * �������� � ������ �������� �����������
	 * ������� ������ ����� �� jpg, gif, png
	 *
	 * @param unknown_type $img_info
	 */
	function getImgSource(&$img_info)
	{	
		switch ($img_info[2])
		{
			case IMAGETYPE_GIF:
				return imagecreatefromgif($this->source);
				break;
			case IMAGETYPE_JPEG:
				return imagecreatefromjpeg($this->source);
				break;
			case IMAGETYPE_PNG:
				return imagecreatefrompng($this->source);
				break;
			default:
				return imagecreatetruecolor($this->std->settings[$this->sett_prefix.'size'], $this->std->settings[$this->sett_prefix.'size']); 
		}
	}
	
	
	
	/**
	 * ���������� �������
	 *
	 */
	private function resize()
	{
		# �������� ����������� ��������� ����� � �������� ����������� ������ �������� ������
		$error = $this->verifInitSource();
		if ($error != '')
		{
			return '��������� ��������� ������ �������. ������ ����������.<br>'.$error;
		}
		
		
		
		# �������� ��� �������� ��������� � ��������� �����
		$img_info = getimagesize($this->source);
		# �������� � ������ �������� �����������		
		$in_source = $this->getImgSource($img_info);
		
		# ����� ���� �������, ����������� �������������� �������� ���� � ���������� - ������
		$out_source = $this->selectResizeType($img_info, $in_source);
		//$out_source = $in_source;
		
		# ���������� ����������
		if (!is_null($out_source))
		{
			imagejpeg($out_source, $this->result, $this->std->settings[$this->sett_prefix.'quality']);
			@chmod($this->result, 0775);
		}
		else
		{
			return '������ ��� ����������� �������� ��������� ������������ �����.';
		}
		
		# ������������ ��������
		unset($img_info);
		unset($in_source);
		unset($out_source);
				
			
		return true;
	}
	
	
	/**
	 * ����� ���� �������, ����������� �������������� �������� ���� � ���������� - ������
	 *
	 * @param unknown_type $img_info	- ���������� � ���� 
	 * @param unknown_type $in_source	- ��������� �� ���� � ������
	 */
	function selectResizeType(&$img_info, &$in_source)
	{
		$simple_copy = false;
		
		# ������� �������� ��������
		$old_w = $img_info[0];		
		$old_h = $img_info[1];		
		
			
		switch ( $this->std->settings[$this->sett_prefix.'typeresize'] )
		{	
			case 1:	// ���������������� ������ �� ������� �������
				if ($old_w > $old_h)
				{
						# ������ �� ������
						$width = $this->std->settings[$this->sett_prefix.'size'];	// ������
						if ($width >= $old_w) $simple_copy = true; // �������� ���� ������ ��������������, ������ �� ������
						$k = $old_h * 100 / $old_w;		// �����������
						$height = round( $width * $k / 100 );	// �������� ������		
				}
				else
				{
						# ������ �� ������
						$height = $this->std->settings[$this->sett_prefix.'size'];	// ������
						if ($height >= $old_h) $simple_copy = true; // �������� ���� ������ ��������������, ������ �� ������
						$k = $old_w * 100 / $old_h;		// �����������
						$width = round( $height * $k / 100 ); // �������� ������
				}
				break;
								
			case 2:	// ���������������� ������ �� ������
				$width = $this->std->settings[$this->sett_prefix.'size'];	// ������
				if ($width >= $old_w) $simple_copy = true; // �������� ���� ������ ��������������, ������ �� ������
				$k = $old_h * 100 / $old_w;		// �����������
				$height = round( $width * $k / 100 );	// �������� ������			
				break;
					
			case 3:	// ���������������� ������ �� ������
				$height = $this->std->settings[$this->sett_prefix.'size'];	// ������
				if ($height >= $old_h) $simple_copy = true; // �������� ���� ������ ��������������, ������ �� ������
				$k = $old_w * 100 / $old_h;		// �����������
				$width = round( $height * $k / 100 ); // �������� ������
				break;
				
			case 4:	// ���������� � ��������
				return $this->createSquare($in_source, $old_w, $old_h);				
				break;
				
			case 0:	// �� ���������
				$simple_copy = true;			
				break;

		}
		
		if ($simple_copy)
		{
			# ������ �� �����, ���� ���� ������ ��� �����
			$out_source = &$in_source; 
		}
		else
		{
			$out_source = imagecreatetruecolor( $width, $height );	// ������������ ��������� � ����� ��� � �������			
			
			// ��������� ��������
			if ( !imagecopyresampled( $out_source, $in_source, 0, 0, 0, 0, $width, $height, $old_w, $old_h ) )
			{
				$this->std->log("std->image->selectResizeType :: ������ ��������, ������ � ����������: 0, 0, 0, 0, $width, $height, $old_w, $old_h");
				return null;
			}
		}
		
		
		
		return $out_source;
	}
	
	
	/**
	 * ����������� ����������� � ����� �� �����
	 *
	 */
	public function copyImage()
	{
		$dir = dirname($this->result);
		$fname = str_replace($dir, '', $this->result);	
		$this->std->moveFile($this->source, $fname, $dir, 0, $error);		
	}
	
	
	public function createSquare(&$in_source, $w_src, $h_src)
	{
			 // ������ ������ ���������� �������� 
	         // ����� ������ truecolor!, ����� ����� ����� 8-������ ���������
	         $width = $this->std->settings[$this->sett_prefix.'size']; 
	         $out_source = imagecreatetruecolor($width, $width); 
	
	         // �������� ���������� ��������� �� x, ���� ���� �������������� 
	         if ($w_src > $h_src) 
	         imagecopyresampled($out_source, $in_source, 0, 0,
	                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
	                          0, $width, $width, min($w_src, $h_src), min($w_src,$h_src)); 
	                         
			 // ���
	                          
	
	         // �������� ���������� �������� �� y, 
	         // ���� ���� ������������ (���� ����� ���� ���������) 
	         if ($w_src < $h_src)
	         	imagecopyresampled($out_source, $in_source, 0, 0, 0,
                 round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                 $width, $width, min($w_src,$h_src), min($w_src,$h_src));
                 
			 // ���	         
	         
	         // ���������� �������� �������������� ��� ������� 
	         if ($w_src == $h_src) imagecopyresampled($out_source, $in_source, 0, 0, 0, 0, $width, $width, $w_src, $w_src);
	         
	         
	         return  $out_source;
	}
	
	
	
	//---------------------------------------------------------------------------------------------
	// ����� ����-���� ����������
	// ��������� �������� ����������� � ����������� � �����
	/*function imageresize($outfile,$infile,$neww,$newh,$quality)
		{
		$im=imagecreatefromjpeg($infile);
		$k1=$neww/imagesx($im);
		$k2=$newh/imagesy($im);
		$k=$k1>$k2?$k2:$k1;

		$w=intval(imagesx($im)*$k);
		$h=intval(imagesy($im)*$k);

		$im1=imagecreatetruecolor($w,$h);
		imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

		imagejpeg($im1,$outfile,$quality);
		imagedestroy($im);
		imagedestroy($im1);
		}*/

}


?>
