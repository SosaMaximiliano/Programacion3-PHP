<?php

/*
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.
*/


require_once "testAuto.php";
require_once "Garage.php";

echo "<br>*****************GARAGE***********************<br>";

$garage1 = new Garage("La cocherita", 700);
$garage1->MostrarGarage();

echo '<br>';

$garage1->Add($auto1);
echo '<br>';
$garage1->Add($auto3);
echo '<br>';
$garage1->Add($auto5);
echo '<br>';
$garage1->Add($auto1);

echo '<br>';
echo '<br>';

$garage1->Remove($auto5);
echo '<br>';
$garage1->Remove($auto1);
echo '<br>';
$garage1->Remove($auto1);
echo '<br>';
$garage1->Remove($auto3);
echo '<br>';

var_dump($garage1->Equals($auto1));
