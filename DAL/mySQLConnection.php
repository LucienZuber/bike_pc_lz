<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 10:30
 */
class MySQLConn{
    const HOST = "localhost";
    const PORT = "3306";
    const DATABASE = "bike_pc_lz";
    const USER = "root";
    const PWD = "root";

    private $_conn;
    private static $_instance;

    private function __construct()
    {
        try{
            $this->_conn = new PDO('mysql:host='.self::HOST.';port='.self::PORT.';
                dbname='.self::DATABASE, self::USER,self::PWD);
        }catch (PDOException $e){
            die('Connection failed:'.$e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance) || is_null(self::$_instance)){
            $c = __CLASS__;
            self::$_instance = new $c();
        }
        return self::$_instance;
    }

    public static function getConn(){
        return self::getInstance()->_conn;
    }

}