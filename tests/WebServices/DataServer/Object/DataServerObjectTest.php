<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\DataServer\Object;

use PHPUnit\Framework\TestCase;
use SoapTotvs\Enums\ContextEnum;
use SoapTotvs\WebServices\DataServer\Object\DataServerObject;

final class DataServerObjectTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $dataServer = 'DataServerName';
        $context = ContextEnum::DEFAULT;
        $xml = '<xml>content</xml>';
        $primaryKey = 123;
        $filter = 'FILTER=VALUE';

        $object = new DataServerObject(
            $dataServer,
            $context,
            $xml,
            $primaryKey,
            $filter
        );

        $this->assertSame($dataServer, $object->dataServer);
        $this->assertSame($context, $object->context);
        $this->assertSame($xml, $object->xml);
        $this->assertSame($primaryKey, $object->primaryKey);
        $this->assertSame($filter, $object->filter);
    }

    public function testCanInstantiateWithNullableValues(): void
    {
        $dataServer = 'DataServerName';
        $context = ContextEnum::DEFAULT;
        $xml = null;
        $primaryKey = null;
        $filter = 'FILTER=VALUE';

        $object = new DataServerObject(
            $dataServer,
            $context,
            $xml,
            $primaryKey,
            $filter
        );

        $this->assertNull($object->xml);
        $this->assertNull($object->primaryKey);
    }
}
