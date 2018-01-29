<?php

/**
 * Работа с кешем
 */
class Cache_my {
    private $_sid = 0;
    private $_name_method = '';
    private $_cache_patch = '';

    function __construct($sessionId, $name_method)
    {
		if(!isset($GLOBALS['FILEcache_debug'])) $GLOBALS['FILEcache_debug'] = @array();
		$tme = microtime(true);
		$tmp['name'] = 'FILEcache__construct ('.$name_method.')';
		
        $this->_sid = $sessionId;
        if ($this->_sid === 0) {
			
			$tmp['time'] =  microtime(true)-$tme;
			$GLOBALS['FILEcache_debug'][] = $tmp;	
					
            return false;
        }
        $this->_name_method = $name_method;
        // если не сущетсвует папка
        if (!file_exists(CFG_APP_ROOT.'/cache/' . $name_method) && !is_dir(CFG_APP_ROOT.'/cache/' . $name_method)) {
            // создаем папку $name_method
            if (!mkdir(CFG_APP_ROOT.'/cache/' . $name_method, 0777)) {
				
				$tmp['time'] =  microtime(true)-$tme;
				$GLOBALS['FILEcache_debug'][] = $tmp;
				
                return false;
            }
        }
        $this->_cache_patch = CFG_APP_ROOT.'/cache/' . $name_method . '/' . md5($sessionId) . '.dat';
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
    }

    public function AddData($str)
    {
		$tme = microtime(true);
		$tmp['name'] = 'AddData';
		
        $this->DelData();
        // создаем новый файл кеша
        if (!file_exists($this->_cache_patch)) {
            $content = Array();
            $content['time'] = time();
            $content['sid'] = $this->_sid;
            $content['method'] = $this->_name_method;

            $xml = @simplexml_load_string($str);
            if($xml !== false && $xml != null){
                $xml->RequestTimeStatistic = '';
                $content['data'] = $xml->asXML();
                $content = serialize($content);
            }
            else{
                $content = $str;
            }
			$returndata = file_put_contents($this->_cache_patch, $content);
			
			$tmp['time'] =  microtime(true)-$tme;
			$GLOBALS['FILEcache_debug'][] = $tmp;			
			
            return $returndata;
        }
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
		
        return false;
    }

    public function DelData()
    {
		$tme = microtime(true);
		$tmp['name'] = 'DelData';
		
        // если есть файл кеша
        if (file_exists($this->_cache_patch)) {
			$returndata=unlink($this->_cache_patch);
			
			$tmp['time'] =  microtime(true)-$tme;
			$GLOBALS['FILEcache_debug'][] = $tmp;
		
            return $returndata; // удаляем файл кеша
        }
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
				
        return false;
    }

    public function GetData()
    {
		$tme = microtime(true);
		$tmp['name'] = 'GetData';
		
        // если есть файл кеша
        if (file_exists($this->_cache_patch)) {
			$returndata=unserialize(file_get_contents($this->_cache_patch));
			
			$tmp['time'] =  microtime(true)-$tme;
			$GLOBALS['FILEcache_debug'][] = $tmp;
			
            return $returndata; // отдать кеш
        }
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
		
        return false;
    }

    static public function DelCacheBatchGetUserData($sessionId)
    {
		$tme = microtime(true);
		$tmp['name'] = 'DelCacheBatchGetUserData';
		
        $cache_patch = CFG_APP_ROOT.'/cache/BatchGetUserData/' . md5($sessionId) . '.dat';

        // если есть файл кеша
        if (file_exists($cache_patch)) {
			$returndata = unlink($cache_patch);
			
			$tmp['time'] =  microtime(true)-$tme;
			$GLOBALS['FILEcache_debug'][] = $tmp;
			
            return $returndata; // удаляем файл кеша
        }
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
		
        return false;
    }

    public static function DeleteOldMethodCache($methodName){		
		$tme = microtime(true);
		$tmp['name'] = 'DeleteOldMethodCache  ('.$methodName.')';
		
        foreach(glob(CFG_APP_ROOT . '/cache/' . $methodName . '/*') as $filename){
            if(time() - filectime($filename) > 600 && is_file($filename)){
				$returndata = unlink($filename);
				
				$tmp['time'] =  microtime(true)-$tme;
				$GLOBALS['FILEcache_debug'][] = $tmp;
		
                return $returndata;
            }
        }
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
				
        return true;
    }

    public static function DeleteMethodCacheById($methodName, $id){
		$tme = microtime(true);
		$tmp['name'] = 'DeleteMethodCacheById ('.$methodName.')';
		
		$returndata = @unlink(CFG_APP_ROOT . '/cache/' . $methodName . '/' . md5($id) . '.dat');
		
		$tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['FILEcache_debug'][] = $tmp;
        return $returndata;
    }
	
	static public function DelOldCache($dir)
    {
        return ;
		$tme = 600;
		$coun_f = 10;
		
		if (is_dir($dir)) {			
        	$d = dir($dir);
			$counter = 0;
    		while($entry = $d->read()) { 
        		if ($entry != '.' && $entry != '..') {
					if (is_dir($dir.'/'.$entry)) {
						
						$dir_l2 = $dir.'/'.$entry;
						$d_l2 = dir($dir_l2);
						while($entry_l2 = $d_l2->read()) { 
        					if ($entry_l2 != '.' && $entry_l2 != '..') {
								if ((is_file($dir_l2.'/'.$entry_l2)) and (filectime($dir_l2.'/'.$entry_l2)+$tme < time())) { 					    			
                					unlink($dir_l2.'/'.$entry_l2); 
									$counter++;
									if ($counter > $coun_f) break(2);
            					} 
        					} 
    					} 
    					$d_l2->close();	
						
						
            		} else { 
					    if (filectime($dir.'/'.$entry) > $tme) {
							unlink($dir.'/'.$entry); 
							$counter++;
							if ($counter > $coun_f) break;
						}
            		} 
            		
            		 
        		} 
    		} 
    		$d->close();
		}
    }

}

?>
