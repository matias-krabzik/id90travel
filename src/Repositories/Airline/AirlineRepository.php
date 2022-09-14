<?php

namespace IdTravel\Challenge\Repositories\Airline;

use GuzzleHttp\Client;

class AirlineRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['http_errors' => false]);
    }

    public function getAirlines()
    {
        return $this->client->get('https://beta.id90travel.com/airlines');
    }
}