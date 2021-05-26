<?php
namespace Src\Utils\Infrastructure;

use Src\Utils\Infrastructure\NotificationInterface;
use Src\Utils\Domain\TelegramConstantes;

class TelegramNotification implements NotificationInterface {

    public function send($message){
        $token = TelegramConstantes::API_KEY;
        $chatId = TelegramConstantes::ID;
        $data = [
            'text' => $message,
            'chat_id' => $chatId,
        ];
        $result = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));
    }

}