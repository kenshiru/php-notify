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
        $this->providers = array_merge($this->providers, (array) $providers);
    }

    /**
     * Проверяет интерфейсы провайдеров в массиве
     * @param array||null $providers
     * @return bool true - если все хорошо
     * @throws TypeError - если хотябы один из провайдеров не реализует интерфейс ProviderInterface
     */
    protected function checkProvidersList($providers=null)
    {
        foreach ((array) $providers as $provider) {
            if (! ($provider instanceof ProviderInterface) ) {
                throw new TypeError('provider not implement ProviderInterface');
            }
        }
        return true;
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
