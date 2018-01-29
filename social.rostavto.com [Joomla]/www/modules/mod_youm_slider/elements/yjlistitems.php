<?php
/**
 * @package		Youjoomla Extend Elements
 * @author		Youjoomla LLC
 * @website     Youjoomla.com 
 * @copyright	Copyright (c) 2007 - 2011 Youjoomla LLC.
 * @license   PHP files are GNU/GPL V2. CSS / JS / IMAGES are Copyrighted Commercial
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldYjListitems extends JFormField
{

	var	$type = 'yjlistitems'; 


	public function getInput()
	{
		
		
        $uri = str_replace(DS,"/",str_replace( JPATH_SITE, JURI::base (), dirname(dirname(__FILE__)) ));
		$uri = str_replace("/administrator/", "", $uri);
		
		$name  = $this->name; 
		$document = & JFactory::getDocument();
		$js = "		
		
		
		
		function jSelectArticle(id, title, catid, object) {
			var exists = false;
			$$('#itemsList input').each(function(element){
					if(element.value==id){
						alert('".JText::_('Item exists already in the list')."');
						exists = true;			
					}
			});
			if(!exists){
				var container = new Element('div').injectInside($('itemsList'));
				var img = new Element('img',{'class':'remove', 'src':'".$uri."/images/publish_x.png'}).injectInside(container);
				var span = new Element('span',{'class':'handle'}).set('html',title).injectInside(container);
	var input = new Element('input',{'value':id, 'type':'hidden', 'name':'".$this->name."[]'}).injectInside(container);
				var div = new Element('div',{'style':'clear:both;'}).injectInside(container);
				fireEvent('sortingready');
				alert('".JText::_('Item added in the list')."');			
			}
		}
		
		window.addEvent('domready', function(){			
			fireEvent('sortingready');
		});
		
		window.addEvent('sortingready', function(){
			new Sortables($('itemsList'), {
			 	handles:$$('.handle')
			
			});
			$$('#itemsList .remove').addEvent('click', function(){
				$(this).getParent().dispose();
			});
		});
		";

		$document->addScriptDeclaration($js);
		
		$css = "
		#itemsList {
			height:auto;
			overflow:hidden;
			padding:10px 0;
			display:block;
			clear:both;
		}
		#itemsList img{
			margin:-1px 3px 0 0;
		}
		#itemsList span {
			display:inline-block;
			height:16px;
			line-height:16px;
			color:green;
			font-weight:bold;
			margin:0 0 3px 5px;
		}
		#itemsList span.handle {
			cursor:move;
		}
		#itemsList img.remove {
			width:16px;
			height:16px;
			margin-right:4px;
			cursor:pointer;
			float:left;
		}
		";
		$document->addStyleDeclaration($css);
		$value = $this->value;
		$current = array();
		if(is_string($value) && !empty($value))
			$current[]=$value;
		if(is_array($value))
			$current=$value;
			
		JTable::addIncludePath(JPATH_ROOT.'/modules/mod_yj_nf_ultimate/elements');
		$output = '<div id="itemsList">';
		foreach($current as $id){
			$row = & JTable::getInstance('YjContent', 'Table');
			$row->load($id);



			$output .= '
			<div>
				<img class="remove" src="'.$uri.'/images/publish_x.png"/>
				<span class="handle">'.$row->title.'</span>
				<input type="hidden" value="'.$row->id.'" name="'.$this->name.'[]"/>
				<div style="clear:both;"></div>
			</div>
			';
		}
		$output .= '</div>';
		return $output;
	}
}
