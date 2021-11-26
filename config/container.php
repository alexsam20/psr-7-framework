<?php

use Framework\Container\Container;

$container = new Container();

$container->set('config', require 'config/parameters.php');

require __DIR__ . '/definitions.php';

return $container;
