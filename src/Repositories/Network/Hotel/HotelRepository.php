<?php

namespace IdTravel\Challenge\Repositories\Network\Hotel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HotelRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['http_errors' => false]);
    }

    /**
     * @throws GuzzleException
     */
    public function getHotels($params): \Psr\Http\Message\ResponseInterface
    {
        return $this->client->get('https://beta.id90travel.com/api/v1/hotels.json', [
            'query' => [
                'guests[]' => $params['guests'] ?? '',
                'checkin' => $params['checkin'] ?? '',
                'checkout' => $params['checkout'] ?? '',
                'destination' => $params['destination'] ?? '',
                'keyword' => $params['keyword'] ?? '',
                'rooms' => $params['rooms'] ?? 1,
                'longitude' => $params['longitude'] ?? '',
                'latitude' => $params['latitude'] ?? '',
                'sort_criteria' => $params['sort_criteria'] ?? 'Overall',
                'sort_order' => $params['sort_order'] ?? 'desc',
                'per_page' => $params['per_page'] ?? 25,
                'page' => $params['page'] ?? 1,
                'currency' => $params['currency'] ?? 'USD',
                'price_low' => $params['price_low'] ?? '',
                'price_high' => $params['price_high'] ?? '',
            ]
        ]);
    }
}