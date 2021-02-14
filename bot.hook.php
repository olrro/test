<?php

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bot.config.php';

try {

    $telegram = new Longman\TelegramBot\Telegram( $config['token'], $config['username'] );
    $result = $telegram->setWebhook( $config['url'] . 'bot.hook.php' );

    if ( $result->isOk() ) {
        echo $result->getDescription();
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

    echo $e->getMessage();

}
