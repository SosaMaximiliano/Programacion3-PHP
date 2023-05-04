<?php

include "../Clase 03/Login/Usuario.php";

// Aplicación No 23 (Registro JSON)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). 
// crear un dato con la fecha de registro , 
// toma todos los datos y utilizar sus métodos para poder hacer el alta,
// guardando los datos en usuarios.json y subir la imagen al servidor en la 
// carpeta Usuario/Fotos/.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario.

$nombre = $_POST["nombre"];
$mail = $_POST["mail"];
$clave = $_POST["clave"];
$imagen = $_FILES["imagen"];
$destino = "./Usuario/Fotos/".$_FILES["imagen"]["name"];

$nombre2 = $_POST["nombre2"];
$mail2 = $_POST["mail2"];
$clave2 = $_POST["clave2"];
$imagen2 = $_FILES["imagen"];

if (move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino)) 
{
    echo "Archivo subido correctamente<br>";
}
else
{
    echo "Archivo no subido<br>";
}

$usuario1 = new Usuario($nombre, $mail, $clave);
$usuario2 = new Usuario($nombre2, $mail2, $clave2);

Usuario::Add($usuario1);
Usuario::Add($usuario2);

//$usuario1->MostrarDatos();

Usuario::MostrarUsuarios();



