<?php

require __DIR__ . '/api/autoload.php';
require __DIR__ . '/config.php';

$bot_api_key  = $config['token'];
$bot_username = $config['username'];

try {

    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $telegram->handle();

    $result = Request::sendMessage([
    'chat_id' => $chat_id,
    'text'    => 'Your utf8 text 😜 ...',
]);

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

    echo $e->getMessage();

}
