<?php

class TextHelper
{
    public static function wrapWordsInText($text, $word_length = 40, $wrap_symbol = " ", $keep_html_tags = false)
    {
        $result = $text;
        if (! $keep_html_tags) {
            $words_array = explode(' ', strip_tags($text));
            if (! empty($words_array)) {
                foreach ($words_array as $key => $word) {
                    if ($word !== '') {
                        $words_array[$key] = ((mb_strlen($word) > $word_length) && (!preg_match('/(href=|src:)/', $word))) ? wordwrap($word, $word_length, $wrap_symbol, true) : $word;
                    }
                }
                $result = implode(' ', $words_array);
            }
        } else {
            $words_array = preg_split("'(<[\/\!]*?[^<>]*?>)'si", $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            if (! empty($words_array)) {
                foreach ($words_array as $key => $word) {
                    if ($word[0] != '<') {
                        $words_array[$key] = ((mb_strlen($word) > $word_length) && (!preg_match('/(href=|src:)/', $word))) ? wordwrap($word, $word_length, $wrap_symbol, true) : $word;
                    }
                }
                $result = implode('', $words_array);
            }
        }
        return $result;
    }

    public static function formatNumber($number, $decimals = null, $dec_point = ',', $thousands_sep = '&nbsp;')
    {
        $decimals = !is_null($decimals) ? $decimals : (int)General::getConfigValue('price_round_decimals');
        $number = number_format($number, $decimals, $dec_point, " ");
        return str_replace(" ", $thousands_sep, $number);
    }

    /**
     * Форматирование цены вместе со знаком валюты
    **/
    public static function formatPrice(
        $price,
        $sign = '',
        $sign_right = true,
        $dec_point = '.',
        $decimals = null,
        $thousands_sep = '&nbsp;'
    ) {
        $decimals = is_null($decimals) ? (int)General::getConfigValue('price_round_decimals') : $decimals;
        $formatted_price = number_format((float)$price, $decimals, $dec_point, " ");
        $formatted_price = str_replace(" ", $thousands_sep, $formatted_price);

        if ($sign_right) {
            $result = $formatted_price . '&nbsp;' . $sign;
        } else {
            $result = $sign . '&nbsp;' . $formatted_price;
        }
        return $result;
    }

    public static function truncate($string, $length = 150)
    {
        $len = (mb_strlen($string) > $length) ? mb_strripos(mb_substr($string, 0, $length), ' ') : $length;
        $cutStr = mb_substr($string, 0, $len);
        return (mb_strlen($string) > $length) ? $cutStr . '...' : $cutStr;
    }
    
    public static function normalizeUserAccount($account)
    {
        $normalizedAccount = defined('CFG_PREFIX_REPLACE_USR') ? str_replace('USR', CFG_PREFIX_REPLACE_USR, (string)$account) : (string)$account;
        return $normalizedAccount;
    }
    
    public static function clearHTMLTags($text)
    {
        return strip_tags($text);
    }
    
    public static function truncateAndClearHTML($text, $length = 150)
    {
        $text = self::clearHTMLTags($text);
        $text = self::truncate($text, $length);     
        return $text;
    }

    public static function plural($n, $form1, $form2, $form5)
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) return $form5;
        if ($n1 > 1 && $n1 < 5) return $form2;
        if ($n1 == 1) return $form1;
        return $form5;
    }
    
    public static function translitСonverter($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",  'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",  'Ы' => 'Y',   'Ъ' => "'",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            '/' => '', '.' => '', ',' => '', ';' => '', ' ' => '-', '\'' => '',
            ')' => '', '(' => '', '  ' => '-', '--' => '-',
            '<' => '', '>' => '', '!' => '', '@' => '', '#' => '', '$' => '',
            '%' => '', '^' => '', '&' => '', '*' => '', '[' => '', ']' => '',
            '"' => '', '_' => '', '\\' => '', '?' => ''
        );
        $tmpString = strtr($string, $converter);
        //$tmpString = preg_replace ("/[^a-zA-ZА-Яа-я_ -0-9\s]/iu","", $tmpString);
        $tmpString = preg_replace("/[^A-z0-9_-]/ius", "", $tmpString);
        return $tmpString;
    }
}
