<?php

namespace Tests\App\Http\Action;

use App\Http\Action\HelloAction;
use Zend\Diactoros\ServerRequest;

class HelloActionTest
{
    public function testGuest()
    {
        $action = new HelloAction();

        $request = new ServerRequest();
        $response = $action($request);

        self::assertEquals(200, $response->getStstusCode());
        self::assertEquals('Hello, Guest!', $response->getBody()->getContents());
    }

    public function testJson()
    {
        $action = new HelloAction();

        $request = (new ServerRequest())
            ->withQueryParams(['name' => 'John']);

        $response = $action($request);

        self::assertEquals('Hello, John!', $response->getBody()->getContents());
    }
}