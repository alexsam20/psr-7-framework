<?php

namespace Framework\Container;

class Container
{
    private $definition = [];
    
    public function get($id)
    {
        if (!array_key_exists($id, $this->definition)) {
            throw new ServiceNotFoundException('Undefined parameter"' . $id . '"');
        }
        return $this->definition[$id];
    }

    public function set($id, $value): void
    {
        $this->definition[$id] = $value;
    }
}