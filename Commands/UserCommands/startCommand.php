<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class StartCommand extends UserCommand
{

    protected $name = 'start';
    protected $description = 'Данная команда выводит приветствие';

    protected $usage = '/start';
    protected $version = '1.0';


    public function execute(): ServerResponse
    {

        return $this->replyToChat(
          'Привет! Я бот для накрутки рекламы на Twitch'
          . PHP_EOL .
          'Напиши команду /help, чтобы увидеть все мои команды'
        );

    }
}
