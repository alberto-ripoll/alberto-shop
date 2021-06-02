<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;
use Src\Utils\Application\EncriptarPasswordCommand;
class ComprobarPasswordCorrectaCommand{
    public $queryBuilder;
    public $encriptarPasswordCommand;

    public function __construct(QueryBuilder $queryBuilder,EncriptarPasswordCommand $encriptarPasswordCommand){
        $this->queryBuilder = $queryBuilder;
        $this->encriptarPasswordCommand = $encriptarPasswordCommand;

    }
    public function __invoke(string $usuario,string $password){
        ($this->encriptarPasswordCommand)($password);
        $password = ($this->encriptarPasswordCommand)($password);

        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password";

        return $this->queryBuilder->getRow($sql,['username'=>$usuario, 'password'=>$password]);
        // return $this->queryBuilder->getRow("SELECT * FROM framework WHERE username = $usuario && password = $password");
    }

}
