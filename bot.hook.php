<?php

require_once __DIR__ . '/api/telegram/autoload.php';
require_once __DIR__ . '/bot.config.php';

$bot_api_key  = $config['token'];
$bot_username = $config['username'];
$hook_url = $config['url'] . 'bot.hook.php';

try {

    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $result = $telegram->setWebhook($hook_url);

    if ($result->isOk()) {
        echo $result->getDescription();
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

    echo $e->getMessage();

}
