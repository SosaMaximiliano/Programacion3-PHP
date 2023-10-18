<?php

require_once 'Manejador.php';
require_once 'Hamburguesa.php';

class Pedido
{

    public static $pedidos = array();

    public function __construct($mail, $sabor, $tipo, $cantidad)
    {
        self::AltaPedido($mail, $sabor, $tipo, $cantidad);
    }

    /******************************PARTE 1*********************************** */

    private static function AltaPedido($mail, $sabor, $tipo, $cantidad)
    {
        #TRAIGO LOS LISTADOS
        $arrayPedidos = Manejador::LeerJSON("Pedidos");
        $arrayStock = Manejador::LeerJSON("Hamburguesa");
        $idAux = 0;
        $cantidadStock = 0;

        #CONFIRMO QUE HAYA STOCK
        if (($idAux = Hamburguesa::ExisteStock($sabor, $tipo)) > 0)
            foreach ($arrayStock as $e)
            {
                if ($e["id"] == $idAux)
                    $cantidadStock = $e["cantidad"];
            }
        #LA CANTIDAD NO PUEDE SER MAYOR AL STOCK!!!
        #No pude usar el metodo ActualizoStock de la otra clase
        if ($cantidad <= $cantidadStock)
        {
            foreach ($arrayStock as &$e)
            {
                if ($e["id"] == $idAux)
                {
                    $e["cantidad"] -= $cantidad;
                    break;
                }
            }
        }
        else
        {
            echo "No hay stock disponible o suficiente<br>Stock: $cantidadStock";
            return false;
        }

        #SI HAY STOCK PREPARO EL PEDIDO
        $pedidoAux = array(
            "id" => Manejador::UltimoIDJSON("Pedidos"),
            "mail" => $mail,
            "sabor" => $sabor,
            "tipo" => $tipo,
            "cantidad" => intval($cantidad),
            "fecha" => date('Y-m-d'),
            "pedido" => self::UltimoPedido("Pedidos")
        );

        $arrayPedidos[] = $pedidoAux;

        #ESCRIBO LOS ARCHIVOS
        $jsonP = json_encode($arrayPedidos, JSON_PRETTY_PRINT);
        $jsonS = json_encode($arrayStock, JSON_PRETTY_PRINT);

        Manejador::EscribirArchivo($jsonP, "Pedidos");
        Manejador::EscribirArchivo($jsonS, "Hamburguesa");

        $usuario = explode("@", $mail);
        $extension = explode(".", $_FILES["imagen"]["full_path"]);
        $destino = "ImagenesDeLaVenta/$tipo - $sabor - $usuario[0]." . $extension[1];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

        echo "Pedido agregado correctamente<br>";
        return true;
    }


    public static function UltimoPedido($nombreArchivo)
    {
        $listado = Manejador::LeerJSON($nombreArchivo);
        if (!empty($listado))
        {
            $ultimoPedido = end($listado);
            $idaux = $ultimoPedido["pedido"] + 1;
        }
        else
            $idaux = 1;
        return $idaux;
    }

    /******************************PARTE 2*********************************** */


    public static function ConsultarTotalVentasFecha($fecha)
    {
        $listado = Manejador::LeerJSON("Pedidos");
        $cantidad = 0;
        foreach ($listado as $e)
        {
            if (empty($fecha))
                $fecha = date('Y-m-d', strtotime($fecha . ' - 1 day'));
            if ($fecha == $e["fecha"])
                $cantidad += $e["cantidad"];
        }
        echo "Total de ventas el $fecha: $cantidad";
    }

    public static function ConsultarVentasTipo($tipo)
    {
        $listado = Manejador::LeerJSON("Pedidos");
        $ventasTipo = array();
        foreach ($listado as $e)
        {
            if ($e["tipo"] == $tipo)
                $ventasTipo[] = $e;
        }
        if (count($ventasTipo) > 0)
        {
            foreach ($ventasTipo as $e)
            {
                foreach ($e as $key => $value)
                    echo "$key : $value<br>";
                echo '<br>';
            }
        }
        else echo "No hay pedidos de ese tipo";
    }

