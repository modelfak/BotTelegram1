<?php

namespace BotTelegram\bot\Commands;

use BotTelegram\bot\BotTelegram as Bt;
use BotTelegram\bot\Command;
use BotTelegram\Models\CommandsTelegram;
use BotTelegram\Models\UserService;

class UnsubscribeCommand extends Command{

    public static $command = '/unsubscribe';

    public function execute()
    {
        // TODO: Implement execute() method.

            $message = $this->getMessage();
            $chat_id = $message->getChat()->getId();
            $userid = $message->getFrom();

            $user_service = UserService::where('external_id', $userid->id)->first();
           
            if($user_service) {
                $user_service->subscribe = 0;
                $user_service->save();
                $this->telegram->sendAswer(self::$command);
            }
    }
}