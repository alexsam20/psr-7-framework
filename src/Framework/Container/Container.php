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
                $reflection = new \ReflectionClass($id);
                $arguments = [];
                if (($constructor = $reflection->getConstructor()) !== null) {
                    foreach ($constructor->getParameters() as $param) {
                        $paramClass = $param->getClass();
                        $arguments[] = $this->get($paramClass->getName());
                    }
                }
                $result = $reflection->newInstanceArgs($arguments);
                return $this->results[$id] = $result;
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