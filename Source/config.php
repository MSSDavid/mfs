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
    define("BASE_URL", 'https://classi-o.000webhostapp.com');
    $config['dbname'] = 'id3124513_classi_o';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'id3124513_administrador';
    $config['dbpass'] = 'root123';
}

global $db;

global $MailHost;
global $MailPort;
global $MailSecurity;
global $MailUsername;
global $MailPassword;
global $MailName;
$MailHost = "smtp.gmail.com";
$MailPort = "465";
$MailSecurity = "ssl";
$MailUsername = "classi.o.inf.ufg@gmail.com";
$MailPassword = "classi-o123";
$MailName = "Equipe Classi-O";

try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass']);
}catch (PDOExeption $e){
    echo "ERRO: ".$e->getMessage();
}