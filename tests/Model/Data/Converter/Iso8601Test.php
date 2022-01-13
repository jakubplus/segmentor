<?php

namespace App\Test\Model\Data\Converter;

use App\Model\Data\Converter\Iso8601;
use PHPUnit\Framework\TestCase;

class Iso8601Test extends TestCase {

    public function testToFloatBadArgument() {
        $this->expectException(\Exception::class);
        $toFloat = Iso8601::toFloat('ddd');
    }

    public function testToFloat() {
        $toFloat = Iso8601::toFloat('PT3M46.225S');
        $this->assertEquals(226.225, $toFloat);
    }

}