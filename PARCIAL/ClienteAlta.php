<?php
/*
B- ClienteAlta.php: (por POST) se ingresa Nombre y Apellido, Tipo Documento, Nro.
Documento, Email, Tipo de Cliente (individual o corporativo), País, Ciudad y Teléfono.
*/

require_once 'Cliente.php';

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipoDni']) && isset($_POST['nroDni']) && isset($_POST['mail']) && isset($_POST['tipoCliente']) && isset($_POST['pais']) && isset($_POST['ciudad']) && isset($_POST['telefono']))
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipoDni = $_POST['tipoDni'];
    $nroDni = $_POST['nroDni'];
    $mail = $_POST['mail'];
    $tipoCliente = $_POST['tipoCliente'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];

    $cliente = new Cliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono);
}
else echo "Por favor completar todos los datos";
