<?php

/*
Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , crear
un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.
*/

include_once "Usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["mail"]) && isset($_POST["clave"]))
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $mail = $_POST["mail"];
    $clave = $_POST["clave"];

    $user = new Usuario($nombre, $apellido, $mail, $clave);
}
else echo "Complete todos los datos";
