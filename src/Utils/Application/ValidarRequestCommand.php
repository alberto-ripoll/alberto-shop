<?php
namespace Src\Utils\Application;

class ValidarRequestCommand{

    public function isRequired($campo){
        if ($campo !== ''){
            return true;
        } 
        echo "PETO EN REQUIRED de $campo";
        return false;
    }
    public function isString($campo){
        if (is_string($campo)){
            return true;
        }
        echo "PETO EN isString de $campo";

        return false;

    }
    public function isNumeric($campo){
        if (is_nan($campo)){
        echo "PETO EN isNumeric de $campo";

            return false;
        }

        return true;
    }
    public function isAlphaNumeric($campo){
        if (ctype_alnum($campo)) {
            return true;
        }
        echo "PETO EN isAlphaNumeric de $campo";

        return false;
    }
    public function isEmail($campo){
        if (filter_var($campo,FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        echo "PETO EN isEmail de $campo";

        return false;
    }
    public function onlyLetters($campo){
        if (ctype_alpha($campo)) {
            return true;
        }
        echo "PETO EN onlyLetters de $campo";

        return false;
    }
    public function __invoke($req, array $contrato){
        foreach ($contrato as $key =>$value) {
            foreach ($value as $campo) {             
                if (call_user_func_array([$this,$campo],[$req->$key]) == false){
                    return false;
                }
            }
        }
        return true;
    }
}
