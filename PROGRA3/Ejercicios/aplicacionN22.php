<?php

/*
Aplicación No 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.
*/

require_once "Usuario.php";

if (!(isset($_POST["mail"]) && isset($_POST["clave"])))
{
    echo "Completar los campos";
}
else
{
    $mail = $_POST["mail"];
    $clave = $_POST["clave"];

    Usuario::ValidarUsuario($mail, $clave);
}
