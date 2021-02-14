<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/api/predis/autoload.php';
require_once __DIR__ . '/api/telegram/autoload.php';
require_once __DIR__ . '/config.php';

Predis\Autoloader::register();

var_dump($_ENV);
echo getenv( 'REDIS_URL' );

$redis = new Predis\Client( getenv( 'REDIS_URL' ) );
$redis->set( 'dick', 'pick' );

echo $redis->get('dick');

$bot = new \TelegramBot\Api\Client( $config['token'] );

$bot->command( 'dump', function ( $message ) use ( $bot ) {
  $bot->sendMessage( $message->getFrom()->getId(), $bot->getRawBody() );
  $bot->sendMessage( $message->getFrom()->getId(), $redis->get('dick') );
});

$bot->run();
