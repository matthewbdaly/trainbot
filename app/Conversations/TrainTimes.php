<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class TrainTimes extends Conversation
{
    public function askDeparture()
    {
        $this->ask('What station will you be departing from?', function (Answer $answer) {
            $this->departing = $answer->getText();
            $this->askDestination();
        });
    }

    public function askDestination()
    {
        $this->ask('What station will you be travelling to?', function (Answer $answer) {
            $this->destination = $answer->getText();
            $this->say("OK, you are travelling from $this->departing to $this->destination");
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askDeparture();
    }
}
