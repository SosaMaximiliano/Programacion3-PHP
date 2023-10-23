<?php

/*
7- AjusteReserva.php (por POST),
Se ingresa el número de reserva afectada al ajuste y el motivo del mismo. 
El número de reserva debe existir.
Guardar en el archivo ajustes.json
Actualiza en el estado de la reserva en el archivo reservas.json
*/

include_once "Reserva.php";
if (isset($_POST['idReserva']) && isset($_POST['motivo']) && isset($_POST['nuevaHabitacion']))
{
    $idReserva = $_POST['idReserva'];
    $motivo = $_POST['motivo'];
    $nuevaHabitacion = $_POST['nuevaHabitacion'];
    Reserva::AjustaReserva($idReserva, $motivo, $nuevaHabitacion);
}
else
    echo "Completar todos los campos";
