<?php

namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class HelloAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse($this->render($name));
    }

    /**
     * @return string
     */
    private function render($name): string
    {
        ob_start();
        require 'templates/hello.php';
        return ob_get_clean();
    }
}