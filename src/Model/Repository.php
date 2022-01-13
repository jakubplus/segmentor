<?php

namespace App\Model;

abstract class Repository {

    /**
     * Typical resource finder
     *
     * @param array $options
     * @return array
     */
    abstract public function getResults(array $options): array;

}