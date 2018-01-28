<?php
#
#  для работы с графикой
# ResizeType:
# 	0 - нересайз
# 	1 - пропорциональный ресайз по ширине
# 	2 - пропорциональный ресайз по высоте
# 	3 - непропорциональный ресайз
#
#	Для ResizeType = 3 действуют ещё три правила
#	ResizeMethod:
#	1 - ресайз с вмещением в итоговую картинку
#	2 - ресайз с обрезанием лишнего по центру
#	3 - ресайз с обрезанием по левому верхнему углу
#



class ClassImage {

	/** ссылка на класс - библиотеку функций  */
	public $std			= null;

	/** название модуля, который использует класс */
	public $mod_name	= '';

	public $sett_prefix	= '';

	/** файл - источник  */
	private $source		= "";

	/** файл - приёмник  */
	private $result		= "";



	function  __construct(&$std)
	{
		$this->std = $std;
		
	}
	
	
	function __destruct()
	{
		# проверям, нужно ли сохранить исходную загруженную фото
		if ($this->std->settings[$this->mod_name.'_save_imgsource'] == '0')
		{
			# удаление исходного фото
			@unlink($this->source);
		}
	}



	




	/**
	 * Изменение размера картинки
	 *
	 * @param unknown_type $insource	- путь к исходному файлу
	 * @param unknown_type $outsource	- путь к файлу с результатом
	 */
	public function resize_img($insource, $outsource)
	{
		$this->source = $insource;
		$this->result = $outsource;		
		$this->sett_prefix = $this->mod_name.'_img_';
		$this->resize();
	}


	/**
	 * Изменение размера картинки
	 *
	 * @param unknown_type $insource	- путь к исходному файлу
	 * @param unknown_type $outsource	- путь к файлу с результатом
	 */
	public function resize_th($insource, $outsource)
	{
		$this->source = $insource;
		$this->result = $outsource;
		$this->sett_prefix = $this->mod_name.'_th_';
		$this->resize();
	}
	
	/**
	 * Изменение размера исходной картинки, и сохранение
	 *
	 * @param unknown_type $insource	- путь к исходному файлу
	 * @param unknown_type $outsource	- путь к файлу с результатом
	 */
	public function resize_source($insource, $outsource)
	{		
		# нужно ли вообще сохранять исходную фотку?
		if ($this->std->settings[$this->mod_name.'_save_imgsource'] == '1')
		{
			# да, сохранить нужно, копируем
			$this->source = $insource;
			$this->result = $outsource;
			$this->copyImage();
		}
	}


