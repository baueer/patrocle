<?php

class UserIP {

    protected $ipAddr = '';
    protected $ipDetails = [];

    public function fetchIP() {
        $ip = '';
        
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = 'UNKNOWN';

        if($ip == '::1') {
            $ip = '127.0.0.1';
        }

        // test
        $ip = '79.113.164.12';
        $this->ipAddr = $ip;
        
        return $ip;
    }

    public function defineIPDetails($ip) {
        $response = json_decode(file_get_contents("http://ipinfo.io/$ip/json?token=a1fc3e63528a25"));

        $this->ipDetails = [
            "ip" => $response->ip,
            "hostname" => $response->hostname,
            "city" => $response->city,
            "region" => $response->region,
            "country" => $response->country,
            "loc" => $response->loc,
            "org" => $response->org,
            "postal" => $response->postal,
            "timezone" => $response->timezone,
        ];

        return $this->ipDetails;
    }

    public function geoGet($ip, $arg) {
        if($arg = 'full_loc' && $ip == $this->ipAddr) {
            $str = $this->ipDetails["city"].', '.$this->ipDetails["region"].', '.$this->ipDetails["country"];
            return $str;
        } else if($ip == $this->ipAddr) {
            return $this->ipDetails["{$arg}"];
        }
        return false;
    }

}

// initializarea se face cu declararea unui obiect la inceputul fiecarui constroller
// $userData = new UserData;
// de preferat, la fiecare initializare, se va apela functia fetchIP() pentru initializare
// pentru returnarea unei date prin API-ul furnizat de ipinfo.io se foloseste
// $userData->geoGet(IP, "NUME_VALOARE")