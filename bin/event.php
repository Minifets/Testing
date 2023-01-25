<?php

require_once __DIR__ . '/../bootstrap.php';

$events = json_decode(file_get_contents(__DIR__ . '/../fixtures/events.json'), true);

foreach ($events as $event) {
    $queueName = 'client#' . $event['clientId'];
    $predis->rpush($queueName, $event['message']);
}