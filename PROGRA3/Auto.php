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
*/

class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    function __construct($marca, $color, $precio = 263000, $fecha = null)
    {
        $this->_marca = $marca;
        $this->_color = $color;
        $this->_precio = $precio;
        if ($fecha == null)
            $this->_fecha = date("d/m/Y");
        else $this->_fecha = $fecha;
    }

    public function getPrecio()
    {
        return $this->_precio;
    }

    public function getColor()
    {
        return $this->_color;
    }

    public function getMarca()
    {
        return $this->_marca;
    }

    public function getFecha()
    {
        return $this->_fecha;
    }


    public function AgregarImpuestos($impuestos)
    {
        $this->_precio += $impuestos;
    }

    public static function MostrarAuto(Auto $auto)
    {
        echo "Marca: " . $auto->_marca . '<br>';
        echo "Color: " . $auto->_color . '<br>';
        echo "Precio " . $auto->_precio . '<br>';
        echo "Fecha: " . $auto->_fecha . '<br>';
    }

    public function Equals(Auto $auto)
    {
        return $this->getMarca() == $auto->getMarca();
    }

    public static function Add(Auto $auto1, Auto $auto2)
    {
        if (!$auto1->Equals($auto2))
            return "No se pueden sumar autos de distintas marcas";
        if (!($auto1->_color == $auto2->_color))
            return "No se pueden sumar autos de distintos colores";

        return $auto1->getPrecio() + $auto2->getPrecio();
    }
}
