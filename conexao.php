<?php
session_start();

$localhost = "localhost";
$user = "root";
$passw = "usbw";
$banco = "project_1";
global $pdo;

try{
    $pdo = new PDO("mysql:dbname=".$banco."; host=".$localhost, $user, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXECPTION);
}
catch(PDOExecption $e){
    echo "Erro: ".$e->getMessage();
    exit;
}
?>