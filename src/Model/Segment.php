<?php

namespace App\Model;

class Segment
{

    /**
     * @var string $title
     */
    public $title;

    /**
     * @var string $offset
     */
    public $offset;

    /**
     * Segment constructor.
     * @param string $title
     * @param string $offset
     */
    public function __construct(
        string $title,
        string $offset
    ) {
        $this->setTitle($title);
        $this->setOffset($offset);
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param float $offset
     */
    public function setOffset(string $offset): void {
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getOffset(): string {
        return $this->offset;
    }
}