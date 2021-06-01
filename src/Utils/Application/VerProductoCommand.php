<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;

class VerProductoCommand{
    public $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }
    public function __invoke(string $id){
        return $this->queryBuilder->getRow("SELECT * FROM productos WHERE id= (:id)",["id"=>$id]);

    }
}
