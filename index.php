<?php

// Composer autoloading
include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

use App\Adapter\LaminasAdapter;
use App\WebService\ConsultaSQL;

$ws = new ConsultaSQL(new LaminasAdapter);

echo "<pre>";
var_dump($ws->execute());
echo "</pre>";

?>

See <a href="/README.md">README.md</a> for more information.
