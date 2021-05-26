<?php
namespace AlbertoCore\Modulos;

class Session{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    /**
     * Devuelve parámetros de la variable global Sesion
     *
     * @param [string] $name clave a buscar
     * @return mixed Devuelve la clave encontrada o false

     */
    public function __get(string $name)
    {
        if (isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
        return false;
    }
    public function __set(string $key, $value){
        $_SESSION[$key] = $value;
    }

}