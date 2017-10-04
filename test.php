<?php

require_once 'Interfaces/ProviderInterface.php';


require_once 'Interfaces/Sms/SmsMessageInterface.php';

class SmsMessage implements SmsMessageInterface
{
    public $text;
    public $phones;
}

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


require_once 'Interfaces/Mandrill/MandrillMessageInterface.php';

class MandrillMessage implements MandrillMessageInterface
{
    public $emails;
    public $text;
}

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


$providers = [
    new SmsProvider(),
    new MandrillProvider()
];

$messages = [];

$message_1 = new SmsMessage();
$message_1->text = 'SmsProvider: The greatest message#1 (SMS for 3 phone numbers)';
$message_1->phones = ['79990000011', '79990000012', '79990000013'];
array_push($messages, $message_1);

$message_2 = new SmsMessage();
$message_2->text = 'SmsProvider: The greatest message#2 (SMS for alone phone number)';
$message_2->phones = ['79990000023'];
array_push($messages, $message_2);

$message_3 = new MandrillMessage();
$message_3->text = 'MandrillProvider: The greatest message#3 (Send three emails)';
$message_3->emails = ['email_3_1@example.com', 'email_3_2@example.com', 'email_3_3@example.com'];
array_push($messages, $message_3);

$message_4 = new SmsMessage();
$message_4->text = 'SmsProvider: The greatest message#4 (Send four phones)';
$message_4->phones = ['41', '42', '43', '45'];
array_push($messages, $message_4);


foreach ($messages as $message) {
    foreach ($providers as $provider) {
        if ($provider->can($message)) {
            $provider->send($message);
            var_dump($provider);
            echo '#####################' . PHP_EOL;
        }
    }
}


