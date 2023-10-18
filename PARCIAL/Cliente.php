<?php

require_once 'Manejador.php';


class Cliente
{
    #VOLVER A USAR VARIABLES Y PASAR UNA INSTANCIA A AltaJSON
    #CAMBIAR ID ESTATICO POR ID INSTANCIA
    private $nombre;
    private $apellido;
    private $tipoDni;
    private $nroDni;
    private $mail;
    private $pais;
    private $ciudad;
    private $telefono;
    private static $id;
    private static $tipoCliente = array("Individual" => "IN", "Corporativo" => "CO");
    private static $clientes = array();

    public function __construct($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono)
    {
        self::AltaJSON($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono);
    }


    /*******************************PARTE 1***********************/


    private static function AltaJSON($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono)
    {
        self::$clientes = Manejador::LeerJSON("Hoteles");
        #REVISO SI EL CLIENTE EXISTE
        if (self::ExisteCliente($nombre, $apellido, $tipoDni, $nroDni) > 0)
        {
            echo "El cliente ya se encuentra registrado";
            return;
        }
        else
        #SI NO CARGO UNO NUEVO
        {
            self::AgregoCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono);
        }

        #ESCRIBO EN EL ARCHIVO
        $jsonData = json_encode(self::$clientes, JSON_PRETTY_PRINT);
        Manejador::EscribirArchivo($jsonData, "Hoteles");

        $extension = explode(".", $_FILES["imagen"]["full_path"]);
        $destino = "ImagenesDeClientes/2023/" . self::$id . $tipoCliente . "." . $extension[1];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

        echo "El cliente $nombre $apellido se ingresó correctamente<br>";
    }


    public static function ExisteCliente($nombre, $apellido, $tipoDni, $nroDni)
    {
        $listado = Manejador::LeerJSON("Hoteles");
        foreach ($listado as $e)
        {
            if ($e["nombre"] == $nombre && $e["apellido"] == $apellido && $e["tipoDni"] == $tipoDni && $e["nroDni"] == $nroDni)
                return $e["id"];
        }
        return 0;
    }

    public static function BuscarCliente($tipoCliente, $idCliente)
    {
        $listado = Manejador::LeerJSON("Hoteles");
        foreach ($listado as $e)
        {
            if ($e["tipoCliente"] == $tipoCliente && $e["id"] == $idCliente)
                return $e;
        }
        return [];
    }

    // public static function ActualizoClientes($id, $nuevoTelefono, $nuevoMail)
    // {
    //     self::$clientes = Manejador::LeerJSON("Hoteles");
    //     foreach (self::$clientes as &$e)
    //     {
    //         if ($e["id"] == $id)
    //         {
    //             $e["telefono"] = $nuevoTelefono;
    //             $e["mail"] = $nuevoMail;
    //             break;
    //         }
    //     }
    // }

    private static function AgregoCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono)
    {
        self::$id = strval(Manejador::UltimoIDJSON("Hoteles"));
        $arrayClientes = array(
            "id" => self::$id . self::$tipoCliente[$tipoCliente],
            "nombre" => $nombre,
            "apellido" => $apellido,
            "tipoDni" => $tipoDni,
            "nroDni" => $nroDni,
            "mail" => $mail,
            "tipoCliente" => $tipoCliente,
            "pais" => $pais,
            "ciudad" => $ciudad,
            "telefono" => $telefono,
        );
        #AGREGO EL CLIENTE A LA LISTA
        self::$clientes[] = $arrayClientes;
    }

    public static function MostrarCliente($tipoCliente, $idCliente)
    {
        $flagID = false;
        self::$clientes = Manejador::LeerJSON("Hoteles");
        foreach (self::$clientes as $e)
        {
            if ($e["id"] == $idCliente)
            {
                $flagID = true;
                if ($e["tipoCliente"] == $tipoCliente)
                {
                    echo "Pais: " . $e["pais"] . "<br>";
                    echo "Ciudad: " . $e["ciudad"] . "<br>";
                    echo "Telefono: " . $e["telefono"] . "<br>";
                    return;
                }
            }
        }
        if ($flagID)
            echo "Tipo de cliente incorrecto";
        else
            echo "No existe el ID y tipo de cliente";
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
