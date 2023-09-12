<?php

/*
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
*/


$a = 1;
$b = 5;
$c = 1;


echo 'a = ' . $a;
echo '<br>';
echo 'b = ' . $b;
echo '<br>';
echo 'c = ' . $c;
echo '<br>';
echo '<br>';


if (($a < $b && $b < $c) or ($a > $b && $b > $c))
    echo $b . ' esta en medio';
else if (($b < $c && $c < $a) or ($b > $c && $c > $a))
    echo $c . ' esta en medio';
else if (($c < $a && $a < $b) or ($c > $a && $a > $b))
    echo $a . ' esta en medio';
else echo 'No hay numero en medio';
