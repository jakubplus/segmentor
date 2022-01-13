<?php

namespace App\Model\Data\Converter;

use App\Model\Data\DataConverter;
use DateInterval;

class Iso8601 implements DataConverter {

    public static function toFloat(string $iso8601_string): float {
        $t = [
            $iso8601_string,
        ];
        $dotpos = strpos($iso8601_string, '.');
        if ($dotpos > -1) {
            $t = [
                substr($iso8601_string, 0, $dotpos) . 'S',
                substr($iso8601_string, $dotpos + 1, -1),
            ];
        }
        $inv = new DateInterval($t[0]);
        if (!$inv->i) {
            $inv->i = 0;
        }
        $s = ($inv->s) + ($inv->i * 60) + ($inv->h * 60 * 60);
        if (count($t) === 1) {
            return (float)$s;
        }
        $f = strlen($t[1]) < 3 ? strlen($t[1]) < 2 ? '00' . $t[1] : '0' . $t[1] : $t[1];
        return (float)($s . '.' . $f);
    }
}