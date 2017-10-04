<?php

require_once 'Base/AbstractNotification.php';
require_once 'EmailContact.php';
require_once 'EmailMessageBuilder.php';
require_once 'EmailProvider.php';

class EmailNotification extends AbstractNotification
{
    public function getContacts()
    {
        $contacts = [
            ['name' => 'Александр I', 'email' => 'a_1@a.a', 'group' => 'operator'],
            ['name' => 'Александр II', 'email' => 'a_2@a.a', 'group' => 'administrator'],
            ['name' => 'Александр III', 'email' => 'a_3@a.a', 'group' => 'operator']
        ];

        $contactsObjList = [];
        foreach ($contacts as $contact) {
            if ($contact['group'] == $this->additional['group'] ) {
                array_push($contactsObjList, (new EmailContact($contact)));
            }
        }
        return $contactsObjList;
    }

    public function messageBuilder()
    {
        return (new EmailMessageBuilder());
    }

    public function provider()
    {
        return (new EmailProvider());
    }
}
