<?php


/*
Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
$miGarage->Remove($autoUno);
*/

include_once 'Auto.php';

class Garage
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = array();

    function __construct($razonSocial, $precioPorHora = 500)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
    }

    public function getRazonSocial()
    {
        return $this->_razonSocial;
    }

    public function getPrecio()
    {
        return $this->_precioPorHora;
    }

    public function MostrarGarage()
    {
        echo "Razon Social: " . $this->getRazonSocial();
        echo '<br>';
        echo "Precio/Hora: " . $this->getPrecio();
    }

    public function Equals(Auto $auto)
    {
        foreach ($this->_autos as $e)
        {
            if ($e->Equals($auto))
                return ($e->getColor() === $auto->getColor());
        }
        return false;
    }

    public function Add(Auto $auto)
    {
        if (!$this->Equals($auto))
        {
            array_push($this->_autos, $auto);
            echo "Auto agregado al garage";
        }
        else echo "El auto ya se encuentra en el garage";
    }

    public function Remove(Auto $auto)
    {
        $aux = -1;
        foreach ($this->_autos as $e)
        {
            $aux++;
            if ($e->Equals($auto) && $e->getColor() == $auto->getColor())
            {
                unset($this->_autos[$aux]);
                echo "El auto fue removido";
                return;
            }
        }
        echo "El auto no se encuentra en el garage";
    }
}
