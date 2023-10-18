<?php
/*
3-
a- ReservaHabitacion.php: (por POST) se recibe el Tipo de Cliente, Nro de Cliente,
Fecha de Entrada, Fecha de Salida, Tipo de Habitación (Simple, Doble, Suite), y el
importe total de la reserva. Si el cliente existe en hoteles.json, se registra la reserva en
el archivo reservas.json con un id autoincremental). Si el cliente no existe, informar el
error.
b- Completar la reserva con imagen de confirmación de reserva con el nombre: Tipo de
Cliente, Nro. de Cliente e Id de Reserva, guardando la imagen en la carpeta
/ImagenesDeReservas2023.
*/

require_once 'Reserva.php';

if (isset($_POST['tipoCliente']) && isset($_POST['tipoCliente']) && isset($_POST['entrada']) && isset($_POST['salida']) && isset($_POST['habitacion']))
{
    $tipoCliente = $_POST['tipoCliente'];
    $nroCliente = $_POST['id'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];
    $habitacion = $_POST['habitacion'];

    Reserva::ReservaHabitacion($tipoCliente, $nroCliente, $entrada, $salida, $habitacion);
}
else echo "Completar todos los parametros";
