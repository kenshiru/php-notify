<?php

require_once 'Base/AbstractProvider.php';

class EmailProvider extends AbstractProvider
{
    public function send($messageText, $messageData, $contactData, $additional)
    {
        echo "Отправляю сообщеньку: {$messageText}" . PHP_EOL;
        echo "Получатель: {$contactData['email']} {$contactData['name']}" . PHP_EOL;
        return true;
    }
}