<?php

/*
Aplicación Nº 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
*/

$lapicera1 = array();
$lapicera2 = array();
$lapicera3 = array();

$lapicera1['color'] = 'rojo';
$lapicera1['marca'] = 'Bic';
$lapicera1['trazo'] = 'fino';
$lapicera1['precio'] = '350';

$lapicera2['color'] = 'negro';
$lapicera2['marca'] = 'Faber Castell';
$lapicera2['trazo'] = 'fino';
$lapicera2['precio'] = '430';

$lapicera3['color'] = 'azul';
$lapicera3['marca'] = 'Pelikan';
$lapicera3['trazo'] = 'grueso';
$lapicera3['precio'] = '280';

foreach ($lapicera1 as $key => $value)
{
    echo $key . '=' . $value . '<br>';
}
echo '<br>';

foreach ($lapicera2 as $key => $value)
{
    echo $key . '=' . $value . '<br>';
}
echo '<br>';

foreach ($lapicera3 as $key => $value)
{
    echo $key . '=' . $value . '<br>';
}
