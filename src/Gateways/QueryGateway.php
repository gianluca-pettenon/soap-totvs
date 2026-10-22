<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace SoapTotvs\Gateways;

use SoapTotvs\Enums\{OperationEnum, WsdlEnum};

final class QueryGateway extends Gateway
{
    protected function wsdl(): WsdlEnum
    {
        return WsdlEnum::QUERY;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function execute(
        string $sentence,
        int $affiliate,
        string $system,
        array $parameters
    ): object {
        return $this->call(OperationEnum::REALIZE_SQL_QUERY, [
            'codSentenca' => $sentence,
            'codColigada' => $affiliate,
            'codSistema' => $system,
            'parameters' => $parameters,
        ]);
    }
}
