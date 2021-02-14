<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class SetViewsCommand extends UserCommand
{

    protected $name = 'setviews';
    protected $description = 'Данная команда устанавливает лимит по количеству просмотров рекламы';

    protected $usage = '/setviews <количество>';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        global $database;

        $message = $this->getMessage();
        $text = $message->getText(true);

        if ( !ctype_digit( $text ) ) {

          $this->replyToChat( $this->getDescription() );
          return $this->replyToChat( 'Использование команды: ' . $this->getUsage() );

        }

        $database['views'] = intval( $text );
        return $this->replyToChat( 'Новое количество просмотров было успешно установлено' );

    }
}
