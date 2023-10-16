<?php

require_once 'Pizza.php';

class Pedido
{
    // public $mail;
    // public $sabor;
    // public $tipo;
    // public $cantidad;
    // public $fecha;
    // private $id;
    public static $pedidos = array();

    public function __construct($mail, $sabor, $tipo, $cantidad)
    {
        self::AltaPedido($mail, $sabor, $tipo, $cantidad);
    }


    private static function AltaPedido($mail, $sabor, $tipo, $cantidad)
    {
        #TRAIGO LOS LISTADOS
        $arrayPedidos = Pizza::LeerJSON("Pedidos");
        $arrayStock = Pizza::LeerJSON("Pizza");
        $idAux = 0;
        $cantidadStock = 0;

        #CONFIRMO QUE HAYA STOCK
        if (($idAux = Pizza::ExisteStock($sabor, $tipo)) > 0)
            foreach ($arrayStock as $e)
            {
                if ($e["id"] == $idAux)
                    $cantidadStock = $e["cantidad"];
            }
        #LA CANTIDAD NO PUEDE SER MAYOR AL STOCK!!!
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
            "id" => Pizza::UltimoIDJSON("Pedidos"),
            "mail" => $mail,
            "sabor" => $sabor,
            "tipo" => $tipo,
            "cantidad" => intval($cantidad),
            "fecha" => date('Y-m-d'),
            "nroPedido" => self::UltimoPedido("Pedidos")
        );

        $arrayPedidos[] = $pedidoAux;

        #ESCRIBO LOS ARCHIVOS
        $jsonP = json_encode($arrayPedidos, JSON_PRETTY_PRINT);
        $jsonS = json_encode($arrayStock, JSON_PRETTY_PRINT);

        Pizza::EscribirArchivo($jsonP, "Pedidos");
        Pizza::EscribirArchivo($jsonS, "Pizza");

        $usuario = explode("@", $mail);
        $extension = explode(".", $_FILES["imagen"]["full_path"]);
        $destino = "PedidosIMG/$tipo - $sabor - $usuario[0]." . $extension[1];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

        echo "Pedido agregado correctamente<br>";
        return true;
    }

    public static function UltimoPedido($nombreArchivo)
    {
        $listado = Pizza::LeerJSON($nombreArchivo);
        if (!empty($listado))
        {
            $ultimoPedido = end($listado);
            $idaux = $ultimoPedido["nroPedido"] + 1;
        }
        else
            $idaux = 1;
        return $idaux;
    }

    public static function ConsultarTotalVentas()
    {
        $listado = Pizza::LeerJSON("Pedidos");
        $cantidad = 0;
        foreach ($listado as $e)
        {
            $cantidad += $e["cantidad"];
        }
        echo "Total de ventas: $cantidad";
    }

    public static function ConsultarVentasSabor($sabor)
    {
        $listado = Pizza::LeerJSON("Pedidos");
        $ventasSabor = array();
        foreach ($listado as $e)
        {
            if ($e["sabor"] == $sabor)
                $ventasSabor[] = $e;
        }
        if (count($ventasSabor) > 0)
        {
            foreach ($ventasSabor as $e)
            {
                foreach ($e as $key => $value)
                    echo "$key : $value<br>";
                echo '<br>';
            }
        }
        else echo "No hay pedidos de ese sabor";
    }

    public static function ConsultarVentasUsuario($usuario)
    {
        $listado = Pizza::LeerJSON("Pedidos");
        $ventasUsuario = array();
        foreach ($listado as $e)
        {
            $aux = explode("@", $e["mail"]);
            if ($aux[0] == $usuario)
                $ventasUsuario[] = $e;
        }
        foreach ($ventasUsuario as $e)
        {
            foreach ($e as $key => $value)
                echo "$key : $value<br>";
            echo '<br>';
        }
    }

    public static function ConsultarPorFecha($desde, $hasta)
    {
        try
        {
            // Validar y asegurarse de que las fechas estén en un formato válido
            $desdeDT = new DateTime($desde);
            $hastaDT = new DateTime($hasta);

            $listado = Pizza::LeerJSON("Pedidos");
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
}
