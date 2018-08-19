<?php
namespace App\Library\Services;
use App\Library\Services\FooInterface;

class Worker
{
    private $cache;

    public function __construct(FooInterface $cache)
    {
        $this->cache = $cache;
    }

    public function result()
    {
        // Use the cache for something...
        $result = $this->cache->doSomething();
        return $result;
    }
}

?>