<?php

namespace AlbertoCore\Modulos;
use AlbertoCore\Modulos\View;

/** 
 * Modulo con la información de la respuesta
 */
class Response
{
    public $viewname = false;
    public $data;
    public $view;
    public $status;
    public $file = false;
    public function __construct(View $view)
    {
        $this->view = $view;
    }
    /**
     * Llama a la vista con los datos necesarios y cierra el ciclo
     * de la petición
     *
     * @return void
     */
    public function send()
    {
        http_response_code($this->status);
        if ($this->file){
            return $this->sendFile();
        }
        if ($this->view){
            ($this->view)($this->viewname,$this->data);
        }else{
            header('Content-Type: application/json');
            echo json_encode($this->data);
            // return $this->data;
        }
        session_write_close();
        if (function_exists('fastcgi_finish_request'))
        fastcgi_finish_request();
    }
    /**
     * Guarda en sus atributos propios los datos recibidos por el 
     * controlador
     * @param array $res
     * @return void
     */
    public function res(array $res)
    {
        $this->status = $res["status"];
        $this->data = $res["data"];
        $this->viewname = $res["viewname"];

        return $this;
    }
    /**
     * Devuelve el archivo que le pida el controlador
     *
     * @return mixed archivo
     */
    private function sendFile(){
        $file = $this->file;
        $fileName = explode('/',$file);
        $fileName = end($fileName);
 
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Transfer-Encoding: binary");
        header("Content-Type: binary/octet-stream");
        header("Content-Disposition: attachment; filename=" . $fileName);
        header('Pragma: no-cache');
        header("Content-length: " . filesize($file));
 
        return readfile($file);     
    }
}
