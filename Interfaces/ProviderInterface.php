<?php

interface ProviderInterface
{
    public function send($message);
    public function can($message);
}