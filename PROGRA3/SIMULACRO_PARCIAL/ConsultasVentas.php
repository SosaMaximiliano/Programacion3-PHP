<?php

/*
4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas                                   OK
b- el listado de ventas entre dos fechas ordenado por sabor.        Falta ordenar por sabor
c- el listado de ventas de un usuario ingresado                     OK
d- el listado de ventas de un sabor ingresado                       OK
*/

include_once 'Pedido.php';

//Pedido::ConsultarTotalVentas();
//Pedido::ConsultarVentasUsuario("mail");
Pedido::ConsultarVentasSabor("Muzzarella");
//Pedido::ConsultarPorFecha("2023-07-16", "2023-09-16");
