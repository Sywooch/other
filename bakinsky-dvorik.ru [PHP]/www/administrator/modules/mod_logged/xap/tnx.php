<?php
// ���� ����� ���������� ������ - �����������������:
error_reporting(0);

/* TNX */
class TNX_n
{
        /*
        ���������� �� ���������
        */
        /****************************************/
        var $_timeout_cache = 3600; // 3600 - ����� ��� ���������� ����, �� ��������� 3600 ������, �.�. 1 ���
        var $_timeout_down = 3600; // 3600 - ����� ��� ���������� ��������� � tnx, � ������ ������� �������, �� ��������� 3600, �.�. 1 ���
        var $_timeout_down_error = 60; // ������������ �����, ��� ��������� ����� ������ ��� ��������� ������ � �������
        var $_timeout_connect = 5; // ������� ��������
        var $_connect_using = 'fsock'; // ������ �������� - curl ��� fsock
        var $_check_down = false; // ���������, �� ���� �� �������� �������. ���� ���� - �� ��������� �������� ������� �� ����� ��������
        var $_html_delimiter = '<br>'; // ����������� ��� ����� ����� ��������
        var $_encoding = ''; // ����� ��������� ������ �����. ����� - win-1251 (�� ���������). ����� ��������: KOI8-U, UTF-8 (��������� ������ iconv �� ��������)
        var $_exceptions = 'PHPSESSID'; // ����� ����� �������� ����� ������ �����, �������� � ���� ��� ���������� �� ���������� ��������, � �.�. �� robots.txt. ��� ����, �� ��������� �����������, ��� �� ������������ ��������. ����� ���������� �� ������.
        var $_forbidden = ''; // ����������� ��������, ����� ������, �������� ����� ��������� http://www.site.ru/index.php ����� '/index.php' � �.�. �� ��������� ���� http://www.site.ru/index.php?id=100 ����� ������������ ������, ����� �� ������������ - ����������� exceptions
        /****************************************/

        /*
        ����� ������ �� ������
        */
        var $_version = '0.2c';
        var $_return_point = 0;
        var $_down_status = 0;
        var $_content = '';

