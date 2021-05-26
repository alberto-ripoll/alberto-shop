<?php
namespace Src\Utils\Infrastructure;

interface NotificationInterface {
    public function send($message);
}