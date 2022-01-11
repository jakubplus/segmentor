<?php

namespace App;

use App\Model\Segment;
use DateInterval;

class Segmentor
{

    /**
     * @var float $chapter_silence_duration
     */
    private $chapter_silence_duration;

    /**
     * @var string $xml
     */
    private $xml;

    /**
     * @var array $segments
     */
    private $segments = [];

    /**
     * Segmentor constructor.
     * @param string $path
     * @param int $chapter_silence_duration
     */
    public function __construct(
        string $path,
        float $chapter_silence_duration
    ) {
        $this->loadXmlFile($path);
        $this->chapter_silence_duration = $chapter_silence_duration;
    }

    /**
     * @param string $iso8601_string
     * @return float
     * @throws Exception
     */
    public function convertIso8601StringToSeconds(string $iso8601_string): float {
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

    /**
     * Loads XML file
     */
    public function loadXmlFile(string $path): void {
        if (file_exists($path)) {
            $this->xml = simplexml_load_file($path);
        } else {
            throw new \Exception("File $path not found.");
        }
    }

    /**
     * @return string
     */
    public function getXml(): string {
        return $this->xml;
    }

    /**
     * Converts silences from file to practical sound segments
     *
     * @throws Exception
     */
    public function convertSilencesToSegments(): void {
        $this->segments['segments'][] = new Segment('Chapter 1, part 1', 'PT0S');
        $ch = 1;
        $p = 2;
        foreach ($this->xml->silence as $silence) {
            $fdt = $this->convertIso8601StringToSeconds((string)$silence['from']);
            $udt = $this->convertIso8601StringToSeconds((string)$silence['until']);
            $df = round($udt - $fdt, 3);
            if ($df > (float)$this->chapter_silence_duration) {
                $ch++;
                $p = 1;
            }
            $this->segments['segments'][] = new Segment('Chapter ' . $ch . ', part ' . $p, $silence['until']);
            $p++;
        }
    }

    /**
     * @return array
     */
    public function getSegments(): array {
        return $this->segments;
    }

    /**
     * Returns JSON string with segments
     *
     * @return false|string
     */
    public function getJsonSegments(): string {
        return json_encode($this->segments);
    }

}