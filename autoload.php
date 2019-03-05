<?php
/**
 * Created by Xcoding-Core.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 7:04
 */

spl_autoload_register(function($class){
   $pathInfo = explode("\\", $class);
   $className = array_pop($pathInfo);
   $pathInfo = array_map(function($vo){
       return strtolower($vo);
   }, $pathInfo);
   $fileName = __DIR__ . "/src/" .$className.".php";
   if (is_file($fileName)) require $fileName;
});