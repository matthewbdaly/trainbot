<?php

namespace App\Services\Train;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use App\Contracts\Services\Train\Client as ClientContract;

class Client implements ClientContract
{
    protected $client;

    protected $messageFactory;

    protected $appId;

    protected $key;

    public function __construct($appId, $key, HttpClient $client = null, MessageFactory $messageFactory = null)
    {
        $this->client = $client ?: HttpClientDiscovery::find();
        $this->messageFactory = $messageFactory ?: MessageFactoryDiscovery::find();
        $this->appId = $appId;
        $this->key = $key;
    }

    public function getDepartures($from, $to = null)
    {
        $query = http_build_query([
            'app_id' => $this->appId,
            'app_key' => $this->key,
            'destination' => $to,
            'train_status' => 'passenger'
        ]);
        $url = "http://transportapi.com/v3/uk/train/station/$from/live.json?$query";
        $request = $this->messageFactory->createRequest('GET', $url);
        return $this->client->sendRequest($request);
    }
}
