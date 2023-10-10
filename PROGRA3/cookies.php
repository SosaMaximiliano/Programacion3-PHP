<?php

echo $_COOKIE["prueba"];

if (isset($_COOKIE["prueba"]))
    echo "<p>La cookie está creada</p>";
else
{
    echo "<p>La cookie no existia. Ahora está creada</p>";
    setcookie("prueba", true, time() + (60 * 2));
}
