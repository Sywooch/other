<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once ( JPath::clean(JPATH_SITE.'/components/com_k2/helpers/route.php') );

if (! class_exists("YTMegaSlider") ) {
class YTMegaSlider {
	var $items = array();
	var $is_frontpage = 0;	// 0 - without frontpage, 1 - only frontpage - 2 both
	var $type = 0;
    var $featured = 0;
    var $theme = array();
    var $iditems = 0;
	var $cat_or_sec_ids = array();
	var $limit = 5;
	var $article_ids = array();
    var $customUrl = array();      
	var $arrCustomUrl = array();
    var $customUrlImage = array();      
	var $arrCustomUrlImage = array();
    var $cutStr_style = 'removing';
	var $is_cat_or_sec = 1;		
	var $sort_order_field = 'created';
	var $type_order = 'DESC';	
	var $thumb_width = '40';
	var $thumb_height = '40';
    var $small_thumb_width = '0';
	var $small_thumb_height = '0';
	var $web_url = '';	
	var $cropresizeimage = 0;
    var $imagesource = 0;
	var $max_title = 0;
    var $max_normal_title = 0;
    var $max_main_title = 0;
	var $target = '_self';
    
	var $max_main_description = 0;
    var $max_normal_description = 0;
	var $resize_folder = '';
	var $url_to_resize = '';
	var $url_to_module = '';        
                
   
	function getList($module) {
			global $mainframe;
            $arrCustomUrl = YTMegaSlider::getArrURL();			
			require_once ( JPath::clean(JPATH_SITE.'/components/com_k2/helpers/route.php') );
			$co_params = &JComponentHelper::getParams('com_k2');
			$user = &JFactory::getUser();
			$aid = $user->get('aid');
			$db = &JFactory::getDBO();
			
			$jnow = &JFactory::getDate();
			$now = $jnow->toMySQL();
			$nullDate = $db->getNullDate();
			
			$where = YTMegaSlider::getCondition();
			$query = "SELECT distinct(a.id),a.*, cr.rating_sum/cr.rating_count as rating, c.name as categoryname,
                                 c.id as categoryid, c.alias as categoryalias, c.params as categoryparams, cc.commentcount as commentcount".
                                " FROM #__k2_items as a".
                                " LEFT JOIN #__k2_categories c ON c.id = a.catid" .
                                " LEFT JOIN #__k2_rating as cr ON a.id = cr.itemid".
                                " LEFT JOIN (select cm.itemid  as id, count(cm.id) as commentcount from #__k2_comments as cm
                                                                    where cm.published=1 group by cm.itemid) as cc on a.id = cc.id";
                
            $query .= " WHERE a.published = 1"
                . " AND a.access IN(".implode(',', $user->authorisedLevels()).")"
                . " AND a.trash = 0"
                . " AND c.published = 1"
                . " AND c.access IN(".implode(',', $user->authorisedLevels()).")"
                . " AND c.trash = 0 " ;   
                        
          
			if( $this->featured == 0 ){
                $query.= " AND a.featured != 1"; 
            } elseif ( $this->featured == 1 ) {
                $query.= " AND a.featured = 1";
            } 
			switch ($this->sort_order_field)
            {
                case 'title': $ordering = 'a.title ASC';
                              break; 
                case 'modified': $ordering = 'a.modified DESC';
                            break;               
                case 'hits_dsc': $ordering = 'a.hits DESC';
                              break; 
                case 'hits_asc': $ordering = 'a.hits ASC';
                              break;
                case 'order':                         
                            if ($this->featured  == 2)
                                $ordering = 'a.featured_ordering ASC';
                            else
                                $ordering = 'a.ordering ASC';
                                break;   
             
                case 'random': $ordering = 'RAND()';
                             break;                          
                case 'created': 
                default:       $ordering = 'a.created DESC';                              
                             break;                      
            }
        
            $query .=  $where . ' ORDER BY ' . $ordering;   
			$query .=  $this->limit ? ' LIMIT ' . $this->limit : '';
			$db->setQuery($query);
			$items = $db->loadObjectlist();
			if(!empty($items)){			
			    foreach( $items as $key => &$item ){			
				/*Update Link for Popup*/
				   if(array_key_exists($item->id,$arrCustomUrl)){
                        if(isset($arrCustomUrl[$item->id])){
                            $item->link = trim($arrCustomUrl[$item->id]);
                            if($this->target=='pop-up'){
                                $popupstrposlink = strpos(trim($item->link),"?");
                                $popupstrlenlink = intval(strlen(trim($item->link))-1);

                                $popuplink = '';
                                if($popupstrposlink>0){
                                    if($popupstrposlink == $popupstrlenlink ){
                                        $popuplink = 'tmpl=component';
                                    }elseif($popupstrposlink != $popupstrlenlink){
                                        $popuplink = '&tmpl=component';
                                    }
                                }else{
                                    $popuplink = '?tmpl=component';
                                }
                                $item->link .= $popuplink;
                            }
                            
    				    }else{
    				        if($this->target=='pop-up'){
                                $item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));           
                                $popupstrposlink = strpos(trim($link),"?");
                                $popupstrlenlink = intval(strlen(trim($link))-1);
                                $popuplink = '';
                                if($popupstrposlink>0){
                                    if($popupstrposlink == $popupstrlenlink ){
                                        $popuplink = 'tmpl=component';
                                    }elseif($popupstrposlink != $popupstrlenlink){
                                        $popuplink = '&tmpl=component';
                                    }
                                }else{
                                    $popuplink = '?tmpl=component';
                                }
                                $link .= $popuplink; 
    				        }else{
    				            $item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));           
    				            
                            }
    				    }
                        
                    }else
                    {
                        if($this->target=='pop-up'){
                		    		             
                           $item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));           
                           
                            $popupstrposlink = strpos(trim($item->link),"?");
                            $popupstrlenlink = intval(strlen(trim($item->link))-1);

                            $popuplink = '';
                            if($popupstrposlink>0){
                                if($popupstrposlink == $popupstrlenlink ){
                                    $popuplink = 'tmpl=component';
                                }elseif($popupstrposlink != $popupstrlenlink){
                                    $popuplink = '&tmpl=component';
                                }
                            }else{
                                $popuplink = '?tmpl=component';
                            }
                            $item->link .= $popuplink;
				        }else{
				           $item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));           
				        }			
                    }
				    $item->date = JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC2')); 
				    $item->rating = (is_numeric($item->rating))?floatval($item->rating / 5 * 100):null;
				    $item->main_image = '';
				
				YTMegaSlider::forImage($item);
				
			}

			$k2items = array();

			foreach ($items as $key => $article){
				$k2 = array();
                $k2['id'] = $article->id;
				$k2['title'] = $article->title;
				$k2['img'] = $article->main_image;
				$k2['content'] = $article->introtext;
				$k2['link'] = $article->link;      		
              
                $k2items[] = $k2;
			}

			$items = $this->update($k2items, $module);
			//echo "<pre>";print_r($items);die;
			
         }   
        return $items;	
			
	}		
	
	
	function forImage( &$item ){
		
			$content =  $item->introtext;
			$content .=  $item->fulltext;
			//echo "<pre>";print_r($content);die;			
			$item  = YTMegaSlider::k2Image( $item );
			
			if( $item->main_image != '' ){
				
				return $item;
			}
			
			preg_match ( "#<img.+src\s*=\s*\"([^\"]*)\"[^\>]*\>#iU" , $content, $matches); 
			$images = (count($matches)) ? $matches : array();
            //var_dump($images);die;
			if (count($images)){				
				$item->main_image = $images[1];
			} else {				
				$row->main_image = '';	
			}
			//var_dump($item->main_image);die;
		}
		
		
					
		function k2Image( &$item, $size='XL' ){			
			$item->main_image ='';
			if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_'.$size.'.jpg')) {
				$item->main_image = 'media/k2/items/cache/'.md5("Image".$item->id).'_'.$size.'.jpg';
			}
			
			return $item; 
		}
        
	     
        
		function filterParams( $string ) {
			$string = html_entity_decode($string, ENT_QUOTES);
			$regex = "/\s*([^=\s]+)\s*=\s*('([^']*)'|\"([^\"]*)\"|([^\s]*))/";
			 $params = null;
			 if(preg_match_all($regex, $string, $matches) ){
					for ($i=0;$i<count($matches[1]);$i++){ 
					  $key 	 = $matches[1][$i];
					  $value = $matches[3][$i]?$matches[3][$i]:($matches[4][$i]?$matches[4][$i]:$matches[5][$i]);
					  $params[$key] = $value;
					}
			  }
			  return $params;
		}
		
		
		function unhtmlentities($string) 
		{
			$trans_tbl = array("&lt;" => "<", "&gt;" => ">", "&amp;" => "&");
			return strtr($string, $trans_tbl);
		}
		
		
		function getFile($name, $modPath, $tmplPath) {
			if (file_exists(JPATH_SITE.DS.$tmplPath.$name)) {
				return $tmplPath.$name;
			}
			return $modPath.$name;
		}
		
		function getCondition() {	
			
			$sql = '';
			switch ($this->showtype) {
				case 0:
					if ((count($this->category)==1)&&($this->category[0]==0)) {        
						$sql = '';
					} else {
						$catids = !is_array($this->category) ? $this->category : '"'.implode('","',$this->category).'"';
						$sql = ' AND  a.catid IN( '.$catids.' )';
					}
					
					break;
				case 1:
					$ids = split(',', $this->listIDs);	
					$tmp = array();
										
					foreach( $ids as $id ){
						$tmp[] = (int) trim($id);
					}
					$sql = " AND a.id IN('". implode( "','", $tmp ) ."')";
					
					break;
				default:
					$sql = '';
				
			}
			
			return $sql;
		}
		
	function getArrURL() {     
            $arrUrl = array();
            $tmp = explode("\n", trim($this->customUrl));            
            foreach( $tmp as $strTmp){
                $pos = strpos($strTmp, ":");
                if($pos >=0){
                    $tmpKey = substr($strTmp, 0, $pos);
                    $key = trim($tmpKey);
                    $tmpLink = substr($strTmp, $pos+1, strlen($strTmp)-$pos);

                    $haveHttp =  strpos(trim($tmpLink), "http://"); 
                    //var_dump($haveHttp);die;        
                    if(!$haveHttp && ($haveHttp!==0)){
                        $link = "http://" . trim($tmpLink);  
                    }else {
                        $link = trim($tmpLink);
                    }
                    $arrUrl[$key] = $link;
                }  
            }            
            return $arrUrl;
    }
    
	function update($items, $module){		
		$tmp = array();
		
		foreach ($items as $key => $item) {
			if (!isset($item['sub_normal_title'])) {
				$item['sub_normal_title'] = $this->cutStr($item['title'], $this->max_normal_title);
			}
            if (!isset($item['sub_main_title'])) {
				$item['sub_main_title'] = $this->cutStr($item['title'], $this->max_main_title);
			}
			if (!isset($item['sub_main_content'])) {
                if($this->cutStr_style == 'keeping'){
			         $item['sub_main_content'] = $this->mb_cutsubstrws($item['content'], $this->max_main_description);
			     }else{
			         $item['sub_main_content'] = $this->cutStr($item['content'], $this->max_main_description);
			     } 
			}
			if (!isset($item['sub_normal_content'])) {
				$item['sub_normal_content'] = $this->cutStr($item['content'], $this->max_normal_description);
			}
            if($item['img'] == ''){
               $item['img'] = 'modules/'.$module->module.'/assets/no_image.png';
            } 
			            
            if($this->imagesource == 1){
                if (!isset($item['thumb'])) {
                    $item['thumb'] = $item['img'];                 
                }  
                if (!isset($item['small_thumb'])) {
                    $item['small_thumb'] = $this->processImage($item['img'], $this->small_thumb_width, $this->small_thumb_height, $item['id']);                 
                }  
            }else{
                if (!isset($item['thumb'])) {
                    $item['thumb'] = $this->processImage($item['img'], $this->thumb_width, $this->thumb_height, $item['id']);                 
                }  
                if (!isset($item['small_thumb'])) {
                    $item['small_thumb'] = $this->processImage($item['img'], $this->small_thumb_width, $this->small_thumb_height, $item['id']);                 
                }   
                
            }
              
			$tmp[] = $item;
            
		}
		
		return $tmp;				
	}
	
	function processImage($img, $width, $height, $id) {
	
	$imagSource = JPATH_SITE.DS. str_replace( '/', DS,  $img );
		if(file_exists($imagSource) && is_file($imagSource)){	
    		if ($this->cropresizeimage == 0){
    			return $this->resizeImage($img, $width, $height, $id);
    		} else {
    			return $this->cropImage($img, $width, $height, $id);
    		}

        } else{

            return '';
	   }
	}
	
	function resizeImage($imagePath, $width, $height, $id) {
		global $module;
				
		$folderPath = $this->resize_folder;
		 
		 if(!JFolder::exists($folderPath)){
		 		JFolder::create($folderPath);	 
		 }
		 
		 $nameImg = str_replace('/','',strrchr($imagePath,"/"));
			
		 $ext = substr($nameImg, strrpos($nameImg, '.'));
		
		 $file_name = substr($nameImg, 0,  strrpos($nameImg, '.'));
		 
		 $size = getimagesize( $imagePath );
          
          // if it's not a image.
          if( !$size ){ return ''; }
          
           // case 1: render image base on the ratio of source.
          $x_ratio = $width / $size[0];
          $y_ratio = $height / $size[1];
          
          // set dst, src
          $dst = new stdClass();
          $src = new stdClass();
          $src->y = $src->x = 0;
          $dst->y = $dst->x = 0;
       
          if ($width > $size[0])
             $width = $size[0];
          if ($height > $size[1])
             $height = $size[1];
    	  
	
		 $nameImg = $file_name. "_" . $id ."_" . $this->themes . "_" . $width . "_" . $height .  $ext;

		 if(!JFile::exists($folderPath.DS.$nameImg)){
			 $image = new SimpleImage();
	  		 $image->load($imagePath);
	  		 $image->resize($width,$height);
	   		 $image->save($folderPath.DS.$nameImg);
		 }else{
		 		 list($info_width, $info_height) = @getimagesize($folderPath.DS.$nameImg);
		 		 if($width!=$info_width||$height!=$info_height){
		 		 	 $image = new SimpleImage();
	  				 $image->load($imagePath);
	  				 $image->resize($width,$height);
	   				 $image->save($folderPath.DS.$nameImg);
		 		 }
		 }
   		 return $this->url_to_resize . $nameImg;
	}
	
	function cropImage($imagePath, $width, $height, $id) {
		global $module;
		
		$folderPath = $this->resize_folder;
		 
		if(!JFolder::exists($folderPath)){
		 		JFolder::create($folderPath);	 
		}
        $nameImg = "crop_" . $this->themes . "__" . $id . '__'. $width. '__'. $height. str_replace('/','',strrchr($imagePath,"/"));	
        //var_dump($this->themes);die;	
		//$nameImg = str_replace('/','',strrchr($imagePath,"/"));		 
		 if(!JFile::exists($folderPath.DS.$nameImg)){
			 $image = new SimpleImage();
	  		 $image->load($imagePath);
	  		 $image->crop($width,$height);
	   		 $image->save($folderPath.DS.$nameImg);
		 }else{
		 		 list($info_width, $info_height) = @getimagesize($folderPath.DS.$nameImg);
		 		 if($width!=$info_width||$height!=$info_height){
		 		 	 $image = new SimpleImage();
	  				 $image->load($imagePath);
	  				 $image->crop($width,$height);
	   				 $image->save($folderPath.DS.$nameImg);
		 		 }
		 }
		 
   		 return $this->url_to_resize . $nameImg;
	}
	
	/*Cut string*/
	function cutStr( $str, $number){
		//If length of string less than $number
		$str = strip_tags($str);
		if(strlen($str) <= $number){
			return $str;
		}
		$str = substr($str,0,$number);
	
		$pos = strrpos($str,' ');
	
		return substr($str,0,$pos).'...';
	}
    function mb_cutsubstrws( $str_text, $number){

        if( (mb_strlen($str_text) > $number) ) {
    
            $whitespaceposition = mb_strpos($str_text," ",$number)-1;
    
            if( $whitespaceposition > 0 ) {
                $chars = count_chars(mb_substr($str_text, 0, ($whitespaceposition+1)), 1);
                //var_dump($chars);die;
                if (isset($chars[ord('<')]) > isset($chars[ord('>')]))
                    $whitespaceposition = mb_strpos($str_text,">",$whitespaceposition)-1;
                $str_text = mb_substr($str_text, 0, ($whitespaceposition+1));
            }
    
            // close unclosed html tags
            if( preg_match_all("|<([a-zA-Z]+)|",$str_text,$aBuffer) ) {
    
                if( !empty($aBuffer[1]) ) {
    
                    preg_match_all("|</([a-zA-Z]+)>|",$str_text,$aBuffer2);
    
                    if( count($aBuffer[1]) != count($aBuffer2[1]) ) {
    
                        foreach( $aBuffer[1] as $index => $tag ) {
    
                            if( empty($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag)
                                $str_text .= '</'.$tag.'>';
                        }
                    }
                }
            }
        }
        $str_text = preg_replace( "#<img.+src\s*=\s*\"([^\"]*)\"[^\>]*\>#iU" ,'', $str_text); 
		//$imageskeephtml = (count($matches)) ? $matches : array();
        //var_dump($imageskeephtml);die;
		
        //echo "<pre>";print_r($str_text);die;
        return $str_text;
    }
	
}
}
if (! class_exists("SimpleImage") ) {
class SimpleImage {
   var $image;
   var $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
     	 
		 
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null) {
   			
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   function resize($width,$height) {
        $width = intval($width);
        $height = intval($height);
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image	, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image; 
   }    
   function getbeginWidth($width){
   $k = $this->getWidth();
   $x1 = ($k - $width)/2;
   return $x1;
   }
   function getbeginHeight($height){
   $k = $this->getHeight();
   $y1 = ($k - $height)/2;
   return $y1;
   }
   function crop($width,$height) {
        $width = intval($width);
        $height = intval($height);
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, $this->getbeginWidth($width), $this->getbeginHeight($height),  $width, $height, $width, $height);
        $this->image = $new_image;   
   }   
}
}
?>
