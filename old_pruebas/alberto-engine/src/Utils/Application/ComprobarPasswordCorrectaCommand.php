<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;

class ComprobarPasswordCorrectaCommand{
    public $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }
    public function __invoke(string $usuario,string $password){
        $sql = "SELECT * FROM framework WHERE username = :username AND password = :password";

        return $this->queryBuilder->getRow($sql,['username'=>$usuario, 'password'=>$password]);
        // return $this->queryBuilder->getRow("SELECT * FROM framework WHERE username = $usuario && password = $password");
    }

}
