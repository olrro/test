<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class StartCommand extends SystemCommand
{

    protected $name = 'start';
    protected $description = 'Start command';

    protected $usage = '/start';
    protected $version = '1.2.0';

    public function execute(): ServerResponse
    {
        return $this->replyToChat(
            'Hi there!' . PHP_EOL .
            'Type /help to see all commands!'
        );
    }
}
