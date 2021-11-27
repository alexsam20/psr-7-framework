<?php

namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class HelloAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse($this->render('hello', [
            'name' => $name,
        ]));
    }

    private function render($view, array $params = []): string
    {
        extract($params, EXTR_OVERWRITE);

        ob_start();
        require 'templates/' . $view . '.php';
        return ob_get_clean();
    }
}