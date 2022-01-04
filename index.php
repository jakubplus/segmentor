<?php

require './vendor/autoload.php';

try {
    if (!isset($argv[1]) || !is_string($argv[1])) {
        echo 'Missing silence file path (string) parameter.'; exit;
    }
    if (!isset($argv[2]) || !is_string($argv[2])) {
        echo 'Missing chapter silence duration (float|int) parameter.'; exit;
    }
    // For browser test use
    // $segmentor = new \App\Segmentor('./silence-files/silence1.xml', 2.7);
    $segmentor = new \App\Segmentor($argv[1], $argv[2]);
    $segmentor->convertSilencesToSegments();
    print_r($segmentor->getJsonSegments());

} catch (Exception $e) {
    echo $e->getMessage();
}
exit;
