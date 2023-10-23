<?php
include 'Cliente.php';
class Reserva
{
    private static $habitaciones = array(
        "Simple" => 500,
        "Doble" => 1000,
        "Suite" => 3000
    );

    public static function ReservaHabitacion($tipoCliente, $nroCliente, $entrada, $salida, $habitacion)
    {
        if (self::ValidarReserva($tipoCliente, $entrada, $salida, $habitacion))
        {
            $arrayReservas = Manejador::LeerJSON("Reservas");
            $cliente = Cliente::BuscarCliente($tipoCliente, $nroCliente);
            $id = strval(Manejador::UltimoIDJSON("Reservas"));
            #REVISO SI EL CLIENTE EXISTE
            if (empty($cliente))
            {
                echo "El cliente no se encuentra registrado";
                return;
            }
            elseif (!empty(self::BuscarReservaPorCliente($tipoCliente, $nroCliente)))
            {
                echo "Ya existe una reserva para el cliente $nroCliente";
                return;
            }
            else
            {
                $nuevaReserva = array(
                    "id" => $id,
                    "nombre" => $cliente["nombre"],
                    "apellido" => $cliente["apellido"],
                    "nroDni" => $cliente["nroDni"],
                    "tipoCliente" => $cliente["tipoCliente"],
                    "nroCliente" => $cliente["id"],
                    "entrada" => $entrada,
                    "salida" => $salida,
                    "habitacion" => $habitacion,
                    "importe" => strval(self::$habitaciones[$habitacion]),
                    "estado" => "activa"
                );

                $arrayReservas[] = $nuevaReserva;
                $jsonR = json_encode($arrayReservas, JSON_PRETTY_PRINT);
                Manejador::EscribirArchivo($jsonR, "Reservas");

                $extension = explode(".", $_FILES["imagen"]["full_path"]);
                $destino = "ImagenesDeReservas2023/" . $id . $tipoCliente . "." . $extension[1];
                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $destino))
                    echo "La imagen no se pudo guardar correctamente";
            }
            echo "Reserva creada con exito";
        }
    }

    public static function BuscarReservaPorCliente($tipoCliente, $idCliente)
    {
        $listado = Manejador::LeerJSON("Reservas");
        foreach ($listado as $e)
        {
            if ($e["tipoCliente"] == $tipoCliente && $e["nroCliente"] == $idCliente)
                return $e;
        }
        return [];
    }

    public static function ConsultarReservaCliente($tipoCliente, $idCliente)
    {
        $reserva = self::BuscarReservaPorCliente($tipoCliente, $idCliente);
        $clientesValidos = array("Individual", "Corporativo");
        if (!in_array($tipoCliente, $clientesValidos))
        {
            echo "El tipo de cliente no es válido";
            return false;
        }
        else
        {
            if (!empty($reserva))
            {
                foreach ($reserva as $key => $value)
                {
                    echo "$key : $value<br>";
                }
            }
            else echo "No existe reserva para ese cliente";
        }
    }

    public static function ConsultarReservaFecha($tipoHabitacion, $fecha)
    {
        $listado = Manejador::LeerJSON("Reservas");
        $totalHabitacion = 0;
        $habitacionesValidas = array("Simple", "Doble", "Suite");
        if (!empty($tipoHabitacion = ucfirst(strtolower($tipoHabitacion))))
        {
            if (!in_array($tipoHabitacion, $habitacionesValidas))
            {
                echo "El tipo de habitación no es válido";
                return false;
            }
            else
            {
                foreach ($listado as $e)
                {
                    if (empty($fecha))
                        $fecha = date('Y-m-d', strtotime($fecha . ' - 1 day'));
                    if ($fecha == $e["entrada"] && $tipoHabitacion == $e["habitacion"])
                        #TENGO QUE VALIDAR QUE HAYA RESERVAS EN ESA FECHA
                        switch ($e["habitacion"])
                        {
                            case 'Simple':
                                $totalHabitacion += floatval($e["importe"]);
                                break;
                            case 'Doble':
                                $totalHabitacion += floatval($e["importe"]);
                                break;
                            default:
                                $totalHabitacion += floatval($e["importe"]);
                                break;
                        }
                }
                echo "Total de reservas el $fecha:<br>$tipoHabitacion: $totalHabitacion<br>";
            }
        }
        else
            echo "El tipo de habitación no puede estar vacío<br>";
    }

    public static function ConsultarReservaHabitacion($tipoHabitacion)
    {
        $listado = Manejador::LeerJSON("Reservas");
        $reservas = array();
        $habitacionesValidas = array("Simple", "Doble", "Suite");
        if (!empty($tipoHabitacion = ucfirst(strtolower($tipoHabitacion))))
        {
            if (!in_array($tipoHabitacion, $habitacionesValidas))
            {
                echo "El tipo de habitación no es válido";
                return false;
            }
            else
            {
                foreach ($listado as $e)
                {
                    if ($e["habitacion"] == $tipoHabitacion)
                        $reservas[] = $e;
                }
                if (count($reservas) > 0)
                {
                    foreach ($reservas as $e)
                    {
                        foreach ($e as $key => $value)
                            echo "$key : $value<br>";
                        echo '<br>';
                    }
                }
                else echo "No hay reservas para ese tipo de habitación";
            }
        }
        else
            echo "El tipo de habitación no puede estar vacío<br>";
    }

    public static function ConsultarReservaEntreFechas($desde, $hasta)
    {
        $desdeDT = new DateTime($desde);
        $hastaDT = new DateTime($hasta);
        $reservas = Manejador::LeerJSON("Reservas");
        $reservasSort = array();

        foreach ($reservas as $e)
        {
            $fecha = new DateTime($e["entrada"]);
            if ($fecha >= $desdeDT && $fecha <= $hastaDT)
                $reservasSort[] = $e;
        }

        function Compara($a, $b)
        {
            return strcmp($a["entrada"], $b["entrada"]);
        }

        try
        {
            usort($reservasSort, "Compara");

            foreach ($reservasSort as $e)
            {
                foreach ($e as $key => $value)
                    echo "$key : $value<br>";
                echo '<br>';
            }
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function BajaReserva($tipoCliente, $nroCliente, $idReserva)
    {
        #VALIDAR QUE EL CLIENTE EXISTA EN LOS DOS ARCHIVOS
        $reservas = Manejador::LeerJSON("Reservas");
        $clienteR = self::BuscarReservaPorCliente($tipoCliente, $nroCliente);
        $clienteH = Cliente::BuscarCliente($tipoCliente, $nroCliente);
        $flagIdReservaOk = false;

        #VALIDAR SI EXISTE LA RESERVA
        if (empty($clienteH))
        {
            echo "El cliente no existe en la lista del hotel";
            return false;
        }
        else
        {
            if (empty($clienteR))
            {
                echo "El cliente no tiene reservas";
                return false;
            }
            else
            {
                foreach ($reservas as &$e)
                {
                    if ($e['id'] == $idReserva)
                    {
                        if ($e['estado'] != "Cancelada")
                        {
                            $e['estado'] = "Cancelada";
                            $flagIdReservaOk = true;
                            break;
                        }
                        else
                        {
                            echo "La reserva $idReserva ya fue cancelada";
                            return false;
                        }
                    }
                }
                if (!$flagIdReservaOk)
                {
                    echo "El numero de reserva no existe para ese cliente";
                    return false;
                }
                try
                {
                    $jsonR = json_encode($reservas, JSON_PRETTY_PRINT);
                    Manejador::EscribirArchivo($jsonR, "Reservas");
                    echo "La baja se realizó correctamente";
                    return true;
                }
                catch (Exception $e)
                {
                    echo "Error al escribir el archivo";
                    return $e->getMessage();
                }
            }
        }
    }

    public static function AjustaReserva($idReserva, $motivo, $nuevaHabitacion)
    {
        #TRAIGO LISTADO 
        $reservas = Manejador::LeerJSON("Reservas");
        $ajustes = Manejador::LeerJSON("Ajustes");
        $ajuste = [];
        $flagModifico = false;
        #BUSCO RESERVA
        foreach ($reservas as &$e)
        {
            if ($e['id'] === $idReserva)
            {
                if ($e['habitacion'] != $nuevaHabitacion)
                {
                    $hAux = $e['habitacion'];
                    #MODIFICO
                    $e['habitacion'] = $nuevaHabitacion;
                    $e["importe"] = strval(self::$habitaciones[$nuevaHabitacion]);
                    $ajuste["reserva"] = $e['id'];
                    $ajuste["motivo"] = "$motivo: $hAux => {$e['habitacion']}";
                    $ajuste["nuevo valor"] = $e['importe'];
                    $ajustes[] = $ajuste;
                    $flagModifico = true;
                    break;
                }
                else
                {
                    echo "La habitacion ya es del tipo $nuevaHabitacion";
                    return false;
                }
            }
        }
        if ($flagModifico)
        {
            #ESCRIBO
            $jsonR = json_encode($reservas, JSON_PRETTY_PRINT);
            $jsonA = json_encode($ajustes, JSON_PRETTY_PRINT);
            Manejador::EscribirArchivo($jsonR, "Reservas");
            Manejador::EscribirArchivo($jsonA, "Ajustes");
            echo "los cambios se realizaron correctamente";
        }
        else echo "No hay reservas para modificar";
    }

    private static function ValidarReserva($tipoCliente, $entrada, $salida, $habitacion)
    {
        $entradaDT = new DateTime($entrada);
        $salidaDT = new DateTime($salida);
        $clientesValidos = array("Individual", "Corporativo");
        $habitacionesValidas = array("Simple", "Doble", "Suite");

        if (!in_array($tipoCliente, $clientesValidos))
        {
            echo "El tipo de cliente ingresado no es valido";
            return false;
        }
        if (!in_array($habitacion, $habitacionesValidas))
        {
            echo "El tipo de habitacion ingresado no es valido";
            return false;
        }
        if ($salidaDT < $entradaDT)
        {
            echo "La fecha de entrada no puede ser posterior a la fecha de salida";
            return false;
        }

        return true;
    }
}
