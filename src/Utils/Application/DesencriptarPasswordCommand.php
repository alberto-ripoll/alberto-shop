<?php
namespace Src\Utils\Application;
use AlbertoCore\Modulos\Crypt;

class DesencriptarPasswordCommand{
    public $crpyt;

    public function __construct(Crypt $crpyt){
        $this->crpyt = $crpyt;
    }
    public function __invoke(string $usuario){
        return $this->queryBuilder->getRow("SELECT * FROM usuarios WHERE username = :username",['username'=>$usuario]);
    }

}
