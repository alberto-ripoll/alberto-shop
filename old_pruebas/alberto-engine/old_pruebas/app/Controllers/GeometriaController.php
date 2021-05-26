<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use Src\Utils\Infrastructure\Exceptions\TestException;
use Src\Utils\Application\CalcularAreaCommand;
use Src\Utils\Application\EnviarNotificationCommand;
use AlbertoCore\DB\QueryBuilder;

class GeometriaController extends Controller{
    public $calcularAreaCommand;
    public $enviarNotificationCommand;
    public $queryBuilder;
    public function __construct(Response $response, CalcularAreaCommand $calcularAreaCommand, EnviarNotificationCommand $enviarNotificationCommand, QueryBuilder $queryBuilder){
        $this->response = $response;
        $this->calcularAreaCommand = $calcularAreaCommand;
        $this->enviarNotificationCommand = $enviarNotificationCommand;
        $this->queryBuilder = $queryBuilder;
    }

    public function __invoke(){
        try{
            $this->queryBuilder->getArray("SELECT * FROM framework");
            $area = ($this->calcularAreaCommand)($_POST);
            $this->responde('geometria',[$area]);

        }catch (\Exception $th) {
            // var_dump($th);
            if ($th->getCode()==8){
                ($this->enviarNotificationCommand)('Interfaz no cargada funciona');
                throw new TestException('Interfaz no cargada funciona');
            }else{
                throw new TestException('Ni puta idea');
            }

        }
    }

    public function init(){
        $this->file = alRUTA.'/storage/telegram-api.txt';
        $params["nombre"]='Pepe';
        $this->queryBuilder->begin();
        $this->queryBuilder->execute("INSERT INTO framework (nombre) VALUES (:nombre)",$params);
        $this->queryBuilder->rollback();
        $this->responde('geometria',[]);
    }
}
?>