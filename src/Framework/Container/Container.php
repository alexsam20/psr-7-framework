<?php

namespace Framework\Container;

class Container
{
    private $definition = [];
    private $results = [];
    
    public function get($id)
    {
        if (array_key_exists($id, $this->results)) {
            return $this->results[$id];
        }

        if (!array_key_exists($id, $this->definition)) {
            throw new ServiceNotFoundException('Undefined parameter"' . $id . '"');
        }
        
        $definition = $this->definition[$id];
        
        if ($definition instanceof \Closure) {
            $this->results[$id] = $definition();
        } else {
            $this->results[$id] = $definition;
        }
        
        return $this->results[$id];
    }

    public function set($id, $value): void
    {
        if (array_key_exists($id, $this->results)) {
            unset($this->results[$id]);
        }
        $this->definition[$id] = $value;
    }
}