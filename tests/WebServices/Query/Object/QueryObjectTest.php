<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\Query\Object;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Enums\AffiliateEnum;
use SoapTotvs\Enums\SystemEnum;
use SoapTotvs\WebServices\Query\Object\QueryObject;

final class QueryObjectTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $sentence = 'EDU.001';
        $affiliate = AffiliateEnum::DEFAULT;
        $system = SystemEnum::EDUCATIONAL;
        $parameters = ['param1' => 'value1'];

        $object = new QueryObject(
            $sentence,
            $affiliate,
            $system,
            $parameters
        );

        $this->assertSame($sentence, $object->sentence);
        $this->assertSame($affiliate, $object->affiliate);
        $this->assertSame($system, $object->system);
        $this->assertSame($parameters, $object->parameters);
    }
}
