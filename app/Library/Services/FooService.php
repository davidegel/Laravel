<?php
namespace App\Library\Services;
use App\Library\Services\FooInterface;

class FooService implements FooInterface
{
    private $wokServ;

    public function __construct($var)
    {
        $this->wokServ = $var;
    }

    public function doSomething()
    {
        return $this->wokServ;
    }
}

?>