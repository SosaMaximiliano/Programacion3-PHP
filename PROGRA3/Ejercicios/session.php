<?php

session_start();

if (isset($_SESSION["usuario"]))
    echo $_SESSION["usuario"];
else
    $_SESSION["usuario"] = "Max Payne";
