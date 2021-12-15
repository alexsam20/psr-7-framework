#!/usr/bin/env php
<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var Psr\Container\ContainerInterface $container
 */
$container = require 'config/container.php';

$command = $container->get(App\Console\Command\CacheClearCommand::class);
$args = array_splice($argv, 1);
$command->execute($args);

$logger = $container->get(Psr\Log\LoggerInterface::class);
$logger->info('Clearing cache');
