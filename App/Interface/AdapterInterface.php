<?php

namespace App\Interface;

interface AdapterInterface
{
    /**
     * @param string $url
     * @return mixed
     */
    public function getAdapter(string $url): mixed;
}