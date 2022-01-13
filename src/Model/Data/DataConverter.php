<?php

namespace App\Model\Data;

interface DataConverter {

    /**
     * @param string $input
     * @return float
     */
    public static function toFloat(string $input): float;

}