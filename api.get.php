<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

Predis\Autoloader::register();

$redis = new Predis\Client( $_ENV['REDIS_URL'] );
$database = @json_decode( $redis->get( 'database' ), 1 );

if ( empty( $database['channels'] ) ) $database['channels'] = [];
if ( empty( $database['views'] ) ) $database['views'] = 1500;

foreach ( $database['channels'] as $url => $views ) {

  if ( $views < $database['views'] ) {
    exit( json_encode( [ 'channel' => $url ] ) );
  }

}
