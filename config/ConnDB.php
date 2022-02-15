<?php

class ConnDB{

    private static $host = 'localhost';
    private static $user = 'root';
    private static $pass = '';
    private static $dbname = 'palacioLibro';



    public static function creaConn(){
        try {
            $conn = new PDO('mysql:host='.SELF::$host.';dbname='.SELF::$dbname, SELF::$user, SELF::$pass);
            return $conn;
        }catch(PDOException $exception){
            die('Error: '. $exception -> getMessage());
        }

    }




}

