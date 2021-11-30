<?php

namespace Framework\Template;

use Framework\Http\Router\Router;

class PhpRenderer implements TemplateRenderer
{
    private $path;
    private $extends;
    private $blocks = [];
    private $blockNames;
    private $router;

    public function __construct($path, Router $router)
    {
        $this->path = $path;
        $this->blockNames = new \SplStack();
        $this->router = $router;
    }

    public function render($view, array $params = []): string
    {
        $templateFile = $this->path . '/' . $view . '.php';
        ob_start();
        extract($params, EXTR_OVERWRITE);
        $this->extends = null;
        require $templateFile;
        $content = ob_get_clean();

        if ($this->extends === null) {
            return $content;
        }
        return $this->render($this->extends);
    }

    public function extend($view): void
    {
        $this->extends = $view;
    }

    public function block($name, $content)
    {
        if ($this->hasBlock($name)) {
            return;
        }
        $this->blocks[$name] = $content;
    }

    public function ensureBlock($name): bool 
    {
        if ($this->hasBlock($name)) {
            return false;
        }
        $this->beginBlock($name);
        return true;
    }

    public function beginBlock($name): void
    {
        $this->blockNames->push($name);
        ob_start();
    }

    public function endBlock(): void
    {
        $content = ob_get_clean();
        $name = $this->blockNames->pop();
        if ($this->hasBlock($name)) {
            return;
        }
        $this->blocks[$name] = $content;
    }

    public function renderBlock($name): string
    {
        $block = $this->blocks[$name] ?? null;

        if ($block instanceof \Closure) {
            return $block();
        }

        return $block ?? '';
    }

    public function hasBlock($name): bool
    {
        return array_key_exists($name, $this->blocks);
    }

    public function encode($string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE);
    }

    public function path($name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }
}