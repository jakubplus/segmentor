<?php

namespace App\Model\Data\Provider;

use App\Model\Data\DataProvider;
use SimpleXMLElement;

class XmlProvider extends DataProvider {

    private SimpleXMLElement $file;

    /**
     * JsonProvider constructor.
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path) {
        $this->loadFile($path);
    }

    /**
     * @param string $path
     * @throws \Exception
     */
    public function loadFile(string $path): void {
        if (file_exists($path)) {
            $this->file = simplexml_load_file($path);
        } else {
            throw new \Exception("File $path not found.");
        }
    }

    /**
     * @return array
     */
    public function getData(): array {
        $data = [];
        foreach ($this->file->silence as $silence) {
            $data[] = [
                'from' => (string)$silence['from'],
                'until' => (string)$silence['until']
            ];
        }
        return $data;
    }

}