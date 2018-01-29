<?php

class Cacher {
    public static function rRmDir($dir, $removeDir = true)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") self::rRmDir($dir . "/" . $object); else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            if ($removeDir)
                rmdir($dir);
        }
    }

}