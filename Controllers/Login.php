<?php

class Login extends Controller {

    private $user_IP;
    private $user_IPGeoData;
    private $user_IPLocation;
    private static $MODEL;
    private static $userIP_MODEL;

    function __construct() {
        parent::__construct();
        
        require 'Models/login_model.php';
        self::$MODEL = new Login_Model;
        self::$userIP_MODEL = new UserIP;

        self::getUserData();

        $this->view->render('login');
    }

    function getUserData() {
        $this->user_IP = self::$userIP_MODEL->fetchIP();
        $this->user_IPGeoData = self::$userIP_MODEL->defineIPDetails($this->user_IP);

        $geoData = $this->user_IPGeoData;
        $this->user_IPLocation = $geoData['city'].', '.$geoData['region'].', '.$geoData['country'];

        $this->user_IPLocation = iconv('UTF-8', 'ASCII//TRANSLIT', $this->user_IPLocation);
    }

    function submitLogin() {
        $login = self::$MODEL->selectUser();

        if(is_array($login)) {
            self::successfulLogin($login);
        } else {
            self::errorLogin($login);
        }
    }

    private function successfulLogin($details = array()) {
        require 'Models/userdata_model.php';
        $userData = new UserData;

        $id = $details[0];
        $email = $details[1];
        $admin = $details[2];

        $_SESSION['user'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['admin'] = $admin;
        $_SESSION['company'] = $userData->returnData($id, 'company', 'user_data');
        $_SESSION['display_name'] = $userData->returnData($id, 'display_name', 'user_data');
        $_SESSION['title'] = $userData->returnData($id, 'title', 'user_data');

        self::$MODEL->log($email, $id, '1', $this->user_IP, $this->user_IPLocation);
        
        header('location: '.ROOT.DASHBOARD_ROUTE);
        exit;
    }

    private function errorLogin($details) {
        $_SESSION['error'] = $details;

        $email = explode('-', $details)[2];
        if($details != 'EMPTY') {
            self::$MODEL->logAttempt($email, $this->user_IPGeoData, $this->user_IPLocation);
        }

        header('location: '.ROOT.LOGIN_ROUTE);
        exit;
    }

}