<?php

/**
 * Interface ProviderInterface - базовый интерфейс провайдера
 */
interface ProviderInterface
{
    /**
     * @param $message - сообщение
     * @return boolean - отправил/не отправил
     * @throws Exception - если не может обработать данное сообщение
     */
    public function send($message);

    /**
     * Проверяет способность провайдера отправить сообщение $message
     * @param MessageInterface $message - сообщение
     * @return boolean - способен/не способен
     */
    public function can($message);
}