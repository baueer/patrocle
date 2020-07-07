<?php

class ErrorController extends Controller {

    function __construct() {
        parent::__construct();
        echo 'ERROR PAGE';

        $this->view->render('error');
    }

}