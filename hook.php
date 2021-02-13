<?php

require_once __DIR__ . '/api/autoload.php';
require_once __DIR__ . '/config.php';

try {

    $bot = new \TelegramBot\Api\Client( $config['token'] );

    $bot->command('ping', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'pong!');
    });

    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {

    $e->getMessage();

}
