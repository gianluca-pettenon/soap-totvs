<?php

// Composer autoloading
include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

use App\Adapters\LaminasAdapter;
use App\WebServices\Query\Object\QueryObject;
use App\WebServices\Query\Query;
use App\Enums\SystemEnum;

$webService = new Query(
    adapterInterface: new LaminasAdapter,
    queryObject: new QueryObject(
        sentence: 'Example.001',
        affiliate: 1,
        system: SystemEnum::EDUCATIONAL,
        parameters: ['cdUser' => 1302]
    )
);

echo "<pre>";
print_r($webService);
echo "</pre>";