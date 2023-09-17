<?php

/*
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.

● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)
*/


require_once 'Auto.php';

$auto1 = new Auto("Ford", "negro");
$auto2 = new Auto("Ford", "azul");
$auto3 = new Auto("Corvette", "bordo", 360000);
$auto4 = new Auto("Corvette", "bordo", 430000);
$auto5 = new Auto("Chevrolet", "rojo", 420000, "12/06/1954");

$auto3->AgregarImpuestos(1500);
$auto4->AgregarImpuestos(1500);
$auto5->AgregarImpuestos(1500);


echo Auto::Add($auto1, $auto2);

echo '<br>';

if ($auto1->Equals($auto2))
    echo "El auto 1 y el auto 2 son iguales";
else
    echo "El auto 1 y el auto 2 son disintos";
echo '<br>';
if ($auto1->Equals($auto5))
    echo "El auto 1 y el auto 5 son iguales";
else
    echo "El auto 1 y el auto 5 son distintos";

echo '<br>';


Auto::MostrarAuto($auto1);


Auto::AltaAuto($auto1);
Auto::AltaAuto($auto5);
Auto::AltaAuto($auto3);

Auto::LeerArchivo();

var_dump(Auto::BuscarAuto($auto3));
