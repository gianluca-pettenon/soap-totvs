<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
**/

namespace App\WebService;

use App\Interface\AdapterInterface;

class DataServer
{
    private string $dataServer;
    private int $primaryKey;
    private string $context;
    private string $filter;
    private string $xml;

    public function __construct(private AdapterInterface $adapterInterface)
    {
        $this->adapterInterface = $adapterInterface->getAdapter('/wsDataServer/MEX?wsdl');
    }

    /**
     * @param string $dataServer
     * @return void
     */
    public function setDataServer(string $dataServer): void
    {
        $this->dataServer = $dataServer;
    }

    /**
     * @param int $primaryKey
     * @return void
     */
    public function setPrimaryKey(int $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @param string $context
     * @return void
     */
    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    /**
     * @param string $filter
     * @return void
     */
    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @param string $table
     * @param array $data
     * @return void
     */
    public function setXML(string $table, array $data) : void
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $element = $dom->createElement($table);
        $dom->appendChild($element);

        foreach ($data as $key => $value) :
            $append = $dom->createElement($key, $value);
            $element->appendChild($append);
        endforeach;

        $this->xml = $dom->saveXML();
    }

    /**
     * @return int
     */
    public function saveRecord(): int
    {
        return $this->adapterInterface->SaveRecord([
            'DataServerName'    => $this->dataServer,
            'XML'               => $this->xml,
            'Contexto'          => $this->context
        ]);
    }

    /**
     * @return array
     */
    public function readRecord(): array
    {
        try {

            $execute = $this->adapterInterface->ReadRecord([
                'DataServerName'    => $this->dataServer,
                'PrimaryKey'        => $this->primaryKey,
                'Contexto'          => $this->context
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $execute->ReadRecordResult;
    }

    /**
     * @return int
     */
    public function deleteRecord(): int
    {
        try {

            $execute = $this->adapterInterface->DeleteRecord([
                'DataServerName'    => $this->dataServer,
                'XML'               => $this->xml,
                'Contexto'          => $this->context
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $execute->DeleteRecordResult;
    }

    /**
     * @return array
     */
    public function deleteRecordByKey(): array
    {
        try {

            $execute = $this->adapterInterface->DeleteRecordByKey([
                'DataServerName'    => $this->dataServer,
                'PrimaryKey'        => $this->primaryKey,
                'Contexto'          => $this->context,
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $execute->DeleteRecordByKeyResult;
    }

    /**
     * @return array
     */
    public function readView(): array
    {
        try {

            $execute = $this->adapterInterface->ReadView([
                'DataServerName'    => $this->dataServer,
                'Filtro'            => $this->filter,
                'Contexto'          => $this->context
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $execute->ReadViewResult;
    }
}
