<?php

namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class HelloAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse($this->render('hello', $name));
    }

    private function render($view, $name): string
    {
        ob_start();
        require 'templates/' . $view . '.php';
        return ob_get_clean();
    }
}