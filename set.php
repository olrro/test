<?php

require __DIR__ . '/api/autoload.php';
require __DIR__ . '/config.php';

$bot_api_key  = $config['token'];
$bot_username = $config['username'];
$hook_url = $config['url'] . 'hook.php';

try {

    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $result = $telegram->setWebhook($hook_url);

    if ($result->isOk()) {
        echo $result->getDescription();
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

    echo $e->getMessage();

}
