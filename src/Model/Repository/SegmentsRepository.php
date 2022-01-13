<?php

namespace App\Model\Repository;

use App\Model\Repository;
use App\Model\Data\Converter\Iso8601;
use App\Model\Entity\Segment;

class SegmentsRepository extends Repository {

    /**
     * @var array
     */
    public array $sourceData = [];

    /**
     * @var array
     */
    public array $segments = [];

    /**
     * SegmentsRepository constructor.
     * @param array $sourceData
     */
    public function __construct(array $sourceData) {
        $this->sourceData = $sourceData;
    }

    /**
     * @param array $data
     * @param array $options
     */
    public function getResults(array $options = []): array {
        if(!$options['chapter_silence_duration']) {
            $options['chapter_silence_duration'] = 1;
        }
        $ch = 1;
        $p = 1;
        $this->segments[] = new Segment($ch,$p, 'PT0S');
        foreach($this->sourceData as $silence) {
            $ic = new Iso8601();
            $df = round($ic::toFloat($silence['until']) - $ic::toFloat($silence['from']), 3);
            if ($df > $options['chapter_silence_duration']) {
                $p = 1;
                $segment = new Segment(++$ch, $p, $silence['until']);
            }
            else {
                $segment = new Segment($ch, $p, $silence['until']);
            }
            $this->segments[] = $segment;
            $p++;
        }
        return $this->segments;
    }

}