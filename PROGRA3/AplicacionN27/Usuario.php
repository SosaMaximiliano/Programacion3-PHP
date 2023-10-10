<?php

include_once 'AccesoDatos.php';

class Usuario
{
    private $_nombre;
    private $_apellido;
    private $_id;
    private $_mail;
    private $_clave;
    private $_registro;

    private static $usuarios = array();

    public function __construct($nombre, $apellido, $mail, $clave)
    {
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_mail = $mail;
        $this->_clave = $clave;
        $this->_registro = date('Y-m-d');
    }
}
