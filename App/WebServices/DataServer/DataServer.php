<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
 **/

namespace App\WebServices\Process;

use App\Enums\WsdlEnum;
use App\Adapters\Contracts\AdapterInterface;
use App\WebServices\DataServer\Object\DataServerObject;

class DataServer
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private DataServerObject $dataServerObject
    ) {
        $adapterInterface->getAdapter(WsdlEnum::PROCESS);
    }

    public function saveRecord(): object
    {
        return $this->adapterInterface->SaveRecord(
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'Contexto' => $this->dataServerObject->context->value,
                'XML' => $this->dataServerObject->xml
            ]
        );
    }

    public function readRecord(): object
    {
        return $this->adapterInterface->ReadRecord(
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'PrimaryKey' => $this->dataServerObject->primaryKey,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function deleteRecord(): object
    {
        return $this->adapterInterface->DeleteRecord(
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'XML' => $this->dataServerObject->xml,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function deleteRecordByKey(): object
    {
        return $this->adapterInterface->DeleteRecordByKey(
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'PrimaryKey' => $this->dataServerObject->primaryKey,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

    public function readView(): object
    {
        return $this->adapterInterface->ReadView(
            [
                'DataServerName' => $this->dataServerObject->dataServer,
                'Filtro' => $this->dataServerObject->filter,
                'Contexto' => $this->dataServerObject->context->value
            ]
        );
    }

}
