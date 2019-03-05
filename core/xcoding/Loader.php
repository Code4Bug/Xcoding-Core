<?php
/**
 * Created by PhpStorm.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 上午 10:35
 */

class Loader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, "autoload"]);
    }

    public static function autoload($class)
    {
        $pathInfo = explode("\\", $class);
        $class = array_pop($pathInfo);
        $pathInfo = array_map(function($vo){
            return ($vo);
        }, $pathInfo);
        $file = "./core/".implode("/", $pathInfo)."/src/".$class.".php";
        if (is_file($file)) require $file;
    }
}