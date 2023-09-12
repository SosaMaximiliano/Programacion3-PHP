<?php


/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
*/
$operador = '/';
$op1 = 3;
$op2 = 8;
$res = 0;

switch ($operador)
{
    case '+':
        $res = $op1 + $op2;
        echo $res;
        break;

    case '-':
        $res = $op1 - $op2;
        echo $res;
        break;

    case '*':
        $res = $op1 * $op2;
        echo $res;
        break;

    case '/':
        if ($op2 != 0)
        {
            $res = $op1 / $op2;
            echo $res;
        }
        else echo 'No se puede dividir sobre cero';
        break;
}
