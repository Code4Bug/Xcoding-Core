<?php
/**
 * Created by Xcoding-Core.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 5:52
 */

namespace Xcoding\Core;

class App
{
    private $env;
    public function __construct(Env $env)
    {
        $this->env = $env;
    }

    public function run()
    {
        $env = $this->env->get();
        var_dump($env);
    }
}