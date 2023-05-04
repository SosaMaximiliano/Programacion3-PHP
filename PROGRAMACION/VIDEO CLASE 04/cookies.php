<?php

$nombre = "Max";

setcookie($nombre,"Max PC",0,"max-pc");

if (!isset($_COOKIE[$nombre])) {
    echo "Cookie ".$nombre. " no existe<br>";
}
else{
    echo "Cookie ".$nombre. " creada<br>";
}