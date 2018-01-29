<?php

class Lang
{
    static $lexicon = array();

    public static function getTranslations($path = '', $lang_external = '')
    {
        $lang = $lang_external ? $lang_external : Session::getActiveLang();
        if (strpos($_SERVER['SCRIPT_NAME'], 'admin') !== false) {
            $lang = $lang_external ? $lang_external : Session::getActiveAdminLang();
        }

        $cms = new CMS();

        $langFilePath = $path ? $path . $lang . '.xml' : dirname(dirname(__FILE__)) . '/langs/' . $lang . '.xml';
        $forceFile = false;
        if ($path) {
            $forceFile = true;
        }

        if ($langFilePath && file_exists($langFilePath)) {
            $translations = simplexml_load_file($langFilePath);
            foreach ($translations->key as $t) {
                @self::$lexicon[(string)$t['name']] = (string)$t;
            }
        }
        if ($cms->Check() && $cms->existTranslations() && !$forceFile) {
            $translations = $cms->getTranslations('', $lang);
            foreach ($translations as $t) {
                @self::$lexicon[$t['key']] = $t['translation'];
            }
        }
    }

    public static function get($k, $params = array())
    {
        $phrase = isset(self::$lexicon[$k]) ? self::$lexicon[$k] : $k;
        return str_replace(array_map('Lang::applyWrapper', array_keys($params)), array_values($params), $phrase);
    }

    public static function applyWrapper($value){
        return "{{{$value}}}";
    }

    public static function loadJSTranslation($keys)
    {
        $trans = array();
        foreach ($keys as $key) {
            $trans[$key] = self::get($key);
        }

        return '<script type="text/javascript">trans = '.json_encode($trans).';
            trans.get = function(key){
                if(typeof trans[key] !== \'undefined\'){
                    return trans[key];
                }
                else{
                    return key;
                }
            }
        </script>';
    }
}