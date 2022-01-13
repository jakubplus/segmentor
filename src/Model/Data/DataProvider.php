<?php

namespace App\Model\Data;

abstract class DataProvider {
    /**
     * @param string $path
     */
    abstract public function loadFile(string $path): void;

    /**
     * @return array
     */
    abstract public function getData(): array;
}