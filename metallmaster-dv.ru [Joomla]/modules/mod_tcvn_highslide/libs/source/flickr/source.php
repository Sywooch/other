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
if(!class_exists('TCVNFlickrHLDataSource'))
{ 
	require_once("phpFlickr.php");
	class TCVNFlickrHLDataSource extends TCVNDataSourceBase
	{
		/**
		 * @var string $__name;
		 *
		 * @access private
		 */
		var $__name = 'flickr';
		
		/**
		 * override method: get list image from flickr.
		 */
		function getList($params)
		{
			// Create new phpFlickr object
			$flickr_api 		= $params->get("flickr_api","");
			$flickr_username 	= $params->get("flickr_username","");
			$filter_type 		= $params->get("search_type","username");
			$flickr_tags 		= $params->get("flickr_tags","");
			$flickr_limit 		= $params->get("flickr_limit","");
			
			$f = new phpFlickr($flickr_api);
			
			if($params->get("enable_fcache", 1))
			{
				$config 	= &JFactory::getConfig();
				$host 		= $config->getValue('config.host');
				$user 		= $config->getValue('config.user');
				$password 	= $config->getValue('config.password');
				$db 		= $config->getValue('config.db');
				$f->enableCache(
					"db",
					"mysql://".$user.":".$password."@".$host."/".$db.""
				);
			}
			
			$i 			= 0;
			$photos_url = "";
			
			if($filter_type == "username")
			{
					// Find the NSID of the username inputted via the form
					$person = $f->people_findByUsername($flickr_username);
				 
					// Get the friendly URL of the user's photos
					$photos_url = $f->urls_getUserPhotos($person['id']);
				 
					// Get the user's first 36 public photos
					$tmp = $f->people_getPublicPhotos($person['id'], NULL, NULL, $flickr_limit);
					$photos = (array)$tmp['photos']['photo'];
			}
			else {
				$tmp = $f->photos_search(array("tags"=>$flickr_tags, "sort"=>"interestingness-desc", "per_page"=>$flickr_limit));
				$photos = (array)$tmp['photo'];
			}
			if($photos)
			{
				$rows = array();
				// Loop through the photos and output the html
				foreach($photos as $photo)
				{
					$photos_url 	= empty($photos_url)?"http://www.flickr.com/photos/".$photo["owner"]."/":$photos_url;
					$row 			= new stdClass();
					$row->filetype 	= "image";
					$row->subtitle 	= $photo['title'];
					$row->introtext = $photo['title'];
					$row->description 	= $photo['title'];
					$row->link 			= $photos_url.$photo['id'];
					$row->mainImage 	= $f->buildPhotoURL($photo, $params->get("main_size", "large"));
					$row->thumbnail 	= $f->buildPhotoURL($photo, $params->get("thumbnail_size", "thumbnail"));
					$row->show_link 	= 1;
					$row->showThumb 	= 1;
					$row->target_open 	= '';
					$rows[] 			= $row;
					$i++;
				}
				return $rows;
			}
			return array();
		}
	}
}