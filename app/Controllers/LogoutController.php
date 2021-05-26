<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Session;



class LogoutController extends Controller{
    public $session;

    public function __construct(Session $session, Request $request, Response $response){
        $this->session = $session;
        $this->response = $response;
        $this->request = $request;
    }

        
    public function __invoke(){
        $this->redirect= '/';
        $this->session->logged = false;
    }
}



?>