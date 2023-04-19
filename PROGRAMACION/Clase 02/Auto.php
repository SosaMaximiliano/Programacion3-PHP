<?php
echo 'Clase Auto OK<br><br>';

class Auto
{
  private $color;
  private $precio;
  private $marca;
  private $fecha;
  public static $autos = array();

  public function __construct($marca, $color, $precio = 1500, $fecha = "25/05")
  {
    $this->marca = $marca;
    $this->color = $color;
    $this->precio = $precio;
    $this->fecha = $fecha;
  }

  public function AgregarImpuestos($impuestos)
  {
    $this->precio += $impuestos;
  }

  public static function MostrarAuto($auto)
  {
    echo 'Marca: ' . $auto->marca . '<br>';
    echo 'Color: ' . $auto->color . '<br>';
    echo 'Precio: $' . $auto->precio . '<br>';
    echo 'Fecha: ' . $auto->fecha . '<br><br>';
  }

  public function Equals($auto2)
  {
    if ($this->marca == $auto2->marca && $this->color == $auto2->color)
      return true;
    else
      return false;
  }

  public static function Add($auto1, $auto2)
  {
    if ($auto1->Equals($auto1, $auto2) && $auto1->color == $auto2->color) {
      echo 'La suma de los dos autos es: $';
      return $auto1->precio += $auto2->precio;
    } else
      return "No se pudo sumar";
  }

  public static function Alta($auto)
  {
    array_push(Auto::$autos, $auto);

    $listado = fopen("autos.csv", "a");

    fwrite($listado, $auto->marca . ',');
    fwrite($listado, $auto->color . ',');
    fwrite($listado, $auto->precio . ',');
    fwrite($listado, $auto->fecha);
    fwrite($listado, ';');

    fclose($listado);
  }

  public static function MostrarListadoAutos()
  {
    $listado = fopen("autos.csv", "r");

    while ($fila = fgetcsv($listado, 0, ';')) {
      foreach ($fila as $e) {
        echo $e;
        echo '<br>';
      }
    }
  }
}
