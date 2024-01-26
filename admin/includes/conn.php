<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    //different port number -->
    //$conn = new PDO("mysql:host=$servername;port=3306;dbname=un_r4", $username, $password, $options);
    $conn = new PDO("mysql:host=$servername;dbname=project", $username, $password, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}catch(PDOException $e){//PDOExcceptiion to view error
    echo "Connection failed: " . $e->getMessage();
}

?>