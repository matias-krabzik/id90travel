<?php

namespace IdTravel\Challenge\Providers\Hotels;

use GuzzleHttp\Exception\GuzzleException;
use IdTravel\Challenge\Repositories\Hotel\HotelRepository;

class HotelProviderId90Travel implements HotelProviderInterface
{

    /**
     * @throws GuzzleException
     */
    public function search($params): array
    {
        $response = (new HotelRepository())->getHotels($params);
        return json_decode($response->getBody()->getContents(), true);
    }
}