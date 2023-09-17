<?php

/*
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.
*/

$res = 0;

for ($i = 0; $res < 1000; $i++)
{
    $res += $i;
    if ($res > 1000)
        break;
    echo $res . '<br>';
}

echo '<br>Se sumaron ' . $i . ' numeros<br>';
