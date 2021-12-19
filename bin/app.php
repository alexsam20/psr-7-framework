#!/usr/bin/env php
<?php

use App\Console\Command\CacheClearCommand;
use Framework\Console\Application;
use Framework\Console\Input;
use Framework\Console\Output;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var Psr\Container\ContainerInterface $container
 */
$container = require 'config/container.php';

$cli = new Application();

$commands = $container->get('config')['console']['commands'];
foreach ($commands as $command) {
    $cli->add($container->get($command));
}

$cli->run(new Input($argv), new Output());

$logger = $container->get(Psr\Log\LoggerInterface::class);
$logger->info('Clearing cache');
