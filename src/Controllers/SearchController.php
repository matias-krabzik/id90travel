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

    public function search(): void
    {
        $params = array_merge($_GET);
        $provider = new HotelProvider();
        $response = $provider->search(new HotelRepository(), $params);

        if ($response->getStatusCode() === 200) {
            $content = json_decode($response->getBody()->getContents());
            $data = [
                'member' => $_SESSION['session']->member,
                'results' => $content->hotels,
                'pagination' => [
                    'page' => $content->meta->page,
                    'total' => $content->meta->total_pages,
                    'url' => 'http://localhost:8881/search?' . http_build_query($params)
                ],
                'olds' => [
                    'destination' => $params['destination'] ?? '',
                    'checkin' => $params['checkin'] ?? '',
                    'checkout' => $params['checkout'] ?? '',
                    'guests' => $params['guests'] ?? '',
                ]
            ];
            echo view('search', $data);
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