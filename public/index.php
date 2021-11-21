<?php

use App\Http\Action;
use App\Http\Middleware;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Zend\Diactoros\Response;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Debug

function dump($data, $flag = 0) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($flag !== 0) exit;
}

### Configuration

$container = new \Framework\Container\Container();

// Parameters

$container->set('debug', true);
$container->set('users', ['admin' => 'password', 'alex' => '12345678']);
$container->set('dsn', 'mysql:localhost;dbname=psr-7');
$container->set('username', 'root');
$container->set('password', '');

// Services

$container->set('db', function () use ($container) {
    return new \PDO(
        $container->get('dsn'),
        $container->get('username'),
        $container->get('password')
    );
});

$db = $container->get('db');

### Initialization

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', Action\HelloAction::class);
$routes->get('about', '/about', Action\AboutAction::class);
$routes->get('cabinet', '/cabinet', Action\CabinetAction::class);
$routes->get('blog', '/blog', new Action\Blog\IndexAction($container->get('db')));
$routes->get('blog_show', '/blog/{id}', new Action\Blog\ShowAction($container->get('db')))->tokens(['id' => '\d+']);

$router = new AuraRouterAdapter($aura);

$resolver = new MiddlewareResolver();
$app = new Application($resolver, new Middleware\NotFoundHandler(), new Response());

$app->pipe(new Middleware\ErrorHandlerMiddleware($container->get('debug')));
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe(new Framework\Http\Middleware\RouteMiddleware($router));
$app->pipe('/cabinet', new Middleware\BasicAuthActionMiddleware($container->get('users')));
$app->pipe(new Framework\Http\Middleware\DispatchMiddleware($resolver));

### Running

$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request, new Response());

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);
