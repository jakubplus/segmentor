<?php

namespace App\Test\Controller\Console;

use App\Controller\Console\SegmentController;
use App\Model\Data\Provider\XmlProvider;
use App\View\Type\JsonView;
use PHPUnit\Framework\TestCase;

class SegmentControllerTest extends TestCase {

    public function testInitializeControllerMissingSourceFailed() {
        $this->expectException(\Exception::class);
        $provider = new XmlProvider('./ddd.xml');
    }

    public function testInitializeControllerUndefinedViewProviderFailed() {
        $this->expectException(\ArgumentCountError::class);
        $provider = new XmlProvider('./silence-files/silence1-test.xml');
        $segmentController = new SegmentController($provider);
    }

}