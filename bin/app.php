#!/usr/bin/env php
<?php

use App\Console\Command\CacheClearCommand;
use Framework\Console\Input;
use Framework\Console\Output;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * @var Psr\Container\ContainerInterface $container
 */
$container = require 'config/container.php';

$commands = [
    [
        'name' => 'cache:clear',
        'command' => CacheClearCommand::class,
        'description' => 'Clear cache',
    ]
];

$input = new Input($argv);
$output = new Output();
$name = $input->getArgument(0);

if (!empty($name)) {
    foreach ($commands as $definition) {
        if ($definition['name'] === $name) {
            /** @var Framework\Console\Command $command */
            $command = $container->get($definition['command']);
            $command->execute($input, $output);
            exit;
        }
    }
    throw new InvalidArgumentException('Undefined command ' . $name);
}

$output->writeLn('Available commands:');
$output->writeLn('');
foreach ($commands as $definition) {
    $output->writeLn($definition['name'] . "\t" . $definition['description']);
}
$output->writeLn('');

$logger = $container->get(Psr\Log\LoggerInterface::class);
$logger->info('Clearing cache');
