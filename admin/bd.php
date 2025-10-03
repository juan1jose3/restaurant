<?php

$dsn = "mysql:host=localhost;dbname=restaurant";
$dbusername = "root";
$password = "";
try{
    $pdo = new PDO($dsn,$dbusername,$password);
    //echo "Conectado";

}

catch(PDOException $e){
    echo "Connection Failed: " . $e->getMessage();
}