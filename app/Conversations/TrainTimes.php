<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

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
            $this->getConfirmation();
        });
    }

    public function getConfirmation()
    {
        $question = Question::create("OK, you are travelling from $this->departing to $this->destination. Is that correct?")
            ->fallback('Unable to ask question')
            ->callbackId('confirmed')
            ->addButtons([
                Button::create('Yes')->value(1),
                Button::create('No')->value(0),
        ]);
        return $this->ask($question, function (Answer $answer) {
            if ($answer->getValue()) {
                $this->say("OK, the next train is at 2pm");
            } else {
                $this->askDeparture();
            }
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
