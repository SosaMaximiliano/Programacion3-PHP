<?php

// var_dump($_POST);
// var_dump($_FILES);

$nombreArchivo = $_POST["nombreArchivo"];
$aux = explode('.',$_FILES["archivo"]["name"]);
$extension = end($aux);
$destino = "uploads/".$nombreArchivo.'.'.$extension;


if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino))
{
    echo 'Archivo "'.$nombreArchivo.'" cargado correctamente<br>';
}
else
{
    var_dump($_FILES["archivo"]["error"]);
    echo 'Error al subir archivo';
}
