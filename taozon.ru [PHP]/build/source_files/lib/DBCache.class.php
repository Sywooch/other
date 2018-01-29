<?php

class DBCache implements IDBCache{	
	
	function __construct()
    {
		if(!isset($GLOBALS['DBcache_debug'])) $GLOBALS['DBcache_debug'] = @array();
		$tme = microtime(true);
		
        $cms = new CMS();
        $cms->Check();
        $cms->checkTable('cache');
		//Если нет дебага то создаем его
		
		$tmp['name'] = 'DBcache__construct';  $tmp['time'] =  microtime(true)-$tme;
		$GLOBALS['DBcache_debug'][] = $tmp;	
    }
	
    public function AddCacheEl($key,$life_time = 21600,$value){
		//Если кэш есть то раз вызвали AddCacheEl надо его обновить        
		$tme = time();
		$tme2 = microtime(true);
			
		$edited_value = mysql_real_escape_string($value);				
		//Записываем кэш
		$res = mysql_query("SELECT `added_time` FROM `cache` WHERE `key` = '$key'");
		if (@mysql_num_rows($res)==0) {
			//Добавляем
			mysql_query("INSERT INTO `cache` (`key`, `life_time`, `value`, `added_time`) VALUES ('$key', '$life_time', '$edited_value', '$tme' )");
		} else {
			//Обнвляем
			mysql_query("UPDATE `cache` SET  `life_time` = '$life_time', `value` = '$edited_value' , `added_time` = '$tme' WHERE `key` = '$key'");
		}	
			
		$tmp['name'] = 'AddCacheEl ('.$key.')';  $tmp['time'] =  microtime(true)-$tme2;
		$GLOBALS['DBcache_debug'][] = $tmp;	
		
    }
	
	public function DelCacheEl($key){        
		//Удаляем кэш
		$tme = microtime(true);
		
		mysql_query("DELETE FROM `cache` WHERE `key` = '$key'");
			
		$tmp['name'] = 'DelCacheEl ('.$key.')';  $tmp['time'] = microtime(true)-$tme;
		$GLOBALS['DBcache_debug'][] = $tmp;
    }
	
	public function GetCacheEl($key){        
		//Получаем в кэш
		$tme = microtime(true);
		
		$res = mysql_query("SELECT `value` FROM `cache` WHERE `key` = '$key'");	
		$returndata=mysql_result($res, 0);	
		
		$tmp['name'] = 'GetCacheEl ('.$key.')';  $tmp['time'] = microtime(true)-$tme;
		$GLOBALS['DBcache_debug'][] = $tmp;
		return $returndata;					
		
    }
	
	public function CheckCacheEl($key){        
		//Проверяем кэш на жизнеспособность
		$tme = microtime(true);
		$tmp['name'] = 'CheckCacheEl ('.$key.')';
		
		$res = mysql_query("SELECT `added_time`,`life_time` FROM `cache` WHERE `key` = '$key'");
		if (@mysql_num_rows($res)==0) {
			
			$tmp['time'] = microtime(true)-$tme;
			$GLOBALS['DBcache_debug'][] = $tmp;
			
			return false;
		}
		$times = @mysql_fetch_assoc($res);
		if (($times['added_time']+$times['life_time']) > time()) {
			//Если все еще жив
			
			$tmp['time'] = microtime(true)-$tme;
			$GLOBALS['DBcache_debug'][] = $tmp;
			
			return true;
		} else {
		    //Уже мертв	
			self::DelCacheEl($key);
			
			$tmp['time'] = microtime(true)-$tme;
			$GLOBALS['DBcache_debug'][] = $tmp;
			
		    return false;
		}
		
    }
	
	public function ClearDBCache(){        
		//Очищаем кэш
		$tme = microtime(true);		
		
		$res = mysql_query("DROP TABLE  `cache`");
		
		$tmp['name'] = 'ClearDBCache';  $tmp['time'] = microtime(true)-$tme;
		$GLOBALS['DBcache_debug'][] = $tmp;		
    }
	
    

}

?>