<?php

require_once 'Base/AbstractMessageBuilder.php';

class EmailMessageBuilder extends AbstractMessageBuilder
{
    public function getText($messageData, $contactData)
    {
        return "Сообщенька [{$messageData['text']}] для {$contactData['name']}";
    }
}