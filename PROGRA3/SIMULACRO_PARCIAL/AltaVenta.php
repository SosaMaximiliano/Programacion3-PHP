<?php

/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .

b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/

include_once 'Pedido.php';

if (isset($_POST['mail']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_POST['cantidad']))
{
    $mail = $_POST['mail'];
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    new Pedido($mail, $sabor, $tipo, $cantidad);
}
