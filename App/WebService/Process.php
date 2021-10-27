<?php

namespace App\WebService;

use App\Connection\WebService;

class Process
{
    private $connection;
    private $process;
    private $xml;

    public function __construct()
    {
        $this->connection = WebService::getClient('/wsProcess/MEX?wsdl');
    }

    public function setProcess(string $process): void
    {
        $this->process = $process;
    }

    public function setXML(array $xml = []): void
    {
        $this->xml = $xml;
    }

    public function execute()
    {

        try {

            $execute = $this->connection->ExecuteWithXmlParams([
                'ProcessServerName' => $this->process,
                'strXmlParams'      => $this->xml
            ]);

            $return = $execute->ExecuteWithXmlParamsResult;
            
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $return;
    }
}
