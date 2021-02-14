<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class StatCommand extends UserCommand
{

    protected $name = 'stat';
    protected $description = 'Данная команда выводит полную статистику';

    protected $usage = '/stat';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        global $database;

        $stat = [];

        $stat[] = '--------------';
        $stat[] = 'Количетво ссылок для просмотра - ' . count( $database['channels'] );
        $stat[] = 'Лимит просмотров - ' . $database['views'];
        $stat[] = '--------------';

        foreach ( $database['channels'] as $url => $views ) {
          $stat[] = $url . ' (' . $views . ')';
        }

        $this->replyToChat( 'Статистика:' );

        return $this->replyToChat( implode( "\n", $stat ) );

    }
}
