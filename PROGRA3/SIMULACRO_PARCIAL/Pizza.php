<?php

class Pizza
{
    private $sabor;
    private $precio;
    private $tipo;
    private $cantidad;
    private $id;
    private static $stock = array();

    public function __construct($sabor, $precio, $tipo, $cantidad)
    {
        $this->sabor = $sabor;
        $this->precio = floatval($precio);
        $this->tipo = $tipo;
        $this->cantidad = intval($cantidad);
        self::AltaJSON($this);
    }

    // public function MostrarDatosJSON()
    // {
    //     $datos = self::LeerJSON();
    //     foreach ($datos as $e)
    //     {
    //         if ($this->tipo === $e["id"])
    //         {
    //             foreach ($e as $key => $value)
    //             {
    //                 if ($key != "clave")
    //                     echo "$key : $value <br>";
    //             }
    //         }
    //     }
    // }

    public static function MostrarListadoJSON($nombreArchivo)
    {
        $datos = self::LeerJSON($nombreArchivo);
        foreach ($datos as $e)
        {
            foreach ($e as $key => $value)
            {
                if ($key != "clave")
                    echo "$key : $value <br>";
            }
            echo '<br>';
        }
    }

    public static function ExisteStock($sabor, $tipo)
    {
        $listado = self::LeerJSON("Pizza");
        $arrayAux = array();
        foreach ($listado as $e)
        {
            if ($e["cantidad"] > 0)
                if ($e["sabor"] == $sabor)
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

    private static function Equals(Pizza $p)
    {
        $listado = self::LeerJSON("Pizza");
        foreach ($listado as $e)
        {
            if ($e["sabor"] == $p->sabor && $e["tipo"] == $p->tipo)
                return $e["id"];
        }
        return 0;
    }

    public static function ActualizoStock($id, $cantidad)
    {
        self::$stock = self::LeerJSON("Pizza");
        foreach (self::$stock as &$e)
        {
            if ($e["id"] == $id)
            {
                $e["cantidad"] += $cantidad;
                break;
            }
        }
    }

    private static function AgregoAStock(Pizza $p)
    {
        $stockAux = array(
            "id" => $p->id = self::UltimoIDJSON("Pizza") + 1,
            "sabor" => $p->sabor,
            "precio" => $p->precio,
            "tipo" => $p->tipo,
            "cantidad" => $p->cantidad,
        );
        #AGREGO EL PEDIDO A LA LISTA
        self::$stock[] = $stockAux;
    }

    private static function AltaJSON(Pizza $p)
    {
        self::$stock = self::LeerJSON("Pizza");

        $flag = false;
        #REVISO SI EL ITEM EXISTE
        if (($idAux = self::Equals($p)) > 0)
        {
            self::ActualizoStock($idAux, $p->cantidad);
        }
        else
        #CARGO LOS DATOS
        {
            self::AgregoAStock($p, "Pizza");
            $flag = true;
        }

        $jsonData = json_encode(self::$stock, JSON_PRETTY_PRINT);
        #ESCRIBO EN EL ARCHIVO
        self::EscribirArchivo($jsonData, "Pizza");

        if (!$flag)
            echo "El pedido $p->sabor $p->tipo ya existe<br>Se suma al resto de stock";
        else
            echo "El pedido $p->sabor $p->tipo se ingresó correctamente<br>";
    }

    public static function LeerJSON($nombreArchivo)
    {
        $contenido = file_get_contents("$nombreArchivo.json");
        return json_decode($contenido, true);
    }

    public static function UltimoIDJSON($nombreArchivo)
    {
        $listado = self::LeerJSON($nombreArchivo);
        if (!empty($listado))
        {
            $ultimoID = end($listado);
            $idaux = $ultimoID["id"] + 1;
        }
        else
            $idaux = 300;
        return $idaux;
    }

    // public static function BajaJSON($id)
    // {
    //     #GUARDO EL ARCHIVO EN UN ARRAY
    //     $usuariosIn = self::LeerJSON();
    //     $usuariosOut = array();

    //     #REVISO SI EXISTE
    //     if (!Pizza::ExisteID($id))
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
}
