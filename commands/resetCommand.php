<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class ResetCommand extends UserCommand
{

    protected $name = 'reset';
    protected $description = 'Данная команда устанавливает лимит по количеству просмотров рекламы';

    protected $usage = '/reset';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        global $database;

        $database = [];

        return $this->replyToChat( 'Все данные были успешно удалены' );

    }
}
