<?php
/**
 * Created by Xcoding-Core.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 5:54
 */

namespace Xcoding\Core;

class Env
{
    private $env;
    public function __construct()
    {
        $this->env=$_SERVER;
    }

    public function get($key=null)
    {
        return $key ? $this->env[$key] : $this->env;
    }
}