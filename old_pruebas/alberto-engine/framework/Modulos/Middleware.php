<?php
namespace AlbertoCore\Modulos;
use AlbertoCore\Modulos\Contenedor;
/**
 * Clase base de los middleware
 */
class Middleware
{
    public $middlewares = [];
    /**
     * Recorre el middleware y lo ejecuta en la posicion en la que este el cursor
     */
    public function next()
    {
        $middleware = array_shift($this->middlewares);

        return $this->execute($middleware);
    }
    public function execute($middleware)
    {
        if ($middleware && class_exists($middleware)) {
            $object = Contenedor::build($middleware);
            $response = $object->process($this->req, $this);
            return $response;
        } else {
            return $this->process($this->req, $this);
        }
    }
}
