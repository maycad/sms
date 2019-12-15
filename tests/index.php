<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MayCad\SMS\SMS;

$sms = new SMS(['username' => 'richard', 'password' => '123456', 'from' => 'MayCad']);

$sms->send('22893138706', 'Hello World');