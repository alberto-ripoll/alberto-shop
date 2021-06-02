<?php
namespace Src\Utils\Application;
use AlbertoCore\Modulos\Validator;

class ValidarRequestCommand{
    public $validator;
    public $validation;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function __invoke($input, array $contrato){
        foreach ($contrato as $key =>$value) {
            foreach ($value as $rule) { 
                $this->validation = ($this->validator)($rule,$key,$input);
            }
        }
        return $this->validation;
    }
}