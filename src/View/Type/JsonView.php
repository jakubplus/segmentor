<?php

namespace App\View\Type;

use App\View\View;
use \Exception;

class JsonView extends View {

    /**
     * @param string $template
     * @param array $data
     * @throws \Exception
     */
    public function display($template = 'standard', array $data = []): void {
        $templatePath = ROOT.TEMPLATE_DIR;
        if(file_exists($templatePath.$template.'.php')) {
            require_once $templatePath.$template.'.php';
        }
        else {
            throw new Exception("Template file $template not found.");
        }
    }

    /**
     * @param array $data
     */
    public function toString(array $data): void {
        try {
            $response = json_encode($data);
            echo $response;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }

    }

}