	/**
	 * Проверка доступности файла
	 *
	 */
	private function verifInitSource()
	{
		$error = '';

		if (!file_exists($this->source))
		{
			$error .= "slacc_image :: verifSource :: Файл недоступен для ресайза.".chr(13);
			$this->std->log($error);
			return $error;
		}
		else
		{
			# создание всех необходимых папок
			$this->createFolder();
		}


		return '';
	}
	
	
	/**
	 * Создание всех папок, необходимых для хранения файлов
	 *
	 */
	function createFolder()
	{
		# общая папка для всех файлов модуля
		$dir = $this->std->config['path_files'].'/'.$this->mod_name;			
		if (!file_exists($dir))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($dir))
			{		// создали каталог
				@chmod($dir, 0775);
			}
		}
		
		
		# папка для исходных фото
		$source .= $dir.'/'.'source';
		if (!file_exists($source))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($source))
			{		// создали каталог
				@chmod($source, 0775);
			}
		}
		
		# папка для основных фото
		$img .= $dir.'/'.'img';
		if (!file_exists($img))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($img))
			{		// создали каталог
				@chmod($img, 0775);
			}
		}
		
		# папка для привью
		$th .= $dir.'/'.'th';
		if (!file_exists($th))
		{		// каталога ещё нет, но нужно создать
			if (@mkdir($th))
			{		// создали каталог
				@chmod($th, 0775);
			}
		}
		
		# папка для сохрания фото с разбиением по масяцам		
		if (!file_exists(dirname($this->result)))
		{
			if (@mkdir(dirname($this->result)))
			{		// создали каталог
				@chmod(dirname($this->result), 0775);
			}
		}
		
	}



	
	
	
	/**
	 * помещаем в память исходное изображение
	 * извлечь ресурс можем из jpg, gif, png
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
	 * Выполнение ресайза
	 *
	 */
	private function resize()
	{
		# проверка доступности исходного файла и проверка правльности других исходных данных
		$error = $this->verifInitSource();
		if ($error != '')
		{
			return 'Указанные исходнные данные неверны. Ресайз невозможен.<br>'.$error;
		}
		
		
		
		# получаем все исходную иформацию о полученой фотке
		$img_info = getimagesize($this->source);
		# помещаем в память исходное изображение		
		$in_source = $this->getImgSource($img_info);
		
		# выбор типа ресайза, определение результирующих размеров фото и собственно - ресайз
		$out_source = $this->selectResizeType($img_info, $in_source);
		//$out_source = $in_source;
		
		# сохранение результата
		if (!is_null($out_source))
		{
			imagejpeg($out_source, $this->result, $this->std->settings[$this->sett_prefix.'quality']);
			@chmod($this->result, 0775);
		}
		else
		{
			return 'Ошибка при определении размеров итогового графического файла.';
		}
		
		# освобождение ресурсов
		unset($img_info);
		unset($in_source);
		unset($out_source);
				
			
		return true;
	}
	
	
	/**
	 * выбор типа ресайза, определение результирующих размеров фото и собственно - ресайз
	 *
	 * @param unknown_type $img_info	- информация о фото 
	 * @param unknown_type $in_source	- указатель на фото в памяти
	 */
	function selectResizeType(&$img_info, &$in_source)
	{
		$simple_copy = false;
		
		# размеры исходной картинки
		$old_w = $img_info[0];		
		$old_h = $img_info[1];		
		
			
		switch ( $this->std->settings[$this->sett_prefix.'typeresize'] )
		{	
			case 1:	// пропорциональный ресайз по большей стороне
				if ($old_w > $old_h)
				{
						# ресайз по ширине
						$width = $this->std->settings[$this->sett_prefix.'size'];	// ширина
						if ($width >= $old_w) $simple_copy = true; // исходное фото меньше результирующей, ресайз не делаем
						$k = $old_h * 100 / $old_w;		// коэффициент
						$height = round( $width * $k / 100 );	// итоговая высота		
				}
				else
				{
						# ресайз по высоте
						$height = $this->std->settings[$this->sett_prefix.'size'];	// высота
						if ($height >= $old_h) $simple_copy = true; // исходное фото меньше результирующей, ресайз не делаем
						$k = $old_w * 100 / $old_h;		// коэффициент
						$width = round( $height * $k / 100 ); // итоговая ширина
				}
				break;
								
			case 2:	// пропорциональный ресайз по ширине
				$width = $this->std->settings[$this->sett_prefix.'size'];	// ширина
				if ($width >= $old_w) $simple_copy = true; // исходное фото меньше результирующей, ресайз не делаем
				$k = $old_h * 100 / $old_w;		// коэффициент
				$height = round( $width * $k / 100 );	// итоговая высота			
				break;
					
			case 3:	// пропорциональный ресайз по высоте
				$height = $this->std->settings[$this->sett_prefix.'size'];	// высота
				if ($height >= $old_h) $simple_copy = true; // исходное фото меньше результирующей, ресайз не делаем
				$k = $old_w * 100 / $old_h;		// коэффициент
				$width = round( $height * $k / 100 ); // итоговая ширина
				break;
				
			case 4:	// приведение к квадрату
				return $this->createSquare($in_source, $old_w, $old_h);				
				break;
				
			case 0:	// не ресайзить
				$simple_copy = true;			
				break;

		}
		
		if ($simple_copy)
		{
			# ресайз не нужен, фото итак меньше чем нужно
			$out_source = &$in_source; 
		}
		else
		{
			$out_source = imagecreatetruecolor( $width, $height );	// формирование заготовки с новой шир и высотой			
			
			// изменение размеров
			if ( !imagecopyresampled( $out_source, $in_source, 0, 0, 0, 0, $width, $height, $old_w, $old_h ) )
			{
				$this->std->log("std->image->selectResizeType :: Ресайз неудачен, ошибка в параметрах: 0, 0, 0, 0, $width, $height, $old_w, $old_h");
				return null;
			}
		}
		
		
		
		return $out_source;
	}
	
	
	/**
	 * копирование изображения с места на мосто
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
			 // создаём пустую квадратную картинку 
	         // важно именно truecolor!, иначе будем иметь 8-битный результат
	         $width = $this->std->settings[$this->sett_prefix.'size']; 
	         $out_source = imagecreatetruecolor($width, $width); 
	
	         // вырезаем квадратную серединку по x, если фото горизонтальное 
	         if ($w_src > $h_src) 
	         imagecopyresampled($out_source, $in_source, 0, 0,
	                          round((max($w_src,$h_src)-min($w_src,$h_src))/2),
	                          0, $width, $width, min($w_src, $h_src), min($w_src,$h_src)); 
	                         
			 // ИЛИ
	                          
	
	         // вырезаем квадратную верхушку по y, 
	         // если фото вертикальное (хотя можно тоже серединку) 
	         if ($w_src < $h_src)
	         	imagecopyresampled($out_source, $in_source, 0, 0, 0,
                 round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                 $width, $width, min($w_src,$h_src), min($w_src,$h_src));
                 
			 // ИЛИ	         
	         
	         // квадратная картинка масштабируется без вырезок 
	         if ($w_src == $h_src) imagecopyresampled($out_source, $in_source, 0, 0, 0, 0, $width, $width, $w_src, $w_src);
	         
	         
	         return  $out_source;
	}
	
	
	
	//---------------------------------------------------------------------------------------------
	// МОЖЕТ ДАКА-НИТЬ пригодится
	// Изменение размеров изображения с вписыванием в рамки
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