        function TNX_n($login, $cache_dir)
        {
                // ��������� ��������
                if($this->_connect_using == 'fsock' AND !function_exists('fsockopen'))
                {
                        $this->print_error('������, fsockopen �� ��������������, ��������� ������� �������� ������� �������� ��� ���������� CURL');
                        return false;
                }
                if($this->_connect_using == 'curl' AND !function_exists('curl_init'))
                {
                        $this->print_error('������, CURL �� ��������������, ���������� fsock.');
                        return false;
                }
                if(!empty($this->_encoding) AND !function_exists("iconv"))
                {
                        $this->print_error('������, iconv �� ��������������.');
                        return false;
                }
                // �������� �� ������� ��������, �� ���� �����, �� ����� ����.
                if (strlen($_SERVER['REQUEST_URI']) > 180)
                {
                        return false;
                }

                if ($_SERVER['REQUEST_URI'] == '')
                {
                        $_SERVER['REQUEST_URI'] = '/';
                }

                if(!empty($this->_exceptions))
                {
                        $exceptions = explode(' ', $this->_exceptions);
                        for ($i=0; $i<sizeof($exceptions); $i++)
                        {
                                if($_SERVER['REQUEST_URI'] == $exceptions[$i]) return false;
                                if($exceptions[$i] == '/' AND preg_match("#^\/index\.\w{1,5}$#", $_SERVER['REQUEST_URI'])) return false;
                                if(strpos($_SERVER['REQUEST_URI'], $exceptions[$i]) !== false) return false;
                        }
                }

                if(!empty($this->_forbidden)) // 21.09.07
                {
                        $forbidden = explode(' ', $this->_forbidden);
                        for ($i=0; $i<sizeof($forbidden); $i++)
                        {
                                if($_SERVER['REQUEST_URI'] == $forbidden[$i]) return false;
                        }
                }

                $login = strtolower($login);
                $this->_host = $login . '.tnx.net';

                $file = base64_encode($_SERVER['REQUEST_URI']);
                $user_pref = substr($login, 0, 2);
                $this->_md5 = md5($file);
                $index = substr($this->_md5, 0, 2);

                $site = str_replace('www.', '', $_SERVER['HTTP_HOST']);

                $this->_path = '/users/' . $user_pref . '/' . $login . '/' . $site. '/' . substr($this->_md5, 0, 1) . '/' . substr($this->_md5, 1, 2) . '/' . $file . '.txt';

                $this->_url = 'http://' . $this->_host . $this->_path;

                $absolute = $_SERVER['DOCUMENT_ROOT'] . $cache_dir;

                $site = str_replace('http://', '', $site);
                $site = str_replace('.', '_', $site);

                $this->_cache_file = $absolute . 'cache_' . $site . '_' . $index . '.txt';
                $this->_down_file = $absolute . 'down_' . $site . '.txt';

                /*
                ������ ��������� _down_file �����, ��������� ������� � _down_status
                ����� read_down ����������:
                0 - ������� � ����� ���������
                time() - ����� �������, ������� �������� �� ���������
                */
                if($this->_check_down)
                {
                        $this->_down_status = $this->read_down();
                }
                // ���������, ���������� �� ���� ����
                if(!is_file($this->_cache_file))
                {
                        // ������ ������ ��� ������������ ��������
                        $this->_content = $this->get_content();
                        if($this->_content)
                        {
                                /*
                                ���� ������ ��������, ��
                                 - ������� ���� _cache_file � ������� � ����,
                                   time() �������� ����,
                                   ��� ������������ ����������� ����������
                                */
                                $this->write_timeout();

                                /*
                                ����� ���������� ������ � ��� _cache_file
                                � ���� "_md5|_content\r\n"
                                */
                                $this->write_cache();
                        }
                }
                // ���� ���� ���� ����������
                else
                {
                        /*
                        ������ �� _cache_file ������ ������, ����� �������� ����.
                        ������� �����, ��������� � ������� �������� ����
                        */
                        $time = time() - $this->read_timeout();

                        // ���������, ����� �� �������� ���
                        if($time > $this->_timeout_cache)
                        {
                                // ������ ������ ��� ������������ ��������
                                $this->_content = $this->get_content();
                                if($this->_content)
                                {
                                        /*
                                        ���� ������ ��������, ��
                                        - �������� ���� _cache_file � ������� � ����,
                                          time() ���������� ����,
                                          ��� ������������ ����������� ����������
                                        */
                                        $this->write_timeout();
                                        // ����� ���������� ������
                                        $this->write_cache();
                                }
                        }

                        /*
                        ���� ��������� ��� �� ����� ��� �� _content == false
                        �.�. ����� get_content() ������ false � ������ �� ��������, ��:
                        */
                        if($time < $this->_timeout_cache OR isset($this->_content))
                        {
                                // ������� ����� �� ���� _md5 ������ ��� �������� ��������
                                $this->_content = $this->read_cache();
                                if(!$this->_content)
                                {
                                        // ���� read_cache() ������ false
                                        // ������� ������� ������ � tnx
                                        $this->_content = $this->get_content();
                                        if($this->_content)
                                        {
                                                /*
                                                ���� ������ ��������, ��
                                                ����� �� � ���
                                                */
                                                $this->write_cache();
                                        }
                                }
                        }
                }
                // ������� ��� ��������� ������
                clearstatcache();

                if($this->_content !== false)
                {
                        $this->_content_array = explode('<br>', $this->_content);
                        for ($i=0; $i<sizeof($this->_content_array); $i++)
                        {
                                $this->_content_array[$i] = trim($this->_content_array[$i]);
                        }
                }

        }

        // ������� ������
        function show_link($num = false)
        {
                // ��������� ���� �� ������ ������ � ���
                if(!isset($this->_content_array))
                {
                        return false;
                }

                $links = '';

                // ������������ ���������� ������ � �������
                if(!isset($this->_content_array_count)){$this->_content_array_count = sizeof($this->_content_array);}
                if($this->_return_point >= $this->_content_array_count)
                {
                        return false;
                }
                // ���� ������� ��� ������ ��� ��������� ���������� ������, ������ ��� �� �� ����� ����
                if($num === false OR $num >= $this->_content_array_count)
                {
                        for ($i = $this->_return_point; $i < $this->_content_array_count; $i++)
                        {
                                $links .= $this->_content_array[$i] . $this->_html_delimiter;
                        }
                        $this->_return_point += $this->_content_array_count;
                }
                else
                {
                        // ���� ��� ������ ��� ���� ��������, �� ���������� ������
                        if($this->_return_point + $num > $this->_content_array_count)
                        {
                                return false;
                        }

                        for ($i = $this->_return_point; $i < $num + $this->_return_point; $i++)
                        {
                                $links .= $this->_content_array[$i] . $this->_html_delimiter;
                        }

                        // ����������� ����� ������� ������
                        $this->_return_point += $num;
                }
                return (!empty($this->_encoding)) ? iconv("windows-1251", $this->_encoding, $links) : $links;
        }

