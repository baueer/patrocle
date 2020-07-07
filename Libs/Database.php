<?php

class Database {

    public static $dbHost = 'localhost';
    public static $dbName = 'patrocleme';
    public static $dbUsername = 'root';
    public static $dbPassword = ''; 

    public static function connect() {
        $pdo = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName.";charset=utf8", self::$dbUsername, self::$dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);

        $queryType = explode(' ', $query)[0];
        if(strtolower($queryType) == 'select') {
            $data = $stmt->fetchAll();
            return $data;
        }
    }

}

// DATABASE <- MODEL <- PARTICULAR_MODEL (inheritance)
// ORICE MODEL FOLOSESTE
// PT SELECTIE: Database::query('select * from users)
// PT INSERTIE: Database::query('insert into users (email, password) values (?, ?)', ['admin@yahoo.ro', '4321'])

// LA SELECTIE, REZULTATUL RETURNAT ESTE INTR-UN ARRAY ASOCIATIV
// INSERTIA NU RETURNEAZA NIMIC