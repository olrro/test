<?php

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

Predis\Autoloader::register();

$redis = new Predis\Client( $_ENV['REDIS_URL'] );

$channels = $redis->get( 'channels' );

if ( empty( $channels ) ) {
  $channels = [];
}

try {

	$telegram = new Telegram( $config['token'], $config['name'] );

	$telegram->addCommandsPath( __DIR__ . '/commands' );
  $telegram->enableAdmins( [ 1235529311 ] );

	$telegram->handle();

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

	var_dump($e);

}
