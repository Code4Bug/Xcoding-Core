<?php
/**
 * Created by PhpStorm.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 上午 11:34
 */

class Err
{
    public static function register()
    {
        set_exception_handler([__CLASS__, "exceptionHandler"]);
        set_error_handler([__CLASS__, "errorHandler"]);
    }

    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        var_dump($errno, $errstr, $errfile, $errline);
    }

    public static function exceptionHandler($e)
    {
        var_dump([
            'msg' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }
}