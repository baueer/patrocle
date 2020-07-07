<?php

class View {

    public $data;

    public function render($page) {
        require 'Views/' . $page . '.php';
    }

}