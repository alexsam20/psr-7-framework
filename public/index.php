<?php

use Framework\Http\Application;
use Zend\Diactoros\Response;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

/**
 * @var \Psr\Container\ContainerInterface $container
 * @var \Framework\Http\Application $app
 */

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Debug
function dump($data, $flag = 0) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($flag !== 0) exit;
}

$container = require 'config/container.php';
$app = $container->get(Application::class);

require 'config/pipeline.php';
require 'config/routes.php';

$request = ServerRequestFactory::fromGlobals();
$response = $app->run($request, new Response());

$emitter = new SapiEmitter();
$emitter->emit($response);
