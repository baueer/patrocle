<?php

class Logout_Model extends Model {

    function _construct() {
        parent::construct();
    }

    public function log($uid, $ip, $loc) {
        $res = Database::query('select email from users where id = ?', [$uid]);
        $email = $res[0]['email'];
        Database::query('insert into login_logs (email, uid, action, ip, loc) values (?, ?, ?, ?, ?)', [$email, $uid, '2', $ip, $loc]);
    }

}