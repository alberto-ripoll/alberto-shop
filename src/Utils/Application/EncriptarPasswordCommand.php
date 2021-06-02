<?php
namespace Src\Utils\Application;
use AlbertoCore\Modulos\Crypt;

class EncriptarPasswordCommand{
    public $crpyt;

    public function __construct(Crypt $crpyt){
        $this->crpyt = $crpyt;
    }
    public function __invoke(string $password){

        return $this->crpyt->crypt_msg($password);
    }

}
