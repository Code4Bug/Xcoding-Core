<?php
/**
 * Created by Xcoding-Core.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 5:21
 */
namespace root;



use Xcoding\Core\Container;
use Xcoding\Core\Loader;

require 'src/Container.php';
require 'src/Loader.php';
require 'src/App.php';

Loader::addMap([
    'app' => 'Xcoding\Core\App',
    'env' => 'Xcoding\Core\Env'
]);

$container = Container::getInstance();
$app = $container->get('app');
var_dump($app);