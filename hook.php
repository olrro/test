<?php

require_once __DIR__ . '/api/autoload.php';
require_once __DIR__ . '/config.php';

try {

    $bot = new \TelegramBot\Api\Client( $config['token'] );
    $chat_id = $message->getChat()->getId();

    if ( $chat_id != $config['admin_id'] ) {

      $bot->sendMessage( $chat_id, 'Вы не администратор!' . PHP_EOL . 'Ваш ID - ' . $chat_id );

    }
    else {

      $bot->command( 'dump', function ( $message ) use ( $bot ) {
          $bot->sendMessage( $chat_id, json_encode( $message ) );
      });

      $bot->command( 'setadcount', function ( $message ) use ( $bot ) {
          $bot->sendMessage( $chat_id, json_encode( $message ) );
      });

    }

    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {

    $e->getMessage();

}
