<?php

namespace App\Http\Action\Blog;

use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    public function __invoke()
    {
        return new JsonResponse([
            ['id' => 2, 'title' => 'The Second Page'],
            ['id' => 1, 'title' => 'The First Page'],
        ]);
    }
}