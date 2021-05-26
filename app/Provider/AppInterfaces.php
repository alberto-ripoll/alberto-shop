<?php
namespace App\Provider;

use Src\Utils\Infrastructure\NotificationInterface;
use Src\Utils\Infrastructure\TelegramNotification;
/**
 * Contenedor de Interfaces, encargada de asignar que 
 * clase resolverá la interfaz utilizada
 */
class AppInterfaces
{
    public static $interfaces = [
        NotificationInterface::class => TelegramNotification::class,
    ];
}
