<?php

namespace IdTravel\Challenge\Controllers;

use IdTravel\Challenge\Providers\AirlinesProvider;
use IdTravel\Challenge\Repositories\Airline\AirlineRepository;

class AirlinesController
{

    public function getAirlines(): void
    {
        $provider = new AirlinesProvider();
        $response = $provider->getAirlines(new AirlineRepository());
        if ($response->getStatusCode() === 200) {
            header('Content-Type: application/json; charset=utf-8');
            echo $response->getBody()->getContents();
            return;
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Invalid credentials', 'response' => $response->getStatusCode()]);
    }
}