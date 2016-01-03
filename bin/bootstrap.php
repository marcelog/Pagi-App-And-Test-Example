<?php
declare(ticks=1);
$myDir = realpath(implode(DIRECTORY_SEPARATOR, array(__DIR__, '..')));
define('APPLICATION_PATH', $myDir);
define('SOUNDS_PATH', $myDir . '/config/sounds');

require_once implode(DIRECTORY_SEPARATOR, array(
  __DIR__.
  'vendor',
  'autoload.php'
));

