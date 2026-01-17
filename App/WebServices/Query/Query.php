<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace SoapTotvs\WebServices\Query;

use SoapTotvs\Enums\WsdlEnum;
use SoapTotvs\Enums\OperationEnum;
use SoapTotvs\Adapters\Contracts\AdapterInterface;
use SoapTotvs\WebServices\Query\Object\QueryObject;

class Query
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private QueryObject $queryObject
    ) {
    }

    public function execute(): object
    {
        return $this->adapterInterface->call(
            WsdlEnum::QUERY,
            OperationEnum::REALIZE_SQL_QUERY,
            [
                'codSentenca' => $this->queryObject->sentence,
                'codColigada' => $this->queryObject->affiliate->value,
                'codSistema' => $this->queryObject->system->value,
                'parameters' => $this->queryObject->parameters
            ]
        );
    }
    
}
