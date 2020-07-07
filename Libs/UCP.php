<?php

class UCP extends Controller {

    private $user_IP;
    private $user_IPGeoData;
    private $user_IPLocation;
    private static $LOGOUT_MODEL;

    function __construct() {
        parent::__construct();
        self::sessionDashInit();
        
        require 'Models/logout_model.php';
        self::$LOGOUT_MODEL = new Logout_Model;

        self::getUserData();
    }

    function getUserData() {
        $userData = new UserIP;
        $this->user_IP = $userData->fetchIP();
        $this->user_IPGeoData = $userData->defineIPDetails($this->user_IP);

        $geoData = $this->user_IPGeoData;
        $this->user_IPLocation = $geoData['city'].', '.$geoData['region'].', '.$geoData['country'];

        $this->user_IPLocation = iconv('UTF-8', 'ASCII//TRANSLIT', $this->user_IPLocation);
    }

    private function sessionDashInit() {
        session_start();
        if(!isset($_SESSION['user'])) {
            $_SESSION['error'] = '3-you are not connected';

            header('location: '.ROOT.LOGIN_ROUTE);
            exit;
        }
    }

    function logout() {
        self::$LOGOUT_MODEL->log($_SESSION['user'], $this->user_IP, $this->user_IPLocation);

        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        unset($_SESSION['company']);
        unset($_SESSION['display_name']);
        unset($_SESSION['title']);

        header('location: '.ROOT.LOGIN_ROUTE);
        exit;
    }

}