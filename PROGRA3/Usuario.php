<?php

class Usuario
{
    private $_nombre;
    private $_apellido;
    private $_id;
    private $_mail;
    private static $id;

    public function __construct($nombre, $apellido, $mail)
    {
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_mail = $mail;
        self::$id = self::UltimoID() + 1;
        self::Alta($this);
    }

    public function getMail()
    {
        return $this->_mail;
    }

    public function MostrarDatos()
    {
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                if ($this->_mail === $fila[2])
                {
                    echo "Nombre: $fila[0]<br>";
                    echo "Apellido: $fila[1]<br>";
                    echo "Correo: $fila[2]<br>";
                }
            }
            fclose($archivo);
            return false;
        }
    }

    private function Equals(Usuario $u)
    {
        $maux = "";
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                $maux = $fila[2];
                if ($u->_mail === $maux)
                {
                    fclose($archivo);
                    return true;
                }
            }
            fclose($archivo);
            return false;
        }
    }
    private static function Alta(Usuario $u)
    {
        if ($u->Equals($u))
        {
            echo "El usuario ya se encuentra ingresado<br>";
            return false;
        }
        else
        {
            if ($archivo =  fopen("usuarios.csv", "a"))
            {
                $u->_id = self::$id;
                fwrite($archivo, $u->_nombre . ";");
                fwrite($archivo, $u->_apellido . ";");
                fwrite($archivo, $u->_mail . ";");
                fwrite($archivo, $u->_id . "\n");
                fclose($archivo);
                echo "Usuario ingresado correctamente<br>";
                return true;
            }
            else echo "No se pudo abrir el archivo para escritura";
            return false;
        }
    }

    private static function UltimoID()
    {
        $idaux = 0;
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                $idaux = $fila[3];
            }
            if ($idaux == 0)
                $idaux = 300;
            return $idaux;
        }
    }

    public static function Baja(Usuario $u)
    {
        #GUARDO EL ARCHIVO EN UN ARRAY
        $usuariosAux = array();
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                if ($u->_mail !== $fila[2])
                {
                    $usuariosAux[] = $fila;
                }
            }
            fclose($archivo);
        }

        var_dump($usuariosAux);

        #SOBREESCRIBO EL ARCHIVO
        if ($archivo = fopen("usuarios.csv", "w"))
        {
            foreach ($usuariosAux as $e)
            {
                fputcsv($archivo, $e, ';');
            }
            fclose($archivo);
        }
    }
}
