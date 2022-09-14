<?php

namespace IdTravel\Challenge\Providers;

use IdTravel\Challenge\Repositories\Hotel\HotelRepository;

class HotelProvider
{
    public function search(HotelRepository $repository, $params)
    {
        return $repository->getHotels($params);
    }
}