<?php

namespace Framework\Template;

Interface TemplateRenderer
{
    public function render($name, array $params = []): string;
}