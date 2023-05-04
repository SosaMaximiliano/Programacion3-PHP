<?php


session_start();

$_SESSION["NOMBRE"] = "Max";

echo $_SESSION["NOMBRE"];

var_dump($_SESSION);
