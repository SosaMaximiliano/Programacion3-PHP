<?php
/*
B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
*/

include_once "Pizza.php";

$sabor = $_GET['sabor'];
$precio = $_GET['precio'];
$tipo = $_GET['tipo'];
$cantidad = $_GET['cantidad'];

$pedido = new Pizza($sabor, $precio, $tipo, $cantidad);
