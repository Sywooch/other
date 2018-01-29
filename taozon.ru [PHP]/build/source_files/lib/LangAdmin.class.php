<?php

class LangAdmin {
    static $lexicon = array();
    
    public static function getTranslations($path = '', $lang_external = ''){
        $lang = @$lang_external ? $lang_external : $_SESSION['active_lang_admin'];
        
        $cms = new CMS();

        $langfile_path = $path ? $path.$lang.'.xml' : 'langs/'.$lang.'.xml';
        $forceFile = false;
        if($path){
            $forceFile = true;
        }
        
        if($cms->Check() && $cms->existTranslations() && !$forceFile){
            $translations = $cms->getTranslations('', $lang);
            foreach($translations as $t){
                self::$lexicon[$t['key']] = $t['translation'];
            }
        }
        elseif($langfile_path){
            $translations = simplexml_load_file('langs/'.$lang.'.xml');
            foreach($translations->key as $t){
                @self::$lexicon[(string)$t['name']] = (string)$t;
            }
        }

        $langfile_custom_path = 'langscustom/'.$lang.'.xml';
        if(file_exists($langfile_custom_path)){
            $translations = simplexml_load_file($langfile_custom_path);
            foreach($translations->key as $t){
                @self::$lexicon[(string)$t['name']] = (string)$t;
            }
        }
    }
    
    public static function get($k){
        return @self::$lexicon[$k] ? self::$lexicon[$k] : $k;
    }
}

?>
