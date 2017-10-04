<?php

abstract class AbstractContact
{
    public $contactData;

    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function getContactData()
    {
        return $this->contactData;
    }
}
