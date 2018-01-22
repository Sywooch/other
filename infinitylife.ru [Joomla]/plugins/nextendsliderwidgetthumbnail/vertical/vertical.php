<?php
/*
# author Roland Soos
# copyright Copyright (C) Nextendweb.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-3.0.txt GNU/GPL
*/
defined('_JEXEC') or die('Restricted access'); 


 
 $dir=str_replace("plugins/nextendsliderwidgetthumbnail/vertical/","",dirname(__FILE__));

// define('JPATH_BASE', $dir ); 

  
     //define('_JEXEC', 1);
//define('JPATH_BASE', $dir);
//define('DS', DIRECTORY_SEPARATOR);
 
/* Required files */
//require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
//require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
 
/* Create the Application */
//$app = JFactory::getApplication('site')->initialise();




?><?php

nextendimportsmartslider2('nextend.smartslider.plugin.widget');
nextendimport('nextend.image.color');

class plgNextendSliderWidgetThumbnailVertical extends plgNextendSliderWidgetAbstract {

    var $_name = 'vertical';

    function onNextendthumbnailList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';
        $thumbnail = $params->get('thumbnail', false);
        if ($thumbnail && $thumbnail != '-1') {

            $displayclass = self::getDisplayClass($params->get('widgetthumbnaildisplay', '0|*|always|*|0|*|0'), true);

            $css = NextendCss::getInstance();
            $css->addCssFile(NextendFilesystem::translateToMediaPath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR . 'style.css'));

            $js = NextendJavascript::getInstance();
            $js->addLibraryJsLibraryFile('jquery', 'jquery.mousewheel.js');
            $js->addLibraryJsFile('jquery', dirname(__FILE__) . '/vertical/script.js');

            $thumbnailactivebackground = $params->get('thumbnailactivebackground', '00000080');
            $rgbathumbnailactivebackground = NextendColor::hex2rgba($thumbnailactivebackground);
            $rgbacssthumbnailactivebackground = 'RGBA('.$rgbathumbnailactivebackground[0].','.$rgbathumbnailactivebackground[1].','.$rgbathumbnailactivebackground[2].','.round($rgbathumbnailactivebackground[3]/127, 2).')';
            $colorhexthumbnailactivebackground = substr($thumbnailactivebackground, 0,6);

            $info = pathinfo($thumbnail);
            $class = 'nextend-thumbnail nextend-thumbnail-vertical nextend-thumbnail-vertical-' . basename($thumbnail, '.' . $info['extension']);

            $thumbnailsize = array(NextendParse::parse($params->get('thumbnailsize', '300')));
            $thumbnailcolumn = $params->get('thumbnailcolumn', '30');
            $thumbnailperpage = $params->get('thumbnailperpage', 2);

            list($positionstyle, $data) = self::getPosition($params->get('thumbnailposition', ''));
            $positionstyle.= 'z-index:10; font-size: '.intval($slider->_sliderParams->get('globalfontsize', '12')).'px;';

            $html .= '<div id="'.$id.'-thumbnail" class="'.$displayclass.'" style="width: '.$thumbnailsize[0].'px;height: 100%;'.$positionstyle.'" '.$data.'>';

            $html .= '<div class="nextend-thumbnail-container ' . $class . ' nextend-clearfix">
            <div class="nextend-arrow-top"></div>';

            $html .= '<div class="nextend-thumbnail-strip-hider"><div class="nextend-thumbnail-strip">';
            
