<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\Adapters;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SoapTotvs\Adapters\SoapConfig;
use SoapTotvs\Enums\WsdlEnum;

final class SoapConfigTest extends TestCase
{
    #[Test]
    public function optionsIncludeCredentialsDefaultsAndOverrides(): void
    {
        $config = new SoapConfig('http://example.com', 'user', 'pass', ['trace' => 1, 'connection_timeout' => 10]);

        $this->assertSame('http://example.com/wsConsultaSQL/MEX?wsdl', $config->wsdl(WsdlEnum::QUERY));
        $this->assertSame([
            'soap_version' => SOAP_1_1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'keep_alive' => false,
            'connection_timeout' => 10,
            'login' => 'user',
            'password' => 'pass',
            'trace' => 1,
        ], $config->options());
    }
}
