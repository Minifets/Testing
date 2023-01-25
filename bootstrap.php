<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/redis.php';

$predis = new Predis\Client(array(
    'scheme' => 'tcp',
    'host'   => REDIS_HOST,
    'port'   => REDIS_PORT,
));

$logger = new Monolog\Logger('worker', [
    new Monolog\Handler\StreamHandler(__DIR__ . '/logs/worker.log', Monolog\Logger::DEBUG),
]);
