<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class AddChannelCommand extends UserCommand
{

    protected $name = 'addchannel';
    protected $description = 'Данная команда добавляет новую ссылку для просмотра';

    protected $usage = '/addchannel <ссылка на видео>';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        global $database;

        $message = $this->getMessage();
        $text = $message->getText(true);

        if ( !preg_match( '/^https:\/\/www.twitch.tv\/videos\/[0-9]{9}$/', $text ) ) {

          $this->replyToChat( $this->getDescription() );
          return $this->replyToChat( 'Использование команды: ' . $this->getUsage() );

        }

        $database['channels'][$text] = 0;
        return $this->replyToChat( 'Новый канал был успешно добавлен' );

    }
}
