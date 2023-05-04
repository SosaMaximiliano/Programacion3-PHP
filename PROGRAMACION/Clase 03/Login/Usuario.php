<?php

class Usuario
{
    private $_nombre = "";
    private $_email = "";
    private $_clave = "";
    private $_IDUsuario;
    private $_fechaAlta;
    private static $autoinc = 1000;
    private static $_usuarios = [];
    public $_datos = [];

    public function __construct($nombre, $email, $clave)
    {
        if ($nombre !== "" && $email !== "" && $clave !== "") {
            $this->_nombre = $nombre;
            $this->_email = $email;
            $this->_clave = $clave;
            $this->_IDUsuario = Usuario::$autoinc++;
            $this->_fechaAlta = date("D d M Y");
            $this->_datos = [
                "Nombre" => $this->_nombre,
                "Correo" => $this->_email,
                "ID" => $this->_IDUsuario,
                "Alta" => $this->_fechaAlta
            ];
            $this->EscribirDatos();
            echo 'Usuario '.$this->_nombre.' creado<br>';
        } else
            echo 'El usuario no pudo ser creado<br>';
    }

    public function MostrarDatos()
    {
        echo "Nombre: " . $this->_nombre . '<br>';
        echo "Correo: " . $this->_email . '<br>';
        echo "ID: " . $this->_IDUsuario . '<br>';
        echo "Fecha de alta: " . $this->_fechaAlta . '<br>';
        echo '<br>';
    }

    // public function MostrarDatos()
    // {
    //     echo json_encode($this->_datos, JSON_PRETTY_PRINT).'<br>';
    // }

    public static function Add(Usuario $usuario)
    {
        //Validar
        if(!($usuario->_nombre === "" && $usuario->_email === "" && $usuario->_clave ===""))
        {
            array_push(Usuario::$_usuarios, $usuario);
        }
    }

    public static function MostrarUsuarios()
    {
        //Validar que no sea null o vacio

        foreach (Usuario::$_usuarios as $usuario) {
            if (!is_null($usuario))
                $usuario->MostrarDatos();
            else
                continue;
        }
    }

    private function EscribirDatos()
    {
        $archivo = fopen("usuarios.json", "a");
        fwrite($archivo, json_encode($this->_datos, JSON_PRETTY_PRINT));
        fclose($archivo);
    }
}
