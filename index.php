<?php

require './vendor/autoload.php';

use App\Model\Data\Provider\XmlProvider;
use App\View\Type\JsonView;
use App\Controller\Console\SegmentController;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ .DS);
define('TEMPLATE_DIR', 'src'.DS.'templates'.DS);

try {
    if (!isset($argv[1]) || !is_string($argv[1])) {
        echo 'Missing silence file path (string) parameter.'; exit;
    }
    if (!isset($argv[2]) || !is_string($argv[2])) {
        echo 'Missing chapter silence duration (float|int) parameter.'; exit;
    }

    $provider = new XmlProvider($argv[1]);
    $view = new JsonView();
    $segmentController = new SegmentController($provider, $view);
    $segments = $segmentController->getSegments($argv[2]);

} catch (Exception $e) {
    echo $e->getMessage();
}
exit;
