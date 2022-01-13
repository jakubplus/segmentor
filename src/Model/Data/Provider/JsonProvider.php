<?php

namespace App\Model\Data\Provider;

use App\Model\Data\DataProvider;

class JsonProvider extends DataProvider {

    private string|false $file;

    /**
     * JsonProvider constructor.
     * @param string $path
     * @throws \Exception
     */
    public function __construct(string $path) {
        $this->file = $this->loadFile($path);
    }

    /**
     * @param string $path
     * @throws \Exception
     */
    public function loadFile(string $path): void {
        if (file_exists($path)) {
            $this->file = file_get_contents($path);
        } else {
            throw new \Exception("File $path not found.");
        }
    }

    /**
     * @return array
     */
    public function getData(): array {
        return json_decode($this->file,true);
    }

}