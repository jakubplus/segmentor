<?php

namespace App\Model\Data;

abstract class DataProvider {
    abstract public function loadFile(string $path): void;
    abstract public function getData(): array;
}