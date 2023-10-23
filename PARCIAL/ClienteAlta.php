<?php
/*
B- ClienteAlta.php: (por POST) se ingresa Nombre y Apellido, Tipo Documento, Nro.
Documento, Email, Tipo de Cliente (individual o corporativo), País, Ciudad y Teléfono.
Se guardan los datos en el archivo hoteles.json, tomando un id autoincremental de 6
dígitos como Nro. de Cliente (emulado). Si el nombre y tipo ya existen , se actualiza la
información y se agrega al registro existente.
completar el alta con imagen/foto del cliente, guardando la imagen con Número y Tipo
de Cliente (ej.: NNNNNNTT) como identificación en la carpeta:
/ImagenesDeClientes/2023.
*/


include_once './Cliente.php';

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

    //$cliente = new Cliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono);
    Cliente::AltaCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono);
}
else echo "Por favor completar todos los datos";
