<?php

/**
 * @package Plugin No External Links for Joomla! 1.5
 * @version $Id: noexternallinks.php 579 2011-08-30 12:34:41Z kir $
 * @author Kirill Mazur
 * @copyright Copyright (C) 2011 - Kirill Mazur, wmdn.ru
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 **/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );

class plgSystemNoexternallinks extends JPlugin
{
	var $appl;
	var $pluginp;
	var $link_sep;
	var $no_link;
	var $_blank;
	var $nofollow;
	var $noindex_start;
	var $noindex_end;
	var $full;
	var $enable;

	function plgSystemNoexternallinks( &$subject, $config )
	{
		$this->appl =& JFactory::getApplication();
		$plugin =& JPluginHelper::getPlugin('system', 'noexternallinks');
		$this->pluginp = new JParameter($plugin->params);
		$this->link_sep = $this->pluginp->get("link_sep");
		$this->no_link = $this->pluginp->get("no_link");
		$this->full = $this->pluginp->get("full");
		$this->enable = $this->pluginp->get("enable");
		if ($this->pluginp->get("_blank")) {$this->_blank = ' target="_blank"';}
		if ($this->pluginp->get("nofollow")) {$this->nofollow = ' rel="nofollow"';}
		if ($this->pluginp->get("noindex")) {$this->noindex_start = '<noindex>'; $this->noindex_end = '</noindex>';}
		if (@$_GET[$this->link_sep]) $this->redirect($_GET[$this->link_sep]);
		parent::__construct( $subject, $config );
		$lang = JPlugin::loadLanguage("plg_system_noexternallinks");
	}

	function redirect($url)
	{
		header('Content-type: text/html; charset="utf-8"',true);
		@header('Location: ' . $url);
		exit();
	}

	function noexternallinks($row_text)
	{
		$exclude_urls_found = '';
		$url = '?'.$this->link_sep.'=%s';
		$exclude_urls = $this->pluginp->get("exclude_urls");
		$exclude_urls = @explode("\n", $exclude_urls);

		$pattern_main = '|<a (.*?)href=[\"\'](.*?)\/\/(.*?)[\"\'](.*?)>(.*?)<\/a>|';
		preg_match_all($pattern_main, $row_text, $out);
		
		preg_match_all('|<noextlinks>(.*?)<\/noextlinks>|is', $row_text, $no_out);
		if ($no_out) {
			$row_text = str_replace($no_out[0], $no_out[1], $row_text);
			$no_out[1] = implode($no_out[1]);
			preg_match_all($pattern_main, $no_out[1], $no_out);
			$out[0] = array_diff($out[0], $no_out[0]);
		}
		
		for ($i=0;$i<@max(array_keys($out[0]))+1;$i++){
			if (@$out[0][$i] && (substr(@$out[2][$i],0,4) == "http" || substr(@$out[2][$i],0,3) == "ftp") && strpos(@$out[0][$i], $_SERVER['HTTP_HOST']) === false){
				$link = $out[2][$i].'//'.rawurldecode($out[3][$i]);
				if (strlen(implode($exclude_urls)) > 1){
					$exclude_urls_found = 0;
					for ($k=0;$k<count($exclude_urls);$k++) {
						if (strstr($link,$exclude_urls[$k])) {
							$exclude_urls_found++;
						}
					}
				}
				if ($exclude_urls_found == 0){
					if ($this->enable){
						$row_text = str_replace(@$out[0][$i], ''.$this->noindex_start.'<a'.$this->_blank.''.$this->nofollow.''.$out[4][$i].''.$out[1][$i].' href="'.str_replace("%s", $link, $url).'">'.$out[5][$i].'</a>'.$this->noindex_end.'', $row_text);
					}
					else {
						$row_text = str_replace(@$out[0][$i], ''.$this->noindex_start.'<a'.$this->_blank.''.$this->nofollow.''.$out[4][$i].''.$out[1][$i].' href="'. $link .'">'.$out[5][$i].'</a>'.$this->noindex_end.'', $row_text);
					}
				}
			}
		}
		return($row_text);
	}

	function onAfterRender()
	{
		if (!$this->appl->isAdmin() and $this->full){
			$body = JResponse::getBody();
			$body = $this->noexternallinks($body);
			JResponse::setBody($body);
		}
	}

	function onPrepareContent( &$row, &$params, $page=0 )
	{
		if (!$this->full){
			$row->text = $this->noexternallinks($row->text);
			return true;
		}
	}
}