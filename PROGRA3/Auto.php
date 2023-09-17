<?php


/*
Aplicación No 17 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.
ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble
por parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);

Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
*/

class Auto
{
    private $props = array();

    function __construct($marca, $color, $precio = 263000, $fecha = null)
    {
        $this->props["marca"] = $marca;
        $this->props["color"] = $color;
        $this->props["precio"] = $precio;
        if ($fecha == null)
            $this->props["fecha"] = date("d/m/Y");
        else $this->props["fecha"] = $fecha;
    }

    public function getPrecio()
    {

        return $this->props["precio"];
    }

    public function getColor()
    {
        return $this->props["color"];
    }

    public function getMarca()
    {
        return $this->props["marca"];
    }

    public function getFecha()
    {
        return $this->props["fecha"];
    }


    public function AgregarImpuestos($impuestos)
    {
        $this->props["precio"] += $impuestos;
    }

    public static function MostrarAuto(Auto $auto)
    {
        foreach ($auto->props as $key => $value)
        {
            echo $key . ' => ' . $value . '<br>';
        }
    }

    public function Equals(Auto $auto)
    {
        return $this->getMarca() == $auto->getMarca();
    }

    public static function Add(Auto $auto1, Auto $auto2)
    {
        if (!$auto1->Equals($auto2))
            return "No se pueden sumar autos de distintas marcas";
        if (!($auto1->props["color"] == $auto2->props["color"]))
            return "No se pueden sumar autos de distintos colores";

        return $auto1->getPrecio() + $auto2->getPrecio();
    }

    public static function AltaAuto(Auto $auto)
    {
        if (Auto::BuscarAuto($auto))
            echo "El auto " . $auto->getMarca() . " " . $auto->getColor() . " ya se encuentra en el listado<br>";
        else
        {
            $archivo = fopen("_Autos/autos.csv", "a");
            if ($archivo !== false)
            {
                foreach ($auto->props as $e => $v)
                {
                    fwrite($archivo, $v . ';');
                }
                fwrite($archivo, "\n");
                fclose($archivo);
            }
            else echo "No se pudo abrir el archivo para escritura.";
        }
    }

    public static function LeerArchivo()
    {
        $archivo = fopen("_Autos/autos.csv", "r");
        if ($archivo !== false)
        {
            while (($fila = fgetcsv($archivo, 0, ';')) !== false)
            {
                foreach ($fila as $e)
                {
                    echo $e . '<br>';
                }
            }
            fclose($archivo);
        }
        else echo "No se pudo abrir el archivo para lectura.";
    }

    private static function BuscarAuto(Auto $auto)
    {
        $archivo = fopen("_Autos/autos.csv", "r");
        if ($archivo !== false)
        {
            while (($fila = fgetcsv($archivo, 0, ';')) !== false)
            {
                if (
                    $fila[0] == $auto->getMarca() &&
                    $fila[1] == $auto->getColor() &&
                    $fila[2] == $auto->getPrecio()
                )
                {
                    fclose($archivo);
                    return true;
                }
            }
            fclose($archivo);
            return false;
        }
        else echo "No se pudo abrir el archivo para busqueda.";
        fclose($archivo);
    }
}
