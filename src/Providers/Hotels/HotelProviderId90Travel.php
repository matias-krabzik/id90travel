<?php

namespace IdTravel\Challenge\Providers\Hotels;

use GuzzleHttp\Exception\GuzzleException;
use IdTravel\Challenge\Repositories\Hotel\HotelRepository;

class HotelProviderId90Travel implements HotelProviderInterface
{

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function search($params): array
    {
        $response = (new HotelRepository())->getHotels($params);
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Error interno. Intente mas tarde.');
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}