            $thumbnailtitlelink = $params->get('thumbnailtitlelink', 0);


$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=16 AND trash=0");
$list = $database->loadObjectList();


$i=0;
 foreach($list as $it) { 
/////////////////////////////





$html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'goto\',' . $i . ',false);" class="' . $class . ($slider->_slides[$i]['first'] ? ' active' : '') . '">';


$hash = md5('Image'.$it->id);



                if($thumbnailcolumn != 0){
                    if(!$slider->_slides[$i]['thumbnail'] && $slider->_slides[$i]['bg']['desktop']){
                        $slider->_slides[$i]['thumbnail'] = $slider->_slides[$i]['bg']['desktop'];
                    }
                    $html .= '<div class="nextend-thumbnail-vertical-image" style="float:left;width:'.$thumbnailcolumn.'%; background-image:url(/media/k2/items/src/'.$hash.'.jpg);"></div>';
                }
		
				
				
                $html .= '<div class="nextend-thumbnail-vertical-content tmp1" style="width:'.(100-$thumbnailcolumn).'%;">';
      	       
               // $link = NextendParse::parse($slider->_slides[$i]['params']->get('link'));
               $link="/";
			   
			 	      
                if($thumbnailtitlelink && $link[0] != '' && $link[0] != '#'){
                    $html .= '<h4 class="'.$params->get('thumbnailfontclasstitle').'"><a href="'.$link[0].'" target="'.$link[1].'">'.$slider->_slides[$i]['title'].'</a>1234</h4>';
                }else{
                    $html .= '<h4 class="'.$params->get('thumbnailfontclasstitle').'">'.$slider->_slides[$i]['title'].'</h4>';
                }
                  $abc = explode(" ", $it->introtext);
				  $mydesc2="";
				  
				  for($i2=0; $i2<10; $i2++){$mydesc2 = $mydesc2.$abc[$i2]." ";}
				  $mydesc = $mydesc2."...";
				  
				  
                $html .= '<p class="'.$params->get('thumbnailfontclassdescription').'">'.$mydesc.'</p>';

				
				/*
                    </div></div>';
             

            $html .= '</div></div></td>';

            $html .= '<div class="nextend-arrow-bottom"></div>';
			
			*/
			$html .= '</div>';
			
			
			
			$html .= '</div>';

           
$i++;

////////////////////////////
 }





            for ($i = 0; $i < count($slider->_slides); $i++) {
			break;
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'goto\',' . $i . ',false);" class="' . $class . ($slider->_slides[$i]['first'] ? ' active' : '') . '">';
                if($thumbnailcolumn != 0){
                    if(!$slider->_slides[$i]['thumbnail'] && $slider->_slides[$i]['bg']['desktop']){
                        $slider->_slides[$i]['thumbnail'] = $slider->_slides[$i]['bg']['desktop'];
                    }
                    $html .= '<div class="nextend-thumbnail-vertical-image" style="float:left;width:'.$thumbnailcolumn.'%; background-image:url(\''.$slider->_slides[$i]['thumbnail'].'\');"></div>';
                }
                $html .= '<div class="nextend-thumbnail-vertical-content tmp1" style="width:'.(100-$thumbnailcolumn).'%;">';
                
                $link = NextendParse::parse($slider->_slides[$i]['params']->get('link'));
                    
                if($thumbnailtitlelink && $link[0] != '' && $link[0] != '#'){
                    $html .= '<h4 class="'.$params->get('thumbnailfontclasstitle').'"><a href="'.$link[0].'" target="'.$link[1].'">'.$slider->_slides[$i]['title'].'</a>1234</h4>';
                }else{
                    $html .= '<h4 class="'.$params->get('thumbnailfontclasstitle').'">'.$slider->_slides[$i]['title'].'</h4>';
                }
                
                $html .= '<p class="'.$params->get('thumbnailfontclassdescription').'">'.$slider->_slides[$i]['description'].'</p>
                    </div></div>';
            }

            $html .= '</div></div></td>';

            $html .= '<div class="nextend-arrow-bottom"></div></div></div>';

            $html .="
              <script type='text/javascript'>
                  njQuery(document).ready(function () {
                      window['".$id."-thumbnail'] = new smartSliderVertical({
                          id: '".$id."',
                          node: window.njQuery('#".$id."-thumbnail'),
                          thumbnailperpage: '".$thumbnailperpage."',
                          thumbnailanimation: '".$params->get('thumbnailanimation', 700)."'
                      });
                  });
              </script>
            ";
            
            $css->addCssFile('
                #'.$id.' .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical1:HOVER,            
                #'.$id.' .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical1.active,                      
                #'.$id.' .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical1 .nextend-arrow-top:HOVER,
                #'.$id.' .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical1 .nextend-arrow-bottom:HOVER,
                #'.$id.' .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical-light:HOVER,            
                #'.$id.' .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical-light.active,                      
                #'.$id.' .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical-light .nextend-arrow-top:HOVER,
                #'.$id.' .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical-light .nextend-arrow-bottom:HOVER{            
                    background-color:'.$rgbacssthumbnailactivebackground.';
                }', $id);
        }
        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetthumbnail', 'plgNextendSliderWidgetThumbnailVertical');