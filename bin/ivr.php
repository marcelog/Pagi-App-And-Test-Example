<?php
require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'bootstrap.php'));
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');
$log->pushHandler(new StreamHandler(
  __DIR__ . '/../runtime/log/production.log', Logger::DEBUG
));


try
{
    $client = PAGI\Client\Impl\ClientImpl::getInstance();
    $client->setLogger($log);
    $app = new MyApp\App(array('pagiClient' => $client));
    $app->setLogger($log);

    $app->init();
    $app->run();
    $app->shutdown();
} catch(\Exception $exception) {
    $logger = $client->getAsteriskLogger();
    $logger->error($exception);
}

