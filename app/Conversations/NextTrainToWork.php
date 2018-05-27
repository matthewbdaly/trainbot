<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;

class NextTrainToWork extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $client = app()->make('Matthewbdaly\TransportApi\Contracts\Client');
        $response = $client->getDepartures("DIS", "NRW");
        $content = collect(json_decode($response->getBody()->getContents()));
        $time = $content['departures']->all[0]->expected_departure_time;
        $this->getBot()
             ->reply("The next train is expected at $time");
    }
}
