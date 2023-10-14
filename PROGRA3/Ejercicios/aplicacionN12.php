<?php

/*
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
*/


$array = array("H", "O", "L", "A");

function reordenar($array)
{
    krsort($array);
    foreach ($array as $e)
    {
        echo $e;
    }
}

reordenar($array);
