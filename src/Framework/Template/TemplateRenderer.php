<?php

namespace Framework\Template;

class TemplateRenderer
{
    public function render($view, array $params = []): string
    {
        $templateFile = 'templates/' . $view . '.php';

        ob_start();
        extract($params, EXTR_OVERWRITE);
        require $templateFile;
        return ob_get_clean();
    }
}