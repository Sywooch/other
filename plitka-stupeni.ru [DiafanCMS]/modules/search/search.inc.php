<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Search_inc
 */
class Search_inc
{
    /**
     * @var object основной объект системы
     */
    public $diafan;
        
    /**
     * Конструктор класса
     * 
     * @return void
     */
    public function __construct($diafan)
    {
        $this->diafan = $diafan;
    }
    
    /**
    * Выделение уникальных слов из текста
    * @param string  $text  индексируемый текст
    *
    *  @return array $words
    */
    public function prepare($text)
    {
        $lang_name = $this->get_lang(defined('_LANG')? _LANG : 0);
        
        if($lang_name == 'ru')
        {
            include_once ABSOLUTE_PATH.'plugins/stemmer.php';
            $processor = new Lingua_Stem_Ru();
        }
        
        $text = utf::strtolower(strip_tags($text));
		$text = html_entity_decode($text);
        $text = preg_replace('/\s+|[\.,:;\"\'\/\\!\?\(\)]/', ' ', $text);
		$text = preg_replace('/[^a-zабвгдеёжзийклмнопрстуфхцчшщъыьэюя0-9 ]+/', '', $text);
        $matchesarray = explode(' ',$text);

        foreach ($matchesarray as $key => $value)
        {
            if(utf::strlen($value) < 3)
			{
				unset ($matchesarray[$key]);
			}
        }

        $matchesarray = array_unique($matchesarray);

        $words = array();
        foreach($matchesarray as $word)
        {
            if($lang_name == 'ru')
            {
                $word = $processor->stem_word($word);
            }
            
            $words[] = $word; 
        }
        
        $words = array_unique($words);

        return $words;
    }
    
    /**
    * Получение языка сайта 
    * @param string  $lang  идентификатор языка
    *
    *  @return string $lang_name
    */
    public function get_lang($lang = 0)
    {
        $lang = (int) $lang;
        
        foreach($this->diafan->languages as $language)
        {
			if($language["id"] == $lang)
			{
				if($language["shortname"] == 'ru' || $language["shortname"] == 'rus')
				{
					return 'ru';
				}
				else
				{
					return $language["shortname"];
				}
			}
        }
        return 'ru';
    }
}