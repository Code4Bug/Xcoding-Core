<?php
/**
 * Created by PhpStorm.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 上午 10:36
 */

namespace Xcoding;

use Exception;
use ReflectionMethod;
use ReflectionFunction;
use ReflectionClass;
use Countable;
use Iterator;
use ArrayAccess;

class Container
{
    public static $instance = null;
    public $binding = [];
    public $instances = [];
    public $map = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) self::$instance = new Self;
        return self::$instance;
    }

    public function bind($abstract, $handler=null)
    {
        if ($handler==null) {
            if (is_array($abstract)) {
                foreach ($abstract as $key => $vo) {
                    $this->bind($key, $vo);
                }
                return true;
            } else {
                $this->binding[$abstract] = $abstract;
                return true;
            }
        }

        if (is_callable($handler)) {
            $this->binding[$abstract] = $handler;
            return true;
        }

        if (gettype($handler) == 'string') {
            $this->binding[$abstract] = $handler;
            return true;
        }

        if (gettype($handler) == 'object') {
            $this->instances[$abstract] = $handler;
        }

        throw new Exception("error type");
    }

    public function get($abstract=null, $params=null, $share=false)
    {
        if ($abstract==null) throw new Exception("invalid params");

        if (key_exists($abstract, $this->binding)) {
            if (is_callable($this->binding[$abstract])) {
                $function = $this->binding[$abstract];
                unset($this->instances[$abstract]);
                $result = $this->invokeFunction($function, $params);
                if ($share === true) {
                    if (is_callable($result)) {
                        $this->bind($abstract, $result);
                    }

                    if (gettype($result) == 'object') {
                        $this->instances[$abstract] = $result;
                    }

                    if (gettype($result) == 'string' || is_numeric($result)) {
                        $this->binding[$abstract] = $result;
                    }
                }
                return $result;
            }

            if (gettype($this->binding[$abstract]) == 'string') {
                if (class_exists($this->binding[$abstract])) {
                    return $this->make($abstract, $params, $share);
                }
            } else {
                return $this->binding[$abstract];
            }
        }
        if (key_exists($abstract, $this->instances)) return $this->instances[$abstract];
    }

    public function make($abstract, $params=null, $share=false)
    {
//        var_dump($abstract);die;
        $instance = $this->invokeClass($this->binding[$abstract], $params);
        if ($share == true) $this->instances[$abstract] = $instance;
        return $instance;
    }

    public function invokeClass($class)
    {
        if ($class == null) throw new Exception('class name is null');
        $reflection = new ReflectionClass($class);
        $construct = $reflection->getConstructor();
        $paramStructor = $construct->getParameters();
        if (!!$paramStructor) {
            $params=[];
            foreach ($paramStructor as $vo) {
                $class = $vo->getClass();
                $params[] = $this->invokeClass($class->name);
            }
            $instance = $reflection->newInstanceArgs($params);
        } else $instance = $reflection->newInstance();
        return $instance;
    }

    private function invokeMethod($class, $method='__construct')
    {

    }

    private function hasParams($function)
    {
        $reflection = new ReflectionFunction($function);
        $params = $reflection->getParameters();
    }

    private function invokeFunction($function, $params=null)
    {
        $reflection = new ReflectionFunction($function);
        if ($params == null) {
            $return = $reflection->invoke();
        } else {
            $return = $reflection->invokeArgs($params);
        }
        return $return;
    }
}