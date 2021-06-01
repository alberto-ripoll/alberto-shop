<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;

class ComprobarUsuarioExisteCommand{
    public $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }
    public function __invoke(string $usuario){
        return $this->queryBuilder->getRow("SELECT * FROM usuarios WHERE username = :username",['username'=>$usuario]);
    }

}
