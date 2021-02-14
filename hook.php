<?php

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

Predis\Autoloader::register();

$redis = new Predis\Client( $_ENV['REDIS_URL'] );
$database = $redis->get( 'database' );

if ( empty( $database['channels'] ) ) $database['channels'] = [];
if ( empty( $database['views'] ) ) $database['views'] = 1500;

try {

	$telegram = new Telegram( $config['token'], $config['name'] );

	$telegram->addCommandsPath( __DIR__ . '/commands' );
  $telegram->enableAdmins( [ 1235529311 ] );

	$telegram->handle();

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

	var_dump($e);

}

$redis->set( 'database', json_encode( $database ) );
