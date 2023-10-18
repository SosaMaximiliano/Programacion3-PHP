<?php
/*
B- (1 pt.) HamburguesaCarga.php: (por POST) se ingresa Nombre, Precio, Tipo (“simple” o “doble”), Cantidad( de
unidades). Se guardan los datos en en el archivo de texto Hamburguesas.json, tomando un id autoincremental
como identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen de la hamburguesa, guardando la imagen con el tipo y el nombre como
identificación en la carpeta /ImagenesDeHamburguesas.
*/

include_once "Hamburguesa.php";
if (isset($_POST['nombre'], $_POST['precio'], $_POST['tipo'], $_POST['cantidad']))
{
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    $pedido = new Hamburguesa($nombre, $precio, $tipo, $cantidad);
}
else
    echo "Los parametros no pueden estar vacios";
