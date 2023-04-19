<?php

$ruta_archivo = "prueba.txt";

if (file_exists($ruta_archivo)) {
    echo "El archivo existe";
    echo '<br>';

    echo "Peso del archivo: " . filesize($ruta_archivo) . " bytes";
    echo '<br>';

    $fecha_acceso = fileatime($ruta_archivo);
    echo "La ultima fecha de acceso es: " . date('D d M Y', $fecha_acceso);
    echo '<br>';

    $fecha_modificacion = filectime($ruta_archivo);
    echo "La ultima fecha de modificacion es: " . date('D d M Y', $fecha_modificacion);
    echo '<br>';

    echo "Es legible? " . is_readable($ruta_archivo);
    echo '<br>';

    echo "Podemos escribir en el? " . is_writable($ruta_archivo);
    echo '<br>';

    $contenido = file_get_contents($ruta_archivo);
    echo $contenido;
    echo '<br>';

    $archivo = fopen($ruta_archivo, "a");
    // do {
    //     echo fgets($archivo);
    // } while (!feof($archivo));
    
    fwrite($archivo,"\nNuevo contenido sin perder el anterior");
    fclose($archivo);

    copy($ruta_archivo, "prueba_copia.txt") /*or die()*/;

    rename($ruta_archivo, "cambio_nombre.txt");
}
