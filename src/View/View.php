<?php

namespace App\View;

abstract class View {

    /**
     * @param string $template
     * @param array $data
     */
    abstract public function display(string $template, array $data): void;

    /**
     * @param array $data
     */
    abstract public function toString(array $data): void;
}