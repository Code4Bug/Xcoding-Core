<?php
/**
 * Created by PhpStorm.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 上午 10:33
 */
use Xcoding\Container;

define("ROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);

$loadFile = ROOT . "\\core\\xcoding\\Loader.php";
$error = ROOT . "\\core\\xcoding\\Error.php";

require $loadFile;
require_once $error;

\Loader::register();
\Err::register();

$container = Container::getInstance();
$container->bind([
    'pro' => 'Xcoding\\Pro',
    'comA' => 'Xcoding\\ComA',
    'test' => function($a, $b){
        return function($c) use ($a, $b) {
            return $a*$b*$c;
        };
    }
]);
$container->get('pro', ["Hello", "World"])->test();

var_dump(memory_get_usage());