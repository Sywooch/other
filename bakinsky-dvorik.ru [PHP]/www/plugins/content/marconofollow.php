<?php
/*
 * A plugin that allows you to add rel="nofollow" on all external link
 * Plugin for Joomla 1.5 Version 1.4
 * License: http://www.gnu.org/copyleft/gpl.html
 * Authors: marco maria leoni
 * Copyright (c) 2010 - 2014 marco maria leoni web consulting - http: www.mmleoni.net
 * Project page at http://www.mmleoni.net/marco-rel-nofollow
 * *** Last update: May 17th, 2014 ***
*/


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class plgContentMarconofollow extends JPlugin{

	public function onPrepareContent(&$row, &$params, $limitstart){
		if (is_object($row)){
			return $this->setNofollow($row->text, $params);
		}
		return $this->setNofollow($row, $params);
	}
 
	private function setNofollow(&$text, &$params){
		/*
		 * Check for presence of {mnf=off} which is explicits disables this
		 * bot for the item.
		 */
		
		if (JString::strpos($text, '{mnf=off}') !== false) {
			$text = JString::str_ireplace('{mnf=off}', '', $text);
			return true;
		}

		// Load plugin params info
		$mode = $this->params->get('mode');
		$attribsModeStrict = $this->params->get('attribsModeStrict', 0);
		$target = $this->params->get('target');
		$applyMethod = $this->params->get('applymethod', 'ALL');
		if($this->params->get('classeslist')){
			$classesList = explode(',', preg_replace('/\s*/', '', $this->params->get('classeslist')));
		}else{
			$classesList = array();
		}
		
		/* $pattern = "/<a((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/i"; */
		$tags = array( 'a' => '/<a\s+([^>]*)>/i', 'area' => '/<area\s+([^>]*)>/i' );
		foreach($tags as $tag => $pattern){
			$links = array();
			preg_match_all( $pattern, $text, $links, PREG_SET_ORDER );

			foreach ($links as $link){
				$pattern = "/(\w+)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?/i"; // get attributes
				$attribs = array();
				preg_match_all ( $pattern, $link[1], $attribs, PREG_SET_ORDER );
				
				$list = array();
				foreach ($attribs as $attrib){
					if (!isset($attrib[2])) continue; // something wrong, may be js in email cloaking plugin
					if(!$attribsModeStrict){ //relaxed
						$list[strtolower($attrib[1])] = preg_replace("/=\s*[\"']?([^'\"]*)[\"']?/", "$1", $attrib[2]);
					}else{ //strict
						$list[strtolower($attrib[1])] = preg_replace("/=\s*(?:\"([^\"]*)\")|(?:'([^']*)')/", "$1", $attrib[2]);
					}

				}
				
				// skip if non http link or anchor
				if (!isset($list['href'])) continue;
				if (stripos($list['href'], 'http') !== 0) continue;
				$href = preg_replace("/https?:\/\//i", '', $list['href']);

				// skip if internal link
				if (stripos($href, $_SERVER['SERVER_NAME']) === 0) continue;
				
				//get classes
				if(!empty($list['class'])){
					$linkClasses = preg_split('/\s+/', $list['class']);
				}else{
					$linkClasses = array();
				}

				if(array_intersect($linkClasses, $classesList)){
					//link classes are present in classes list
					if($applyMethod=='ALL') continue;
				}else{
					if($applyMethod=='NONE') continue;
				}
				
				if( ($mode == 0) && !isset($list['rel']) ){
					$list['rel'] = 'nofollow';
				}else if ($mode==1)	{
					$list['rel'] = 'nofollow';
				}else if ($mode==2)	{
					unset($list['rel']);
				}
				
				if( ($target == 0) && !isset($list['target']) ){
					$list['target'] = "_blank";
				}else if ($target == 1){
					$list['target'] = "_blank";			
				}else if ($target == 2){
					$list['target'] = "_parent";
				}
				
				$ahref = "<$tag ";
				foreach ($list as $k=>$v){
					$ahref .= "{$k}=\"{$v}\" ";
				}
				$ahref .= '>';
				
				$text = str_replace($link[0], $ahref, $text);
				
			}
		}
		return true;
	}
}	
?>