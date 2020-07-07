<?php

class Employees extends UCP {

    private $permission = 1;
    private static $USERDATA;

    function __construct() {
        require 'Models/userdata_model.php';
        self::$USERDATA = new UserData;

        parent::__construct();
        if($_SESSION['admin'] ==  $this->permission) {
            if(!strpos($_GET['url'], 'add')) {
                $this->view->data = self::populateTable();
                $this->view->render('employees'); 
            }
            
        } else {
            header('location: '.ROOT.DASHBOARD_ROUTE);
            exit;
        }
    }

    public function populateTable() {
        $employees = self::$USERDATA->returnCompanyEmployees($_SESSION['company']);
        return $employees;
    }

    public function add() {
        $this->view->render('add');
    }
}