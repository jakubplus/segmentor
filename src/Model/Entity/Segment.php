<?php

namespace App\Model\Entity;

use App\Model\Entity;

class Segment extends Entity
{

    /**
     * @var int
     */
    private int $chapterNo;

    /**
     * @var int
     */
    private int $partNo;

    /**
     * @var string $offset
     */
    private string $offset;

    /**
     * Segment constructor.
     * @param int $chapterNo
     * @param int $partNo
     * @param string $offset
     */
    public function __construct(
        int $chapterNo,
        int $partNo,
        string $offset
    ) {
        $this->chapterNo = $chapterNo;
        $this->partNo = $partNo;
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getChapterNo(): int {
        return $this->chapterNo;
    }

    /**
     * @return int
     */
    public function getPartNo(): int {
        return $this->partNo;
    }

    /**
     * @return string
     */
    public function getOffset(): string {
        return $this->offset;
    }


}