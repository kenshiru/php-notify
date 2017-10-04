<?php

abstract class AbstractProvider
{
    public $additional;
    public function setAdditional($additional)
    {
        $this->additional = $additional;
    }

    /**
     * Логика отправки оповещений.
     * Имплементировть данный метод.
     *
     * @param $messageText - текст сообщения
     * @param $messageData - данные для формирования сообщения
     * @param $contactData - данные контакта
     * @param $additional - дополнительная информация
     * @return boolean - отправил / не отправил
     */
    abstract public function send($messageText, $messageData, $contactData, $additional);
}