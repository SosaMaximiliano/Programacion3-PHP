<?php

/*
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.
*/

echo date('d-m-Y');
echo '<br>';

$dia = date('d');
$mes = date('m');


if (($mes > 2 && $dia > 20) && $mes < 6)
    echo "Es Otoño";
else if (($mes > 5 && $dia > 20) && $mes < 9)
    echo "Es Invierno";
else if (($mes > 8 && $dia > 20) && $mes < 12)
    echo "Es Primavera";
else
    echo "Es Verano";
