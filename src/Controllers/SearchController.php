<?php

namespace IdTravel\Challenge\Controllers;

use IdTravel\Challenge\Providers\HotelProvider;
use IdTravel\Challenge\Repositories\Hotel\HotelRepository;

class SearchController
{

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['session'])) {
            header("Location: http://localhost:8881/login", TRUE, 301);
            exit();
        }
    }

    public function searchView(): void
    {
        echo view('search', [
            'member' => $_SESSION['session']->member
        ]);
    }

    public function search(): void
    {
        $params = array_merge($_GET);
        $provider = new HotelProvider();
        $response = $provider->search(new HotelRepository(), $params);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody()->getContents());
            $floor = floor($data->meta->total_pages / 2);
            echo view('search', [
                'member' => $_SESSION['session']->member,
                'results' => $data->hotels,
                'pagination' => [
                    'page' => $data->meta->page,
                    'total' => $data->meta->total_pages,
                    'url' => 'http://localhost:8881/search?' . http_build_query($params)
                ],
                'olds' => [
                    'destination' => $params['destination'] ?? '',
                    'checkin' => $params['checkin'] ?? '',
                    'checkout' => $params['checkout'] ?? '',
                    'guests' => $params['guests'] ?? '',
                ]
            ]);
            exit();
        }

        echo view('search', [
            'error' => 'Invalid search',
            'member' => $_SESSION['session']->member,
            'results' => [],
            'olds' => [
                'destination' => $params['destination'] ?? '',
                'checkin' => $params['checkin'] ?? '',
                'checkout' => $params['checkout'] ?? '',
                'guests' => $params['guests'] ?? '',
            ]
        ]);
    }
}