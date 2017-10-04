<?php

abstract class AbstractNotification
{
    public $contacts;
    public $messageBuilder;
    public $provider;
    public $messageData;

    public function __construct($messageData, $providerData=null, $additionalData=null)
    {
        $this->messageBuilder = $this->messageBuilder();
        $this->provider = $this->provider();
        $this->provider->additional = $providerData;
        $this->additional = $additionalData;
        $this->contacts = $this->getContacts();
        $this->messageData = $messageData;
    }

    /**
     * Возвращает определенный сборщик сообщений
     * @return AbstractMessageBuilder
     */
    abstract public function messageBuilder();

    /**
     * Возвращает инстанс определенного провайдера (тот кто непосредственно отправляет)
     * @return AbstractProvider
     */
    abstract public function provider();

    /**
     * @return array - массив контактов
     */
    abstract public function getContacts();

    /**
     * @param mixed $additional - дополнительная информация которая будет проброшена в метод $provider->send(...)
     * @return bool
     */
    public function send($additional=null)
    {
        $success = true;
        /* @var Contact $contact */
        foreach ($this->contacts as $contact) {
            $messageText = $this->messageBuilder->getText($this->messageData, $contact->contactData);
            $success &= $this->provider->send($messageText, $this->messageData, $contact->contactData, $additional);
        }
        return $success;
    }

}
