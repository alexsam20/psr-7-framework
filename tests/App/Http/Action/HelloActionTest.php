<?php

namespace Tests\App\Http\Action;

use App\Http\Action\HelloAction;
use Framework\Template\TemplateRenderer;
use Zend\Diactoros\ServerRequest;

class HelloActionTest
{
    private $renderer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->renderer = new TemplateRenderer('templates');
    }

    public function testGuest()
    {
        $action = new HelloAction($this->renderer);

        $request = new ServerRequest();
        $response = $action($request);

        self::assertEquals(200, $response->getStstusCode());
        self::assertContains('Hello, Guest!', $response->getBody()->getContents());
    }

    public function testJson()
    {
        $action = new HelloAction($this->renderer);

        $request = (new ServerRequest())
            ->withQueryParams(['name' => 'John']);

        $response = $action($request);

        self::assertContains('Hello, John!', $response->getBody()->getContents());
    }
}