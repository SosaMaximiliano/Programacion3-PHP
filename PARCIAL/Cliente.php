<?php

include_once 'Manejador.php';


class Cliente
{
    private static $id;
    private static $tipoCliente = array("Individual" => "IN", "Corporativo" => "CO");
    private static $clientes = array();


    public static function AltaCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono)
    {
        if (self::ValidarCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono))
        {
            self::$clientes = Manejador::LeerJSON("Hoteles");
            #REVISO SI EL CLIENTE EXISTE
            if (self::ExisteCliente($nombre, $apellido, $tipoDni, $nroDni) > 0)
            {
                echo "El cliente $nombre $apellido ya se encuentra registrado";
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
            $destino = "ImagenesDeClientes/2023/" . self::$id . self::$tipoCliente[$tipoCliente] . "." . $extension[1];
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

            echo "El cliente $nombre $apellido se ingresó correctamente<br>";
        }
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

    public static function ActualizoClientes($idCliente, $tipoCliente, $nombre, $apellido, $tipoDni, $nroDni, $mail, $pais, $ciudad, $telefono)
    {
        self::$clientes = Manejador::LeerJSON("Hoteles");
        $flagExiste = false;
        foreach (self::$clientes as &$e)
        {
            if ($e["id"] == $idCliente && $e["tipoCliente"] == $tipoCliente)
            {
                $e["nombre"] = $nombre;
                $e["apellido"] = $apellido;
                $e["tipoDni"] = $tipoDni;
                $e["nroDni"] = $nroDni;
                $e["mail"] = $mail;
                $e["pais"] = $pais;
                $e["ciudad"] = $ciudad;
                $e["telefono"] = $telefono;
                #ESCRIBIR DATOS
                $jsonData = json_encode(self::$clientes, JSON_PRETTY_PRINT);
                Manejador::EscribirArchivo($jsonData, "Hoteles");
                $flagExiste = true;
                echo "Datos actualizados correctamente";
                break;
            }
        }
        if (!$flagExiste)
            echo "El cliente no existe";
    }

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

    private static function ValidarCliente($nombre, $apellido, $tipoDni, $nroDni, $mail, $tipoCliente, $pais, $ciudad, $telefono)
    {
        $clientesValidos = array("Individual", "Corporativo");
        $dniValidos = array("DNI", "Pasaporte");
        $telValido = explode("-", $telefono);
        if (strlen($nombre) < 1 || strlen($apellido) < 1)
        {
            echo "El nombre y apellido no pueden estar vacios";
            return false;
        }
        elseif (strlen($nombre) > 20 || strlen($apellido) > 20)
        {
            echo "El nombre y apellido no pueden tener mas de 20 caracteres";
            return false;
        }
        if (strlen($pais) < 1 || strlen($ciudad) < 1)
        {
            echo "El pais y ciudad no pueden estar vacios";
            return false;
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            echo "La dirección de correo electrónico ingresada no es válida";
            return false;
        }
        if (!in_array($tipoCliente, $clientesValidos))
        {
            echo "El tipo de cliente ingresado no es valido";
            return false;
        }
        if (!in_array($tipoDni, $dniValidos))
        {
            echo "El tipo de documento ingresado no es valido";
            return false;
        }
        if (!is_int(intval($nroDni)))
        {
            echo "El numero de documento ingresado no es valido";
            return false;
        }
        foreach ($telValido as $e)
        {
            if (!is_numeric($e))
            {
                echo "El numero de telefono no es valido";
                return false;
            }
        }
        return true;
    }
}
