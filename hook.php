<?php

require_once __DIR__ . '/api/predis/autoload.php';
require_once __DIR__ . '/api/telegram/autoload.php';
require_once __DIR__ . '/config.php';

try {

    Predis\Autoloader::register();

    $redis = new Predis\Client( getenv( 'REDIS_URL' ) );
    $redis->set( 'dick', 'pick' );

    $bot = new \TelegramBot\Api\Client( $config['token'] );

    $bot->command( 'dump', function ( $message ) use ( $bot ) {
      $bot->sendMessage( $message->getFrom()->getId(), $bot->getRawBody() );
      $bot->sendMessage( $message->getFrom()->getId(), $redis->get('dick') );
    });

    $bot->run();

} catch (\Exception $e) {

    $e->getMessage();

}
