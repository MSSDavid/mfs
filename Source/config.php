<?php
require 'environment.php';
$config = array();
if(ENVIRONMENT == 'development'){
    define("BASE_URL", 'http://localhost/php/Classi-o/Source');
    $config['dbname'] = 'classi-o';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
} else{
    define("BASE_URL", 'https://classi-o.000webhostapp.com/');
    $config['dbname'] = 'id3124513_classi_o';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'id3124513_administrador';
    $config['dbpass'] = 'root123';
}

global $db;
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass']);
}catch (PDOExeption $e){
    echo "ERRO: ".$e->getMessage();
}