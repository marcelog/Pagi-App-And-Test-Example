<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'bootstrap.php'));

$client = PAGI\Client\Impl\ClientImpl::getInstance();

try
{
    $app = new App(array('pagiClient' => $client));
    $app->init();
    $app->run();
    $app->shutdown();
} catch(\Exception $exception) {
    $logger = $client->getAsteriskLogger();
    $logger->error($exception);
}

