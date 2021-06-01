<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Session;

use Src\Utils\Application\EstaLoggeadoCommand;
use Src\Utils\Application\VerTodosProductosCommand;

class PrincipalController extends Controller{
    public $estaLoggeadoCommand;
    public function __construct(Session $session, Response $response, EstaLoggeadoCommand $estaLoggeadoCommand, VerTodosProductosCommand $verTodosProductosCommand  ){
        $this->session = $session;
        $this->response = $response;
        $this->estaLoggeadoCommand = $estaLoggeadoCommand;
        $this->verTodosProductosCommand = $verTodosProductosCommand;
    }
    public function __invoke(){
        $isLogged = $this->session->logged;
        $allProducts = ($this->verTodosProductosCommand)();

        $this->responde('Principal',[
            "isLogged" => $isLogged  ,
            "productos"=>$allProducts
        ]);
    }
}



?>