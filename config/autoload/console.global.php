<?php

use App\Console\Command;
use Doctrine\Migrations\Tools\Console;

return [
    'dependencies' => [
        'factories' => [
            Command\CacheClearCommand::class => Infrastructure\App\Console\Command\CacheClearCommandFactory::class,
            Console\Command\DiffCommand::class => Infrastructure\App\Doctrine\Factory\DiffCommandFactory::class,
        ],
    ],
    'console' => [
        'commands' => [
            Command\CacheClearCommand::class,
            Doctrine\Migrations\Tools\Console\Command\ExecuteCommand::class,
            Doctrine\Migrations\Tools\Console\Command\GenerateCommand::class,
            Doctrine\Migrations\Tools\Console\Command\LatestCommand::class,
            Doctrine\Migrations\Tools\Console\Command\MigrateCommand::class,
            Doctrine\Migrations\Tools\Console\Command\DiffCommand::class,
            Doctrine\Migrations\Tools\Console\Command\UpToDateCommand::class,
            Doctrine\Migrations\Tools\Console\Command\StatusCommand::class,
            Doctrine\Migrations\Tools\Console\Command\VersionCommand::class,
        ],
        'cachePaths' => [
            'twig' => 'var/cache/twig',
        ],
    ],
];