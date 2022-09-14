<?php

namespace IdTravel\Challenge\Providers;

use IdTravel\Challenge\Repositories\Hotel\HotelRepository;

class HotelProvider
{
    public function search($params): \Psr\Http\Message\ResponseInterface
    {
        return (new HotelRepository())->getHotels($params);
    }
}