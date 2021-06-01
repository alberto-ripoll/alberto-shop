<?php
namespace AlbertoCore\Modulos;
/**
 * Clase base de los controladores
 */
class Controller{
    public $request;
    public $redirect = false;
    public $response;
    public $viewname = false;
    public $data = [];
    public $file = false;
    /**
     * Almacena en los atributos propios los calculados por el controlador 
     * @param string $vistaname
     * @param array $params
     * @return void
     */
    public function responde($vistaname, array $params = []){
        $this->data = array_merge($this->data, $params);
        $this->viewname = $vistaname;          
    }
}