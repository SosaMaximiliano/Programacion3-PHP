<?php

/*
6- CancelarReserva.php: (por POST) se recibe el Tipo de Cliente, Nro de Cliente, y el Id
de Reserva a cancelar. Si el cliente existe en hoteles.json y la reserva en reservas.json,
se marca como cancelada en el registro de reservas. Si el cliente o la reserva no existen,
informar el tipo de error.
*/

include "Reserva.php";

if (isset($_POST['tipoCliente']) && isset($_POST['nroCliente']) && isset($_POST['idReserva']))
{
    $tipoCliente = $_POST['tipoCliente'];
    $nroCliente = $_POST['nroCliente'];
    $idReserva = $_POST['idReserva'];

    Reserva::BajaReserva($tipoCliente, $nroCliente, $idReserva);
}
else echo "Completar todos los campos";
