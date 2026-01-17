<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
 **/

namespace SoapTotvs\WebServices\DataServer;

use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;
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
            OperationEnum::SAVE_RECORD,
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
            OperationEnum::READ_RECORD,
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
            OperationEnum::DELETE_RECORD,
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
            OperationEnum::DELETE_RECORD_BY_KEY,
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
            OperationEnum::READ_VIEW,
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'Filtro' => $this->dataServerObject->filter,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

}

