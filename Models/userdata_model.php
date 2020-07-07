<?php

class UserData extends Model {

    function __construct() {
        parent::__construct();
    }

    public function returnData($user, $data, $tbl) {
        $result = Database::query("select {$data} from {$tbl} where uid = ?", [$user]);
        if(empty($result)) {
            return "N/A";
        }
        return $result[0]["${data}"];
    }

    // returneaza array cu id-urile din user_data ale userilor ce fac parte dintr-o companie
    public function returnCompanyEmployees($id) {
        $data = array();
        $result = Database::query("select uid from user_data where company = ?", [$id]);
        foreach($result as $i) {
            $res = Database::query("select uid, display_name, team, rfid_tag, last_seen from user_data where uid = ?", [$i[0]]);
            array_push($data, $res);
        }
        return $data;
    }

    public function returnEmployeesTableInfo($id) {
        $result = Database::query("select display_name, team, rfid_tag, last_seen from user_data where uid = $id");
        return $result;
    }

}