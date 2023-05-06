<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+Process
**/

namespace App\WebService;

use App\Interface\AdapterInterface;

class Process
{
    private string $process;
    private string $xml;

    public function __construct(private AdapterInterface $adapterInterface)
    {
        $this->adapterInterface = $adapterInterface->getAdapter('/wsProcess/MEX?wsdl');
    }

    /**
     * @param string $process
     * @return void
     */
    public function setProcess(string $process): void
    {
        $this->process = $process;
    }

    /**
     * @param string $xml
     * @return void
     */
    public function setXML(string $xml): void
    {
        $this->xml = $xml;
    }

    /**
     * @return int
     */
    public function execute(): int
    {

        try {

            $execute = $this->adapterInterface->ExecuteWithXmlParams([
                'ProcessServerName' => $this->process,
                'strXmlParams'      => $this->xml
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $execute->ExecuteWithXmlParamsResult;
    }
}
