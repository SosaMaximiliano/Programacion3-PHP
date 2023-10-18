<?php
// Verificamos que el parámetro accion este definido

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'POST':
        switch ($_POST['accion'])
        {
            case 'carga':
                include 'HamburguesaCarga.php';
                break;
            case 'consulta':
                include 'HamburguesaConsulta.php';
                break;
            case 'venta':
                include 'AltaVenta.php';
                break;
            default:
                echo 'Parámetro "accion" no permitido';
                break;
        }
        break;
    case 'GET':
        switch ($_GET['accion'])
        {
            case 'archivo':
                include 'archivos.php';
                break;
            default:
                echo 'Parámetro "accion" no permitido';
                break;
        }
        break;
    default:
        echo 'Verbo no permitido';
        break;
}
