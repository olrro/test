<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class RemoveVideoCommand extends UserCommand
{

    protected $name = 'removevideo';
    protected $description = 'Данная команда удаляет ссылку для накрутки рекламы на видео';

    protected $usage = '/removevideo <ID видео>';
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

        if ( isset( $database['channels'][$text] ) ) {
          unset( $database['channels'][$text] );
        }
        else {
          return $this->replyToChat( 'Такого видеоролика нет, возможно вы ошиблись' );
        }

        return $this->replyToChat( 'Видеоролик был успешно удален' );

    }
}
