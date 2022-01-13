<?php
/**
 * @var array|\App\Model\Entity\Segment[] $data
 */

$viewData = [];
foreach($data['segments'] as $segment) {
    $viewData[] = [
        'title' =>  sprintf('Chapter %d, part %d', $segment->getChapterNo(), $segment->getPartNo()),
        'offset' => $segment->getOffset()
    ];
}

print_r(json_encode($viewData));