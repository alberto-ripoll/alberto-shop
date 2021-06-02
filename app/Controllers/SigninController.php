<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use AlbertoCore\Modulos\Response;
use AlbertoCore\Modulos\Request;
use AlbertoCore\Modulos\Session;
use Src\Utils\Application\RegistrarUsuarioCommand;
use Src\Utils\Application\EncriptarPasswordCommand;

use Src\Utils\Application\ComprobarUsuarioExisteCommand;
use Src\Utils\Application\ValidarRequestCommand;
use Src\Utils\Domain\Contracts\SigninContract;

class SigninController extends Controller{
    public $comprobarUsuarioExisteCommand;
    public $validarRequestCommand;
    public $registrarUsuarioCommand;
    public $session;
    public $encriptarPasswordCommand;

    public function __construct(EncriptarPasswordCommand $encriptarPasswordCommand, Session $session, Request $request, Response $response, RegistrarUsuarioCommand $registrarUsuarioCommand, ValidarRequestCommand $validarRequestCommand, ComprobarUsuarioExisteCommand $comprobarUsuarioExisteCommand){
        $this->session = $session;
        $this->response = $response;
        $this->request = $request;
        $this->comprobarUsuarioExisteCommand = $comprobarUsuarioExisteCommand;
        $this->validarRequestCommand = $validarRequestCommand;
        $this->registrarUsuarioCommand = $registrarUsuarioCommand;
        $this->encriptarPasswordCommand = $encriptarPasswordCommand;
    }

        
    public function __invoke(){
        $num1 = random_int(10,20);
        $num2 = random_int(0,10);

        $this->responde('Signin',[
            "num1"=>$num1,
            "num2"=>$num2,
            "password"=>'',
            "email" => '',
            "ciudad" => '',
            "nombre" => '',
            "username"=>"",
            "validator"=>[],
            ]);
    }
    public function signin(){
        $resultado = $this->request->resultado;
        $num1 = $this->request->num1;
        $num2 = $this->request->num2;
        $nombre = $this->request->nombre;
        $email = $this->request->email;
        $ciudad = $this->request->ciudad;
        $username = $this->request->username;
        $password = $this->request->password;
        if ($num1-$num2!=$resultado){
            $num1 = random_int(10,20);
            $num2 = random_int(0,10);
            return $this->responde('Signin',[
                "num1"=>$num1,
                "num2"=>$num2,
                "password"=>$password,
                "email" => $email,
                "ciudad" => $ciudad,
                "nombre" => $nombre,
                "username"=>$username,
                "validator"=>['resultado'=>'No ha pasado la verificacion humana, compruebe la operacion'],
                ]);
        }
        $input = [
            'nombre'=>$nombre,
            'num1'=>$num1,
            'num2'=>$num2,
            'email'=>$email,
            'ciudad'=>$ciudad,
            'resultado'=>$resultado,
            'username'=>$username,
            'password'=>$password,
        ];
        $validator = ($this->validarRequestCommand)($input, SigninContract::$rules);
        if (!$validator['valid']){
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
                'validator'=>$validator,
                ]);   
        }
        $existe = ($this->comprobarUsuarioExisteCommand)($username);
        if ($existe){
            $validator['username'] = 'Este usuario ya existe';
            return $this->responde('Signin',[
                "password"=>$password,
                "num1"=>$num1,
                "num2"=>$num2,
                "email" => $email,
                "ciudad" => $ciudad,
                "nombre" => $nombre,
                "username"=>$username,
                "validator"=>$validator
                ]);
        }
        $hashedPassword = ($this->encriptarPasswordCommand)($password);
        $data = [
            'username' =>$username,
            'nombre' =>$nombre,
            'email' =>$email,
            'ciudad' =>$ciudad,
            'password' =>$hashedPassword,
            'username' =>$username,
        ];

        ($this->registrarUsuarioCommand)($data);
        $this->redirect= '/';
        $this->session->logged = true;
        $this->session->usuario = $username;
    }
}
?>