<?php

namespace App\View\Type;

use App\View\View;
use \SimpleXMLElement;

class XmlView extends View {

    /**
     * @var SimpleXMLElement
     */
    private SimpleXMLElement $xml_data;

    /**
     * XmlView constructor.
     */
    public function __construct() {
        $this->xml_data = new SimpleXMLElement('<root/>');
    }

    /**
     * @param array $data
     */
    private function arrayToXml( array $data ): void {
        foreach( $data as $key => $value ) {
            if( is_object($value)) {
                $value = (array)$value;
            }
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $this->xml_data->addChild($key);
                foreach($value as $sk=>$property) {
                    $this->xml_data->{$key}->addChild($sk, $property);
                }
            } else {
                $this->xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

    /**
     * @param string $template
     * @param array $data
     * @throws \Exception
     */
    public function display($template = 'standard', array $data): void {
        $this->arrayToXml($data['segments']);
        $data = $this->xml_data;

        $templatePath = ROOT.TEMPLATE_DIR;
        if(file_exists($templatePath.$template.'.php')) {
            require_once $templatePath.$template.'.php';
        }
        else {
            throw new \Exception("Template file $template not found.");
        }
    }

    /**
     * @param array $data
     */
    public function toString(array $data): void {
        try {
            $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
            $response = $this->arrayToXml($data['segments'], $xml_data);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        echo $response;
    }

}