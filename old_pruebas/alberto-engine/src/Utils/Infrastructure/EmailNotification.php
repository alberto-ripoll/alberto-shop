<?php
namespace Src\Utils\Infrastructure;

use Src\Utils\Infrastructure\NotificationInterface;

class EmailNotification implements NotificationInterface {
    public function send($subject,$to,$from){
        echo "<b>$subject</b> is sending an email using <b>EmailNotification</b> services from <b>$from</b> to <b>$to</b>";
        
    }
}