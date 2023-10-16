<?php

/*
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
*/

include_once "Pizza.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];
$stock = Pizza::ExisteStock($sabor, $tipo);

if ($stock > 0)
    echo "Si, hay<br>";
elseif ($stock == -1)
    echo "Hay de $sabor pero no de tipo $tipo<br>";
else
    echo "No hay<br>";
