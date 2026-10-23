<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Web+Service+DataServer
 **/

namespace SoapTotvs\Gateways;

use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

final class DataServerGateway extends Gateway
{
    protected function wsdl(): WsdlEnum
    {
        return WsdlEnum::DATASERVER;
    }

    public function saveRecord(
        string $dataServer,
        string|int $context,
        string $xml
    ): object {
        return $this->call(OperationEnum::SAVE_RECORD, [
            'DataServerName' => $dataServer,
            'Contexto' => $context,
            'XML' => $xml,
        ]);
    }

    public function readRecord(
        string $dataServer,
        string|int $context,
        int $primaryKey
    ): object {
        return $this->call(OperationEnum::READ_RECORD, [
            'DataServerName' => $dataServer,
            'PrimaryKey' => $primaryKey,
            'Contexto' => $context,
        ]);
    }

    public function deleteRecord(
        string $dataServer,
        string|int $context,
        string $xml
    ): object {
        return $this->call(OperationEnum::DELETE_RECORD, [
            'DataServerName' => $dataServer,
            'XML' => $xml,
            'Contexto' => $context,
        ]);
    }

    public function deleteRecordByKey(
        string $dataServer,
        string|int $context,
        int $primaryKey
    ): object {
        return $this->call(OperationEnum::DELETE_RECORD_BY_KEY, [
            'DataServerName' => $dataServer,
            'PrimaryKey' => $primaryKey,
            'Contexto' => $context,
        ]);
    }

    public function readView(
        string $dataServer,
        string|int $context,
        string $filter
    ): object {
        return $this->call(OperationEnum::READ_VIEW, [
            'DataServerName' => $dataServer,
            'Filtro' => $filter,
            'Contexto' => $context,
        ]);
    }
}
