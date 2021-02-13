<?php

require_once __DIR__ . '/api/autoload.php';
require_once __DIR__ . '/config.php';

try {

    $bot = new \TelegramBot\Api\Client( $config['token'] );

    $bot->command( 'dump', function ( $message ) use ( $bot ) {
      $bot->sendMessage( $message->getFrom()->getId(), $bot->getRawBody() );
      $bot->sendMessage( $message->getFrom()->getId(), json_encode( $message ) );
    });

    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {

    $e->getMessage();

}
