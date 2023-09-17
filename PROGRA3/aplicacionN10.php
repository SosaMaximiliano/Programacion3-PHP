<?php

/*
Aplicación Nº 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.
*/

$lapicera = array();

$lapicera['lapicera 1']['color'] = 'rojo';
$lapicera['lapicera 1']['marca'] = 'Bic';
$lapicera['lapicera 1']['trazo'] = 'fino';
$lapicera['lapicera 1']['precio'] = '350';

$lapicera['lapicera 2']['color'] = 'negro';
$lapicera['lapicera 2']['marca'] = 'Faber Castell';
$lapicera['lapicera 2']['trazo'] = 'fino';
$lapicera['lapicera 2']['precio'] = '430';

$lapicera['lapicera 3']['color'] = 'azul';
$lapicera['lapicera 3']['marca'] = 'Pelikan';
$lapicera['lapicera 3']['trazo'] = 'grueso';
$lapicera['lapicera 3']['precio'] = '280';

foreach ($lapicera as $e)
{
    foreach ($e as $key => $value)
    {
        echo $key . '=' . $value . '<br>';
    }
    echo '<br>';
}
