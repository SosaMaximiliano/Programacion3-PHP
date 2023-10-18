<?php

/*
ConsultarCliente.php: (por POST) Se ingresa Tipo y Nro. de Cliente, si coincide con
algún registro del archivo hoteles.json, retornar el país, ciudad y teléfono del cliente/s.
De lo contrario informar si no existe la combinación de nro y tipo de cliente o, si existe
el número y no el tipo para dicho número, el mensaje: “tipo de cliente incorrecto”.
*/

require_once 'Cliente.php';

if (isset($_POST['tipoCliente']) && isset($_POST['id']))
{
    $tipoCliente = $_POST['tipoCliente'];
    $id = $_POST['id'];

    Cliente::MostrarCliente($tipoCliente, $id);
}
else echo "Completar todos los parametros";
