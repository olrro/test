<?php

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bot.config.php';

Predis\Autoloader::register();

$redis = new Predis\Client( $_ENV['REDIS_URL'] );
$database = @json_decode( $redis->get( 'database' ), 1 );

if ( empty( $database['channels'] ) ) $database['channels'] = [];
if ( empty( $database['views'] ) ) $database['views'] = 1500;

try {

	$telegram = new Telegram( $config['token'], $config['name'] );

	$telegram->enableAdmins( $config['admins'] );
	$telegram->addCommandsPath( __DIR__ . '/commands' );

	$telegram->handle();

} catch (Longman\TelegramBot\Exception\TelegramException $e) {

	var_dump($e);

}

$redis->set( 'database', json_encode( $database ) );
