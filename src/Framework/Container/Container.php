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
            if (class_exists($id)) {
                return $this->results[$id] = new $id();
            }
            throw new ServiceNotFoundException('Undefined parameter"' . $id . '"');
        }
        
        $definition = $this->definition[$id];
        
        if ($definition instanceof \Closure) {
            $this->results[$id] = $definition($this);
        } else {
            $this->results[$id] = $definition;
        }
        
        return $this->results[$id];
    }

    public function has($id): bool
    {
        return array_key_exists($id, $this->definition) || class_exists($id);
    }

    public function set($id, $value): void
    {
        if (array_key_exists($id, $this->results)) {
            unset($this->results[$id]);
        }
        $this->definition[$id] = $value;
    }
}