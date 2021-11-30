<?php

namespace Framework\Template;

class PhpRenderer implements TemplateRenderer
{
    private $path;
    private $extends;
    private $blocks = [];
    private $blockNames;

    public function __construct($path)
    {
        $this->path = $path;
        $this->blockNames = new \SplStack();
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

    public function ensureBlock($name)
    {
        if ($this->hasBlock($name)) {
            return false;
        }
        $this->beginBlock($name);
        return true;
    }

    public function beginBlock($name)
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

    public function renderBlock($name)
    {
        return $this->blocks[$name] ?? '';
    }

    public function hasBlock($name)
    {
        return array_key_exists($name, $this->blocks);
    }
}