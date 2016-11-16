<?php

require __DIR__ . '/vendor/autoload.php';

use Sx\Logger\Logger;
use Sx\Logger\Writers\FileWriter;
use Sx\Logger\Formatters\SimpleTextFormatter;

$writer = new FileWriter(__DIR__ . '/storage/filelog.log');
$formatter = new SimpleTextFormatter;
$fileLogger = new Logger($writer, $formatter);

$fileLogger->info('A user with IP [{ip}] has logged', [
    'ip' => $_SERVER['REMOTE_ADDR'],
]);