    public static function ConsultarVentasUsuario($usuario)
    {
        $listado = Manejador::LeerJSON("Pedidos");
        $ventasUsuario = array();
        foreach ($listado as $e)
        {
            $aux = explode("@", $e["mail"]);
            if ($aux[0] == $usuario)
                $ventasUsuario[] = $e;
        }
        if (count($ventasUsuario) > 0)
        {
            foreach ($ventasUsuario as $e)
            {
                foreach ($e as $key => $value)
                    echo "$key : $value<br>";
                echo '<br>';
            }
        }
        else echo "No hay pedidos de ese usuario";
    }

    public static function ConsultarPorFecha($desde, $hasta)
    {
        try
        {
            // Validar y asegurarse de que las fechas estén en un formato válido
            $desdeDT = new DateTime($desde);
            $hastaDT = new DateTime($hasta);

            $listado = Manejador::LeerJSON("Pedidos");
            $pedidos = array();

            foreach ($listado as $e)
            {
                $fecha = new DateTime($e["fecha"]);
                if ($fecha >= $desdeDT && $fecha <= $hastaDT)
                {
                    $pedidos[] = $e;
                }
            }

            function Compara($a, $b)
            {
                return strcmp($a["sabor"], $b["sabor"]);
            }

            usort($pedidos, "Compara");

            // Imprimir los resultados
            foreach ($pedidos as $e)
            {
                foreach ($e as $key => $value)
                {
                    echo "$key : $value<br>";
                }
                echo '<br>';
            }
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    /******************************PARTE 3*********************************** */


    private static function ExistePedido($pedido)
    {
        $arrayPedidos = Manejador::LeerJSON("Pedidos");
        foreach ($arrayPedidos as $e)
        {
            if ($e["pedido"] == $pedido)
                return $e["id"];
        }
        return 0;
    }


    private static function BajaPedido($pedido, $mail, $sabor, $tipo)
    {
        #traigo los pedidos
        $arrayPedidos = Manejador::LeerJSON("Pedidos");
        $arrayPedidosAux = array();
        #guardo los que quiero conservar
        foreach ($arrayPedidos as $e)
        {
            if (!($e["sabor"] == $sabor && $e["tipo"] == $tipo && $e["pedido"] == $pedido && $e["mail"] == $mail))
                $arrayPedidosAux[] = $e;
        }
        var_dump($arrayPedidosAux);
        #escribo el archivo sin el que quiero eliminar
        $jsonP = json_encode($arrayPedidosAux, JSON_PRETTY_PRINT);
        Manejador::EscribirArchivo($jsonP, "Pedidos");
    }

    public static function ModificarPedido($pedido, $mail, $sabor, $tipo, $cantidad)
    {
        #1 DEVUELVO EL PEDIDO AL STOCK
        #traigo el listado de pedidos
        $arrayPedidos = Manejador::LeerJSON("Pedidos");
        $arrayStock = Manejador::LeerJSON("Pizza");
        $cantPedido = 0;
        #veo si el pedido existe
        if (($idPedido = self::ExistePedido($pedido)) > 0)
        {
            #si existe me guardo el ID y con el ID busco la cantidad
            foreach ($arrayPedidos as $e)
            {
                if ($idPedido === $e["id"])
                {
                    $cantPedido = $e["cantidad"];
                    break;
                }
            }
            #recupero el ID del stock
            if ($idAux = (Hamburguesa::Equals($sabor, $tipo)) > 0)
            {
                #devuelvo el pedido al stock
                //Pizza::ActualizoStock($idAux, $cantPedido);
                foreach ($arrayStock as &$e)
                {
                    echo "idAux = $idAux<br>";
                    echo "id = " . $e["id"];
                    if ($e["id"] == $idAux)
                    {
                        $e["cantidad"] += $cantPedido;
                        break;
                    }
                }
                #escribo el archivo de stock
                $jsonS = json_encode($arrayStock, JSON_PRETTY_PRINT);
                Manejador::EscribirArchivo($jsonS, "Hamburguesa");
                #borro el pedido del registro
                self::BajaPedido($pedido, $mail, $sabor, $tipo);
            }
            #2 HAGO UN NUEVO PEDIDO
            #Puedo llamar a AltaPedido()
            // self::AltaPedido($mail, $sabor, $tipo, $cantidad);
        }
        else echo "El pedido no existe";
    }
}
