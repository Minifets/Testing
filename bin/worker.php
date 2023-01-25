<?php

require_once __DIR__ . '/../bootstrap.php';

$logger->debug('Worker Starting.');

$clientId  = $argv[1] ?? null;

if (!is_numeric($clientId)) {
    $logger->error('Client ID must be an integer.');
    exit(1);
} else {
    $logger->debug('Client ID: ' . $clientId);
}

do {
    $queueName = 'client#' . $clientId;
    $job = $predis->blpop($queueName, 10);

    if($job)
    {
        $jobMessage = $job[1];
        $random = random_int(1, 5);

        if ($random === 4) {
            $logger->error('Job Failed: ' . $jobMessage . ' - retrying');
            $predis->lpush($queueName, $jobMessage);
        } else {
            sleep(1);
            $logger->info('Job Completed: Client #' . $clientId . ', Job: '  . $jobMessage);
        }
    }
} while (true);