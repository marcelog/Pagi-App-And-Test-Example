<?php
require_once __DIR__ . '/bootstrap.php';

$client = PAGI\Client\Impl\ClientImpl::getInstance(array(
    'log4php.properties' => __DIR__ . '/../config/log4php.properties'
));

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

