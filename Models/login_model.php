<?php

class Login_Model extends Model {

    var $email;
    var $password;

    function __construct() {
        parent::__construct();
    }

    public function selectUser() {
        if(empty($_POST['email']) || empty($_POST['password'])) {
            // temporar, form completion va fi asigurat de javascript
            return 'EMPTY';
        }

        $this->email = $_POST['email'];
        $this->password = md5($_POST['password']);

        $result = Database::query('select id from users where email = ?', [$this->email]);
        if(empty($result)) {
            return "1-invalid email address-$this->email";
        }
        unset($result);

        $result = Database::query('select id, admin from users where email = ? and password = ?', [$this->email, $this->password]);
        if(empty($result)) {
            return "2-invalid password-$this->email";
        } else {
            return array($result[0]['id'], $this->email, $result[0]['admin']);
        }
    }

    public function logAttempt($email, $geoData = array(), $loc) {
        Database::query('insert into login_attempt_logs (email, ip, loc, coords, postal_code) values (?, ?, ?, ?, ?)', [$email, $geoData['ip'], $loc, $geoData['loc'], $geoData['postal']]);
    }

    public function log($email, $uid, $action, $ip, $loc) {
        Database::query('insert into login_logs (email, uid, action, ip, loc) values (?, ?, ?, ?, ?)', [$email, $uid, $action, $ip, $loc]);
    }

}