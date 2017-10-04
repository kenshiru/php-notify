<?php

class SmsProvider implements ProviderInterface
{
    public function can($message)
    {
        return $message instanceof SmsMessageInterface;
    }

    public function send($message)
    {
        if (!$this->can($message)) {
            throw new Exception('Unsupported message type');
        }

        foreach ($message->phones as $phone) {
            echo "Send SMS \"{$message->text}\" to {$phone}".PHP_EOL;
        }
        return true;
    }

}
