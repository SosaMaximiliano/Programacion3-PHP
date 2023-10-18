<?php

/*
4- (1 pts.)ConsultasVentas.php: necesito saber :
a- La cantidad de Hamburguesas vendidas en un día en particular, si no se pasa fecha, se muestran las del
día de ayer.
b- El listado de ventas entre dos fechas ordenado por nombre.
c- El listado de ventas de un usuario ingresado.            OK
d- El listado de ventas de un tipo ingresado.               OK
*/

include_once 'Pedido.php';

$tipo = $_GET["tipo"];
$usuario = $_GET["usuario"];
$fecha = $_GET["fecha"];


//Pedido::ConsultarVentasTipo($tipo);   /*OK
//Pedido::ConsultarVentasUsuario($usuario); /*OK
Pedido::ConsultarTotalVentasFecha($fecha);
//Pedido::ConsultarPorFecha("2023-07-16", "2023-09-16");
