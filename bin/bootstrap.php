<?php
declare(ticks=1);
$myDir = realpath(__DIR__ . '/..');
define('APPLICATION_PATH', $myDir);
define('SOUNDS_PATH', $myDir . '/config/sounds');

require_once 'PAGI/Autoloader/Autoloader.php';
PAGI\Autoloader\Autoloader::register();

