<?php
/**
 * @var array|\App\Model\Entity\Segment[] $data
 */

foreach($data['segments'] as $segment) {
    echo sprintf('Chapter: %d part: %d offset: %s', $segment->getChapterNo(), $segment->getPartNo(), $segment->getOffset());
    echo "\r\n";
}