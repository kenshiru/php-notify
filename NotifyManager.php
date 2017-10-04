<?php

class NotifyManager {

    /**
     * @var array - провайдеры умеют отправлять сообщения определенного вида
     */
    public $providers = array();

    /**
     * NotifyManager constructor.
     * @param null $providers
     */
    public function __construct($providers=null)
    {
        $this->checkProvidersList($providers);
        foreach ((array) $providers as $provider) {
            $this->registerProvider($provider);
        }
    }

    /**
     * Добавляет провайдера в пулл провайдеров
     * @param ProviderInterface $provider - провайдер
     */
    public function registerProvider(ProviderInterface $provider)
    {
        array_push($this->providers, $provider);
    }

    /**
     * Подбирает провайдера из пулла (согласно интерфейсу сообщения).
     * Провайдер подбирается первый попавшийся
     * @param MessageInterface $message - сообщение для отправки
     * @throws Exception - если не нашел подходящего провайдера
     * @return boolean - отправил/не отправил
     */
    public function send($message)
    {
        foreach ($this->providers as $provider) {
            if ($provider->can($message)) {
                return $provider->send($message);
            }
        }
        throw new Exception('provider not found');
    }

}
