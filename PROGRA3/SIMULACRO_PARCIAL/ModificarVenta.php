<?php
/*
6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.
*/

include_once 'Pedido.php';

// if ($_SERVER['REQUEST_METHOD'] === 'PUT')
// {
//     $putData = file_get_contents("php://input");
//     $data = json_decode($putData, true);

//     if ($data === null)
//     {
//         echo "Error al procesar los datos PUT.";
//     }
//     else
//     {
//         $pedido = $data['pedido'];
//         $mail = $data['mail'];
//         $sabor = $data['sabor'];
//         $tipo = $data['tipo'];
//         $cantidad = $data['cantidad'];

//         echo "$pedido $mail $sabor $tipo $cantidad<br>";
//     }
// }
// else
// {
//     echo "Esta no es una solicitud PUT.";
// }

$pedido = intval($_GET['pedido']);
$mail = $_GET['mail'];
$sabor = $_GET['sabor'];
$tipo = $_GET['tipo'];
$cantidad = intval($_GET['cantidad']);

Pedido::ModificarPedido($pedido, $mail, $sabor, $tipo, $cantidad);
