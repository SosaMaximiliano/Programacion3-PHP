<?php
/*
Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario
*/

include_once "Usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["mail"]) && isset($_POST["clave"]))
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $mail = $_POST["mail"];
    $clave = $_POST["clave"];

    $user = new Usuario($nombre, $apellido, $mail, $clave);

    $user->MostrarDatos();

    //Usuario::Baja($user);
}
else echo "Complete todos los datos";
