<?php

#12
echo '<b>#12</b><br>';

$arrayChar = ['H', 'O', 'L', 'A'];

function invertir($arrayChar)
{
  krsort($arrayChar);
  foreach ($arrayChar as $char) {
    echo $char;
  }
}

invertir($arrayChar);


#13
echo '<br><br><b>#13</b><br>';

function invertir2($palabra, $max)
{
  $arrayPalabras = ["Recuperatorio", "Parcial", "Programacion"];

  
  if (strlen($palabra) <= $max) {
    foreach ($arrayPalabras as $p) {
      if ($palabra == $p)
      {
        echo $palabra.'<br>';
        return 1;
      }
    }
    echo $palabra.'No se encuentra<br>';
    return 0;
  }
}

echo invertir2("Parcial", 50).'<br>';
echo invertir2("Programacion", 50).'<br>';
echo invertir2("Recuperatorio", 50).'<br>';
echo invertir2("Vaca", 50).'<br>';
