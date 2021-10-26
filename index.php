<?php

// Composer autoloading
include __DIR__ . '/vendor/autoload.php';

use App\WebService\ConsultaSQL;

$ws = new ConsultaSQL;
$ws->setSentence('EXAMPLE.QUERY.001');
$ws->setAffiliate(1);
$ws->setSystem('S');
$ws->setParameters();

var_dump($ws->execute());

