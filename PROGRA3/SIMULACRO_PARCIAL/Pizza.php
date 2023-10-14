<?php

class Pizza
{
    private $sabor;
    private $precio;
    private $tipo;
    private $cantidad;
    private $id;
    private static $pedidos = array();

    public function __construct($sabor, $precio, $tipo, $cantidad)
    {
        $this->sabor = $sabor;
        $this->precio = floatval($precio);
        $this->tipo = $tipo;
        $this->cantidad = intval($cantidad);
        self::AltaJSON($this);
    }

    public function MostrarDatosJSON()
    {
        $datos = self::LeerJSON();
        foreach ($datos as $e)
        {
            if ($this->tipo === $e["id"])
            {
                foreach ($e as $key => $value)
                {
                    if ($key != "clave")
                        echo "$key : $value <br>";
                }
            }
        }
    }

    public static function MostrarListadoJSON()
    {
        $datos = self::LeerJSON();
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

    public static function ExistePedido($sabor, $tipo)
    {
        $listado = self::LeerJSON();
        $flagS = false;
        $flagT = false;
        foreach ($listado as $e)
        {
            if ($e["sabor"] == $sabor)
            {
                $flagS = true;
                if ($e["tipo"] == $tipo)
                    $flagT = true;
            }
            else
            if ($e["tipo"] == $tipo)
                $flagT = true;
        }
        return 0;
    }

    private static function Equals(Pizza $p)
    {
        $listado = self::LeerJSON();
        foreach ($listado as $e)
        {
            if ($e["sabor"] == $p->sabor && $e["tipo"] == $p->tipo)
                return $e["id"];
            break;
        }
        return 0;
    }

    private static function ActualizoPedido($id, $cantidad)
    {
        foreach (self::$pedidos as &$e)
        {
            if ($e["id"] == $id)
            {
                $e["cantidad"] += $cantidad;
                break;
            }
        }
    }

    private static function PedidoNuevo(Pizza $p)
    {
        $pedidoAux = array(
            "id" => $p->id = self::UltimoIDJSON() + 1,
            "sabor" => $p->sabor,
            "precio" => $p->precio,
            "tipo" => $p->tipo,
            "cantidad" => $p->cantidad,
        );
        #AGREGO EL PEDIDO A LA LISTA
        self::$pedidos[] = $pedidoAux;
    }

    private static function AltaJSON(Pizza $p)
    {
        self::$pedidos = self::LeerJSON();

        $flag = false;
        #REVISO SI EL PEDIDO EXISTE
        if (($idAux = self::Equals($p)) > 0)
        {
            self::ActualizoPedido($idAux, $p->cantidad);
        }
        else
        #CARGO LOS DATOS
        {
            self::PedidoNuevo($p);
            $flag = true;
        }

        $jsonData = json_encode(self::$pedidos, JSON_PRETTY_PRINT);
        #ESCRIBO EN EL ARCHIVO
        self::EscribirArchivo($jsonData);

        if (!$flag)
            echo "El pedido $p->sabor $p->tipo ya existe<br>Se suma al resto de pedidos";
        else
            echo "El pedido $p->sabor $p->tipo se ingresó correctamente<br>";
    }

    public static function LeerJSON()
    {
        $contenido = file_get_contents("pedidos.json");
        return json_decode($contenido, true);
    }

    public static function UltimoIDJSON()
    {
        $listado = self::LeerJSON();
        if (!empty($listado))
        {
            $ultimoUsuario = end($listado);
            $idaux = $ultimoUsuario["id"];
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

    public static function ValidarUsuarioJSON($mail, $clave)
    {
        $listado = self::LeerJSON();
        foreach ($listado as $e)
        {
            if ($e["mail"] === $mail && $e["clave"] === $clave)
                return true;
        }
        echo "Usuario no registrado<br>";
        return false;
    }

    private static function EscribirArchivo($jsonData)
    {
        if ($archivo = fopen("pedidos.json", "w"))
        {
            fwrite($archivo, $jsonData . "\n");
            fclose($archivo);
            return true;
        }
        else echo "No se pudo abrir el archivo para escritura";
        return false;
    }
}
