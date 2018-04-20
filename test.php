<?php

class a
{
    public $b;
    public function __construct()
    {
        $this->b = new b();

    }
}

class b
{

}

$a = new a();

$b = $a;
$c = &$b;

$c = $a->b;

var_dump($a);