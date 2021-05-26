<?php
namespace Src\Utils\Infrastructure\Exceptions;

use \Exception;

class ExceptionModule extends Exception{
    public $sourceError;
    public function __construct($err){
       $this->setError($err);
    }
    public function getSourceCode()
    {
        return $this->sourceError->getCode();
    }

    public function getSourceMessage()
    {
        return $this->sourceError->getMessage();
    }

    public function getSourceFile()
    {
        return $this->sourceError->getFile();
    }

    public function getSourceLine()
    {
        return $this->sourceError->getLine();
    }

    public function getSourceTraceAsString()
    {
        return $this->sourceError->getTraceAsString();
    }    

    public function setError($error){
        if (is_string($error)){
            $this->sourceError = new Exception($error);
        }
        else{
            $this->sourceError = $error;
        }

    }
}