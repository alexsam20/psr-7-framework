<?php

namespace App\Http\Action\Blog;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ShowAction
{
    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');

        if ($id > 5) {
            return new JsonResponse(['error' => 'Undefined page'], 404);
        }

        return new JsonResponse(['id' => $id, 'title' => 'Post # ' . $id]);
    }
}