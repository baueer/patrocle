<?php

class Dashboard extends UCP {

    function __construct() {
        parent::__construct();
        $this->view->render('dashboard');
    }

}