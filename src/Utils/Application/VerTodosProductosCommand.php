<?php
namespace Src\Utils\Application;
use AlbertoCore\DB\QueryBuilder;

class VerTodosProductosCommand{
    public $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }
    public function __invoke(){
        return $this->queryBuilder->getArray("SELECT * FROM productos");

    }
}
