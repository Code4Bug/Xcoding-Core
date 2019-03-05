<?php
/**
 * Created by Xcoding-Core.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 5:33
 */


namespace Xcoding\Core;

class Loader
{
    private static $map = [];
    public static function addMap($key, $val=null)
    {
        if (is_array($key)) {
            self::$map = self::$map + $key;
        } else {
            self::$map[$key] = $val;
        }
    }

    public static function getMap()
    {
        return self::$map;
    }
}