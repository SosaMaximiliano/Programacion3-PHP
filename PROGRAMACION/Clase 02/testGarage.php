<?php

require 'Auto.php';
require 'Garage.php';


$testAuto1 = new Auto('Chevrolet', 'Verde');
$testAuto2 = new Auto('Chevrolet', 'Verde', 6300);
$testAuto3 = new Auto('Porsche', 'Gris', 250000);
$testAuto4 = new Auto('Mercury', 'Crema', 300000);
$testAuto5 = new Auto('Fiat', 'Rojo', 24000, '12/06/1986');

$testAuto2->AgregarImpuestos(1500);
$testAuto3->AgregarImpuestos(1500);
$testAuto4->AgregarImpuestos(1500);

echo Auto::Add($testAuto1, $testAuto2) . '<br>';


if ($testAuto1->Equals($testAuto2))
    echo 'Son iguales<br>';
else
    echo 'Son distintos<br>';

if ($testAuto1->Equals($testAuto5))
    echo 'Son iguales<br>';
else
    echo 'Son distintos<br>';

echo '<br>******************************************<br>';

$garage = new Garage("KALI", 230);

$garage->Add($testAuto1);
$garage->Add($testAuto4);
$garage->Add($testAuto5);

$garage->MostrarGarage();

if ($garage->Remove($testAuto1)) {
    echo '<u><b>SE REMOVIO EL AUTO:</u></b><br>';
    Auto::MostrarAuto($testAuto1);
} else
    echo 'El auto no está en el garage';

echo '<br>******************************************<br>';

$garage->MostrarGarage();

echo '<br>******************************************<br>';

if ($garage->Add($testAuto4))
    echo 'Un auto fue agregado';
else
    echo 'El auto ya se encuentra en el garage';

echo '<br>******************************************<br>';

if ($garage->Add($testAuto3))
    echo 'Un auto fue agregado';
else
    echo 'El auto ya se encuentra en el garage';

echo '<br>******************************************<br>';

$garage->MostrarGarage();
