<?php

require 'vendor/autoload.php';

/** @var Psr\Container\ContainerInterface $container */
$container = require 'config/container.php';

return [
	'environments' => [
		'default _migration_table' => 'migrations',
		'default_database' => 'app',
		'app' =>[
			'name' => $container->get('config')['phinx']['database'],
			'connection' => $container->get(PDO::class)
		],
	],
	'paths' => [
		'migrations' => 'db/migrations',
		'seeds' => 'db/seeds',
	],
];