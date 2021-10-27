<?php
// Composer autoloading
include __DIR__ . '/vendor/autoload.php';

use App\Connection\WebService;

use App\WebService\ConsultaSQL;
use App\WebService\Process;
use App\WebService\DataServer;


$ws = new ConsultaSQL(new WebService);

echo "<pre>";
var_dump($ws->execute());
echo "</pre>";

?>

See <a href="/README.md">README.md</a> for more information.