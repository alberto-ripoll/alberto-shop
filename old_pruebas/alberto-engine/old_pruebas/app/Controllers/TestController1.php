<?php
namespace App\Controllers;


use App\Models\ArmarioModel;
use App\Models\ZapatoModel;
use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use Src\Utils\Infrastructure\NotificationInterface;
class TestController1 extends Controller{

    public $armario;
    public $zapato;
    public $notificationModule;

    public function __construct(Response $response, ArmarioModel $armario,ZapatoModel $zapato, NotificationInterface $notificationModule){
        $this->response = $response;
        $this->armario = $armario;
        $this->zapato = $zapato;
        $this->notificationModule = $notificationModule;
        // $this->response = $response;

    }
    public function __invoke(){
        $this->responde('home',[
            "armario"=>$this->armario,
            "zapato"=>$this->zapato
            ]);
    }
    public function test(){
        $this->armario->figura->setNombre('Pikachu');
        $this->armario->figura->setColor('Amarillo');
        $this->armario->user->setId('1A');
        $this->armario->user->setNombre('Alberto');
        $this->armario->user->setEdad(19);
        $this->zapato::setColor('Negro');
        $this->zapato::setTalla('43');

        $this->notificationModule->send('Hola crack','micorreo@mail.com','tucorreo@gmail.com');
        return $this->responde('home',[
            "armario"=>$this->armario,
            "zapato"=>$this->zapato
            ]);
    }
    
    public function metodo($params){

        echo "\n******************************** METODO SE EJECUTA, parámetros: \n ********************************";
        var_dump($params) ;
        echo "****************************************************************************************************\n";

    }
}



?>