<?php

namespace SoapTotvs\Adapters;

use SoapTotvs\Enums\WsdlEnum;

final readonly class SoapConfig
{
    /**
     * @var array<string, mixed>
     */
    private const array DEFAULTS = [
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'keep_alive' => false,
        'connection_timeout' => 25,
    ];

    /**
     * @param array<string, mixed> $options SoapClient options. Override the defaults, including connection_timeout (seconds).
     */
    public function __construct(
        public string $host,
        public string $user,
        public string $password,
        public array $options = []
    ) {
    }

    public function wsdl(WsdlEnum $wsdl): string
    {
        return $this->host . $wsdl->value;
    }

    /**
     * @return array<string, mixed>
     */
    public function options(): array
    {
        return [
            ...self::DEFAULTS,
            'login' => $this->user,
            'password' => $this->password,
            ...$this->options,
        ];
    }
}
