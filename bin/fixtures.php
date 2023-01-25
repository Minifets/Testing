<?php

$events = [];

for ($i = 1; $i < 100000; $i++) {
    $events[] = [
        'clientId' => random_int(1, 1000),
        'message' => 'Event #' . $i,
    ];
}

file_put_contents(__DIR__ . '/../fixtures/events.json', json_encode($events));