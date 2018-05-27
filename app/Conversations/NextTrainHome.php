<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;

class NextTrainHome extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $client = app()->make('Matthewbdaly\TransportApi\Contracts\Client');
        $response = $client->getDepartures("NRW", "DIS");
        $departures = collect(json_decode($response->getBody()->getContents()))['departures']->all;
        eval(\Psy\Sh());
        $time = $departures[0]->expected_departure_time;
        $this->say("The next train is expected at $time", [
            'shouldEndSession' => true,
        ]);
    }
}
