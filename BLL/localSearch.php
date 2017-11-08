<?php
/**
 * Created by PhpStorm.
 * User: lucien
 * Date: 01.11.2017
 * Time: 09:48
 */

require_once "../DAL/mySQLConnection.php";
//This page is used for the local search
//we connect to the db
$_dbh = null;
    try{
        $dbh = MySQLConn::getConn();

    }catch (PDOException $e){
        die('Connection failed/Connexion échouée/Verbindung fehlgeschlagen:'.$e->getMessage());
    }
//if there is a term given, we try to query the db
if (isset($_GET['term'])){
    $return_arr = array();

    try {

        $stmt = $dbh->prepare("SELECT name FROM station WHERE name LIKE :term");
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));

        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['country'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

?>