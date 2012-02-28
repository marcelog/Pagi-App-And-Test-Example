<?php
$myDir = realpath(__DIR__ . '/..');
define('APPLICATION_PATH', $myDir);
$srcDir = $myDir . '/src/php';

require_once 'PAGI/Autoloader/Autoloader.php';
PAGI\Autoloader\Autoloader::register();

