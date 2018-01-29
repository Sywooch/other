<?php

class Assets
{
    private static $scripts = array();
    private static $styles = array();

    public static function addScript($scriptSource)
    {
        self::$scripts[] = $scriptSource;
    }

    public static function addStyle($styleSource)
    {
        self::$styles[] = $styleSource;
    }

    public static function getScripts()
    {
        return self::$scripts;
    }

    public static function getStyles()
    {
        return self::$styles;
    }
}
