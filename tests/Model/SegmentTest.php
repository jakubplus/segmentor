<?php

namespace App\Test;

use App\Model\Segment;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase {

    public function testGetSegmentFailed() {
        $a = new Segment('BlaBlabla', 2.5);
        $this->assertNotEquals('Bla', $a->getTitle());
        $this->assertNotEquals(3, $a->getOffset());
    }

    public function testGetSegment() {
        $a = new Segment('BlaBlabla', 2.5);
        $this->assertEquals('BlaBlabla', $a->getTitle());
        $this->assertEquals(2.5, $a->getOffset());
    }

}