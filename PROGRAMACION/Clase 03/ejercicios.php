<?php

include '../Clase 02/Garage.php';
include '../Clase 02/Auto.php';

$auto1 = new Auto("Nissan", "Azul");
$auto2 = new Auto("Ford", "Rojo");
$auto3 = new Auto("Chevrolet", "Verde");
$auto4 = new Auto("Bugatti", "Gris");
$auto5 = new Auto("Fiat", "Negro");

Auto::Alta($auto1);
Auto::Alta($auto2);
Auto::Alta($auto3);
Auto::Alta($auto4);
Auto::Alta($auto5);

echo var_dump(Auto::$autos);

Auto::MostrarListadoAutos();

echo "<br>***************************<br>";

$garage1 = new Garage("Kali Kar",350);
$garage2 = new Garage("Lapilo y fulioso",230);

Garage::AltaGarage($garage1);
Garage::AltaGarage($garage2);

$garage1->Add($auto1);
$garage1->Add($auto3);
$garage1->Add($auto3);
$garage1->Add($auto5);


Garage::MostrarListadoGarage();

echo var_dump(Garage::$garages);