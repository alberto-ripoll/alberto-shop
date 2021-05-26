<?php
namespace AlbertoCore\DB;

class Connector{
    public static $connections;
    public static $connection = false;
    public static $params = [
        "database"=>'',
        "gestor" => '',
        "host"=>'',
        "port" => '',
        "dbname"=>'',
        "user"=>'',
        "password"=>''
    ];

    public static function addParam(array $param){
        foreach($param as $key => $value){
            self::$params[$key] =$value;
        }
    }
    public static function connect(){
        if(file_exists( alRUTA  . 'config/db.php'))
        require_once alRUTA  . 'config/db.php';
        
        $dsn = self::$params['gestor'].":host=".self::$params["host"].";dbname=".self::$params['dbname'].";port=".self::$params['port'];

        self::$connections[self::$params["database"]] = new \PDO($dsn, self::$params['user'], self::$params['password']);
        self::$connection = self::$connections[self::$params["database"]];
        self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return self::$connection;
    }

    public static function checkConnection(){
        if (!self::$connection){
            return self::connect();
        };
        return self::$connection;
    }
}