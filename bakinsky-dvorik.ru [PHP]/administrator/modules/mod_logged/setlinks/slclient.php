<?php

/*
  Код вызова ссылок SetLinks.ru.
  Основной класс.
  Версия 5.0.0
 */
require_once(dirname(__FILE__) . "/slconfig.php");

class SLClient {

    // внутренние переменные
    var $Config;
    var $links = false;
    var $page_links = false;
    var $return_links = array();
    var $context_links = false;
    var $forever_links = false;
    var $curlink = 0;
    var $servercachetime = 0;
    var $cachetime = 0;
    var $errortime = 0;
    var $delimiter = '';
    var $uri = false;
    var $host = '';
    var $blocks = array();
    var $_safe_params = Array();
    var $_servers = Array();
    var $_show_comment = false;
    var $_moder_message = array();
    var $_errors = array();

    /**
     * Constructor
     * @param type $uri
     */
    function SLClient($uri = '') {
        $this->Config = new SLConfig();

        if (!empty($uri))
            $this->uri = $uri;
        else
            $this->uri = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $HTTP_SERVER_VARS['REQUEST_URI']);

        if (substr($this->Config->server, 0, 7) == 'http://') {
            $this->Config->server = substr($this->Config->server, 7);
        }

        if (strlen(session_id()) > 0) {
            $session = session_name() . "=" . session_id();
            $this->uri = str_replace(array('?' . $session, '&' . $session), '', $this->uri);
        }

        if (empty($this->uri) || (!empty($this->Config->indexfile) && preg_match("!" . $this->Config->indexfile . "!", $this->uri)))
            $this->uri = '/';

        $ok = false;
        if ($this->Config->connecttype == 'CURL' && !function_exists('curl_init'))
            $this->Error('CURL not found! Библиотека CURL не обнаружена!');
        elseif ($this->Config->connecttype == 'SOCKET' && !function_exists('fsockopen'))
            $this->Error('fsockopen not found! Внешние соединения не поддерживаются Вашим хостингом!');
        elseif ($this->Config->connecttype == 'NONE')
            $a=1;
        elseif (!empty($this->Config->connecttype)) {
            $ok = true;
        }
        if (!$ok) {
            if (function_exists('curl_init'))
                $this->Config->connecttype = 'CURL';
            elseif (function_exists('fsockopen'))
                $this->Config->connecttype = 'SOCKET';
            else
                $this->Config->connecttype = 'NONE';
        }
        $this->host = $_SERVER['HTTP_HOST'];
        if (substr($this->host, 0, 4) == 'www.')
            $this->host = substr($this->host, 4);
        if (isset($this->Config->aliases[$this->host]))
            $this->host = $this->Config->aliases[$this->host];
        if (empty($this->Config->cachedir))
            $this->Config->cachedir = dirname(__FILE__) . "/cache/";
        if (!is_dir($this->Config->cachedir))
            $this->Error("Can't open cache dir!");
        else if (!is_writable($this->Config->cachedir))
            $this->Error("Cache dir: Permission denied!");

