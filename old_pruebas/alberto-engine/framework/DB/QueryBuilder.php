<?php
namespace AlbertoCore\DB;
use AlbertoCore\DB\Connector;

class QueryBuilder{
    public $connector;

    public function checkConnection(){
        $this->connector = Connector::checkConnection();
    }

    public function prepare($sql,$params = false){
        $this->checkConnection();
        if ($params){
            $query = $this->connector->prepare($sql);
            $query->execute($params);    
        }
        else{
            $query = $this->connector->query($sql);
        }
        return $query;

    }
    public function getRow($sql,$params = false){
        $query = $this->prepare($sql, $params);
        return $query->fetch();
    }
    public function getArray($sql,$params = false){
        $query = $this->prepare($sql, $params);
        return $query->fetchAll();
    }
    public function execute($sql,$params = false){
        $query = $this->prepare($sql, $params);     
    }
    public function begin(){
        $this->checkConnection();
        $this->connector->beginTransaction();
    }
    public function rollback(){
        $this->checkConnection();
        $this->connector->rollBack();
    }
    public function commit(){
        $this->checkConnection();
        $this->connector->commit();

    }
}