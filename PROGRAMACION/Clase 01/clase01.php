<?php
//1
echo "<b>1-</b></br>";

$resultado = 0;
$i = 0;

while ($resultado <= 1000) {
    $i++;
    $resultado += $i;

    if ($resultado <= 1000)
        echo "$resultado, ";
}

echo "<br>Se sumaron $i números.";


//2
echo "<br><br><b>2-</b></br>";

$fecha = date("l d/F/Y");
echo $fecha;

//3    
echo "<br><br><b>3-</b></br>";

$a = 7;
$b = 4;
$c = 6;

echo "$a, $b, $c<br>";

if ($a > $b && $b > $c || $a < $b && $b < $c) {
    echo "$b está en el medio";
} else if ($b > $a && $a > $c || $b < $a && $a < $c) {
    echo "$a está en el medio";
} else if ($b > $c && $c > $a || $b < $c && $c < $a) {
    echo "$c está en el medio";
} else {
    echo "No hay ninguno en medio";
}

//4

echo "<br><br><b>4-</b></br>";

$operador = '+';

$op1 = 7;
$op2 = 9;

echo "$op1 $operador $op2<br>";

switch ($operador) {
    case '+':
        echo $op1 + $op2;
        break;

    case '-':
        echo $op1 - $op2;
        break;

    case '*':
        echo $op1 * $op2;
        break;

    case '/':
        if ($op2 != 0) echo $op1 / $op2;
        else echo "no se puede dividir por cero";
        break;

    default:
        # code...
        break;
}


//5

echo "<br><br><b>5-</b></br>";

$numero = (string)42;
$decenas = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta"];
$unidades = ["", " y uno", " y dos", " y tres", " y cuatro", " y cinco", " y seis", " y siete", " y ocho", " y nueve"];

echo $decenas[$numero[0]], $unidades[$numero[1]];


//6

echo "<br><br><b>6-</b></br>";

$arrayEnteros = [];
$suma = 0;
$promedio = 0;

for ($i = 0; $i < 5; $i++) {
    $arrayEnteros[] = rand(1, 10);
}

foreach ($arrayEnteros as $numero) {
    echo "$numero, ";
    $suma += $numero;
}

$promedio = $suma / count($arrayEnteros);
echo "<br>Total: $suma";
echo "<br>Promedio: $promedio";
echo "<br>";
if ($promedio == 0) {
    echo "El promedio es igual a 6";
}

echo $promedio > 6 ? "El promedio es mayor a 6" : "El promedio es menor a 6";



//7

echo "<br><br><b>7-</b>";

$arrayNumeros = [];

for ($i = 0; $i < 10; $i++) {
    $arrayNumeros[] = rand(1, 10);
}

echo "<br>Lista de impares del array</br>";
foreach ($arrayNumeros as $numero) {
    if ($numero % 2 != 0) {
        echo "</br>$numero";
    }
}


//8

echo "<br><br><b>8-</b><br>";

$vector = array(1 => 90, 30 => 7, 'e' => 99, "Hola" => "Mundo");

foreach ($vector as $e => $valor) {
    echo $e, '=>', $valor, "<br>";
}

var_dump($vector);


//9

echo "<br><br><b>9-</b><br>";

$lapicera =
    [
        "color",
        "marca",
        "trazo",
        "precio"
    ];


var_dump($lapicera);

//10

echo "<br><br><b>10-</b><br>";

$lapiceras =
    [
        [
            "color" => "Azul",
            "marca" => "Bic",
            "trazo" => "fino",
            "precio" => 50
        ],
        [
            "color" => "Negro",
            "marca" => "Bic",
            "trazo" => "grueso",
            "precio" => 80
        ],
        [
            "color" => "Rojo",
            "marca" => "Paper Mate",
            "trazo" => "fino",
            "precio" => 30
        ]
    ];

foreach ($lapiceras as $e) {
    echo $e["color"], "<br>";
    echo $e["marca"], "<br>";
    echo $e["trazo"], "<br>";
    echo '$', $e["precio"], "<br><br>";
}
