<?php

/*
3-
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el nombre, tipo y cantidad ,si el ítem existe en
Hamburguesas.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id
autoincremental ) y se debe descontar la cantidad vendida del stock .
b- (1 pt) Completar el alta con imagen de la venta , guardando la imagen con el tipo+nombre+mail (solo usuario
hasta el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/

include_once 'Pedido.php';

if (isset($_POST['mail']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['cantidad']))
{
    $mail = $_POST['mail'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    new Pedido($mail, $nombre, $tipo, $cantidad);
}
