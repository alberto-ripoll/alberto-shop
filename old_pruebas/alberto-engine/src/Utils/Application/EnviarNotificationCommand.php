<?php
namespace Src\Utils\Application;
use Src\Utils\Infrastructure\NotificationInterface;

class EnviarNotificationCommand{
    public $telegramInterface;

    public function __construct(NotificationInterface $telegramInterface){
        $this->telegramInterface = $telegramInterface;
    }
    public function __invoke(string $mensaje){
        $this->telegramInterface->send($mensaje);
    }

}
