<?php

namespace App\Test\Model\Data\Converter;

use App\Model\Data\Provider\XmlProvider;
use App\Model\Repository\SegmentsRepository;
use PHPUnit\Framework\TestCase;

class SegmentsRepositoryTest extends TestCase {

    public function testGetResultsFailed() {
        $this->expectException(\ArgumentCountError::class);
        $segmentsRepository = new SegmentsRepository();
        $results = $segmentsRepository->getResults();
        $this->assertEquals(0, count($results));
    }

    public function testGetResults() {
        $dataProvider = new XmlProvider('./silence-files/silence1-test.xml');
        $repository = new SegmentsRepository($dataProvider->getData());
        $results = $repository->getResults(['chapter_silence_duration' => 3]);
        $this->assertEquals(4, count($results));
    }

}