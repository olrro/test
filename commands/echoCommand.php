<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class EchoCommand extends UserCommand
{

    protected $name = 'echo';
    protected $description = 'Show text';

    protected $usage = '/echo <text>';
    protected $version = '1.2.0';


    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $text    = $message->getText(true);

        if ($text === '') {
            return $this->replyToChat('Command usage: ' . $this->getUsage());
        }

        return $this->replyToChat($text);
    }
}
