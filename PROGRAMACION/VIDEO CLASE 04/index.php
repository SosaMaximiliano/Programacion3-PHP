<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <!-- El atributo name es la key que se va a usar para acceder a ese archivo -->
        <input type="file" name="archivo"><br>
        <input type="text" name="nombreArchivo" placeholder="Nombre del archivo"><br>
        <input type="submit" value="Subir">
    </form>

    <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="archivos[]" multiple accept="image/png,.jpg"><br>
        <input type="text" name="nombreArchivo" placeholder="Nombre del archivo"><br>
        <input type="submit" value="Subir">
    </form> -->


</body>
</html> 