<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;

class RegistrarUsuarioCommand{
    public $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }
    public function __invoke(array $data){
        return $this->queryBuilder->getRow("INSERT INTO usuarios (nombre,ciudad,email,username,password) VALUES (:nombre,:ciudad,:email,:username,:password)",
        [
            'username'=>$data['username'],
            'nombre'=>$data['nombre'],
            'ciudad'=>$data['ciudad'],
            'email'=>$data['email'],
            'password'=>$data['password']
        ]
    );
    }

}