        // ������� ��������� ������
        function get_content()
        {
                /*
                �������� � ����� �� ������ �� ����� _down_file
                0 - ������ �������
                */
                if($this->_down_status != 0)
                {
                        /*
                        ��������� �������, ���� ��������� ����� �� ���������,
                        �� ������ �� ������
                        */
                        if(time() - $this->_down_status <= $this->_timeout_down)
                        {
                                return false;
                        }
                        else
                        {
                                // ���� ��������� �������� _down_file � ������� ������� ������
                                $this->clean_down();
                        }
                }

                // ��������� ���� user agent, ���� �� ����� ������, ��� � ��� �����������
                $user_agent = 'TNX_n PHP ' . $this->_version;

                $page = '';

                if ($this->_connect_using == 'curl' OR ($this->_connect_using == '' AND function_exists('curl_init')))
                {
                        // ������� ������� ������ ������
                        $c = curl_init($this->_url);
                        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, $this->_timeout_connect);
                        curl_setopt($c, CURLOPT_HEADER, false);
                        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($c, CURLOPT_TIMEOUT, $this->_timeout_connect);
                        curl_setopt($c, CURLOPT_USERAGENT, $user_agent);
                        $page = trim(curl_exec($c));

                        // ��������� ��� �� ������ ������, �������� �� ������, ���������� ������ 200 � 404
                        if(curl_error($c) OR (curl_getinfo($c, CURLINFO_HTTP_CODE) != '200' AND curl_getinfo($c, CURLINFO_HTTP_CODE) != '404') OR strpos($page, 'fsockopen') !== false)
                        {
                                curl_close($c);

                                $this->check_down();
                                return false;
                        }
                        curl_close($c);
                }
                elseif($this->_connect_using == 'fsock')
                {
                        $buff = '';
                        $fp = @fsockopen($this->_host, 80, $errno, $errstr, $this->_timeout_connect);
                        if ($fp)
                        {
                                fputs($fp, "GET " . $this->_path . " HTTP/1.0\r\n");
                                fputs($fp, "Host: " . $this->_host . "\r\n");
                                fputs($fp, "User-Agent: " . $user_agent . "\r\n");
                                fputs($fp, "Connection: Close\r\n\r\n");

                                stream_set_blocking($fp, true);
                                stream_set_timeout($fp, $this->_timeout_connect);
                                $info = stream_get_meta_data($fp);

                                while ((!feof($fp)) AND (!$info['timed_out']))
                                {
                                        $buff .= fgets($fp, 4096);
                                        $info = stream_get_meta_data($fp);
                                }
                                fclose($fp);

                                if ($info['timed_out']) return false;

                                $page = explode("\r\n\r\n", $buff);
                                $page = $page[1];
                                if((!preg_match("#^HTTP/1\.\d 200$#", substr($buff, 0, 12)) AND !preg_match("#^HTTP/1\.\d 404$#", substr($buff, 0, 12))) OR $errno!=0 OR strpos($page, 'fsockopen') !== false)
                                {
                                        $this->check_down();
                                        return false;
                                }
                        }
                }
                // ���� � ��� 404
                if(strpos($page, '404 Not Found'))
                {
                        return '';
                }

