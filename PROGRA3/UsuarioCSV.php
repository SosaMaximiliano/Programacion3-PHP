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
        self::Alta($this);
    }

    public function MostrarDatos()
    {
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                if ($this->_mail === $fila[2])
                {
                    echo "ID: $fila[4]<br>";
                    echo "Nombre: $fila[0]<br>";
                    echo "Apellido: $fila[1]<br>";
                    echo "Correo: $fila[2]<br>";
                    echo "Fecha: $fila[5]<br>";
                    fclose($archivo);
                    return true;
                }
            }
            echo "Usuario inexistente<br>";
        }
        fclose($archivo);
        return false;
    }

    public static function MostrarListado()
    {
        $cont = 0;
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                self::$usuarios[] = $fila;
            }
            fclose($archivo);

            foreach (self::$usuarios as $e)
            {
                $cont++;
                echo "<ul><u>USUARIO $cont</u>";
                foreach ($e as $v)
                {
                    echo "<li>$v</li>";
                }
                echo "<br>";
                echo "</ul";
            }
        }
    }

    private static function Equals(Usuario $u)
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
        if (self::Equals($u))
        {
            echo "El usuario $u->_nombre $u->_apellido ya se encuentra ingresado<br>";
            return false;
        }
        else
        {
            if ($archivo =  fopen("usuarios.csv", "a"))
            {
                $u->_id = self::UltimoID() + 1;
                fwrite($archivo, $u->_nombre . ";");
                fwrite($archivo, $u->_apellido . ";");
                fwrite($archivo, $u->_mail . ";");
                fwrite($archivo, $u->_clave . ";");
                fwrite($archivo, $u->_registro . ";");
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
                $idaux = $fila[5];
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
                else $aux = "$fila[0] $fila[1]";
            }
            fclose($archivo);
        }

        #SOBREESCRIBO EL ARCHIVO
        if ($archivo = fopen("usuarios.csv", "w"))
        {
            foreach ($usuariosAux as $e)
            {
                fputcsv($archivo, $e, ';');
            }
            fclose($archivo);
        }

        echo "Usuario $aux eliminado<br>";
    }

    public static function ValidarUsuario($mail, $clave)
    {
        if ($archivo = fopen("usuarios.csv", "r"))
        {
            while ($fila = fgetcsv($archivo, 0, ';'))
            {
                if ($fila[2] === $mail)
                {
                    if ($fila[3] === $clave)
                    {
                        fclose($archivo);
                        echo "Verificado<br>";
                        return true;
                    }
                    echo "Error en los datos<br>";
                    return false;
                }
            }
            echo "Usuario no registrado<br>";
            return false;
        }
    }
}