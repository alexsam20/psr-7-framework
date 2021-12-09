<?php

namespace Tests\App\Http\Action;

use App\Http\Action\HelloAction;
use Framework\Template\Php\PhpRenderer;
use PHPUnit\Framework\TestCase;

class HelloActionTest extends TestCase
{
    private $renderer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->renderer = new PhpRenderer('templates');
    }

    public function test()
    {
        $action = new HelloAction($this->renderer);
        $response = $action();

        self::assertEquals(200, $response->getStstusCode());
        self::assertContains('Hello!', $response->getBody()->getContents());
    }
}