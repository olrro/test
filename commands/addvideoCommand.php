<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class AddVideoCommand extends UserCommand
{

    protected $name = 'addvideo';
    protected $description = 'Данная команда добавляет новую ссылку для просмотра видео';

    protected $usage = '/addvideo <ID видео>';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        global $database;

        $message = $this->getMessage();
        $text = $message->getText(true);

        if ( !preg_match( '/^[0-9]{9}$/', $text ) ) {

          $this->replyToChat( $this->getDescription() );
          return $this->replyToChat( 'Использование команды: ' . $this->getUsage() );

        }

        $text = 'https://www.twitch.tv/videos/' . $text;

        $database['channels'][$text] = 0;
        return $this->replyToChat( 'Новый видеоролик был успешно добавлен' );

    }
}
