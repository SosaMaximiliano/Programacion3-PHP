<?php
echo 'Clase Garage OK<br><br>';
class Garage
{
    private $razonSocial;
    private $precioPorHora;
    private $autos = array();
    public static $garages = array();

    public function __construct($razonSocial, $precioPorHora = 200)
    {
        $this->razonSocial = $razonSocial;
        $this->precioPorHora = $precioPorHora;
    }

    public function MostrarGarage()
    {
        echo 'Razon social: ' . $this->razonSocial . '<br>';
        echo 'Precio por hora $' . $this->precioPorHora . '<br>';
        echo '<br>';
        echo '<u><b>AUTOS EN GARAGE:</b></u>:<br>';
        echo '<br>';

        foreach ($this->autos as $a) {
            Auto::MostrarAuto($a);
            echo '<br>';
        }
    }

    public function Add(Auto $auto)
    {
        for ($i = 0; $i <= count($this->autos); $i++) {
            if ($auto->Equals($this->autos[$i])) {
                return false;
            }
        }
        $this->autos[] = $auto;
        return true;
    }
    public function Remove(Auto $auto)
    {
        for ($i = 0; $i < count($this->autos); $i++) {
            if ($auto->Equals($this->autos[$i])) {
                unset($this->autos[$i]);
                return true;
            }
        }
        return false;
    }
    public function Equals($auto2)
    {
        foreach ($this->autos as $a) {
            if ($a === $auto2)
                return true;
            else
                return false;
        }
    }

    public static function AltaGarage($garage)
    {
        array_push(Garage::$garages, $garage);

        $listaGarage = fopen("garages.csv", "a");
        fwrite($listaGarage, $garage->razonSocial . ',');
        fwrite($listaGarage, $garage->precioPorHora . ',');
        fwrite($listaGarage, ';');
        fclose($listaGarage);
    }

    public static function MostrarListadoGarage()
    {
        $listado = fopen("garages.csv", "r");

        while ($fila = fgetcsv($listado, 0, ';')) {
            foreach ($fila as $e) {
                echo $e;
                echo '<br>';
            }
        }
        
    }
}
