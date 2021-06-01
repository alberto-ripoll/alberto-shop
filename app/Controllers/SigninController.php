<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Session;
use Src\Utils\Application\RegistrarUsuarioCommand;

use Src\Utils\Application\ComprobarUsuarioExisteCommand;
use Src\Utils\Application\ValidarRequestCommand;
use Src\Utils\Domain\Contracts\SigninContract;

class SigninController extends Controller{
    public $comprobarUsuarioExisteCommand;
    public $validarRequestCommand;
    public $registrarUsuarioCommand;
    public $session;

    public function __construct(Session $session, Request $request, Response $response, RegistrarUsuarioCommand $registrarUsuarioCommand, ValidarRequestCommand $validarRequestCommand, ComprobarUsuarioExisteCommand $comprobarUsuarioExisteCommand){
        $this->session = $session;
        $this->response = $response;
        $this->request = $request;
        $this->comprobarUsuarioExisteCommand = $comprobarUsuarioExisteCommand;
        $this->validarRequestCommand = $validarRequestCommand;
        $this->registrarUsuarioCommand = $registrarUsuarioCommand;
    }

        
    public function __invoke(){
        $num1 = random_int(10,20);
        $num2 = random_int(0,10);

        $this->responde('Signin',[
            "num1"=>$num1,
            "num2"=>$num2,
            "email" => '',
            "ciudad" => '',
            "nombre" => '',
            "username"=>"",
            "message"=>"",
            "password"=>""

            ]);
    }
    public function signin(){
        $nombre = $this->request->nombre;
        $num1 = $this->request->num1;
        $num2 = $this->request->num2;
        $email = $this->request->email;
        $ciudad = $this->request->ciudad;
        $resultado = $this->request->resultado;
        $username = $this->request->username;
        $password = $this->request->password;
        $cumpleContrato = ($this->validarRequestCommand)($this->request, SigninContract::$rules);
        if (!$cumpleContrato){
            $num1 = random_int(10,20);
            $num2 = random_int(0,10);
            return $this->responde('Signin',[
                "password"=>$password,
                "num1"=>$num1,
                "num2"=>$num2,
                "email" => $email,
                "ciudad" => $ciudad,
                "nombre" => $nombre,
                "username"=>$username,
                "message"=>"Rellene los campos obligatorios"
                ]);   
        }
        $existe = ($this->comprobarUsuarioExisteCommand)($username);
        if ($existe){
            return $this->responde('Signin',[
                "username"=>$username,
                "message"=>"Este usuario ya existe"
                ]);
        }
        $data = [
            'username' =>$username,
            'nombre' =>$nombre,
            'email' =>$email,
            'ciudad' =>$ciudad,
            'password' =>$password,
            'username' =>$username,
        ];

        ($this->registrarUsuarioCommand)($data);
        $this->redirect= '/';
        $this->session->logged = true;
        $this->session->usuario = $username;
    }
}
?>