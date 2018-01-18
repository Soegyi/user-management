<?php

    $host = 'localhost';
    $database = 'ayawaddy';
    $dbuser   = 'root';
    $dbpass   = '';
    
    try {
        $con = new PDO("mysql:dbhost = $host;dbname=$database","$dbuser", "$dbpass");
       
        } 
    catch (PDOException $ex) {
        echo $ex->getMessage();
    }


?>