                return $page;
        }

        // ������ ������ ������ _down_file �����
        function read_down()
        {
                if (!is_file($this->_down_file))
                {
                        $this->clean_down();
                        clearstatcache();
                        return 0;
                }

                $fp = fopen($this->_down_file, "rb");

                if ($fp)
                {
                        flock($fp, LOCK_SH);
                        $flag = (int)fgets($fp, 11);
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return $flag;
                }
                return $this->print_error('�� ���� ������� ������ �� �����: ' . $this->_down_file);
        }

        function clean_down ($str = 0)
        {
                $fp = fopen($this->_down_file, "wb+");

                if ($fp)
                {
                        flock($fp, LOCK_EX);
                        fwrite($fp, $str . "\r\n");
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return true;
                }
                return $this->print_error('�� ���� ������� ������ �� �����: ' . $this->_down_file);
        }

        function read_timeout()
        {
                $fp = fopen($this->_cache_file, "rb");

                if ($fp)
                {
                        flock($fp, LOCK_SH);
                        $timeout = (int)fgets($fp, 11);
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return $timeout;
                }
                return $this->print_error('�� ���� ������� ������ �� �����: ' . $this->_cache_file);
        }

        /*down*/
        function write_down()
        {
                $fp = fopen($this->_down_file, "ab+");

                if ($fp)
                {
                        flock($fp, LOCK_EX);
                        fwrite($fp, time() . "\r\n");
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return true;
                }
                return $this->print_error('�� ���� �������� ������ � ����: ' . $this->_down_file);

        }

        /*down*/
        function down_filesize()
        {
                $size = filesize($this->_down_file);
                clearstatcache();
                return $size;
        }

        /*cache*/
        function write_timeout()
        {
                $fp = fopen($this->_cache_file, "wb+");

                if ($fp)
                {
                        flock($fp, LOCK_EX);
                        fwrite($fp, time() . "\r\n");
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return true;
                }
                return $this->print_error('�� ���� �������� ������ � ����: ' . $this->_cache_file);
        }
        /*cache*/
        function write_cache($flag = "ab+")
        {
                if($this->_content === false)
                {
                        return false;
                }

                $fp = fopen($this->_cache_file, $flag);

                if ($fp)
                {
                        flock($fp, LOCK_EX);
                        fwrite($fp, $this->_md5 . '|' . $this->_content . "\r\n");
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return true;
                }
                return $this->print_error('�� ���� �������� ������ � ����: ' . $this->_cache_file);
        }
        /*cache*/
        function read_cache()
        {
                $fp = fopen($this->_cache_file, "rb");

                if ($fp)
                {
                        flock($fp, LOCK_SH);
                        fseek($fp, 11);
                        while (!feof($fp))
                        {
                                 $buffer = fgets($fp);
                                 if (substr($buffer, 0, 32) == $this->_md5)
                                 {
                                         flock($fp, LOCK_UN);
                                         fclose($fp);
                                         return substr($buffer, 33);
                                 }
                        }
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        return false;
                }
                return $this->print_error('�� ���� ������� ������ �� �����: ' . $this->_cache_file);
        }

        function check_down()
        {
                if(!$this->_check_down)
                {
                        return false;
                }
                /*
                ���� ������ �� ��������, ��
                ����� � _down_file ����� ����
                */
                $this->write_down();

                /*
                � ���� _down_file ��������� 3 ������� ����� (��������� ��������� � �������),
                ������� ��������� ���������������, ����� ���� ���� �������� 39 ����,
                ��������� ������ �����
                */
                if ($this->down_filesize() >= 39)
                {
                        /*
                        ���� ��� ���� ��� ��������� �������, ��
                        ��������� ��������� ��������� ����� ����
                        */

                        // �������� ������ $file � ������� 1-3 (����� ������� ����)
                        $file = file($this->_down_file);
                        for ($i=1; $i<sizeof($file); $i++)
                        {
                                $file[$i] = (int)trim($file[$i]);
                        }

                        // ��������� ������� ����� ���������� ����� 3-�� ������
                        $time_error = (($file[3]-$file[2]) + ($file[2]-$file[1])) / 2;

                        // ���� ������� ����� ������ ���������� ����� (_timeout_down_error), ��
                        if ($time_error <= $this->_timeout_down_error)
                        {
                                /*
                                �������� ���� _down_file � ����� � ���� �����
                                ������������ ����� ������� �������
                                */
                                $this->clean_down(time());
                        }
                        else
                        {       // ���� �� ����� � ���������� �����, �� ������ ��������� � 0
                                $this->clean_down();
                        }
                }
        }

        function print_error($str)
        {
                echo date("Y-m-d G:i:s") . ' - ' . $str . "<br>\r\n";
        }
}
?>