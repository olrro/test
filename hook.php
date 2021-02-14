<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/api/predis/autoload.php';
require_once __DIR__ . '/api/telegram/autoload.php';
require_once __DIR__ . '/config.php';

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

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
