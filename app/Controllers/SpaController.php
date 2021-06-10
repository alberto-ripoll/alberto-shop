<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Session;

use Src\Utils\Application\EstaLoggeadoCommand;
use Src\Utils\Application\VerTodosProductosCommand;

class SpaController extends Controller{
    public $estaLoggeadoCommand;
    public function __construct(Session $session, Response $response, EstaLoggeadoCommand $estaLoggeadoCommand, VerTodosProductosCommand $verTodosProductosCommand  ){
        $this->session = $session;
        $this->response = $response;
        $this->estaLoggeadoCommand = $estaLoggeadoCommand;
        $this->verTodosProductosCommand = $verTodosProductosCommand;
    }
    public function __invoke(){
        $this->responde('index.html',[
        ]);
    }
}



?>