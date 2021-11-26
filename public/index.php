<?php

use App\Http\Action;
use App\Http\Middleware;
use Framework\Container\Container;
use Framework\Http\Application;
use Framework\Http\Middleware\DispatchMiddleware;
use Framework\Http\Middleware\RouteMiddleware;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
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

$container = new Container();

$container->set('config', [
    'debug' => true,
    'users' => ['admin' => 'password', 'alex' => '12345678'],
]);

$container->set(Application::class, function (Container $container) {
    return new Application(
        $container->get(MiddlewareResolver::class),
        $container->get(Router::class),
        new Middleware\NotFoundHandler(),
        new Response()
    );
});

$container->set(Middleware\BasicAuthActionMiddleware::class, function (Container $container) {
    return new Middleware\BasicAuthActionMiddleware($container->get('config')['users']);
});

$container->set(Middleware\ErrorHandlerMiddleware::class, function (Container $container) {
    return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
});

$container->set(DispatchMiddleware::class, function (Container $container) {
    return new DispatchMiddleware($container->get(MiddlewareResolver::class));
});

$container->set(MiddlewareResolver::class, function () {
    return new MiddlewareResolver();
});

$container->set(RouteMiddleware::class, function (Container $container) {
    return new RouteMiddleware($container->get(Router::class));
});

$container->set(Router::class, function (){
    return new AuraRouterAdapter(new Aura\Router\RouterContainer());
});

### Initialization

/** @var Application $app */
$app = $container->get(Application::class);

$app->pipe($container->get(Middleware\ErrorHandlerMiddleware::class));
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe($container->get(RouteMiddleware::class));
$app->pipe('cabinet', $container->get(Middleware\BasicAuthActionMiddleware::class));
$app->pipe($container->get(DispatchMiddleware::class));

$app->get('home', '/', Action\HelloAction::class);
$app->get('about', '/about', Action\AboutAction::class);
$app->get('cabinet', '/cabinet', Action\CabinetAction::class);
$app->get('blog', '/blog', Action\Blog\IndexAction::class);
$app->get('blog_show', '/blog/{id}', Action\Blog\ShowAction::class, ['tokens' => ['id' => '\d+']]);

### Running

$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request, new Response());

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);
