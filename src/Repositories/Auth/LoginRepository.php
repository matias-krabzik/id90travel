<?php

namespace IdTravel\Challenge\Repositories\Auth;

use GuzzleHttp\Client;

class LoginRepository
{

    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['http_errors' => false]);
    }

    public function login($params)
    {
        return $this->client->post('https://beta.id90travel.com/session.json', [
            'headers' => [
                'Content-Type' => 'application/json',
                'charset' => 'utf-8'
            ],
            'body' => json_encode($params)
        ]);
    }
}