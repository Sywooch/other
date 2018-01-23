<?php 
/*
# ------------------------------------------------------------------------
# TCVN Highslide Module for Joomla 2.5
# ------------------------------------------------------------------------
# Copyright(C) 2008-2012 www.Thecoders.vn. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: Thecoders.vn
# Websites: http://Thecoders.com
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

if(!class_exists('TCVNFiletypeHLDataSource'))
{  
	class TCVNFiletypeHLDataSource extends TCVNDataSourceBase
	{
		/**
		 * @var string $__name;
		 *
		 * @access private
		 */
		var $__name = 'filetype';
 
		/**
		 * override method: get list image from articles.
		 */
		function getList($params)
		{
			$maxFiles 		= 20;
			$thumbWidth    	= (int)$params->get('thumbnail_width', 48);
			$thumbHeight   	= (int)$params->get('thumbnail_height', 74);
			$imageHeight   	= (int)$params->get('main_height', 300);
			$imageWidth    	= (int)$params->get('main_width', 660);
			$isThumb       	= $params->get('auto_renderthumb',1);
			
			$baseURI 	= JURI::base();
			$subbase 	= JURI::base(true);
			$path 		= $params->get('folder_path','').DS;
	
			$output = array(); 
		
			for($i=1; $i <= $maxFiles; $i++)
			{
				$obj = $params->get('file' . $i);
					
				if(is_object($obj) && $obj->enable)
				{
					$obj->filetype 	= isset($obj->filetype) ? $obj->filetype:"image";
					$obj->realpath 	= $obj->path;
					$obj->introtext = $obj->content; 
					$obj->subtitle 	= $obj->title;
					$obj->pathURL 	= $obj->path ? str_replace($subbase."//", $subbase.'/', $baseURI.str_replace("//","/",str_replace( DS,"/",$path.$obj->path))):"";
					$obj->description = $obj->introtext = $obj->content;
					
					if($obj->filetype == "image" || $obj->filetype=="html")
					{
						if(substr($obj->preview,0,4)!='http')
						{
							$obj->mainImage = str_replace($subbase."//",$subbase.'/',$baseURI.str_replace("//","/",str_replace( DS,"/",$path.$obj->preview)));
							$obj->mainImage = str_replace("http://","__TCVN_HOLDER__", $obj->mainImage);
							$obj->mainImage = str_replace("http:/","http://", $obj->mainImage);
							$obj->mainImage = str_replace("__TCVN_HOLDER__","http://", $obj->mainImage);
						}
						else {
							$obj->mainImage = $obj->preview;
						}
						if(!empty($obj->path)) {
							$obj->thumbnail  = str_replace( DS,"/",$path.$obj->path); 
						}
						else {
							$obj->thumbnail  = str_replace( DS,"/",$path.$obj->preview); 
						}
						if($image=$this->renderThumb($obj->thumbnail, $thumbWidth, $thumbHeight, $obj->subtitle, $isThumb)) {
							$obj->thumbnail = $image;
						}
						else {
							$obj->thumbnail = $obj->mainImage;
						}
					}
					elseif($obj->filetype == "youtube") {
						$obj->mainImage = $obj->preview;
						$obj->thumbnail  = str_replace( DS,"/",$path.$obj->path); 
						if($image=$this->renderThumb($obj->thumbnail, $thumbWidth, $thumbHeight, $obj->subtitle, $isThumb) ){
							$obj->thumbnail = $image;
						}
						else{
							$obj->thumbnail = $obj->path;
						}
					}
					elseif($obj->filetype == "flash" || $obj->filetype == "iframe" || $obj->filetype=="ajax"){
						$obj->mainImage = $obj->preview;
						if(substr($obj->mainImage,0,4)!='http'){
							$obj->mainImage = str_replace($subbase."//",$subbase.'/',$baseURI.str_replace("//","/",str_replace( DS,"/",$path.$obj->preview)));
							$obj->mainImage = str_replace("http://","__TCVN_HOLDER__", $obj->mainImage);
							$obj->mainImage = str_replace("http:/","http://", $obj->mainImage);
							$obj->mainImage = str_replace("__TCVN_HOLDER__","http://", $obj->mainImage);
						}
						$obj->thumbnail  = str_replace( DS,"/",$path.$obj->path); 
						if( $image=$this->renderThumb($obj->thumbnail, $thumbWidth, $thumbHeight, $obj->subtitle, $isThumb) ){
							$obj->thumbnail = $image;
						}
						else{
							$obj->thumbnail = $obj->path;
						}
					}
					$obj->target_open = '';
					$output[]=$obj;
				}
			 }
			return $output; 
		}
	}
}