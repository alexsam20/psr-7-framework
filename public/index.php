<?php

use Zend\Diactoros\Response\HtmlResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Debug

function dump($data, $flag = 0) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    if ($flag !== 0)
        exit;
}

### Initialization

$request = ServerRequestFactory::fromGlobals();

### Action

$name = $request->getQueryParams()['name'] ?? 'Guest';

$response = (new HtmlResponse('Hello, ' . $name . '!'))
    ->withHeader('X-Developer', 'AlexSaM');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);

/*header('HTTP/1.0 ', $response->getStatusCode() . ' ' . $response->getReasonPhrase());
foreach ($response->getHeaders() as $name => $values) {
    header($name . ':' . $values);
}
echo $response->getBody();*/
