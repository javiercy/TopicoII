<?php

class Usuario
{
    private $nombre;
    private $clave;

    public function __construct($nombre, $clave)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getClave()
    {
        return $this->clave;
    }

    // Verifica si un usuario existe en el archivo CSV
    public static function autenticar($nombre, $clave, $archivo = 'usuarios.csv')
    {
        if (file_exists($archivo)) {
            $fp = fopen($archivo, 'r');
            while (($datos = fgetcsv($fp, 1000, ',')) !== false) {
                if ($nombre === $datos[0] && $clave === $datos[1]) {
                    fclose($fp);
                    return new Usuario($nombre, $clave);
                }
            }
            fclose($fp);
        }
        return null;
    }

    // Registra un nuevo usuario en el archivo CSV si no existe
    public static function registrar($nombre, $clave, $archivo = 'usuarios.csv')
    {
        $nombre = trim($nombre);
        $clave = trim($clave);

        // No permitir comas en usuario o clave
        if (strpos($nombre, ',') !== false || strpos($clave, ',') !== false) {
            return false; // Formato inválido
        }

        // Verifica si el usuario ya existe
        if (file_exists($archivo)) {
            $fp = fopen($archivo, 'r');
            while (($datos = fgetcsv($fp, 1000, ',')) !== false) {
                if ($nombre === trim($datos[0])) {
                    fclose($fp);
                    return false; // Usuario ya existe
                }
            }
            fclose($fp);
        }
        // Agrega el usuario correctamente
        $fp = fopen($archivo, 'a');
        fputcsv($fp, [$nombre, $clave]);
        //fwrite($fp, PHP_EOL); 
        fclose($fp);
        return true;
    }
}