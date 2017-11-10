<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 28.09.2017
 * Time: 10:30
 */
//This is the class containing the informations for the sql connection
class MySQLConn{
    const HOST = "localhost";
    const PORT = "3306";
    const DATABASE = "grp9";
    const USER = "grp9";
    const PWD = "Vietnam2011";

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

    //This function is used to get a singleton of this class
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