<?php

class Lang {
    static $lexicon = array();
    
    public static function getTranslations($path = '', $lang_external = ''){
        $lang = @$lang_external ? $lang_external : $_SESSION['active_lang'];
        if(strstr($_SERVER['SCRIPT_NAME'], 'admin'))
            $lang = @$lang_external ? $lang_external : $_SESSION['active_lang_admin'];

        $cms = new CMS();
        
        $langFilePath = $path ? $path.$lang.'.xml' : dirname(dirname(__FILE__)).'/langs/'.$lang.'.xml';
        $forceFile = false;
        if($path){
            $forceFile = true;
        }

        if($langFilePath){
            $translations = simplexml_load_file($langFilePath);
            foreach($translations->key as $t){
                @self::$lexicon[(string)$t['name']] = (string)$t;
            }
        }
        if($cms->Check() && $cms->existTranslations() && !$forceFile){
            $translations = $cms->getTranslations('', $lang);
            foreach($translations as $t){
                @self::$lexicon[$t['key']] = $t['translation'];
            }
        }
    }
    
    public static function get($k){
        return isset(self::$lexicon[$k]) ? self::$lexicon[$k] : $k;
    }

    public static function loadJSTranslation($keys){
        $trans = array();
        foreach($keys as $key){
            $trans[$key] = self::get($key);
        }

        return '<script type="text/javascript">trans = '.json_encode($trans).';</script>';
    }
}

?>
