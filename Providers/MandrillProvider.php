<?php

class MandrillProvider implements ProviderInterface
{
    public function can($message)
    {
        return $message instanceof MandrillMessage;
    }

    public function send($message)
    {
        if (!$this->can($message)) {
            throw new Exception('Unsupported message type');
        }

        foreach ($message->emails as $email) {
            echo "Send EMAIL \"{$message->text}\" to {$email}".PHP_EOL;
        }
        return true;

    }
}
