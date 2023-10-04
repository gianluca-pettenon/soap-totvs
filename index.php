<?php

echo phpinfo();

// Composer autoloading
/*include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

use App\Adapters\LaminasAdapter;
use App\WebServices\Query\{
    Query,
    QueryObject
};

$webService = new Query(
    new LaminasAdapter,
    new QueryObject(
        sentence: 'Example.001',
        affiliate: 1,
        system: 'S',
        parameters: ['cdUser' => 1302]
    )
);

echo "<pre>";
var_dump($webService);
echo "</pre>";*/
