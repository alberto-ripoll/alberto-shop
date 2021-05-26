<?php
namespace AlbertoCore\Modulos;

class CustomExcepcion extends \Exception{
    public function __construct($errno, $errstr, $errfile, $errline)
    {
        $this->message = $errstr;
        $this->code = $errno;
        $this->file = $errfile;
        $this->line = $errline;
    }
}