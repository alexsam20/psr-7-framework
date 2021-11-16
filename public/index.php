<?php

use App\Http\Action;
use App\Http\Middleware;
use Framework\Http\ActionResolver;
use Framework\Http\Pipeline\Pipeline;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Psr\Http\Message\ServerRequestInterface;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Debug

function dump($data, $flag = 0) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($flag !== 0) exit;
}

### Initialization

$params = [
    'users' => ['admin' => 'password', 'alex' => '12345678'],
];


$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', Action\HelloAction::class);
$routes->get('about', '/about', Action\AboutAction::class);

/*$routes->get('cabinet', '/cabinet', function(ServerRequestInterface $request) use ($params) {
    $pipeline = new Pipeline();

    $pipeline->pipe(new Middleware\ProfilerMiddleware());
    $pipeline->pipe(new Middleware\BasicAuthActionMiddleware($params['users']));
    $pipeline->pipe(new Action\CabinetAction());

    return $pipeline($request, new Middleware\NotFoundHandler());
});*/

$routes->get('cabinet', '/cabinet', [
    Middleware\ProfilerMiddleware::class,
    new Middleware\BasicAuthActionMiddleware($params['users']),
    Action\CabinetAction::class,
]);

$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
$routes->get('blog_show', '/blog/{id}', Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);

$router = new AuraRouterAdapter($aura);
$resolver = new ActionResolver();

### Running

$request = ServerRequestFactory::fromGlobals();
try{
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handlers = $result->getHandler();
    $pipeline = new Pipeline();
    foreach (is_array($handlers) ? $handlers : [$handlers] as $handler) {
        $pipeline->pipe($resolver->resolve($handler));
    }
    $response = $pipeline($request, new Middleware\NotFoundHandler());
} catch (RequestNotMatchedException $e) {
    $handler = new Middleware\NotFoundHandler();
    $response = $handler($request);
}

### Postprocessing

$response = $response->withHeader('X-Developer', 'AlexSaM');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);
