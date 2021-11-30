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
        return $this->render($this->extends, ['content' => $content,]);
    }

    public function extend($view): void
    {
        $this->extends = $view;
    }

    public function beginBlock($name)
    {
        $this->blockNames->push($name);
        ob_start();
    }

    public function endBlock()
    {
        $name = $this->blockNames->pop();
        $this->blocks[$name] = ob_get_clean();
    }

    public function renderBlock($name)
    {
        return $this->blocks[$name] ?? '';
    }
}