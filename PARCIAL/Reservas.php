<?php



class Reserva
{
    private static $habitaciones = array(
        "Simple" => 500,
        "Doble" => 1000,
        "Suite" => 3000
    );

    public function __construct($tipoCliente, $nroCliente, $entrada, $salida, $habitacion)
    {
        self::ReservaHabitacion($tipoCliente, $nroCliente, $entrada, $salida, $habitacion);
    }

    public static function A()
    {
        echo "AAAAA";
    }

    private static function ReservaHabitacion($tipoCliente, $nroCliente, $entrada, $salida, $habitacion)
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
                "importe" => strval(self::$habitaciones[$habitacion])
            );

            $arrayReservas[] = $nuevaReserva;
            $jsonR = json_encode($arrayReservas, JSON_PRETTY_PRINT);
            Manejador::EscribirArchivo($jsonR, "Reservas");

            $extension = explode(".", $_FILES["imagen"]["full_path"]);
            $destino = "ImagenesDeReservas2023/" . $id . $tipoCliente . "." . $extension[1];
            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        }
        echo "Reserva creada con exito";
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
        echo "HOLA";
        $reserva = self::BuscarReservaPorCliente($tipoCliente, $idCliente);
        if (!empty($reserva))
        {
            foreach ($reserva as $key => $value)
            {
                echo "$key : $value<br>";
            }
        }
        else echo "No existe reserva para ese cliente";
    }

    public static function ConsultarReservaFecha($tipoHabitacion, $fecha)
    {
        $listado = Manejador::LeerJSON("Reservas");
        $totalSimple = 0;
        $totalDoble = 0;
        $totalSuite = 0;
        foreach ($listado as $e)
        {
            if (empty($fecha))
                $fecha = date('Y-m-d', strtotime($fecha . ' - 1 day'));
            if ($fecha == $e["entrada"] && $tipoHabitacion == $e["habitacion"])
                #TENGO QUE VALIDAR QUE HAYA RESERVAS EN ESA FECHA
                switch ($e["habitacion"])
                {
                    case 'Simple':
                        $totalSimple += floatval($e["importe"]);
                        break;
                    case 'Doble':
                        $totalDoble += floatval($e["importe"]);
                        break;
                    default:
                        $totalSuite += floatval($e["importe"]);
                        break;
                }
        }
        echo "Total de reservas el $fecha:<br>
        Simple: $totalSimple<br>
        Doble: $totalDoble<br>
        Suite: $totalSuite<br>";
    }

    public static function ConsultarReservaHabitacion($tipoHabitacion)
    {
        $listado = Manejador::LeerJSON("Reservas");
        $reservas = array();
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

    /************ */


    public static function ConsultarReservaEntreFechas($desde, $hasta)
    {
        try
        {
            $desdeDT = new DateTime($desde);
            $hastaDT = new DateTime($hasta);
            var_dump($desdeDT);
            var_dump($hastaDT);
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

            usort($reservasSort, "Compara");

            // Imprimir los resultados
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
} /* FIN CLASS
