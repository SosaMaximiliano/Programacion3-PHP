<?php

class Usuario
{
    private $_nombre;
    private $_email;
    private $_clave;
    private $_IDUsuario;
    private $_fechaAlta;
    private static $autoinc = 1000;

    private static $_usuarios = array();

    public function __construct($nombre, $email, $clave)
    {
        $this->_nombre = $nombre;
        $this->_email = $email;
        $this->_clave = $clave;
        $this->_IDUsuario = Usuario::$autoinc++;
        $this->_fechaAlta = date("D d M Y");
    }

    public function MostrarDatos()
    {
        echo "Nombre: " . $this->_nombre . '<br>';
        echo "Correo: " . $this->_email . '<br>';
        echo "ID: " . $this->_IDUsuario . '<br>';
        echo "Fecha de alta: " . $this->_fechaAlta . '<br>';
    }

    public static function Add(Usuario $usuario)
    {
        //Validar

        array_push(Usuario::$_usuarios, $usuario);
    }

    public static function MostrarUsuarios()
    {
        //Validar que no sea null o vacio

        foreach (Usuario::$_usuarios as $usuario) {
            $usuario->MostrarDatos();
        }
    }

    public function MostrarDatosJson()
    {
        $datos =
            [
                "Nombre" => $this->_nombre,
                "Correo" => $this->_email,
                "ID" => $this->_IDUsuario,
                "Fecha" => $this->_fechaAlta
            ];
    }
}
