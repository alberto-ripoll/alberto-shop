<?php
namespace Src\Utils\Application;

class ValidarRequestCommand{
    public function __invoke($req, array $contrato){
        foreach ($contrato as $key =>$value) {
            if ($req->$key == ""){
                return false;
            }
        }
        return true;
    }
}
