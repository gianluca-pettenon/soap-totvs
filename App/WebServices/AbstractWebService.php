<?php

namespace App\WebServices\Process;

use App\Adapters\Contracts\AdapterInterface;

abstract class AbstractWebService
{
    abstract function getAdapter();
    abstract function getLocation();
}
