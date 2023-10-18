<?php

class Manejador
{

    public static function MostrarListadoJSON($nombreArchivo)
    {
        $datos = self::LeerJSON($nombreArchivo);
        foreach ($datos as $e)
        {
            foreach ($e as $key => $value)
            {
                echo "$key : $value <br>";
            }
            echo '<br>';
        }
    }

    public static function LeerJSON($nombreArchivo)
    {
        $contenido = file_get_contents("$nombreArchivo.json");
        return json_decode($contenido, true);
    }


    public static function EscribirArchivo($jsonData, $nombreArchivo)
    {
        if ($archivo = fopen("$nombreArchivo.json", "w"))
        {
            fwrite($archivo, $jsonData . "\n");
            fclose($archivo);
            return true;
        }
        else echo "No se pudo abrir el archivo para escritura<br>";
        return false;
    }

    public static function UltimoIDJSON($nombreArchivo)
    {
        $listado = self::LeerJSON($nombreArchivo);
        if (!empty($listado))
        {
            $ultimoID = end($listado);
            $idaux = intval($ultimoID["id"] + 1);
        }
        else
            $idaux = rand(300000, 600000);
        return $idaux;
    }
}
