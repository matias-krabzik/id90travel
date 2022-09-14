<?php

namespace IdTravel\Challenge\Controllers;

use IdTravel\Challenge\Providers\AirlinesProvider;
use IdTravel\Challenge\Repositories\Airline\AirlineRepository;

class AirlinesController
{
    private AirlinesProvider $provider;

    public function __construct()
    {
        $this->provider = new AirlinesProvider();
    }

    public function getAirlines()
    {
        $response = $this->provider->getAirlines(new AirlineRepository());
        if ($response->getStatusCode() === 200) {
            header('Content-Type: application/json; charset=utf-8');
            echo $response->getBody()->getContents();
            return;
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Invalid credentials', 'response' => $response->getStatusCode()]);
    }
}