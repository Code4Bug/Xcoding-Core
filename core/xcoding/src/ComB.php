<?php
/**
 * Created by Xcoding-Container.
 * User: Edward
 * Date: 2019/3/5/005
 * Time: 下午 2:00
 */

namespace Xcoding;


class ComB
{
    private $comA;
    public function __construct(ComA $comA)
    {
        $this->comA = $comA;
    }

    public function index()
    {
        var_dump("Hello ComB");
        $this->comA->index("Hello ComB ComA");
    }
}