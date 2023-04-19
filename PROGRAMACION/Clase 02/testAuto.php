<?php

require 'Auto.php';


#17
echo '<br><br><b>#17</b><br>';


$fecha = new DateTime('now');
$auto = new Auto("Ford", "Negro");
$auto2 = new Auto("Ford", "Negro", 25000, $fecha->format('d-m-Y'));
$auto2->AgregarImpuestos(954);

Auto::MostrarAuto($auto);
echo "<br>";
Auto::MostrarAuto($auto2);

echo $auto->Equals($auto, $auto2);
echo "<br>";
echo Auto::Add($auto, $auto2);

if ($testAuto1->Equals($testAuto2))
    echo 'Son iguales<br>';
else
    echo 'Son distintos<br>';

if ($testAuto1->Equals($testAuto5))
    echo 'Son iguales<br>';
else
    echo 'Son distintos<br>';

echo '<br>******************************************<br>';
