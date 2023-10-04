<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace App\WebServices\Query;

use App\Adapters\Contracts\AdapterInterface;
use App\WebServices\Query\QueryObject;

class Query
{
    public function __construct(
        private AdapterInterface $adapterInterface,
        private QueryObject $queryObject
    ) {
        $adapterInterface->getAdapter('/wsConsultaSQL/MEX?wsdl');
    }

    public function execute(): object
    {
        return $this->adapterInterface->RealizarConsultaSQL(
            [
                'codSentenca' => $this->queryObject->sentence,
                'codColigada' => $this->queryObject->affiliate,
                'codSistema' => $this->queryObject->system,
                'parameters' => $this->queryObject->parameters
            ]
        );
    }
}
