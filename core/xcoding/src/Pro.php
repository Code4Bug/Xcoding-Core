<?php
/**
 * Created by PhpStorm.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 上午 11:14
 */

namespace Xcoding;

class Pro
{
    private $component;
    private $b;
    public function __construct(ComA $component, ComB $b)
    {
        $this->component = $component;
        $this->b = $b;
    }

    public function test()
    {
        $this->component->index("Hello Container");
        $this->b->index();
    }
}