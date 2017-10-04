<?php

require_once 'Interfaces/ProviderInterface.php';
require_once 'Interfaces/MessageInterface.php';

require_once 'Interfaces/Sms/SmsMessageInterface.php';
require_once 'Interfaces/Mandrill/MandrillMessageInterface.php';

require_once 'NotifyManager.php';

require_once 'Providers/MandrillProvider.php';
require_once 'Providers/SmsProvider.php';

require_once 'Messages/MandrillMessage.php';
require_once 'Messages/SmsMessage.php';


/**
 * Менеджер оповещений
 */
$notifyManager = new NotifyManager();

/**
 * Регистрируем провайдеров
 */
$notifyManager->registerProvider(new SmsProvider());
$notifyManager->registerProvider(new MandrillProvider());


/**
 * Формируем сообщения
 */

$messages = [];

$message_1 = new SmsMessage();
$message_1->text = 'SmsProvider: SMS for 3 phone numbers';
$message_1->phones = ['79990000011', '79990000012', '79990000013'];
array_push($messages, $message_1);

$message_2 = new SmsMessage();
$message_2->text = 'SmsProvider: SMS for alone phone number';
$message_2->phones = ['79990000023'];
array_push($messages, $message_2);

$message_3 = new MandrillMessage();
$message_3->text = 'MandrillProvider: Send three emails';
$message_3->emails = ['email_3_1@example.com', 'email_3_2@example.com', 'email_3_3@example.com'];
array_push($messages, $message_3);

/**
 * Пробуем отправлять по очереди
 */

foreach ($messages as $message) {
    $notifyManager->send($message);
}


