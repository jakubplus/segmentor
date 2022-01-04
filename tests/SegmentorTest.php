<?php

namespace App\Test;

use App\Segmentor;
use PHPUnit\Framework\TestCase;

class SegmentorTest extends TestCase {

    public function testConstructorBadPathArgumentType() {
        $this->expectException(\Exception::class);
        $segmentor = new Segmentor(225, 2.5);
    }

    public function testConstructorBadChapterSilenceDurationArgumentType() {
        $this->expectException(\TypeError::class);
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 'Bla');
    }

    public function testConvertIso8601StringToSecondsFailed() {
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 2.5);
        $this->assertNotEquals(225, $segmentor->convertIso8601StringToSeconds('PT3M46S'));
    }

    public function testConvertIso8601StringToSeconds() {
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 2.5);
        $this->assertEquals(226.225, $segmentor->convertIso8601StringToSeconds('PT3M46.225S'));
    }

    public function testLoadXmlFileFailed() {
        $this->expectException(\Exception::class);
        $segmentor = new Segmentor('./silence-files/silence-test.xml', 2);
    }

    public function testLoadXmlFile() {
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 2);
        $this->assertNotEquals('', $segmentor->getXml());
    }

    public function testConvertSilencesToSegments() {
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 2.5);
        $segmentor->convertSilencesToSegments();
        $this->assertEquals(1, count($segmentor->getSegments()));
        $this->assertEquals(4, count($segmentor->getSegments()['segments']));
    }

    public function testGetJsonSegments() {
        $segmentor = new Segmentor('./silence-files/silence1-test.xml', 2.5);
        $segmentor->convertSilencesToSegments();
        $this->assertEquals('{', substr($segmentor->getJsonSegments(), 0, 1));
    }

}