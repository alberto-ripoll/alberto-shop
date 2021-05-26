<?php

namespace AlbertoCore\Modulos;
/**
 * Clase con los métodos necesarios para obtener información
 * de la petición HTTP
 */
class Request
{
    /**
     * Devuelve el método HTTP de la petición
     *
     * @return mixed Devuelve el meotodo o false
     */
    public function getMethod()
    {
        if (isset($_SERVER['REQUEST_METHOD'])){
            return $_SERVER['REQUEST_METHOD'];
        }
        return false;
    }

    /**
     * Devuelve la URI de la petición
     *
     * @return mixed Devuelve la URI o false
     */
    public function getUri(){
        if (isset($_SERVER['REQUEST_URI'])){
            return $_SERVER['REQUEST_URI'];
        }
        return false;
    }
    /**
     * Devuelve parámetros extras de la petición que se almacenan en la variable global Server o request
     *
     * @param [string] $name clave a buscar
     * @return mixed Devuelve la clave encontrada o false

     */
    public function __get(string $name)
    {
        if (isset($_REQUEST[$name])){
            return $_REQUEST[$name];
        }
        $name = strtoupper($name);
        if (isset($_SERVER['HTTP_'.$name])){
            return $_SERVER['HTTP_'.$name];
        }

        return false;
    }
    
}
