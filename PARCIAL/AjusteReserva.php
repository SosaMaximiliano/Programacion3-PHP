<?php

/*
7- AjusteReserva.php (por POST),
Se ingresa el número de reserva afectada al ajuste y el motivo del mismo. 
El número de reserva debe existir.
Guardar en el archivo ajustes.json
Actualiza en el estado de la reserva en el archivo reservas.json
*/

include "a.php";

$idReserva = $_POST['idReserva'];
$motivo = $_POST['motivo'];
$nuevaHabitacion = $_POST['nuevaHabitacion'];

a::AjustaReserva($idReserva, $motivo, $nuevaHabitacion);
