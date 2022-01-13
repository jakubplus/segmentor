<?php

namespace App\Model\Data;

interface DataConverter {

    /**
     * @param string $iso8601
     * @return float
     */
    public static function toFloat(string $input): float;

}