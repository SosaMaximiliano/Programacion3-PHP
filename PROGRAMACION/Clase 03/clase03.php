<?php

//Abrir el archivo
#$archivo = fopen("archivo.txt","w");

//Trabajar
#fwrite($archivo,"Nombre: ");

//Cerrar el archivo
#fclose($archivo);

$archivo = fopen("archivo.txt", "r");

//echo fread($archivo,filesize('archivo.txt'));
$contador = 0;
while (!feof($archivo)) {
    $linea = fgets($archivo);
    if ($linea !== false && $linea !== "") {
        echo $linea;
    }
    $contador++;
}

echo $contador;

fclose($archivo);
