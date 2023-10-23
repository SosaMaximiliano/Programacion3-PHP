<?php

/*
5- ModificarCliente.php (por PUT)
Debe recibir todos los datos propios de un cliente; si dicho cliente existe (comparar por
Tipo y Nro. de Cliente) se modifica, de lo contrario informar que no existe ese cliente.
*/

include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT')
{
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (isset($data['id']))
    {
        Cliente::ActualizoClientes(
            $data['id'],
            $data['tipoCliente'],
            $data['nombre'],
            $data['apellido'],
            $data['tipoDni'],
            $data['nroDni'],
            $data['mail'],
            $data['pais'],
            $data['ciudad'],
            $data['telefono']
        );
    }
    else
    {
        echo 'Faltan parámetros en los datos enviados.';
    }
}
