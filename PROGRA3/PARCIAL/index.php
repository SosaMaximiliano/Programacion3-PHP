<?php

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'POST':
        switch ($_POST['action'])
        {
            case 'carga':
                include 'HamburguesaCarga.php';
                break;
            case 'consulta':
                include 'HamburguesaConsultar.php';
                break;
            case 'venta':
                include 'AltaVenta.php';
                break;
            default:
                echo 'Parámetro "action" no permitido';
                break;
        }
        break;
    case 'GET':
        switch ($_GET['action'])
        {
            case 'consulta':
                include 'ConsultasVentas.php';
                break;
            default:
                echo 'Parámetro "action" no permitido';
                break;
        }
        break;
    default:
        echo 'Verbo no permitido';
        break;
}
