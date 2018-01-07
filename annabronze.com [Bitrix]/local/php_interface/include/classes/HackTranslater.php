<?php
class HackTranslater{

    static $words = [
        [
            "RU" => "Вес, грамм",
            "EN" => "Weight, g"
        ]
    ];

    /*
     * Такой супер кастыльнй метод, который подменит слова на основе соотв. пары для текущей версии сайта
     * */
    public static function getWord($word){
        foreach(self::$words as $similar){
            if($similar["RU"] == $word || $similar["EN"] == $word){
                if(LANGUAGE_ID == 'en'){
                    return $similar["EN"];
                }else{
                    return $similar["RU"];
                }
            }
        }

        return $word;
    }
}