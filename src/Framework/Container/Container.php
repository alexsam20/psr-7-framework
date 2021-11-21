<?php

namespace Framework\Container;

//use PHPUnit\Framework\InvalidArgumentException;

class Container
{
    private $defenition = [];
    
    public function get($id)
    {
        if (!array_key_exists($id, $this->defenition)) {
            throw new \InvalidArgumentException('Undefined parameter"' . $id . '"');
        }
        return $this->defenition[$id];
    }

    public function set($id, $value): void
    {
        $this->defenition[$id] = $value;
    }
}