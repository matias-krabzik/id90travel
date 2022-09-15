<?php

namespace IdTravel\Challenge\Providers\Airlines;

use IdTravel\Challenge\Repositories\Airline\AirlineRepository;

/**
 * Esta clase es un proveedor de servicio para las aerolineas.
 */
class AirlinesProvider implements AirlineProviderInterface
{
    public function getAirlines(): array
    {
        $response = (new AirlineRepository())->getAirlines();
        return json_decode($response->getBody()->getContents(), true);
    }
}