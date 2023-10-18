<?php

if (isset($_SERVER['REQUEST_METHOD']))
{
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'POST':
            switch ($_POST['action'])
            {
                case 'alta':
                    include 'ClienteAlta.php';
                    break;
                case 'consulta':
                    include 'ConsultarCliente.php';
                    break;
                case 'reserva':
                    include 'ReservaHabitacion.php';
                    break;
                case 'cancela':
                    include 'CancelarReserva.php';
                    break;
                case 'ajuste':
                    include 'AjusteReserva.php';
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
                    include 'ConsultaReservas.php';
                    break;
                default:
                    echo 'Parámetro "action" no permitido';
                    break;
            }
            break;
        case 'PUT':
            switch ($_PUT['action'])
            {
                case 'modifica':
                    include 'ModificarCliente.php';
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
}
else echo "Metodo invalido";
