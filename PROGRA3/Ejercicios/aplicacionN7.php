<?php


/*
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.
*/

$impares = array();
$contador = 0;

for ($i = 0; $contador < 10; $i++)
{
    if ($i % 2 != 0)
    {
        $impares[$contador] = $i;
        $contador++;
    }
}

foreach ($impares as $e)
{
    echo $e . '<br>';
}
