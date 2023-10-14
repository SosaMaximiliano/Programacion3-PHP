<?php

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
        self::AltaJSON($this);
    }

    public function MostrarDatosJSON()
    {
        $datos = self::LeerJSON();
        foreach ($datos as $e)
        {
            if ($this->_mail === $e["mail"])
            {
                foreach ($e as $key => $value)
                {
                    if ($key != "clave")
                        echo "$key : $value <br>";
                }
            }
        }
    }

    public static function MostrarListadoJSON()
    {
        $datos = self::LeerJSON();
        foreach ($datos as $e)
        {
            foreach ($e as $key => $value)
            {
                if ($key != "clave")
                    echo "$key : $value <br>";
            }
            echo '<br>';
        }
    }

    private static function ExisteID($id)
    {
        $listado = self::LeerJSON();
        foreach ($listado as $e)
        {
            if ($e["id"] === $id)
                return true;
        }
        return false;
    }

    public static function EqualsJSON(Usuario $u)
    {
        $listado = self::LeerJSON();
        foreach ($listado as $e)
        {
            if ($e["mail"] == $u->_mail)
                return true;
        }
        return false;
    }

    private static function AltaJSON(Usuario $u)
    {
        #CARGO LA LISTA DE USUARIOS
        $usuarios = self::LeerJSON();

        #REVISO SI EL USUARIO EXISTE
        if (self::EqualsJSON($u))
        {
            echo "El usuario $u->_nombre $u->_apellido ya se encuentra ingresado<br>";
            return false;
        }
        else
        #CARGO LOS DATOS
        {
            $usuarioAux = array(
                "id" => $u->_id = self::UltimoIDJSON() + 1,
                "nombre" => $u->_nombre,
                "apellido" => $u->_apellido,
                "mail" => $u->_mail,
                "clave" => $u->_clave,
                "registro" => $u->_registro,
            );
            #AGREGO EL USUARIO A LA LISTA
            $usuarios[] = $usuarioAux;
            $jsonData = json_encode($usuarios, JSON_PRETTY_PRINT);

            if ($archivo = fopen("usuarios.json", "w"))
            {
                fwrite($archivo, $jsonData . "\n");
                fclose($archivo);
                echo "Usuario ingresado correctamente<br>";
                self::$usuarios = $usuarios;
                return true;
            }
            else echo "No se pudo abrir el archivo para escritura";
            return false;
        }
    }

    public static function LeerJSON()
    {
        $contenido = file_get_contents("usuarios.json");
        return json_decode($contenido, true);
    }

    public static function UltimoIDJSON()
    {
        $listado = self::LeerJSON();
        if (!empty($listado))
        {
            $ultimoUsuario = end($listado);
            $idaux = $ultimoUsuario["id"];
        }
        else
            $idaux = 300;
        return $idaux;
    }

    public static function BajaJSON($id)
    {
        #GUARDO EL ARCHIVO EN UN ARRAY
        $usuariosIn = self::LeerJSON();
        $usuariosOut = array();

        #REVISO SI EXISTE
        if (!Usuario::ExisteID($id))
        {
            echo "El usuario no existe";
            return false;
        }
        else
        {
            foreach ($usuariosIn as $e)
            {
                if ($e["id"] !== $id)
                {
                    $usuariosOut[] = $e;
                }
            }
            $jsonData = json_encode($usuariosOut, JSON_PRETTY_PRINT);

            #SOBREESCRIBO EL ARCHIVO SIN EL REGISTRO
            if ($archivo = fopen("usuarios.json", "w"))
            {
                fwrite($archivo, $jsonData . "\n");
                fclose($archivo);
                echo "Usuario eliminado correctamente<br>";
                self::$usuarios = $usuariosOut;
                return true;
            }
            else echo "No se pudo abrir el archivo para escritura";
            return false;
        }
    }

    public static function ValidarUsuarioJSON($mail, $clave)
    {
        $listado = self::LeerJSON();
        foreach ($listado as $e)
        {
            if ($e["mail"] === $mail && $e["clave"] === $clave)
                return true;
        }
        echo "Usuario no registrado<br>";
        return false;
    }
}
