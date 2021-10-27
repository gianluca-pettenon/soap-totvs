<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
**/

namespace App\WebService;

use App\Connection\WebService;

class DataServer
{
    private $connection;
    private $dataServer;
    private $primaryKey;
    private $context;
    private $filter;
    private $xml;

    public function __construct()
    {
        $this->connection = WebService::getClient('/wsDataServer/MEX?wsdl');
    }

    public function setDataServer(string $dataServer): void
    {
        $this->dataServer = $dataServer;
    }

    public function setPrimaryKey(int $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

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

    public function saveRecord()
    {
        return $this->connection->SaveRecord([
            'DataServerName'    => $this->dataServer,
            'XML'               => $this->xml,
            'Contexto'          => $this->context
        ]);
    }

    public function readRecord()
    {
        try {

            $execute = $this->connection->ReadRecord([
                'DataServerName'    => $this->dataServer,
                'PrimaryKey'        => $this->primaryKey,
                'Contexto'          => $this->context
            ]);

            $result = json_encode(simplexml_load_string($execute->ReadRecordResult));

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $result;
    }

    public function deleteRecord()
    {
        try {

            $execute = $this->connection->DeleteRecord([
                'DataServerName'    => $this->dataServer,
                'XML'               => $this->xml,
                'Contexto'          => $this->context
            ]);

            $result = $execute->DeleteRecordResult;

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $result;
    }

    public function deleteRecordByKey()
    {
        try {

            $execute = $this->connection->DeleteRecordByKey([
                'DataServerName'    => $this->dataServer,
                'PrimaryKey'        => $this->primaryKey,
                'Contexto'          => $this->context,
            ]);

            $result = json_decode(json_encode(simplexml_load_string($execute->DeleteRecordByKeyResult)), true);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $result;
    }

    public function readView()
    {
        try {

            $execute = $this->connection->ReadView([
                'DataServerName'    => $this->dataServer,
                'Filtro'            => $this->filter,
                'Contexto'          => $this->context
            ]);

            $result = json_decode(json_encode(simplexml_load_string($execute->ReadViewResult)), true);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $result;
    }
}
