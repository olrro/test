<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bot.config.php';

Predis\Autoloader::register();

$redis = new Predis\Client( $_ENV['REDIS_URL'] );
$database = @json_decode( $redis->get( 'database' ), 1 );

if ( empty( $database['channels'] ) ) $database['channels'] = [];
if ( empty( $database['views'] ) ) $database['views'] = 1500;

$json = @json_decode( @file_get_contents( 'php://input' ), 1 );

if ( !json_last_error() ){

  if ( isset( $database['channels'][$json['channel']] ) ) {

    $database['channels'][$json['channel']]++;
    $redis->set( 'database', json_encode( $database ) );

  }

}
