<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace App\WebServices\Query;

use App\Enums\WsdlEnum;
use App\Adapters\Contracts\AdapterInterface;
use App\WebServices\Query\Object\QueryObject;

class Query
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private QueryObject $queryObject
    ) {
        $adapterInterface->getAdapter(WsdlEnum::QUERY);
    }

    public function execute(): object
    {
        return $this->adapterInterface->RealizarConsultaSQL(
            [
                'codSentenca' => $this->queryObject->sentence,
                'codColigada' => $this->queryObject->affiliate->value,
                'codSistema' => $this->queryObject->system->value,
                'parameters' => $this->queryObject->parameters
            ]
        );
    }
    
}
