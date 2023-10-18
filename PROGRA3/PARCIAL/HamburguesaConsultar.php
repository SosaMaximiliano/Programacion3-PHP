<?php

/*
2-
(1pt.) HamburguesaConsultar.php: (por POST)Se ingresa Nombre, Tipo, si coincide con algún registro del archivo
Hamburguesas.json, retornar “Si Hay”. De lo contrario informar si no existe el tipo o el nombre.
*/

include_once "Hamburguesa.php";

if (isset($_POST['nombre'], $_POST['tipo']))
{

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock = Hamburguesa::ExisteStock($nombre, $tipo);

    if ($stock > 0)
        echo "Si, hay<br>";
    elseif ($stock == -1)
        echo "Hay de $nombre pero no de tipo $tipo<br>";
    else
        echo "No hay<br>";
}
else
    echo "Los parametros no pueden estar vacios";
