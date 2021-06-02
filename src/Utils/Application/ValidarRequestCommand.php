<?php
namespace Src\Utils\Application;

class ValidarRequestCommand{
    public $response = [
        'valid'=>true,
    ];

    public function isRequired($campo,$input){
        if (!empty($input[$campo])){
            return true;
        } 
        $this->response['valid']=false;
        $this->response[$campo]='Este campo no puede estar vacío.';      
        return false;
    }
    public function isString($campo,$input){
        if (is_string($input[$campo]) || empty($input[$campo]) ){
            return true;
        }
        $this->response['valid']=false;
        $this->response[$campo]='Este campo debe ser una cadena de texto.';
        return false;

    }
    public function isNumeric($campo,$input){
        if (is_numeric($input[$campo]) || empty($input[$campo])){
            return true;
        }
        $this->response['valid']=false;
        $this->response[$campo]='Este campo debe ser un numero.';
        return false;
    }
    public function isAlphaNumeric($campo,$input){
        if (ctype_alnum($input[$campo]) || empty($input[$campo])) {
            return true;
        }
        $this->response['valid']=false;
        $this->response[$campo]='Este campo no permite espacios ni caracteres especiales.';
        return false;
    }
    public function isEmail($campo,$input){
        if (filter_var($input[$campo],FILTER_VALIDATE_EMAIL) || empty($input[$campo])) {
            return true;
        }
        $this->response['valid']=false;
        $this->response[$campo]='El Email no es valido';
        return false;
    }
    public function onlyLetters($campo,$input){
        if (ctype_alpha($input[$campo]) || empty($input[$campo])) {
            return true;
        }
        $this->response['valid']=false;
        $this->response[$campo]='Este campo solo permite letras';
        return false;
    }
    public function __invoke($input, array $contrato){
        foreach ($contrato as $key =>$value) {
            foreach ($value as $campo) { 
                call_user_func_array([$this,$campo],[$key,$input]);
            }
        }
        return $this->response;
    }
}