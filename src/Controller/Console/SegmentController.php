<?php

namespace App\Controller\Console;

use App\Model\Data\DataProvider;
use App\Model\Repository\SegmentsRepository;
use App\View\View;

class SegmentController {

    /**
     * @var DataProvider $dataProvider
     */
    public DataProvider $dataProvider;

    /**
     * @var View $view
     */
    public View $view;

    public function __construct(DataProvider $dataProvider, View $view) {
        $this->dataProvider = $dataProvider;
        $this->view = $view;
    }

    /**
     * @param float $chapter_silence_duration
     * @return void
     */
    public function getSegments(float $chapter_silence_duration): void {
        $repository = new SegmentsRepository($this->dataProvider->getData());
        $segments = $repository->getResults(['chapter_silence_duration' => $chapter_silence_duration]);

        $this->view->display('json', ['segments' => $segments]);
    }

}