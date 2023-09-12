<?php

include_once 'Usuario.php';

$usuario = new Usuario("Max", "Payne");

echo $usuario->Saludar();

echo '<br>';

include_once 'aplicacionN1.php';
