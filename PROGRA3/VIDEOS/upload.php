<?php

$archivo = $_POST['archivo'];
//var_dump($archivo);
//var_dump($_FILES);

$destino = "uploads/" . $_FILES['archivo']['name'];
move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
