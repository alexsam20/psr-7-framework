<?php

namespace Framework\Template;

class PhpRenderer implements TemplateRenderer
{
    private $path;
    private $params = [];
    private $extends;

    public function __construct($path)
    {
        $this->path = $path;
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
}