        if (empty($this->cachefile))
            $this->cachefile = strtolower($this->host) . '.links';
        if ($this->Config->use_safe_method && trim($this->Config->allow_url_params) != '') {
            $prms = explode(" ", $this->Config->allow_url_params);
            foreach ($prms as $p)
                $this->_safe_params[] = sprintf("%u", crc32($p));
        }
    }

    /**
     * Download links from server
     * @return boolean
     */
    function DownloadLinks() {
        $page = '';
        $path = "/?host=" . $this->host . "&k=" . $this->Config->encoding . "&p=" . $this->Config->password . "&time=" . time() . "&v=" . SETLINKS_CODE_VERSION . ($this->Config->use_safe_method ? "&safe" : "");
        if ($this->Config->connecttype == "CURL") {
            $curl = curl_init('http://' . $this->Config->server . $path);
            if ($curl) {
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->Config->sockettimeout);
                curl_setopt($curl, CURLOPT_TIMEOUT, $this->Config->sockettimeout);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $page = curl_exec($curl);
                if (curl_error($curl) OR curl_getinfo($curl, CURLINFO_HTTP_CODE) != '200') {
                    curl_close($curl);
                    return false;
                }
                curl_close($curl);
            } else {
                return false;
            }
        } else if ($this->Config->connecttype == "SOCKET") {
            $fp = @fsockopen($this->Config->server, 80);
            if (!$fp) {
                return false;
            } else {
                fputs($fp, "GET " . $path .
                        " HTTP/1.0\r\nHost: " . $this->Config->server . "\r\nConnection: Close\r\n\r\n");
                socket_set_timeout($fp, $this->Config->sockettimeout);
                $page = '';
                while (!feof($fp)) {
                    $page .= fread($fp, 2048);
                }
                $status = socket_get_status($fp);
                fclose($fp);
                if ($status['unread_bytes'] == 0 && $status['timed_out'] != 1) {
                    $page = substr($page, strpos($page, "\r\n\r\n") + 4);
                }
                else
                    return false;
            }
        } elseif ($this->Config->connecttype == "FGC" && function_exists('file_get_contents')) {
            $page = file_get_contents('http://' . str_replace('http://', '', $this->Config->server . $path));
        } else {
            $this->Error('CANNOT DOWNLOAD LINKS!');
            return false;
        }
        $page = trim($page);
        if (strlen($page) < 20) {
            if ($page != 'NO SITE') {
                //$this->Error($page);
            }
            return false;
        } else {
            $info = @unserialize($page);
            if (is_array($info)) {
                $this->SaveLinks($info);
            }
        }
        return true;
    }

    /**
     * Считывает и парсит данные из кэша
     * @return boolean
     */
    function ReadCacheFile() {
        $filename = $this->Config->cachedir . $this->cachefile . '.' . $this->Config->encoding;
        $h = @fopen($filename, "r");
        if ($h) {
            $info = fread($h, filesize($filename));
            $info = unserialize($info);
            $this->servercachetime = $info['system']['createtime'];
            $this->cachetime = min(time() + 24 * 60 * 60, $info['system']['cachetime']);
            $this->delimiter = $info['system']['delimiter'];
            $this->_safe_params = explode(" ", $info['system']['url_params']);
            $this->_servers = explode(" ", $info['system']['server_ips']);
            $this->errortime = isset($info['system']['errortime']) ? $info['system']['errortime'] : 0;
            @fclose($h);
        } else {
            return false;
        }
        $this->links = array();
        foreach ($info['links'] as $key => $val)
            $this->links[$key] = $val;

	if (isset($info['system']['blocks'])){
    	    $this->blocks = $info['system']['blocks'];
    	} else {
    	    $this->blocks = false;
    	}

        return true;
    }

    /**
     * ЗАписывает данные в кэш
     * @param type $info
     * @return boolean
     */
    function SaveLinks($info) {
        $h = @fopen($this->Config->cachedir . $this->cachefile . '.' . $this->Config->encoding, "w+");
        if ($h) {
            $info['system']['cachetime'] = time();
            @fwrite($h, serialize($info));
            @fclose($h);
            return true;
        }
        else
            $this->Error('Can\'t open cache file!');
    }

    function IsCached() {
        if (isset($_COOKIE[$this->Config->password])) {
            return false;
        }
        if ($this->ReadCacheFile()) {
            if (($this->cachetime + $this->Config->cachetimeout > time()) || ($this->errortime + $this->Config->errortimeout > time())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Получение ссылок для страницы
     * @param type $countlinks - количество ссылок
     * @param type $delimiter - разделитель, если нужно заменить разделитель из конфига
     * @return string - строка с ссылками и коментарием, если он нужен
     */
    function GetLinks($countlinks = 0, $delimiter = false) {
        static $firstlink = true;

        if (!$this->IsCached()) {
            if (!$this->DownloadLinks()) {
                $this->Error('Error download links from server! Read from local cache file.');
                //return $this->GetModerMessage();
            }
            // кэш не сохранен, выдаем ошибку
            if (!$this->ReadCacheFile()) {
                return $this->GetModerMessage();
            }
        }

        $pageid = sprintf("%u", crc32($this->host . $this->uri));

        if ($this->page_links === false) {
            foreach ($this->links as $links) {
                $links = explode("\t", $links);
                $page_ids = explode(' ', $links[0]);
                if ($page_ids[0] == -1 || $page_ids[0] == $pageid || ( isset($page_ids[1]) && $this->Config->use_safe_method && $page_ids[1] == $this->SafeUrlCrc32('http://' . $this->host . $this->uri))) {
                    unset($links[0]);
                    foreach ($links as $link) {
                        if (substr($link, 0, 1) == '1')
                            $this->context_links[] = substr($link, 1);
                        else if (substr($link, 0, 1) == '2')
                            $this->forever_links[] = substr($link, 1);
                        else if (substr($link, 0, 1) == '0')
                            $this->page_links[] = substr($link, 1);
                        else
                            $this->page_links[] = $link;
                    }
                }
            }
        }

        $user_ip = (isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR']);
        if ($this->Config->show_demo_links || in_array($user_ip, $this->_servers)) {
            if ($this->page_links === false || count($this->page_links) == 0) {
                if (function_exists('iconv')) {
                    $this->page_links = array_fill(0, ($countlinks > 0 ? $countlinks : 3), function_exists('iconv') ? iconv('WINDOWS-1251', $this->Config->encoding, "Демонстрационная ссылка <a href=\"http://" . $this->host . "/\">DEMO LINK</a>! Показывает как будет выглядеть ссылка на странице.") : "This is <a href=\"http://" . $this->host . "/\">DEMO LINK</a>!");
                }
            }
            if ($this->forever_links === false || count($this->forever_links) == 0)
                $this->forever_links = Array("Title: <a href=''>link</a> demo.<br/>This is <a href=''>DEMO FOREVER</a> link.");
        }


        if ($countlinks == -1)
            return true;

        $returnlinks = Array();
        $cnt = 0;
        if ($this->page_links !== false) {
            $cnt = count($this->page_links);
        }
        if ($countlinks > 0)
            $cnt = min($cnt, $this->curlink + $countlinks);
    	    for (; $this->curlink < $cnt; $this->curlink++) {
        	$returnlinks[] = $this->page_links[$this->curlink];
        }

        $user_ip = (isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR']);
        if ($this->Config->show_comment || (!empty($this->_servers) && in_array($user_ip, $this->_servers))) {
            $this->_show_comment = true;
        } else {
            $this->_show_comment = false;
        }

        $retstring = '';
        // выводим блоками или нет, в зависимости от настроек пользователя
        if ($this->blocks['block_enable'] && $cnt > 0) {
            if ($this->blocks['insert_css'] && $firstlink) {
                $retstring .= $this->blocks['css'];
            }
            // выводим ссылки
            $html = '';
            if ($this->blocks['orientation'] == 0) {
                $template = $this->blocks['html']['horizontal'];
            } else {
                $template = $this->blocks['html']['vertical'];
            }
            foreach ($returnlinks as $link) {
                // парсим линки
                if (preg_match('!<a.+href="(.*?)".*>(.*?)</a>!si', $link, $matches)) {
                    $parsed_url = parse_url($matches[1]);
                }
                $domain = $parsed_url['host'];
                $html .= str_replace(array('[!containerUrl]', '[!containerHeader]', '[!containerText]', '[!containerDomain]', '[!css_td_width]'),
                                     array($matches[1],       $matches[2],          $link,              $domain,              intval(100 / count($returnlinks))), $template['item']);
            }
            $retstring .= str_replace('[!item]', $html, $template['block']);
        } else {
            $retstring = (($firstlink && $this->_show_comment) ? $this->GetLinksComment() : '')
                    . implode(($delimiter === false ? $this->delimiter : $delimiter), $returnlinks);
        }
        $firstlink = false;

        $this->return_links = $returnlinks;
        return $retstring . $this->GetModerMessage();
    }

    function SafeUrlCrc32($url) {
        $url = parse_url(trim($url));
        if (isset($url['query'])) {
            $params = $this->GetQueryParams($url['query']);
            if ($params !== false) {
                ksort($params, SORT_STRING);
                $params_string = Array();
                foreach ($params as $name => $value) {
                    if (in_array(sprintf("%u", crc32($name)), $this->_safe_params)) {
                        if ($value === false)
                            $params_string[] = $name;
                        else
                            $params_string[] = $name . '=' . $value;
                    }
                }
                $params_string = implode('&', $params_string);
            }
        }
        if (isset($url['host']))
            $url['host'] = preg_replace('/^(:?www\.)/i', '', strtolower($url['host']), 1);
        if (!isset($url['path']))
            $url['path'] = "/";
        if (isset($params_string) && $params_string != '')
            $url['query'] = '?' . $params_string;
        else
            $url['query'] = '';
        return sprintf("%u", crc32($url['host'] . $url['path'] . $url['query']));
    }

    function GetQueryParams($query) {
        if (is_null($query) || trim($query) == '')
            return false;
        $params = explode('&', $query);
        $out_params = Array();
        foreach ($params as $val) {
            $delimiter_position = strpos($val, '=');
            if ($delimiter_position === false && $val != '') {
                $out_params[$val] = false;
            } else if ($delimiter_position == 0) {
                // no name...
            } else {
                $name = substr($val, 0, $delimiter_position);
                $value = substr($val, $delimiter_position + 1);
                $out_params[strval($name)] = $value;
            }
        }
        return $out_params;
    }

    function Context(&$text) {
        $this->GetLinks(-1); // получаем ссылки

        $text_new = preg_replace("!<(" . implode("|", $this->Config->context_bad_tags) . ").*?>.*?</\\1>!i", "<!-- setlinks: bad tags replaced -->", $text);
        $goodtexts = explode("<!-- setlinks: bad tags replaced -->", $text_new);
        $replace_chars = array('&' => '(?:&|&amp;)', ' ' => '(?:\s|&nbsp;)+', '"' => '(?:"|&quot;)', '\'' => '(?:\'|&#039;)', '<' => '(?:<|&lt;)', '>' => '(?:>|&gt;)');

        $this->ModerMessage("Context links: " . count($this->context_links));

        if ($this->context_links !== false) {
            foreach ($this->context_links as $key => $link) {
                // приводим ссылку к регулярному виду
                preg_match("!^(.*?)(<a.*?>).*?</a>!i", ' ' . $link . ' ', $matches);
                $begin_text = str_replace(array_keys($replace_chars), $replace_chars, preg_quote(trim(substr($link, 0, strpos('<a', $link))), "!"));
                preg_match("!(<a href=\".*?\".*?>)(.*?)</a>(.*?)$!i", $link, $matches);
                $link_url = $matches[1];
                $link_text = str_replace(array_keys($replace_chars), $replace_chars, preg_quote(trim($matches[2]), "!"));
                $end_text = str_replace(array_keys($replace_chars), $replace_chars, preg_quote(trim($matches[3]), "!"));

                foreach ($goodtexts as $keytext => $goodtext) {
                    $goodtexts[$keytext] = preg_replace("!({$begin_text}(?:\s|&nbsp;)*)({$link_text})((?:\s|&nbsp;)*{$end_text})!i", "\\1$link_url\\2</a>\\3", $goodtexts[$keytext], 1);
                    if ($goodtexts[$keytext] != $goodtext) { // ставим ссылку
                        $text = str_replace($goodtext, $goodtexts[$keytext], $text);
                        unset($this->context_links[$key]);
                        break;
                    }
                }
            }
        }

        $user_ip = (isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR']);
        if ($this->Config->context_show_comments || in_array($user_ip, $this->_servers)) {
            if (preg_match("!<\!--sl_index-->.*?<\!--/sl_index-->!si", $text)) {
                $text = preg_replace("!<\!--sl_index-->!i", '<!--' . substr($this->Config->password, 2, 5) . '-->', $text);
                $text = preg_replace("!<\!--/sl_index-->!i", '<!--/' . substr($this->Config->password, 2, 5) . '-->', $text);
            } else {
                $text = '<!--' . substr($this->Config->password, 2, 5) . '-->' . $text . '<!--/' . substr($this->Config->password, 2, 5) . '-->';
            }
        }
        $text = preg_replace("!<\!--/?sl_index-->!i", '', $text);
        return $text;
    }

    function IsForeverLinks() {
        $this->GetLinks(-1); // получаем ссылки
        if ($this->forever_links === false)
            return false;
        else
            return count($this->forever_links) > 0;
    }

    function ForeverLinks() {
        $this->GetLinks(-1); // получаем ссылки
        $retstring = '';
        //$this->ModerMessage("Forever links: ".var_export($this->forever_links,1));
        if ($this->forever_links !== false) {
            foreach ($this->forever_links as $fl) {
                $fl = explode('<br/>', $fl);
                $retstring .= "<div><b>{$fl[0]}</b><br/><span>{$fl[1]}</span></div>";
            }
        }
        return '<!--' . substr($this->Config->password, 0, 5) . 'f--> ' . $retstring;
    }

    function AddModerMessage($name, $text) {
        $this->_moder_message[$name] = $text;
    }

    function Error($error) {
        if ($this->Config->show_errors)
            print('<font color="red">Error: ' . $error . " </font><br>\n");
        $this->_errors[] = $error;
    }

    function IsModer() {
        $user_ip = (isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR']);
        if (isset($_COOKIE[$this->Config->password]) || (!empty($this->_servers) && in_array($user_ip, $this->_servers))) {
            return true;
        } else {
            return false;
        }
    }

    function GetModerMessage() {
        static $first = true;
        if (!$first) {
            return '';
        }
        $first = false;

        if ($this->IsModer()) {
            $this->AddModerMessage('PAGE_URL', $this->host . $this->uri);
            $this->AddModerMessage('BLOCK_ENABLE', $this->blocks['block_enable']);
            $this->AddModerMessage('SERVER_INFO', var_export($_SERVER, true));
            $this->AddModerMessage('CONFIG', var_export((array)$this->Config, true));
            $this->AddModerMessage('ERRORS', var_export($this->_errors, true));
            return $this->GetLinksComment() . '<!--SL-MODER-INFO: ' . serialize($this->_moder_message) . ' :END-SL-MODER-INFO-->';
        } else {
            return '';
        }
    }

    function GetLinksComment()
    {
        return '<!--' . substr($this->Config->password, 0, 5) . '-->';
    }

}

