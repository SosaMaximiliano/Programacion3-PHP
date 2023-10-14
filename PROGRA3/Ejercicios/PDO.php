<?php

try
{
    $conStr = "mysql:host=localhost;dbname=TP01SQL;charset=utf8";
    $pdo = new PDO($conStr, "root", "");
    //$pdo = new PDO($conStr, $usr, $pass);
    echo "conexion ok";
}
catch (PDOException $e)
{
    echo "Error: " . $e->getMessage();
    die();
}

$varTabla = 'usuario';

$sentencia = $pdo->prepare("SELECT * FROM :tabla");
$sentencia->bindParam(':tabla', $varTabla, PDO::PARAM_STR);
$sentencia->execute();
