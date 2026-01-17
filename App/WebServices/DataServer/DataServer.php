<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
 **/

namespace SoapTotvs\WebServices\DataServer;

use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\WebServices\DataServer\Object\DataServerObject;

class DataServer
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private DataServerObject $dataServerObject
    ) {
    }

    public function saveRecord(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::DATASERVER,
            'SaveRecord',
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'Contexto' => $this->dataServerObject->context->value,
                'XML' => $this->dataServerObject->xml
            ]
        );
    }

    public function readRecord(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::DATASERVER,
            'ReadRecord',
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'PrimaryKey' => $this->dataServerObject->primaryKey,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function deleteRecord(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::DATASERVER,
            'DeleteRecord',
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'XML' => $this->dataServerObject->xml,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function deleteRecordByKey(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::DATASERVER,
            'DeleteRecordByKey',
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'PrimaryKey' => $this->dataServerObject->primaryKey,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function readView(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::DATASERVER,
            'ReadView',
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'Filtro' => $this->dataServerObject->filter,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

}
