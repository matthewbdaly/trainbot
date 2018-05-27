<?php

namespace Tests\BotMan;

use Tests\TestCase;
use Mockery as m;
use GuzzleHttp\Psr7\Response;

class NextTrainToWorkTest extends TestCase
{
    public function testGetTrainTime()
    {
        $client = m::mock('Matthewbdaly\TransportApi\Contracts\Client');
        $client->shouldReceive('getDepartures')
               ->with('DIS', 'NRW')
               ->once()
               ->andReturn(new Response(200, [], json_encode([
                   'departures' => [
                       'all' => [
                           ['expected_departure_time' => '11:00']
                       ]]])));

        $this->app->instance('Matthewbdaly\TransportApi\Contracts\Client', $client);
        $this->bot
             ->receives('Get me the next train to work')
             ->assertReply('The next train is expected at 11:00');
    }
}
