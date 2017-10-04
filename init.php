<?php

require_once('Email/EmailNotification.php');

$messageData = ['text' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui ...', 'xls_path' => '/storage/exel.xls'];

$notification = new EmailNotification($messageData, null, ['group' => 'operator']);
$notification->send();