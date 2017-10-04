<?php


abstract class AbstractMessageBuilder
{
    /**
     * @param $messageData - данные сообщения
     * @param $contactData - данные контакта
     * @return string - текст сообщения
     */
    abstract public function getText($messageData, $contactData);
}