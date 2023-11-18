<?php

namespace App\Adapters\Contracts;

use App\Enums\WsdlEnum;

interface AdapterInterface
{
    /**
     * @param WsdlEnum $wsdlEnum
     * @return mixed
     */
    public function getAdapter(WsdlEnum $wsdlEnum): mixed;
}