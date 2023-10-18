<?php
/*
4- ConsultaReservas.php: (por GET)
Datos a consultar:
    a- El total de reservas (importe) por tipo de habitación y fecha en un día en particular
    (se envía por parámetro), si no se pasa fecha, se muestran las del día anterior.
    b- El listado de reservas para un cliente en particular.
c- El listado de reservas entre dos fechas ordenado por fecha.
    d- El listado de reservas por tipo de habitación.
*/


require_once 'Reserva.php';

if (isset($_GET['tipoCliente']) && isset($_GET['nroCliente']))
{
    $tipoCliente = $_GET['tipoCliente'];
    $nroCliente = $_GET['nroCliente'];

    Reserva::ConsultarReservaCliente($tipoCliente, $nroCliente);
}
elseif (isset($_GET['habitacion']) && isset($_GET['entrada']))
{
    $tipoHabitacion = $_GET['habitacion'];
    $fecha = $_GET['entrada'];

    //Reserva::ConsultarReservaFecha($tipoHabitacion, $fecha);
    Reserva::ConsultarReservaHabitacion($tipoHabitacion);
}
elseif (isset($_GET['desde']) && isset($_GET['hasta']))
{
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    Reserva::ConsultarReservaEntreFechas($desde, $hasta);
}
else echo "Completar todos los parametros";
