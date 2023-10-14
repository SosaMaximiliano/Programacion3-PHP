<?php

/*
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
*/

include_once "Pizza.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];

switch (Pizza::ExistePedido($sabor, $tipo) > 0)
{
    case 0:
        echo "No hay pedidos en la lista";
        break;

    case -1:
        echo "No hay de ese tipo";
        break;

    case -2:
        echo "No hay de ese sabor";
        break;

    default:
        echo "Si hay";
        break;
}
