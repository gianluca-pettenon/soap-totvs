<?php

namespace App\Adapters\Contracts;

interface AdapterInterface
{
    /**
     * @param string $url
     * @return mixed
     */
    public function getAdapter(string $url): mixed;
}