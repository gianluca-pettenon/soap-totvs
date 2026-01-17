<?php

declare(strict_types=1);

namespace SoapTotvs\Tests\WebServices\Process\Object;

use PHPUnit\Framework\TestCase;
use SoapTotvs\WebServices\Process\Object\ProcessObject;

final class ProcessObjectTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $process = 'ProcessName';
        $xml = '<xml>content</xml>';

        $object = new ProcessObject(
            $process,
            $xml
        );

        $this->assertSame($process, $object->process);
        $this->assertSame($xml, $object->xml);
    }
}
