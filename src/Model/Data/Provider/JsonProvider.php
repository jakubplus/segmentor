<?php

namespace App\Model\Data\Provider;

use App\Model\Data\DataProvider;
use \Exception;

class JsonProvider extends DataProvider {

    private string|false $file;

    public function __construct(string $path) {
        try {
            $this->loadFile($path);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $path
     * @throws Exception
     */
    public function loadFile(string $path): void {
        if (file_exists($path)) {
            $this->file = file_get_contents($path);
        } else {
            throw new Exception("File $path not found.");
        }
    }

    /**
     * @return array
     */
    public function getData(): array {
        return json_decode($this->file,true);
    }

}