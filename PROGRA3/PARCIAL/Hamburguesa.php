<?php

require_once 'Manejador.php';


class Hamburguesa
{

    private static $stock = array();

    public function __construct($nombre, $precio, $tipo, $cantidad)
    {
        self::AltaJSON($nombre, floatval($precio), $tipo, intval($cantidad));
    }


    /*******************************PARTE 1***********************/

    public static function ExisteStock($nombre, $tipo)
    {
        $listado = Manejador::LeerJSON("Hamburguesa");
        $arrayAux = array();
        foreach ($listado as $e)
        {
            if ($e["cantidad"] > 0)
                if ($e["nombre"] == $nombre)
                    $arrayAux[] = $e;
        }
        foreach ($arrayAux as $e)
        {
            if ($e["tipo"] == $tipo)
                return $e["id"];
        }
        if (count($arrayAux) > 0)
            return -1;
        return 0;
    }

    public static function Equals($nombre, $tipo)
    {
        $listado = Manejador::LeerJSON("Hamburguesa");
        foreach ($listado as $e)
        {
            if ($e["nombre"] == $nombre && $e["tipo"] == $tipo)
                return $e["id"];
        }
        return 0;
    }

    public static function ActualizoStock($id, $cantidad)
    {
        self::$stock = Manejador::LeerJSON("Hamburguesa");
        foreach (self::$stock as &$e)
        {
            if ($e["id"] == $id)
            {
                $e["cantidad"] += $cantidad;
                break;
            }
        }
    }

    private static function AgregoAStock($nombre, $precio, $tipo, $cantidad)
    {
        $stockAux = array(
            "id" => Manejador::UltimoIDJSON("Hamburguesa"),
            "nombre" => $nombre,
            "precio" => $precio,
            "tipo" => $tipo,
            "cantidad" => $cantidad,
        );
        #AGREGO EL PEDIDO A LA LISTA
        self::$stock[] = $stockAux;
    }

    private static function AltaJSON($nombre, $precio, $tipo, $cantidad)
    {
        self::$stock = Manejador::LeerJSON("Hamburguesa");
        $flag = false;

        #REVISO SI EL ITEM EXISTE
        if (($idAux = self::Equals($nombre, $tipo)) > 0)
        {
            self::ActualizoStock($idAux, $cantidad);
        }
        else
        #CARGO LOS DATOS
        {
            self::AgregoAStock($nombre, $precio, $tipo, $cantidad);
            $flag = true;
        }

        #ESCRIBO EN EL ARCHIVO
        $jsonData = json_encode(self::$stock, JSON_PRETTY_PRINT);
        Manejador::EscribirArchivo($jsonData, "Hamburguesa");

        $extension = explode(".", $_FILES["imagen"]["full_path"]);
        $destino = "ImagenesDeHamburguesas/$nombre - $tipo." . $extension[1];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

        if (!$flag)
            echo "$nombre $tipo ya existe<br>Se suma al resto de stock";
        else
            echo "El stock de $nombre $tipo se ingresó correctamente<br>";
    }


    /*******************************PARTE 2***********************/












    // public static function BajaJSON($id)
    // {
    //     #GUARDO EL ARCHIVO EN UN ARRAY
    //     $usuariosIn = self::LeerJSON();
    //     $usuariosOut = array();

    //     #REVISO SI EXISTE
    //     if (!Hamburguesa::ExisteID($id))
    //     {
    //         echo "El usuario no existe";
    //         return false;
    //     }
    //     else
    //     {
    //         foreach ($usuariosIn as $e)
    //         {
    //             if ($e["id"] !== $id)
    //             {
    //                 $usuariosOut[] = $e;
    //             }
    //         }
    //         $jsonData = json_encode($usuariosOut, JSON_PRETTY_PRINT);

    //         #SOBREESCRIBO EL ARCHIVO SIN EL REGISTRO
    //         if ($archivo = fopen("usuarios.json", "w"))
    //         {
    //             fwrite($archivo, $jsonData . "\n");
    //             fclose($archivo);
    //             echo "Usuario eliminado correctamente<br>";
    //             self::$usuarios = $usuariosOut;
    //             return true;
    //         }
    //         else echo "No se pudo abrir el archivo para escritura";
    //         return false;
    //     }
    // }

    // public static function ValidarUsuarioJSON($mail, $clave)
    // {
    //     $listado = self::LeerJSON();
    //     foreach ($listado as $e)
    //     {
    //         if ($e["mail"] === $mail && $e["clave"] === $clave)
    //             return true;
    //     }
    //     echo "Usuario no registrado<br>";
    //     return false;
    // }


}
