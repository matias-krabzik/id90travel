<?php

namespace IdTravel\Challenge\Providers;

use IdTravel\Challenge\Repositories\Airline\AirlineRepository;

/**
 * Esta clase es un proveedor de servicio para las aerolineas.
 */
class AirlinesProvider
{
    public function getAirlines(): \Psr\Http\Message\ResponseInterface
    {
        return (new AirlineRepository())->getAirlines();
    }
}