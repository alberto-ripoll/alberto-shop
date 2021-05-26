<?php
namespace App\Controllers;

use AlbertoCore\Modulos\Controller;
use Src\Utils\Application\EnviarNotificationCommand;

class NotificationController extends Controller{
    public $enviarNotificationCommand;

    public function __construct(EnviarNotificationCommand $enviarNotificationCommand){
        $this->enviarNotificationCommand = $enviarNotificationCommand;
    }
    public function __invoke(){
        ($this->enviarNotificationCommand)('HOLA MUNDO');
        $this->responde('telegram',[]);
    }

    public function init(){
        $this->responde('telegram',[]);
    }
}
?>