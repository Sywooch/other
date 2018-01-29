<?php

if (! defined('CFG_APP_ROOT')) {
    define('CFG_APP_ROOT', dirname(dirname(__FILE__)));
}

class OTBase
{
    private static $_aliases = array('system' => CFG_APP_ROOT); // alias => path

    private static $_imports = array();

    private static $_includePaths = array();

    private static $_classMap = array();

    public static function isTest()
    {
        if (defined('DEVELOP')) {
            return (bool) DEVELOP;
        }
        if (defined('MANUAL_DEBUG_MODE')) {
            return (bool) MANUAL_DEBUG_MODE;
        }
        return !defined('NO_DEBUG');
    }

    public static function isMultiCurlEnabled()
    {
        return defined('CFG_MULTI_CURL') && CFG_MULTI_CURL;
    }

    /**
     * http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
    **/
    public static function import($alias, $forceInclude = false)
    {
        if(isset(self::$_imports[$alias]))  // previously imported
            return self::$_imports[$alias];

        if(class_exists($alias,false) || interface_exists($alias,false))
            return self::$_imports[$alias]=$alias;

        if(($pos=strrpos($alias,'.'))===false)  // a simple class name
        {
            if($forceInclude && self::autoload($alias))
                self::$_imports[$alias]=$alias;
            return $alias;
        }

        $className=(string)substr($alias,$pos+1);
        $isClass=$className!=='*';

        if($isClass && (class_exists($className,false) || interface_exists($className,false)))
            return self::$_imports[$alias]=$className;

        if(($path=self::getPathOfAlias($alias))!==false)
        {
            if($isClass)
            {
                if($forceInclude)
                {
                    if(is_file($path.'.php'))
                        require($path.'.php');
                    else
                        throw new Exception('Alias "'.$alias.'" is invalid. Make sure it points to an existing PHP file and the file is readable.');
                    self::$_imports[$alias]=$className;
                }
                else {
                    $file = $path.'.php';
                    $file = is_file($file) ? $file : $path.'.class.php';
                    self::$_classMap[$className] = $file;
                }
                return $className;
            }
            else  // a directory
            {
                array_unshift(self::$_includePaths,$path);

                return self::$_imports[$alias]=$path;
            }
        }
        else
            throw new Exception('Alias "'.$alias.'" is invalid. Make sure it points to an existing directory or file.');
    }

    /**
     * http://www.yiiframework.com/doc/api/1.1/YiiBase#autoload-detail
    **/
    public static function autoload($className)
    {
        // use include so that the error PHP file may appear
        if(isset(self::$_classMap[$className]))
            include(self::$_classMap[$className]);
        else
        {
            // include class file relying on include_path
            if(strpos($className,'\\')===false)  // class without namespace
            {
                if (is_file($className.'.php')) {
                    include($className.'.php');
                } else {
                    foreach(self::$_includePaths as $path)
                    {
                        $classFile=$path.DIRECTORY_SEPARATOR.$className.'.php';
                        $classSuffixFile=$path.DIRECTORY_SEPARATOR.$className.'.class.php';
                        if (is_file($classFile)) {
                            include($classFile);
                            break;
                        } else if (is_file($classSuffixFile)) {
                            include($classSuffixFile);
                            break;
                        }
                    }
                }
            }
            return class_exists($className,false) || interface_exists($className,false);
        }
        return true;
    }

    /**
     * http://www.yiiframework.com/doc/api/1.1/YiiBase#getPathOfAlias-detail
     *
     * Translates an alias into a file path.
     * Note, this method does not ensure the existence of the resulting file path.
     * It only checks if the root alias is valid or not.
     * @param string $alias alias (e.g. system.web.CController)
     * @return mixed file path corresponding to the alias, false if the alias is invalid.
     */
    public static function getPathOfAlias($alias)
    {
        if(isset(self::$_aliases[$alias]))
            return self::$_aliases[$alias];
        else if(($pos=strpos($alias,'.'))!==false)
        {
            $rootAlias=substr($alias,0,$pos);
            if(isset(self::$_aliases[$rootAlias]))
                return self::$_aliases[$alias]=rtrim(self::$_aliases[$rootAlias].DIRECTORY_SEPARATOR.str_replace('.',DIRECTORY_SEPARATOR,substr($alias,$pos+1)),'*'.DIRECTORY_SEPARATOR);
        }
        return false;
    }
}
